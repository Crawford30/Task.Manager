<?php

namespace App\Http\Controllers;

use App\User;
use App\AudioDVD;
use Illuminate\Http\Request;
use App\UserAudioDVDPermission;
use Illuminate\Support\Facades\DB;

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









}
