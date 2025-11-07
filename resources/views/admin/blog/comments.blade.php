@extends('admin.layout.layout')
@section('content')
<h5 class="mb-3">Comments for: {{ $post->title }}</h5>
<div class="card">
  <div class="card-body table-responsive">
    <table class="table table-hover">
      <thead><tr><th>#</th><th>User</th><th>Content</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($post->comments as $c)
        <tr>
          <td>{{ $c->id }}</td>
          <td>{{ $c->user->name ?? 'User #'.$c->user_id }}</td>
          <td>{{ $c->content }}</td>
          <td><span class="badge bg-{{ $c->status=='approved'?'success':($c->status=='rejected'?'danger':'secondary') }}">{{ ucfirst($c->status) }}</span></td>
          <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
          <td class="d-flex gap-2">
            <form method="POST" action="{{ route('admin.blog.comments.approve',$c->id) }}">@csrf @method('PATCH')
              <button class="btn btn-sm btn-outline-success">Approve</button>
            </form>
            <form method="POST" action="{{ route('admin.blog.comments.reject',$c->id) }}">@csrf @method('PATCH')
              <button class="btn btn-sm btn-outline-danger">Reject</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">No comments</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
