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
	
	public function show($id)
	{
		$episode = $this->getEpisodeByID($id);
		
		return view('pages.show', compact('episode'));
	}
	
	/**
	 * gets episode from cache. If none are stored then send request to get them.
	 *
	 * @param int $id
	 * @return object|bool
	 */
	public function getEpisodeByID(int $id)
	{
		$cachedEpisodes = Cache::get('latestEpisodes', array());
		
		$episode = $cachedEpisodes[$id];
		if(sizeof($cachedEpisodes) && $episode)
		{
			return $episode;
		}
		else
		{
			$result = $this->getEpisodes();
			if(isset($result[$id]))
			{
				return $result[$id];
			}
			
			return false;
		}
	}
    
    /**
     * gets array of episodes from BuzzSprout or cache.
     *
     * @return array
     */
    protected function getEpisodes()
    {
        $request = Http::withHeaders([
            "Authorization" => "Token token={$this->podApiToken}",
            "If-None-Match" => Cache::get('ETag', ''),
            "If-Modified-Since" => Cache::get('LastModified', '')
        ]);
        
        $response = $request->get("https://www.buzzsprout.com/api/{$this->podID}/episodes.json");
        return $this->handleResponse($response);
    }
    
    protected function handleResponse($response)
    {
        $this->handleHeaders($response->headers());
        $status = $this->handleStatus($response->status());
        $episodes = $response->json();
        
        if(!$episodes || $status === 304)
        {
            $episodes = Cache::get('latestEpisodes', array());
        }
        else
        {
            $latestEpisodes = $this->cleanEpisodes($episodes);
            Cache::put('latestEpisodes', $latestEpisodes);
        }
        return $episodes;
    }
    
    protected function handleHeaders($headers)
    {
    	if(sizeof($headers))
	    {
            $eTag = $headers['etag'] ?? $headers['ETag'];
		    if($eTag && sizeof($eTag))
		    {
			    Cache::put('ETag', $eTag[0]);
		    }
		
		    $lastModified = $headers['last-modified'] ?? $headers['Last-Modified'];
		    if($lastModified && sizeof($lastModified))
		    {
			    Cache::put('LastModified', $lastModified[0]);
		    }
	    }
    }
    
    protected function handleStatus($status)
    {
        if($status == 304 || $status == "304 Not Modified")
        {
            $cachedEpisodes = Cache::get('latestEpisodes', array());
            if(!sizeof($cachedEpisodes))
            {
                Cache::put('ETag', '');
                Cache::put('LastModified', '');
                return 304;
            }
        }
        elseif($status >= 305)
        {
            redirect('error', $status);
        }
        
        return true;
    }
    
    protected function cleanEpisodes($episodes = array())
    {
    	$cleanedEpisodes = array();
	    foreach($episodes as $episode)
	    {
	    	$episodeID = intval($episode['id']);
	    	$cleanedEpisodes[$episodeID] = (object)[
			    'id' => $episodeID,
			    'episodeNum' => $episode['episode_number'],
			    'seasonNum' => $episode['season_number'],
			    'publishedAt' => date('l M jS, Y', strtotime($episode['published_at'])),
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
