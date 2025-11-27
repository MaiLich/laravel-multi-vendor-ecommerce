<?php

// app/Http/Controllers/Front/BlogCommentController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StoreBlogCommentRequest;
use App\Models\BlogComment;
use App\Models\BlogPost;

class BlogCommentController extends Controller
{
    public function store(StoreBlogCommentRequest $request, $slug){
        $post = BlogPost::where('slug',$slug)->firstOrFail();

        BlogComment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->validated()['content'],
            'status'  => 'pending'
        ]);

        return back()->with('success','Bình luận đã gửi, chờ duyệt!');
    }
}
