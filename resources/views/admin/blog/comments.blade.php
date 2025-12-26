@extends('admin.layout.layout')

@section('content')
    <h5 class="mb-3">Bình luận cho bài viết: {{ $post->title }}</h5>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($post->comments as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->user->name ?? 'Người dùng #'.$c->user_id }}</td>
                            <td>{{ $c->content }}</td>
                            <td>
                                <span class="badge bg-{{ $c->status=='approved'?'success':($c->status=='rejected'?'danger':'secondary') }}">
                                    {{ $c->status == 'approved' ? 'Đã duyệt' : ($c->status == 'rejected' ? 'Đã từ chối' : 'Chờ duyệt') }}
                                </span>
                            </td>
                            <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                            <td class="d-flex gap-2">
                                <form method="POST" action="{{ route('admin.blog.comments.approve',$c->id) }}">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success">Duyệt</button>
                                </form>
                                <form method="POST" action="{{ route('admin.blog.comments.reject',$c->id) }}">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-danger">Từ chối</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có bình luận nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection