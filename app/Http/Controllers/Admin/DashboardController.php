<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //Counts
        $postsCount = Post::count();
        $usersCount = User::count();
        $categoriesCount = Category::count();


        return view('admin.dashboard', compact('postsCount','usersCount','categoriesCount'));
    }
}
