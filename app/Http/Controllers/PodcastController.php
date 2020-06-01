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

    /**
     * sets up and executes our request.
     *
     * @param null|string $episodeID
     * @return void
     */
    protected function handleRequest($episodeID = null)
    {
        $type = "Token";
        $token = "token={$this->podApiToken}";

        $response = Http::withHeaders([
            "Authorization" => "Token token={$this->podApiToken}",
            "Cache-Control" => "max-age=604800000, public",
            "If-None-Match" => "",
            "If-Modified-Since" => ""
        ])->get("https://www.buzzsprout.com/api/{$this->podID}/episodes.json");

        if($response->successful())
        {
            $status = $response->status();
            if($status == "304 Not Modified" || $status == 304)
            {
                dd('No new episodes have been uploaded to BuzzSprout.');
            }
            else {
                dd($response->headers(), $response->json());
            }
            $this->checkETag($response->headers()["ETag"][0]);
        }
        else {
            dd('couldn\'t get podcast episodes from BuzzSprout.');
        }
    }

    /**
     * check when the source was last modified.
     *
     * @param string $eTag
     * @return null|array
     */
	protected function checkETag($eTag)
	{
	    dd($eTag);
//	    return null;
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
