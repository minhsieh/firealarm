<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alarm;

class IndexController extends Controller
{
    public function index()
    {
        $alarms = Alarm::orderBy('created_at','DESC')->take(30)->get();
        return view('welcome',['alarms' => $alarms]);
    }

    public function privacy()
    {
        return view('privacy');
    }
}
