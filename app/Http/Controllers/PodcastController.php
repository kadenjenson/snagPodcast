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
        // $episodes = $this->cleanResponse($episodes);

        echo '<pre>';
        var_dump(print_r($episodes));
        echo '</pre>';

        return $episodes;
    }

    public function cleanResponse($episodes)
    {
        $cleanedResponse = array();

        foreach ($episodes as $item) {
            $desc = preg_replace('/(<!--(\s|\S)*?-->)|(<\/?(\s|\S)*?>)/', '', $item['description']);

            array_push($cleanedResponse, (object)[
                'id' => $item['id'],
                'title' => $item['title'],
                'audioURL' => $item['audio_url'],
                'artURL' => $item['artwork_url'],
                'description' => strip_tags($item['description']),
                'tags' => $item['tags'],
                'created' => strtotime('m-d-Y', $item['published_at']),
            ]);

            // echo '<pre>';
            // var_dump(print_r(strip_tags($item['description'])), true);
            // // var_dump(print_r($desc), true);
            // // var_dump($item['description']);
            // echo '</pre>';
        }

        return $cleanedResponse;
    }

    public function show($episodeID)
    {
        $episode = $this->getPodcast($episodeID);

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
