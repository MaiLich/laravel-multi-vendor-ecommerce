@extends('admin.layout.layout')
@section('content')
<div class="card">
  <div class="card-header"><h5 class="mb-0">{{ $post->exists ? 'Edit Post' : 'Create Post' }}</h5></div>
  <div class="card-body">
    <form method="POST" enctype="multipart/form-data"
      action="{{ $post->exists ? route('admin.blog.update',$post) : route('admin.blog.store') }}">
      @csrf @if($post->exists) @method('PUT') @endif

      <div class="mb-3">
        <label class="form-label">Title *</label>
        <input type="text" name="title" class="form-control" value="{{ old('title',$post->title) }}" required>
        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">

        @if($post->thumbnail)
          {{-- ĐƯỜNG DẪN TƯƠNG ĐỐI, KHÔNG PHỤ THUỘC APP_URL --}}
          <img src="{{ '/storage/'.$post->thumbnail }}" class="mt-2 rounded" height="80" alt="{{ $post->title }}">
        @endif

        @error('thumbnail')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Content *</label>
        <textarea name="content" rows="12" class="form-control" required>{{ old('content',$post->content) }}</textarea>
        @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Status *</label>
        <select name="status" class="form-select">
          <option value="draft" {{ old('status',$post->status)=='draft'?'selected':'' }}>Draft</option>
          <option value="published" {{ old('status',$post->status)=='published'?'selected':'' }}>Published</option>
        </select>
      </div>

      <button class="btn btn-primary">{{ $post->exists ? 'Update' : 'Create' }}</button>
    </form>
  </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script> tinymce.init({ selector:'textarea[name="content"]', height: 500 }); </script>
@endpush
@endsection
