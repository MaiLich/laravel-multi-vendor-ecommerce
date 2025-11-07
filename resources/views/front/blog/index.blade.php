@extends('front.layout.layout')
@section('content')
<div class="container py-4">
  <h2 class="mb-4">Blog</h2>
  <div class="row g-4">
    @forelse($posts as $post)
    <div class="col-md-4">
      <div class="card h-100">
        @if($post->thumbnail)
          <a href="{{ route('front.blog.show',$post->slug) }}">
            <img src="{{ asset('storage/'.$post->thumbnail) }}" class="card-img-top" alt="{{ $post->title }}">
          </a>
        @endif
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">
            <a href="{{ route('front.blog.show',$post->slug) }}">{{ $post->title }}</a>
          </h5>
          <p class="text-muted small mb-3">
            {{ $post->published_at? $post->published_at->format('d/m/Y') : '' }} ·
            by {{ $post->author->name ?? 'Admin' }}
          </p>
          <a class="mt-auto btn btn-outline-primary" href="{{ route('front.blog.show',$post->slug) }}">Read more</a>
        </div>
      </div>
    </div>
    @empty
      <p>Chưa có bài viết.</p>
    @endforelse
  </div>
  <div class="mt-4">{{ $posts->links() }}</div>
</div>
@endsection
