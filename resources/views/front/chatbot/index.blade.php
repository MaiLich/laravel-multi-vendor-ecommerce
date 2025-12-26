@extends('front.layout.layout')

@section('content')
<div class="container my-4">
    <h3 class="mb-3">Trợ lý Chatbot</h3>

    <div id="chatbot-app" class="card">
        <div class="card-body" style="height: 420px; overflow:auto;" id="chatbot-messages"></div>

        <div class="card-footer d-flex gap-2">
            <input id="chatbot-input" class="form-control" placeholder="Nhập tin nhắn..." />
            <button id="chatbot-send" class="btn btn-primary">Gửi</button>
        </div>
    </div>
</div>

<script>
  window.CHATBOT_BASE_URL = @json($chatbotBaseUrl);
</script>
<script>
  window.CHATBOT_BASE_URL = "http://127.0.0.1:8001";
</script>
<script src="/js/chatbot.js"></script>
@endsection
