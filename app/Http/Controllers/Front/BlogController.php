<?php

// app/Http/Controllers/Front/BlogController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index(){
        $posts = BlogPost::published()->latest('published_at')->paginate(9);
        return view('front.blog.index', compact('posts'));
    }

    public function show($slug){
        $post = BlogPost::published()->where('slug',$slug)
                ->with(['author','comments'=>fn($q)=>$q->where('status','approved')->latest()])
                ->firstOrFail();
        // Bài liên quan (simple)
        $related = BlogPost::published()->where('id','!=',$post->id)->latest('published_at')->take(4)->get();
        return view('front.blog.show', compact('post','related'));
    }
}
