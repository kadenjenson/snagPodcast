<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PodcastController extends Controller
{
    public function index()
    {
        $episodes = $this->requestAllPodcasts();
        
        return view('pages.index', compact('episodes'));
    }

    public function requestAllPodcasts()
    {
        $buzzSproutID = env('BUZZSPROUT_ID');
        $apiToken = env('BUZZSPROUT_API_TOKEN');

        $url = "https://www.buzzsprout.com/api/{$buzzSproutID}/episodes.json";

        $client = new Client(['base_uri' => $url]);

        $response = $client->request('GET', "?api_token={$apiToken}");

        $episodes = json_decode($response->getBody()->getContents(), true);

        return $episodes;
    }

    public function show($episodeID)
    {
        $episode = $this->getPodcast($episodeID);

        // echo '<pre>';
        // var_dump($episode);
        // echo '</pre>';

        return view('pages.show', compact('episode'));
    }

    public function getPodcast($id)
    {
        $episodes = $this->requestAllPodcasts();

        foreach ($episodes as $item)
        {
            if ($item['id'] = $id)
            {
                return $item;
            }
        }
    }
}
