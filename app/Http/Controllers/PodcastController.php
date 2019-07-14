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

        $responseArr = $client->request('GET', "?api_token={$apiToken}");
        $responseObj = $this->cleanResponse(json_decode($responseArr->getBody()->getContents(), true));

        if ($responseObj->error === 'no')
        {
            // echo '<pre>';
            // var_dump($responseObj->episodes);
            // echo '</pre>';
            return $responseObj->episodes;
        }
        else {
            return view('pages.404');
        }
    }

    public function cleanResponse($episodes)
    {
        $response = (object)[
            'episodes' => array(),
            'error' => 'no'
        ];

        if ($episodes && $episodes !== null)
        {
            $len = count($episodes);
            for ($i = 0; $i < $len; $i++)
            {
                $item = $episodes[$i];
                array_push($response->episodes, (object)[
                    'id' => strval($item['id']),
                    'episodeNum' => $item['episode_number'],
                    'title' => $item['title'],
                    'audioURL' => $item['audio_url'],
                    'artURL' => $item['artwork_url'],
                    'description' => strip_tags($item['description']),
                    'summary' => $item['summary'],
                    'artist' => $item['artist'],
                    'tags' => $item['tags'],
                    'published' => date('m/d/Y', strtotime($item['published_at']))
                ]);
            }
        }
        else {
            $response->error = 'yes';
        }

        return $response;
    }

    public function show($episodeID)
    {
        $episode = $this->getPodcastByID($episodeID);
        // echo '<pre>';
        // var_dump($episode);
        // echo '</pre>';

        return view('pages.show', compact('episode'));
    }

    public function getPodcastByID($id)
    {
        $episodes = $this->requestAllPodcasts();

        foreach ($episodes as $item)
        {
            if ($item->id === $id)
            {
                return $item;
            }
        }
    }
}
