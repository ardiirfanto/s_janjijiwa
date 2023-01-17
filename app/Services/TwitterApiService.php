<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class TwitterApiService
{

    static $authorization_key = "AAAAAAAAAAAAAAAAAAAAAAcSlQEAAAAAHpr5UhkIU1FR%2B2HRJMBMc9FXW0g%3Db0rjVfeP7gf3t5RcVG4ajyQTDOyJpDpFw5iJPkkm55cFynd1A0";
    static $twitter_url = "https://api.twitter.com/2/";

    static function search($query, $qty = 10)
    {
        $url = 'tweets/search/recent';
        $client = new Client();
        $headers = [
            'authorization' => 'Bearer ' . self::$authorization_key,
        ];
        $req = new Request(
            'GET',
            self::$twitter_url . $url . '?query=' . $query . '&max_results=' . $qty,
            $headers,
        );
        $res = $client->sendAsync($req)->wait();
        return json_decode($res->getBody(), true);
    }
}
