<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use stdClass;

class TwitterApiService
{

    static $authorization_key = "AAAAAAAAAAAAAAAAAAAAAAcSlQEAAAAAHpr5UhkIU1FR%2B2HRJMBMc9FXW0g%3Db0rjVfeP7gf3t5RcVG4ajyQTDOyJpDpFw5iJPkkm55cFynd1A0";
    static $twitter_url = "https://api.twitter.com/2/";

    static function search($query, $qty)
    {
        $url = 'tweets/search/recent';
        $client = new Client();
        $headers = [
            'authorization' => 'Bearer ' . self::$authorization_key,
        ];
        $req = new Request(
            'GET',
            self::$twitter_url . $url . '?query=' . $query . '&max_results=' . $qty . '&tweet.fields=author_id',
            $headers,
        );
        $res = $client->sendAsync($req)->wait();
        return json_decode($res->getBody(), true);
    }

    static function users($users)
    {
        $url = 'users';
        $client = new Client();
        $headers = [
            'authorization' => 'Bearer ' . self::$authorization_key,
        ];
        $request = new Request(
            'GET',
            self::$twitter_url . $url . '?ids=' . $users,
            $headers,
        );
        $res = $client->sendAsync($request)->wait();

        return json_decode($res->getBody(), true);
    }

    static function get($query, $qty = 10)
    {

        $array_post = [];

        // Get Twitter Posts
        $posts = self::search($query, $qty);
        $author_ids = "";
        $count_post = count($posts['data']);
        foreach ($posts['data'] as $key => $post) {
            $separator = ",";
            if ($key + 1 === $count_post) {
                $separator = "";
            }
            $author_ids .= $post['author_id'] . $separator;
        }

        // Get Twitter User
        $users = self::users($author_ids);
        $arr_combine = array_replace_recursive($posts['data'], $users['data']);

        foreach ($arr_combine as $val) {
            $arr = new stdClass;
            $arr->username = '@' . $val['username'];
            $arr->post = $val['text'];
            $array_post[] = $arr;
        }

        return $array_post;
    }
}
