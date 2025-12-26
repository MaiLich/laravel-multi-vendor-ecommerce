@extends('admin.layout.layout')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h5 class="mb-0">{{ $post->exists ? 'Chỉnh sửa bài viết' : 'Tạo bài viết mới' }}</h5>
  </div>

  <div class="card-body">
    <form method="POST" enctype="multipart/form-data"
          action="{{ $post->exists ? route('admin.blog.update',$post) : route('admin.blog.store') }}">
      @csrf @if($post->exists) @method('PUT') @endif

      <div class="row">
        {{-- Cột trái: nội dung chính --}}
        <div class="col-md-8">

          <div class="mb-3">
            <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title',$post->title) }}" required>
            @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Nội dung <span class="text-danger">*</span></label>
            <textarea name="content" rows="12" class="form-control" required>
{{ old('content',$post->content) }}</textarea>
            @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
            <select name="status" class="form-select">
              <option value="draft" {{ old('status',$post->status)=='draft'?'selected':'' }}>Bản nháp</option>
              <option value="published" {{ old('status',$post->status)=='published'?'selected':'' }}>Đã xuất bản</option>
            </select>
          </div>

          <button class="btn btn-primary">
            {{ $post->exists ? 'Cập nhật' : 'Tạo mới' }}
          </button>
        </div>

        {{-- Cột phải: thumbnail + preview ngắn --}}
        <div class="col-md-4">
          <div class="mb-3">
            <label class="form-label">Ảnh đại diện (Thumbnail)</label>
            <input type="file" name="thumbnail" class="form-control">
            @error('thumbnail')<div class="text-danger small">{{ $message }}</div>@enderror
          </div>

          @if($post->thumbnail)
            <div class="card border-0 shadow-sm">
              <div class="card-body p-2">
                <img src="{{ '/storage/'.$post->thumbnail }}"
                     alt="{{ $post->title }}"
                     class="img-fluid rounded mb-2">
                <div class="small text-muted">
                  <div class="font-weight-bold">{{ $post->title }}</div>
                  <div>{{ optional($post->published_at)->format('d/m/Y H:i') }}</div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>

    </form>
  </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector:'textarea[name="content"]',
    height: 500,
    menubar: false,
    plugins: 'link lists code',
    toolbar: 'undo redo | bold italic underline | bullist numlist | link | code'
  });
</script>
@endpush
@endsection