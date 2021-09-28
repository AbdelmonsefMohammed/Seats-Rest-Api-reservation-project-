<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanCommandsController extends Controller
{
    
    public function resetcache()
    {
        \Artisan::call('optimize:clear');
        \Artisan::call('config:cache');
        dd('cache clear successfully');
    }
}
