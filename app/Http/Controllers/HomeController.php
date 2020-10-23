<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\API\Routeros_api;

class HomeController extends Controller
{
    private $routeros_api = null;
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
}
