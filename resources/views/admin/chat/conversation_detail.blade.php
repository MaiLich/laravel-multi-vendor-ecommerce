<style>
    .h-100 { height: 100%; }
    .flex-grow-1 { flex-grow: 1; }
    .mb-3 { margin-bottom: 1rem; }
    .text-end { text-align: right; }
    .rounded { border-radius: 0.5rem; }
    .opacity-75 { opacity: 0.75; }
    .input-group textarea { resize: none; }
</style>

<div class="d-flex flex-column h-100">
    <!-- Header tên khách hàng -->
    <div class="bg-primary text-white p-3 rounded-top">
        <h6 class="mb-0">
            <i class="mdi mdi-account"></i> {{ $conversation->user->name }}
        </h6>
    </div>

    <!-- Khu vực hiển thị tin nhắn -->
    <div id="chat-messages" class="flex-grow-1 p-3" style="overflow-y: auto; max-height: 65vh; background-color: #f8f9fa;">
        @foreach($messages as $msg)
            <div class="mb-3 {{ $msg->sender_id == auth('admin')->id() ? 'text-end' : '' }}">
                <div class="d-inline-block p-3 rounded shadow-sm {{ $msg->sender_id == auth('admin')->id() ? 'bg-primary text-white' : 'bg-white border' }}"
                     style="max-width: 75%;">
                    {!! nl2br(e($msg->message)) !!}
                    <small class="d-block mt-2 opacity-75">
                        {{ $msg->created_at->format('H:i - d/m/Y') }}
                    </small>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Form gửi tin nhắn -->
    <div class="p-3 border-top bg-light rounded-bottom">
        <form id="chat-form-{{ $conversation->id }}"
              onsubmit="sendAdminMessage({{ $conversation->id }}); return false;">
            @csrf
            <div class="input-group">
                <textarea id="msg-input-{{ $conversation->id }}"
                          class="form-control border-primary"
                          rows="3"
                          placeholder="Nhập tin nhắn của bạn..."
                          required></textarea>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="mdi mdi-send"></i> Gửi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const ADMIN_ID = {{ auth('admin')->id() }};
    const CONV_ID  = {{ $conversation->id }};

    function renderMessage(msg) {
        const isMe = msg.sender_type === 'App\\Models\\Admin' && msg.sender_id === ADMIN_ID;

        const wrapper = document.createElement('div');
        wrapper.className = 'mb-3 ' + (isMe ? 'text-end' : '');

        const time = new Date(msg.created_at);
        const timeStr = time.toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'}) +
                        ' - ' + time.toLocaleDateString('vi-VN');

        wrapper.innerHTML = `
            <div class="d-inline-block p-3 rounded shadow-sm ${isMe ? 'bg-primary text-white' : 'bg-white border'}"
                 style="max-width: 75%;">
                ${msg.message.replace(/\n/g, '<br>')}
                <small class="d-block mt-2 opacity-75">${timeStr}</small>
            </div>
        `;
        return wrapper;
    }

    function loadMessages(convId) {
        const container = document.getElementById('chat-messages');

        fetch('{{ url("/admin/chat/messages") }}/' + convId + '?t=' + Date.now())
            .then(r => r.json())
            .then(list => {
                if (!Array.isArray(list)) return;
                container.innerHTML = '';
                list.forEach(msg => container.appendChild(renderMessage(msg)));
                container.scrollTop = container.scrollHeight;
            })
            .catch(err => console.error('Lỗi tải tin nhắn:', err));
    }

    // GỬI TIN NHẮN TỪ ADMIN
    function sendAdminMessage(convId) {
        const input = document.getElementById('msg-input-' + convId);
        const msg   = input.value.trim();
        if (!msg) return;

        fetch('{{ url("/admin/chat/send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                conversation_id: convId,
                message: msg
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.error) {
                alert('Lỗi: ' + data.error);
                return;
            }
            input.value = '';
            loadMessages(convId);
        })
        .catch(err => {
            console.error('Lỗi gửi tin nhắn:', err);
            alert('Không thể gửi tin nhắn. Vui lòng thử lại sau!');
        });
    }

    // TỰ ĐỘNG TẢI TIN NHẮN KHI TRANG SẴN SÀNG
    document.addEventListener('DOMContentLoaded', function () {
        loadMessages(CONV_ID);

        // Tự động tải tin mới mỗi 5 giây
        setInterval(() => loadMessages(CONV_ID), 5000);
    });
</script>