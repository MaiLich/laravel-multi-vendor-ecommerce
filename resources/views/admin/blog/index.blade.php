@extends('admin.layout.layout')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Bài viết Blog</h5>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm">
      <i class="mdi mdi-plus"></i> Tạo bài viết mới
    </a>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="thead-light">
          <tr>
            <th style="width:60px;">#</th>
            <th>Tiêu đề</th>
            <th style="width:120px;">Trạng thái</th>
            <th style="width:140px;">Tác giả</th>
            <th style="width:160px;">Ngày đăng</th>
            <th style="width:230px;" class="text-end">Thao tác</th>
          </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
          <tr>
            <td>{{ $post->id }}</td>
            <td>
              <a href="{{ route('front.blog.show',$post->slug) }}" target="_blank">
                {{ $post->title }}
              </a>
            </td>
            <td>
              @if($post->status === 'published')
                <span class="badge badge-success">Đã xuất bản</span>
              @else
                <span class="badge badge-secondary">Bản nháp</span>
              @endif
            </td>
            <td>{{ $post->author->name ?? 'Quản trị viên' }}</td>
            <td>{{ optional($post->published_at)->format('d/m/Y H:i') }}</td>
            <td class="text-end">
              <a href="{{ route('admin.blog.edit',$post) }}"
                 class="btn btn-sm btn-outline-primary">Chỉnh sửa</a>

              <form action="{{ route('admin.blog.toggle',$post) }}"
                    method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-warning">
                  {{ $post->status === 'published' ? 'Hạ bài' : 'Xuất bản' }}
                </button>
              </form>

              <a href="{{ route('admin.blog.comments',$post) }}"
                 class="btn btn-sm btn-outline-info">Bình luận</a>

              <form action="{{ route('admin.blog.destroy',$post) }}"
                    method="POST" class="d-inline"
                    onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Xóa</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">
              Chưa có bài viết nào.
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card-footer">
    {{ $posts->links() }}
  </div>
</div>
@endsection