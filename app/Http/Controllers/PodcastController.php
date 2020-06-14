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
    	return $this->getEpisodes();
    }

    /**
     * sets up and executes our request.
     *
     * @param null|string $episodeID
     * @return array
     */
    protected function getEpisodes($episodeID = null)
    {
        $cachedETag = Cache::get('ETag', '');
        $lastModified = Cache::get('LastModified', '');

        $response = Http::withHeaders([
            "Authorization" => "Token token={$this->podApiToken}",
            "If-None-Match" => "",
            "If-Modified-Since" => ""
        ])->get("https://www.buzzsprout.com/api/{$this->podID}/episodes.json");
        
        $this->handleHeaders($response->headers());
        $result = $this->handleResponse($response);
        if(sizeof($result))
        {
        	// redirect user to error page if no episodes are returned from response, or not found in the cache.
	        dd($response->headers(), $cachedETag, $lastModified, $result);
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
	    	var_dump('cached episodes');
		    return Cache::get('latestEpisodes', array());
	    }
	    elseif($status >= 400 || $status >= 305)
	    {
	    	return "Problem when trying to get episodes from BuzzSprout. Error code: {$status}";
	    }
	    else {
	    	var_dump('got latest episodes and cleaned them up.');
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
		    array_push($cleanedEpisodes, (object)[
			    'id' => intval($episode['id']),
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
		    ]);
	    }
    	
    	return $cleanedEpisodes;
    }

    /**
     * checks when the resource head was last modified.
     * if the cached eTag matches the resource, get episodes in DB.
     * if no cached eTag or empty DB table, GET episodes,
     * store in DB, and cache response's eTag.
     *
     * @return void|array
     */
    public function getAllEpisodes()
    {
        $this->handleRequest();
        // return array();
    }

    /**
     * gets episode from DB
     *
     * @param int $id
     * @return object
     */
	public function getEpisodeByID($id)
	{
	    return (object) [];
    }
}
