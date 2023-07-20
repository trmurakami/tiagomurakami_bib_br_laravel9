<?php

namespace App\View\Components;

use GuzzleHttp\Client;
use Illuminate\View\Component;

class YoutubeChannel extends Component
{
    public $videos;

    public function __construct()
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $channelId = 'UCsXTceUDyix8zJ6L-Bw8IOw';
        $maxResults = 5; // You can change this number to get more or fewer videos.

        $client = new Client();
        $response = $client->get("https://www.googleapis.com/youtube/v3/search", [
            'query' => [
                'part' => 'snippet',
                'channelId' => $channelId,
                'maxResults' => $maxResults,
                'order' => 'date',
                'key' => $apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $this->videos = $data['items'];
    }

    public function render()
    {
        return view('components.youtube-channel');
    }
}