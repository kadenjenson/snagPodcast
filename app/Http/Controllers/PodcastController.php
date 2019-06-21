<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PodcastController extends Controller
{
    public function index()
    {
        $buzzSproutID = env('BUZZSPROUT_ID');
        $apiToken = env('BUZZSPROUT_API_TOKEN');

        $url = "https://www.buzzsprout.com/api/{$buzzSproutID}/episodes.json";
        // $url = "https://www.buzzsprout.com/api/{$buzzSproutID}/1263065-episode-16-a-fifty-dollar-glass-of-pepsi-robbie-and-susanna-s-story/episode.json";

        $client = new Client(['base_uri' => $url]);

        $response = $client->request('GET', "?api_token={$apiToken}");

        $body = json_decode($response->getBody()->getContents(),true);
        echo '<pre>';
        var_dump(print_r($body));
        echo '</pre>';

       return view('pages.index', compact('body'));
    }

    // public function setupPodcasts($data)
    // {
        
    // }
}
