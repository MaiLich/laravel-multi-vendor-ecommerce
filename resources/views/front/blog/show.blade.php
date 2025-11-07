@extends('front.layout.layout')
@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <article class="mb-4">
        <h1 class="mb-2">{{ $post->title }}</h1>
        <p class="text-muted small mb-3">
          {{ $post->published_at? $post->published_at->format('d/m/Y H:i') : '' }} ·
          by {{ $post->author->name ?? 'Admin' }}
        </p>
        @if($post->thumbnail)
          <img class="img-fluid rounded mb-3" src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->title }}">
        @endif
        <div class="content">{!! $post->content !!}</div>
      </article>

      <section id="comments">
        <h4 class="mb-3">Bình luận ({{ $post->comments->count() }})</h4>

        @auth
        <form method="POST" action="{{ route('front.blog.comment.store',$post->slug) }}" class="mb-4">
          @csrf
          <textarea name="content" rows="4" class="form-control" placeholder="Viết bình luận của bạn...">{{ old('content') }}</textarea>
          @error('content')<div class="small text-danger">{{ $message }}</div>@enderror
          <button class="btn btn-primary mt-2">Gửi bình luận</button>
        </form>
        @else
        <div class="alert alert-info">Vui lòng <a href="{{ url('/login') }}">đăng nhập</a> để bình luận.</div>
        @endauth

        @forelse($post->comments as $c)
        <div class="border rounded p-3 mb-2">
          <strong>{{ $c->user->name ?? 'User #'.$c->user_id }}</strong>
          <span class="text-muted small"> · {{ $c->created_at->diffForHumans() }}</span>
          <p class="mb-0 mt-2">{{ $c->content }}</p>
        </div>
        @empty
          <p>Chưa có bình luận.</p>
        @endforelse
      </section>
    </div>

    <div class="col-lg-4">
      <h5 class="mb-3">Bài viết mới</h5>
      <ul class="list-unstyled">
        @foreach($related as $r)
          <li class="mb-2"><a href="{{ route('front.blog.show',$r->slug) }}">{{ $r->title }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
