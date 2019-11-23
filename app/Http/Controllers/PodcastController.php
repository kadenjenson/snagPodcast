<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PodcastController extends Controller
{
    public function index()
    {
        $episodes = self::requestAllPodcasts();
        
        return view('pages.index', compact('episodes'));
    }

    private static function requestAllPodcasts()
    {
        $buzzSproutID = env('BUZZSPROUT_ID');
        $apiToken = env('BUZZSPROUT_API_TOKEN');

        $url = "https://www.buzzsprout.com/api/{$buzzSproutID}/episodes.json";
        $client = new Client(['base_uri' => $url]);

        $response = $client->request('GET', "?api_token={$apiToken}");
        $result = self::cleanResponse($response);

        if ($result->error === 'no')
        {
            // echo '<pre>';
            // var_dump($result->episodes);
            // echo '</pre>';
            return $result->episodes;
        }
        else {
            return redirect('error');
        }
    }

    private static function cleanResponse($response)
    {
        $result = (object)[
            'episodes' => array(),
            'error' => 'no',
            'message' => ''
        ];

        $status = $response->getStatusCode();
        if ($status !== 200)
        {
            $result->error = 'yes';
            $result->message = $response->getReasonPhrase();
            return $result;
        }

        $episodes = json_decode($response->getBody()->getContents(), true);
        for ($i = 0, $len = sizeof($episodes); $i < $len; $i++)
        {
            $item = $episodes[$i];
            $tags = explode(', ', $item['tags']);

            array_push($result->episodes, (object)[
                'id' => intval($item['id']),
                'episode' => $item['episode_number'],
                'season' => $item['season_number'],
                'title' => $item['title'],
                'audioURL' => $item['audio_url'],
                'artURL' => $item['artwork_url'],
                'description' => strip_tags($item['description']),
                'summary' => $item['summary'],
                'artist' => $item['artist'],
                'tags' => $tags,
                'published' => date('m/d/Y', strtotime($item['published_at']))
            ]);
        }
        // echo '<pre>';
        // var_dump($result);
        // echo '</pre>';
        return $result;
    }

    public function show($episodeID)
    {
        $episode = $this->getPodcastByID($episodeID);
        // echo '<pre>';
        // var_dump($episode);
        // echo '</pre>';

        return view('pages.show', compact('episode'));
    }

    protected function getPodcastByID($id)
    {
        $episodes = self::requestAllPodcasts();
        foreach ($episodes as $item)
        {
            if ($item->id === $id)
            {
                return $item;
            }
        }
    }
}
