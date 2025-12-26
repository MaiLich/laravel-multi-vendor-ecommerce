@extends('front.layout.layout')

@section('content')

    {{-- HERO giống các trang Shop/Discounted --}}
    <section class="py-4" style="background:#f5f5f5;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="mb-2" style="font-size:32px;font-weight:600;">Blog</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-0" style="background:transparent;">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Blog
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    {{-- DANH SÁCH BÀI VIẾT – XẾP DỌC --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                @forelse($posts as $post)
                    <article class="card border-0 shadow-sm mb-4">
                        @if($post->thumbnail)
                            <a href="{{ route('front.blog.show', $post->slug) }}">
                                <img
                                    src="{{ asset('storage/'.$post->thumbnail) }}"
                                    class="card-img-top"
                                    alt="{{ $post->title }}"
                                    style="object-fit:cover;max-height:420px;"
                                >
                            </a>
                        @endif

                        <div class="card-body">
                            <h2 class="h4 mb-2">
                                <a href="{{ route('front.blog.show', $post->slug) }}"
                                   style="color:#222;text-decoration:none;">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <p class="text-muted small mb-2">
                                {{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }}
                                @if($post->author)
                                    · bởi {{ $post->author->name }}
                                @endif
                            </p>

                            <p class="mb-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 220) }}
                            </p>

                            <a href="{{ route('front.blog.show', $post->slug) }}" class="btn btn-outline-primary btn-sm">
                                Đọc thêm
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="text-center">Chưa có bài viết nào.</p>
                @endforelse

                {{-- PHÂN TRANG --}}
                @if(method_exists($posts, 'links'))
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
