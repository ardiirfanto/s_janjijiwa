<?php

namespace App\Http\Controllers;

use App\Services\TwitterApiService;
use Illuminate\Http\Request;

class TestingDetilController extends Controller
{
    function getdata(){

        $get = TwitterApiService::search("kopi janji jiwa");

        echo json_encode($get);

    }
}
