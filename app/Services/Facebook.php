<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;

class Facebook
{
    private $longAccessToken;
    private $page_id;

    /**
     * Retrieve a long lasting access token (60 days) for authentication provding OAUTH has been used
     * to retrieve a short life access token through the facebook log in portal.
     */
    public function authenticate($page_id, $shortAccessToken)
    {
        $this->$page_id = $page_id;
        $response = Http::post('https://graph.facebook.com/oauth/access_token', [
            'grant_type' => env('fb_exchange_token'),
            'client_id' => env('APP-ID'),
            'client_secret' => env('APP-SECRET'),
            'fb_exchange_token' => $shortAccessToken,
            'client_id' => env('APP-ID'),
        ]);
        $this->longAccessToken = $response->access_token;
    }

    /**
     * Post a status update to the authenticated users facebook page. The status
     * provides a link to view the users selected post on post office.
     */
    public function postStatus(Post $post)
    {
        $post_link = route('posts.show', ['post' => $post]);
        $message = "Check out what I'm doing over on Post Office";

        $response = Http::post('https://graph.facebook.com/' . $this->page_id . '/feed', [
            'message' => $message,
            'access_token' => $this->longAccessToken,
            'link' => $post_link
        ]);

        if ($response->id) {
            return true;
        }
        return false;
    }
}