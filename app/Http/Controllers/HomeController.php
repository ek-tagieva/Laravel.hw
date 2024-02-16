<?php

namespace App\Http\Controllers;

use App\Category;
use App\Plant;
use Illuminate\Http\Request;

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
        $plants = Plant::query()->limit(9)->orderByDesc('id')->get();
        return view('main', ['plants' => $plants] );
    }

    public function about()
    {
        return view('about');
    }
}
