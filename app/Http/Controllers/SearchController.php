<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('main.posts.index', ['posts' => Post::where('title','LIKE','%'.request()->title.'%')->paginate(5)]);
    }
}
