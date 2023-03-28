<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Category;
use App\Models\Technology;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();

        return view('admin.posts.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
       $data = $request->validate($request->rules());

       if(array_key_exists('img', $data)) {
        $imgPath = Storage::put('uploads', $data['img']);
        $data['img'] = $imgPath;
       }
   

       $slug = Str::slug($data['title']);

       $newProject = Post::create([
        'title'=> $data['title'],
        'slug'=> $slug,
        'content'=> $data['content'],
        'img'=> $data['img'],
       ]);

       return redirect()->route('admin.posts.show', $newProject->id)->with('success', 'Progetto aggiunto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $technologies = Technology::all();

        return view('admin.posts.edit', compact('post', 'categories', 'technologies'));
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
        $data = $request->validate($request->rules());
        

        if (array_key_exists('delete_img', $data)) {
            if($post->img) 
            Storage::delete($post->img);
            $post->img = null;
            $post->save();
        }

        else if(array_key_exists('img', $data)) {
            $imgPath = Storage::put('uploads', $data['img']);
            $data['img'] = $imgPath;

            if($post->img) {
                Storage::delete($post->img);
            }
           }
 
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->img = $data['img'];
        $post->save();

        return redirect()->route('admin.posts.show', $post->id)->with('success', 'Progetto aggiornato con successo');
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->img) {
            Storage::delete($post->img);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');

    }
}
