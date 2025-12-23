@extends('front.layout.layout')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      {{-- Bài viết --}}
      <article class="mb-5">
        {{-- Tiêu đề + meta --}}
        <header class="mb-4 text-center">
          <h1 class="mb-3" style="font-size: 2.2rem; font-weight: 700;">
            {{ $post->title }}
          </h1>
          <p class="text-muted mb-0" style="font-size: 0.9rem;">
            @if($post->published_at)
              {{ $post->published_at->format('d/m/Y H:i') }}
            @endif
            · bởi <span class="font-weight-semibold">{{ $post->author->name ?? 'Quản trị viên' }}</span>
          </p>
          <hr class="mt-3 mb-0" style="max-width: 120px; border-top: 2px solid #222; opacity:.8;">
        </header>

        {{-- Ảnh thumbnail --}}
        @if($post->thumbnail)
          <figure class="mb-4 text-center">
            <img class="img-fluid rounded shadow-sm"
                 src="{{ '/storage/'.$post->thumbnail }}"
                 alt="{{ $post->title }}"
                 style="max-height: 520px; object-fit: cover;">
          </figure>
        @endif

        {{-- Nội dung --}}
        <div class="content"
             style="font-size: 1.05rem; line-height: 1.8; color:#333;">
          {!! $post->content !!}
        </div>
      </article>

      {{-- Bình luận --}}
      <section id="comments" class="mt-5">
        <h4 class="mb-3">Bình luận ({{ $post->comments->count() }})</h4>

        @auth
          <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
              <form method="POST" action="{{ route('front.blog.comment.store',$post->slug) }}">
                @csrf
                <textarea name="content" rows="4" class="form-control"
                          placeholder="Viết bình luận của bạn..." required>{{ old('content') }}</textarea>
                @error('content')
                  <div class="small text-danger mt-1">{{ $message }}</div>
                @enderror
                <button class="btn btn-primary mt-3 px-4" type="submit">Gửi bình luận</button>
              </form>
            </div>
          </div>
        @else
          <div class="alert alert-info">
            Vui lòng <a href="{{ url('/user/login-register') }}">đăng nhập</a> để viết bình luận.
          </div>
        @endauth

        @forelse($post->comments as $c)
          <div class="card mb-3 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <strong>{{ $c->user->name ?? 'Người dùng #' . $c->user_id }}</strong>
                <span class="text-muted small">{{ $c->created_at->diffForHumans() }}</span>
              </div>
              <p class="mb-0">{{ nl2br(e($c->content)) }}</p>
            </div>
          </div>
        @empty
          <p class="text-muted">Chưa có bình luận nào. Hãy là người đầu tiên!</p>
        @endforelse
      </section>

    </div>

    {{-- Sidebar bài viết mới --}}
    <div class="col-lg-3 mt-5 mt-lg-0">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0">
          <h5 class="mb-0">Bài viết mới nhất</h5>
        </div>
        <div class="list-group list-group-flush">
          @forelse($related as $r)
            <a href="{{ route('front.blog.show',$r->slug) }}"
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
              {{ $r->title }}
              <small class="text-muted">{{ $r->published_at? $r->published_at->format('d/m') : '' }}</small>
            </a>
          @empty
            <div class="list-group-item text-muted">Chưa có bài viết khác.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection