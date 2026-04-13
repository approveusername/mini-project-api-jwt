<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function handle_redis(){
        Redis::set('key', 'value');
        return $value = Redis::get('key');
    }
}
