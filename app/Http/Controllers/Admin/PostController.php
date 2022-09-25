<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    protected $validationRules = [
        'title' => 'required|string|min:3|max:255',
        'post_content' => 'required|min:3|string',
        'post_image' => 'active_url'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** 
         * Per recuperare i post dell'utente loggato
         * $posts = Post::where('user_id', Auth::id())->get();
        */
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
        $post = new Post();
        $tags = Tag::all();
        return view('admin.posts.create', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sentData = $request->validate($this->validationRules);
        $sentData = $request->all();
        $sentData['user_id'] = Auth::id();
        date_default_timezone_set('Europe/Rome');
        $sentData['post_date'] = new DateTime();
        $lastPostId = Post::orderBy('id', 'desc')->first();
        $sentData['slug'] = Str::slug($sentData['title'], '-'). '-' . ($lastPostId->id + 1);

        $post = new Post();
        $post->fill($sentData);
        $post->save();
        $post->tags()->sync($sentData['tags']);

        return redirect()->route('admin.posts.show', $sentData['slug'])->with('created', $sentData['title']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $sentData = $request->validate($this->validationRules);
        $post = Post::where('slug', $slug)->firstOrFail();
        $sentData['slug'] = Str::slug($sentData['title'], '-'). '-' . ($post->id);
        $post->update($sentData);
        $post->tags()->sync($sentData['tags']);

        return redirect()->route('admin.posts.show', $post->slug)->with('edited', $sentData['title']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
