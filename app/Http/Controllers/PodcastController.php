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
        $buzzID = env('BUZZSPROUT_ID');
        $apiToken = env('BUZZSPROUT_API_TOKEN');

        $url = "https://www.buzzsprout.com/api/{$buzzID}/episodes.json";
        $client = new Client();

        // $response = $client->request('GET', "?api_token={$apiToken}");
        // $result = self::cleanResponse($response);

        $request = $client->createRequest("GET", "https://www.buzzsprout.com/api/{$buzzID}/episodes.json");
        $response = $client->get('http://httpbin.org/get',
        [
            'headers' => ['Authorization' => 'Token token={$apiToken}']
        ]);

        echo '<pre>';
        var_dump($response->getHeaders());
        echo '</pre>';
        die;

        // $request->setHeader('Authorization', ['Token', "token={$apiToken}"]);

        // $response = $client->send($request);
        // $headers = $response->getHeaders();

        if ($result->error === 'no')
        {
            // echo '<pre>';
            // var_dump($result->episodes);
            // echo '</pre>';
            return $result->episodes;
        }
        else {
            return redirect('error', compact('result'));
        }
    }

    private static function cleanResponse($response)
    {
        $result = (object)[
            'episodes' => array(),
            'error' => 'no',
            'status' => null,
            'message' => ''
        ];

        $result->status = $response->getStatusCode();
        if ($result->status !== 200)
        {
            $result->error = 'yes';
            $result->message = $response->getReasonPhrase();
            return $result;
        }

        $episodes = json_decode($response->getBody()->getContents(), true);
        foreach ($episodes as $item)
        {
            array_push($result->episodes, (object) [
                'id' => intval($item['id']),
                'episode' => $item['episode_number'],
                'season' => $item['season_number'],
                'title' => $item['title'],
                'audioUrl' => $item['audio_url'],
                'artUrl' => $item['artwork_url'],
                'description' => strip_tags($item['description']),
                'summary' => $item['summary'],
                'artist' => $item['artist'],
                'tags' => explode(', ', $item['tags']),
                'published' => date('m/d/Y', strtotime($item['published_at']))
            ]);
        }

        return $result;
    }

    public function show($episodeID)
    {
        $episode = $this->getPodcastByID($episodeID);
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
