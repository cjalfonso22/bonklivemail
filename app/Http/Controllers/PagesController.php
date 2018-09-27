<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PagesController extends Controller
{
    public function tracker(){
        return view('tracker.tracker');
    }
    
    public function help(){
        return view('pages.help');
    }

    // public function track(){
    //     $log = "Successfully logged!";

    //     $trackerLog = new Logger(tracker);
    //     $trackerLog->pushHandler(new StreamHandler(storage_path('logs/tracker.log')), Logger::INFO);
    //     $trackerLog->info('TrackerLog', $log);
    // }
}