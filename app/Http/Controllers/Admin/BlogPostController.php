<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogPostController extends Controller
{
    // index
    public function index(){
        Session::put('page', 'blog');
        $posts = BlogPost::latest()->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create(){
        Session::put('page', 'blog');
        return view('admin.blog.form', ['post' => new BlogPost()]);
    }

    public function store(StoreBlogPostRequest $request){
        $data = $request->validated();

        // LẤY ID THEO GUARD admin
        $data['author_id'] = Auth::guard('admin')->id();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('blog','public');
            $data['thumbnail'] = $path;

            // 👉 COPY sang public/storage/blog
            $from = storage_path('app/public/'.$path);
            $to   = public_path('storage/'.$path);

            if (!file_exists(dirname($to))) {
                mkdir(dirname($to), 0755, true);
            }
            copy($from, $to);
        }
        if ($data['status']==='published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success','Post created');
    }


    public function edit(BlogPost $post){
        Session::put('page', 'blog');
        return view('admin.blog.form', compact('post'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $post){
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {

            // xóa ảnh cũ (cả storage & public)
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
                @unlink(public_path('storage/'.$post->thumbnail));
            }

            $path = $request->file('thumbnail')->store('blog','public');
            $data['thumbnail'] = $path;

            // 👉 COPY sang public/storage/blog
            $from = storage_path('app/public/'.$path);
            $to   = public_path('storage/'.$path);

            if (!file_exists(dirname($to))) {
                mkdir(dirname($to), 0755, true);
            }
            copy($from, $to);
        }

        if($data['status']==='published' && !$post->published_at){
            $data['published_at'] = now();
        }

        $post->update($data);
        return redirect()->route('admin.blog.index')->with('success','Post updated');
    }

    public function destroy(BlogPost $post){
        if ($post->thumbnail) Storage::disk('public')->delete($post->thumbnail);
        $post->delete();
        return back()->with('success','Post deleted');
    }

    public function toggle(BlogPost $post){
        $post->status = $post->status==='published' ? 'draft' : 'published';
        if ($post->status==='published' && !$post->published_at) $post->published_at = now();
        $post->save();
        return back()->with('success','Status updated');
    }

    // Duyệt comment nhanh trong admin
    public function comments(BlogPost $post){
        Session::put('page', 'blog'); 
        $post->load(['comments.user']);
        return view('admin.blog.comments', compact('post'));
    }
    public function approveComment($commentId){
        \App\Models\BlogComment::where('id',$commentId)->update(['status'=>'approved']);
        return back()->with('success','Comment approved');
    }
    public function rejectComment($commentId){
        \App\Models\BlogComment::where('id',$commentId)->update(['status'=>'rejected']);
        return back()->with('success','Comment rejected');
    }
}
