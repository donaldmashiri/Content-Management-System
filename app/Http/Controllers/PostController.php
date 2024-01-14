<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create')
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // upload image
        $image = $request->image->store('posts');
        // create post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'contents' => $request->contents,
            'image' => $image,
            'user_id' => auth()->user()->id,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id,
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        // flash message
        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.create')
        ->with('post', $post)->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'contents', 'category_id']);
        // check if new image
        if($request->hasFile('image')){
            // upload it
            $image = $request->image->store('posts');
            // delete old one
            // Storage::delete($post->image);
            $post->deleteImage();

            $data['image'] = $image;

        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        $post->update($data);
        session()->flash('success', 'Post Updated Successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){
            // Storage::delete($post->image);
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Post deleted successfully');
        }else{
            $post->delete();
            session()->flash('success', 'Post trashed successfully');
        }

        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');
        return redirect(route('posts.index'));
    }

}
