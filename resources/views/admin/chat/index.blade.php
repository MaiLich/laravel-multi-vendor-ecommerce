@extends('admin.layout.layout')
<style>
.row { height: 90vh; margin: 0; padding: 0; overflow: hidden; }  /* Full height cho 2 cột, không scroll toàn trang */
.col-md-4 { height: 100%; overflow-y: auto; }  /* Cột trái scroll nếu nhiều */
.col-md-8 { height: 100%; display: flex; flex-direction: column; padding: 0; }  /* Cột phải full, column layout */
#chat-area { height: 100%; display: flex; flex-direction: column; }  /* Khu vực chat full size */
#chat-messages { flex: 1; overflow-y: auto; }  /* Tin nhắn scroll full height */
.conversation-item { transition: background 0.2s; padding: 1rem; border-bottom: 1px solid #ddd; }  /* Style list item */
.conversation-item:hover { background: #f0f0f0; cursor: pointer; }
.active { background: #e0e0e0 !important; }  /* Highlight khi chọn */
</style>
@section('title', 'Chat hỗ trợ khách hàng')

@section('content')
<div class="row" style="height: 90vh;">
    <!-- Danh sách người chat -->
    <div class="col-md-4 border-end bg-light" style="overflow-y: auto;">
        <div class="p-3 border-bottom">
            <h5>Khách hàng đang nhắn tin</h5>
        </div>
        @forelse($conversations as $conv)
            <div class="p-3 border-bottom conversation-item hover-bg" 
                 style="cursor: pointer;" 
                 onclick="openChat({{ $conv->id }})">
                <div class="d-flex">
                    <img src="{{ $conv->user->profile_photo ?? asset('admin/assets/img/avatars/1.png') }}" 
                         class="rounded-circle me-3" width="50" height="50">
                    <div class="flex-grow-1">
                        <strong>{{ $conv->user->name }}</strong>
                        <small class="d-block text-muted">
                            {{ $conv->latestMessage ? Str::limit($conv->latestMessage->message, 35) : 'Chưa có tin nhắn' }}
                        </small>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-5 text-center text-muted">
                <i class="fas fa-comments fa-3x mb-3"></i>
                <p>Chưa có tin nhắn nào</p>
            </div>
        @endforelse
    </div>

    <!-- Khu vực chat chi tiết -->
    <div class="col-md-8 d-flex flex-column">
        <div id="chat-area" class="flex-grow-1 p-4">
            <div class="text-center text-muted mt-5">
                <i class="fas fa-comment-dots fa-4x mb-3"></i>
                <h5>Chọn một khách hàng để bắt đầu chat</h5>
            </div>
        </div>
    </div>
</div>

<script>
function openChat(conversationId) {
    fetch(`/admin/chat/conversation/${conversationId}`)
        .then(r => r.text())
        .then(html => {
            document.getElementById('chat-area').innerHTML = html;
            // Highlight conversation được chọn
            document.querySelectorAll('.conversation-item').forEach(item => item.classList.remove('active'));
            document.querySelector(`.conversation-item[data-id="${conversationId}"]`)?.classList.add('active');
        });
}

function scrollToBottom() {
    const area = document.getElementById('chat-messages');
    if (area) area.scrollTop = area.scrollHeight;
}
</script>
@endsection