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
    <!-- Header tên khách -->
    <div class="bg-primary text-white p-3">
        <h6 class="mb-0">{{ $conversation->user->name }}</h6>
    </div>

    <!-- Khu vực tin nhắn -->
    <div id="chat-messages" class="flex-grow-1 p-3" style="overflow-y: auto; max-height: 65vh;">
        @foreach($messages as $msg)
            <div class="mb-3 {{ $msg->sender_id == auth('admin')->id() ? 'text-end' : '' }}">
                <div class="d-inline-block p-3 rounded {{ $msg->sender_id == auth('admin')->id() ? 'bg-primary text-white' : 'bg-light' }}"
                     style="max-width: 75%;">
                    {!! nl2br(e($msg->message)) !!}
                    <small class="d-block mt-1 opacity-75">{{ $msg->created_at->format('H:i d/m') }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Form gửi tin -->
    <div class="p-3 border-top bg-light">
        <form id="chat-form-{{ $conversation->id }}"
              onsubmit="sendMessage(event, {{ $conversation->id }}); return false;">
            @csrf
            <div class="input-group">
                <textarea id="msg-input-{{ $conversation->id }}"
                          class="form-control"
                          rows="2"
                          placeholder="Nhập tin nhắn..."
                          required></textarea>
                <button type="submit" class="btn btn-primary">Gửi</button>
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
        wrapper.className = 'mb-2 ' + (isMe ? 'text-end' : '');
        wrapper.innerHTML = `
            <div class="d-inline-block px-3 py-2 rounded ${isMe ? 'bg-primary text-white' : 'bg-light'}">
                ${msg.message}
                <div class="small opacity-75 mt-1">${(new Date(msg.created_at)).toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'})}</div>
            </div>
        `;
        return wrapper;
    }

    function loadMessages(convId) {
        const container = document.getElementById('messages-container-{{ $conversation->id }}');

        fetch('{{ url("/admin/chat/messages") }}/' + convId + '?t=' + Date.now())
            .then(r => r.json())
            .then(list => {
                if (!Array.isArray(list)) return;
                container.innerHTML = '';
                list.forEach(msg => container.appendChild(renderMessage(msg)));
                container.scrollTop = container.scrollHeight;
            })
            .catch(err => console.error('Load messages error:', err));
    }

    // GỬI TIN NHẮN
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
                alert(data.error);
                return;
            }
            input.value = '';
            loadMessages(convId);
        })
        .catch(err => {
            console.error('Gửi tin lỗi:', err);
            alert('Không gửi được tin nhắn. Vui lòng thử lại!');
        });
    }

    // GẮN SỰ KIỆN SUBMIT CHO FORM (CHẶN RELOAD)
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('chat-form-{{ $conversation->id }}');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            sendAdminMessage(CONV_ID);
        });

        loadMessages(CONV_ID);
    });
</script>
