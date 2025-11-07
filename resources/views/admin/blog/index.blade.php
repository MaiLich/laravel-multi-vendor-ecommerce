@extends('admin.layout.layout')
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Blog Posts</h5>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm">Create Post</a>
  </div>
  <div class="card-body table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr><th>#</th><th>Title</th><th>Status</th><th>Author</th><th>Published</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td><a href="{{ route('front.blog.show',$post->slug) }}" target="_blank">{{ $post->title }}</a></td>
          <td><span class="badge {{ $post->status=='published'?'bg-success':'bg-secondary' }}">{{ ucfirst($post->status) }}</span></td>
          <td>{{ optional($post->author)->name }}</td>
          <td>{{ $post->published_at? $post->published_at->format('d/m/Y H:i') : '-' }}</td>
          <td class="d-flex gap-2">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.blog.edit',$post) }}">Edit</a>
            <form action="{{ route('admin.blog.toggle',$post) }}" method="POST">@csrf @method('PATCH')
              <button class="btn btn-sm btn-outline-warning">Toggle</button>
            </form>
            <a class="btn btn-sm btn-outline-info" href="{{ route('admin.blog.comments',$post) }}">Comments</a>
            <form action="{{ route('admin.blog.destroy',$post) }}" method="POST" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">No posts</td></tr>
        @endforelse
      </tbody>
    </table>
    {{ $posts->links() }}
  </div>
</div>
@endsection
