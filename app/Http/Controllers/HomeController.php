<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pageToken()
    {
        if(!auth()->user()->hasRole('superadmin')){
            abort(403);
        }

        $user = User::find(auth()->user()->id);

        $client = new \GuzzleHttp\Client();

        $page_id = env('FACEBOOK_PAGE_ID','');
        if(empty($page_id)){
            abort(404);
        }

        $response = $client->request('GET', 'https://graph.facebook.com/'.$page_id.'?fields=access_token&access_token='.$user->facebook->token);

        $token = json_decode($response->getBody(),true);
        
        $valuestore = app('valuestore');
        $valuestore->put('page_access_token',$token['access_token']);

        return redirect()->back()->with('success','Page Access Token refresh success!');
    }
}
