<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\User;
use App\MyHelpers\Upload;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $posts = Post::all();

            return DataTables::of($posts)->addIndexColumn()
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("posts.edit", [$row->id]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actiontwo', function($row){$btn = '<a href="'.route("posts.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['actionone','actiontwo'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.form', ['categories' => Category::get(), 'users' => User::all(), 'action' => 'post']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //upload only if request has main_image
        if($request->has('main_image')) $request->merge(['img' => Upload::uploadImage($request->main_image, 'posts' , $request->title)]);

        // Create Post
        $post = Post::create($request->except('_token', 'main_image'));

        return view('admin.posts.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $theCategory = Category::whereId($post->category_id)->first()->id;

        $theUser = User::whereId($post->user_id)->first()->id;


        return view('admin.posts.form', ['post' => $post,
        'categories' => Category::all(),
        'users' => User::all(),
        'theCategory' => $theCategory,
        'theUser' => $theUser,
        'action' => 'put',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // check if request has main_image
        if($request->has('main_image')) { $request->merge(['img' => Upload::uploadImage($request->main_image, 'posts' , $post->title)]); }

        // Update The Post
        $post->update($request->except('_token','main_image'));

        // Get It's name for make a special attachments folder for
        $postName = $post->title;

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $post->delete() ? redirect()->route('posts.index') : abort(500);
    }
}
