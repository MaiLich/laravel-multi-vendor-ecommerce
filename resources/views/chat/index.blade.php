<!-- resources/views/chat/index.blade.php -->
<style>
    .chat-container {
        position: fixed;
        bottom: 80px;
        right: 20px;
        z-index: 1001;
    }

    #chat-window {
        width: 300px;
        height: 400px;
        background: white;
        border: 1px solid #ddd;
        display: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        border-radius: 10px;
        flex-direction: column;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    #chat-header {
        background: #1877f2;
        color: white;
        padding: 12px 15px;
        cursor: move;
        font-weight: 600;
        border-radius: 10px 10px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        user-select: none;
    }

    #chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background: #f8f9fa;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    #chat-footer {
        padding: 12px;
        border-top: 1px solid #e4e6eb;
        background: white;
        display: flex;
        gap: 8px;
        border-radius: 0 0 10px 10px;
    }

    #message-input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #dddfe2;
        border-radius: 20px;
        outline: none;
        font-size: 14px;
    }

    #message-input:focus {
        border-color: #1877f2;
    }

    #send-message {
        background: #1877f2;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    #send-message:hover {
        background: #166fe5;
    }

    #send-message:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .message {
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 18px;
        word-wrap: break-word;
        position: relative;
    }

    .message.sent {
        background: #1877f2;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 5px;
    }

    .message.received {
        background: #e4e6eb;
        color: #1c1e21;
        align-self: flex-start;
        border-bottom-left-radius: 5px;
    }

    .message-time {
        font-size: 11px;
        opacity: 0.7;
        margin-top: 4px;
        text-align: right;
    }

    #open-chat {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #1877f2;
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        z-index: 1000;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    #open-chat:hover {
        background: #166fe5;
        transform: scale(1.05);
    }

    #close-chat {
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: background-color 0.2s;
    }

    #close-chat:hover {
        background: rgba(255,255,255,0.2);
    }

    /* Responsive */
    @media (max-width: 480px) {
        .chat-container {
            right: 10px;
            bottom: 70px;
        }
        
        #chat-window {
            width: calc(100vw - 20px);
            height: 60vh;
        }
        
        #open-chat {
            right: 10px;
            bottom: 10px;
        }
    }

    /* Scrollbar styling */
    #chat-body::-webkit-scrollbar {
        width: 6px;
    }

    #chat-body::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    #chat-body::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    #chat-body::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<div class="chat-container">
    <div id="chat-window">
        <div id="chat-header">
            <span>💬 Chat với Admin</span>
            <button id="close-chat" title="Đóng chat">×</button>
        </div>
        <div id="chat-body">
            <!-- 
                UPDATE 1: Hiển thị tin nhắn từ biến $messages 
                Giả sử model Message có thuộc tính: content, sender_id, created_at
-->
            @if(isset($messages) && count($messages) > 0)
                @foreach($messages as $message)
                    <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                        {{ $message->content }}
                        <div class="message-time">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; color: #999; margin-top: 20px;">
                    Bắt đầu cuộc trò chuyện...
                </div>
            @endif
        </div>
        <div id="chat-footer">
            <input type="text" id="message-input" placeholder="Nhập tin nhắn..." autocomplete="off">
            <button id="send-message">Gửi</button>
        </div>
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
    </div>
</div>

<button id="open-chat" title="Mở chat">Chat</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Chat widget loaded');
    
    // ==========================================
    // UPDATE 2: YÊU CẦU BẮT BUỘC TỪ HÌNH ẢNH
    // Phải có conversationId lấy từ Blade
    // ==========================================
    window.conversationId = {{ isset($conversation) && $conversation ? $conversation->id : 'null' }};

// Kiểm tra xem ID có tồn tại không trước khi chạy các hàm khác
if (!conversationId) {
    console.warn('Chưa có ID cuộc trò chuyện (Conversation ID). Hãy kiểm tra Controller.');
} 
    
    const chatWindow = document.getElementById('chat-window');
    const openChatBtn = document.getElementById('open-chat');
    const closeChatBtn = document.getElementById('close-chat');
    const sendMessageBtn = document.getElementById('send-message');
    const messageInput = document.getElementById('message-input');
    const chatBody = document.getElementById('chat-body');
    const csrfToken = document.getElementById('csrf-token').value;

    // Scroll xuống cuối khi mới load trang nếu có tin nhắn
    chatBody.scrollTop = chatBody.scrollHeight;

    // Mở/đóng chat
    openChatBtn.addEventListener('click', function() {
        chatWindow.style.display = 'flex';
        openChatBtn.style.display = 'none';
        messageInput.focus();
        chatBody.scrollTop = chatBody.scrollHeight; // Scroll xuống cuối khi mở
    });

    closeChatBtn.addEventListener('click', function() {
        chatWindow.style.display = 'none';
        openChatBtn.style.display = 'block';
    });

    // Gửi tin nhắn
    function sendMessage() {
        const message = messageInput.value.trim();
        if (message) {
            // Thêm tin nhắn vào giao diện (Optimistic UI)
            addMessageToChat(message, 'sent');
            messageInput.value = '';
            
            // Gửi tin nhắn đến server sử dụng Fetch API
            fetch('/chat/send', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            // Sử dụng window.conversationId đã được tạo ở trên.
            conversation_id: window.conversationId && window.conversationId !== 'null' ? window.conversationId : null,
            message: message
        })
    })
    .then(response => {
        // Kiểm tra nếu server trả về lỗi (không phải JSON)
        if (!response.ok) {
            throw new Error('Server returned ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Message sent:', data);
        
        // QUAN TRỌNG: Cập nhật lại conversationId nếu server tạo mới hội thoại
        if (data.conversation_id) {
            // Cập nhật biến toàn cục để các tin nhắn sau không bị tạo mới hội thoại nữa
            window.conversationId = data.conversation_id; 
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // alert('Có lỗi xảy ra khi gửi tin nhắn. Vui lòng kiểm tra console.');
        // Có thể hiện thông báo lỗi nhỏ ở đây thay vì alert
    });
        }
    }

    function addMessageToChat(message, type) {
        const messageElement = document.createElement('div');
        messageElement.className = `message ${type}`;
        const now = new Date();
        const timeString = now.toLocaleTimeString('vi-VN', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageElement.innerHTML = `
            ${message}
            <div class="message-time">${timeString}</div>
        `;
        
        chatBody.appendChild(messageElement);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    // Event listeners
    sendMessageBtn.addEventListener('click', sendMessage);
    
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Tính năng kéo thả
    let isDragging = false;
    let startX, startY, initialX, initialY;

    document.getElementById('chat-header').addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', stopDrag);

    function startDrag(e) {
        isDragging = true;
        startX = e.clientX;
        startY = e.clientY;
        initialX = chatWindow.offsetLeft;
        initialY = chatWindow.offsetTop;
        chatWindow.style.cursor = 'grabbing';
    }

    function drag(e) {
        if (!isDragging) return;
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        chatWindow.style.left = `${initialX + dx}px`;
        chatWindow.style.top = `${initialY + dy}px`;
    }

    function stopDrag() {
        isDragging = false;
        chatWindow.style.cursor = 'default';
    }

    // Auto-focus khi mở chat bằng phím tắt
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            if (chatWindow.style.display === 'none') {
                openChatBtn.click();
            } else {
                messageInput.focus();
            }
        }
    });
});
</script>