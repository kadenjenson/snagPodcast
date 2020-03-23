<?php

namespace App\Http\Controllers;

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

        $response = Http::withToken(
            $token,
            $type
        )->get("https://www.buzzsprout.com/api/{$this->podID}/episodes.json");

        dd($response->headers(), $response->cookies(), $response->json());
    }

    /**
     * check when the source was last modified.
     *
     * @param string $eTag
     * @return null|array
     */
	protected function checkETag($eTag)
	{
	    return null;
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
