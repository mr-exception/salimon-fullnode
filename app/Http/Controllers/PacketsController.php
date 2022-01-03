<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacketsController extends Controller
{
    public function fetch(Request $request)
    {
        return ["ok" => true];
    }
    public function send(Request $request)
    {
        return ["ok" => true];
    }
}
