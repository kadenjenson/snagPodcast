<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * PodcastController
 *
 * this handles HTTP GET requests to BuzzSprout's api.
 * it also will utilize a model for storing the responses
 * in our database.
 * @class
 */
class PodcastController extends Controller
{
    private $podID;

    private $podApiToken;

    public function __construct()
    {
        $this->podID = env('BUZZ_SPROUT_ID');
        $this->podApiToken = env('BUZZ_SPROUT_API_TOKEN');
    }
    
    public function index()
    {
    	$episodes = $this->getEpisodes();
    	
    	return view('pages.home', compact('episodes'));
    }
    
    public function show($episodeID)
    {
    	$episode = $this->getEpisodeByID($episodeID);
    	
    	return view('pages.show', compact('episode'));
    }
	
	/**
	 * gets episode from cache. If none are stored then send request to get them.
	 *
	 * @param int $id
	 * @return object
	 */
	public function getEpisodeByID($id)
	{
		$cachedEpisodes = Cache::get('latestEpisodes', array());
		
		$episode = $cachedEpisodes[$id];
		if(sizeof($cachedEpisodes) && $episode)
		{
			return $episode;
		}
		else {
			$result = $this->getEpisodes();
			if(isset($result[$id]))
			{
				return $result[$id];
			}
			return redirect('error', "Looks like we have a 'snag' of our own and can't find that episode! Please refresh the page to try again.");
		}
	}

    /**
     * gets array of episodes from BuzzSprout or cache.
     */
    protected function getEpisodes()
    {
        $response = Http::withHeaders([
            "Authorization" => "Token token={$this->podApiToken}",
            "If-None-Match" => Cache::get('ETag', ''),
            "If-Modified-Since" => Cache::get('LastModified', '')
        ])->get("https://www.buzzsprout.com/api/{$this->podID}/episodes.json");
        
        $this->handleHeaders($response->headers());
        
        $result = $this->handleResponse($response);
        if(!sizeof($result) || !is_array($result))
        {
        	// redirect user to error page if no episodes are returned from response, or not found in the cache.
	        return redirect('error', compact('result'));
        }
	    return $result;
    }
    
    protected function handleHeaders($headers)
    {
    	if(sizeof($headers))
	    {
		    if(sizeof($headers['ETag']))
		    {
			    Cache::put('ETag', $headers['ETag'][0]);
		    }
		
		    if(sizeof($headers['Last-Modified']))
		    {
			    Cache::put('LastModified', $headers['Last-Modified'][0]);
		    }
	    }
    }
    
    protected function handleResponse($response)
    {
    	$status = $response->status();
	    if($status == "304 Not Modified" || $status == 304)
	    {
		    return Cache::get('latestEpisodes', array());
	    }
	    elseif($status >= 400 || $status >= 305)
	    {
	    	return $status;
	    }
	    else {
	    	$episodes = $this->cleanEpisodes($response->json());
	    	
	    	Cache::put('latestEpisodes', $episodes);
	    	return $episodes;
	    }
    }
    
    protected function cleanEpisodes($episodes)
    {
    	$cleanedEpisodes = array();
	    foreach($episodes as $episode)
	    {
	    	$episodeID = intval($episode['id']);
	    	$cleanedEpisodes[$episodeID] = (object)[
			    'id' => $episodeID,
			    'episodeNum' => $episode['episode_number'],
			    'seasonNum' => $episode['season_number'],
			    'published' => date('m/d/Y', strtotime($episode['published_at'])),
			    'title' => $episode['title'],
			    'description' => strip_tags($episode['description']),
			    'summary' => $episode['summary'],
			    'artist' => $episode['artist'],
			    'tags' => explode(", ", $episode['tags']),
			    'audioUrl' => $episode['audio_url'],
			    'artworkUrl' => $episode['artwork_url']
		    ];
	    }
    	return $cleanedEpisodes;
    }
}
