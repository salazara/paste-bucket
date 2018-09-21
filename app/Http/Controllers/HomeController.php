<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pastes = Paste::where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
        return view('home', ['pastes' => $pastes]);

    }
}
