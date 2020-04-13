<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }


    public function index()
    {
        $posts = Post::all();
        return view('pages.backend.posts.postsHome')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.posts.postsCreateUpdate')->with('categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        
        $image = $request->image->store('posts');

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
        ]);

        session()->flash('success','Post Created Successfully');

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('pages.backend.posts.postsCreateUpdate')->with('posts',$post)->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','content','published_at','category']);
        
        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $post->deleteImage();


            $data['image'] = $image;
        }
        

        $post->update($data);
        
        session()->flash('success','Post Updated Successfully');

        return redirect(route('post.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }
        else{
            $post->delete();
        }
        session()->flash('success','Post Deleted Successfully');
        return redirect(route('post.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('pages.backend.posts.postsHome')->withPosts($trashed);
    }

    public function restore($id)
    {
         $post=Post::withTrashed()->where('id',$id)->firstorFail();
         $post->restore();
         session()->flash('success','Post Restored Successfully');
         return redirect()->back();
    }
}
