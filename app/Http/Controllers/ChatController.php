<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // ==================================================================
    // 1. USER TRUY CẬP CHAT (khách hàng mở trang chat)
    // ==================================================================
    public function index()
    {
        try {
            if (!Auth::check()) {
                return view('chat.index', [
                    'conversation' => null,
                    'messages'     => [],
                    'adminError'   => false
                ]);
            }

            $admin = Admin::where('type', 'superadmin')->first();
            if (!$admin) {
                Log::error('Không tìm thấy superadmin');
                return view('chat.index', ['conversation' => null, 'messages' => [], 'adminError' => true]);
            }

            $conversation = Conversation::firstOrCreate([
                'user_id'  => Auth::id(),
                'admin_id' => $admin->id
            ]);

            $messages = $conversation->messages()
                ->with('sender')
                ->orderBy('created_at', 'asc')
                ->get();

            return view('chat.index', compact('conversation', 'messages'));
        } catch (\Exception $e) {
            Log::error('Chat index error: ' . $e->getMessage());
            return view('chat.index', ['conversation' => null, 'messages' => [], 'error' => true]);
        }
    }

    // ==================================================================
    // 2. ADMIN TRUY CẬP TRANG CHAT (trang chính /admin/chat)
    // ==================================================================
    public function adminIndex()
{
    // LẤY TẤT CẢ CONVERSATION MÀ admin_id = ID admin hiện tại đang login
    $conversations = Conversation::with(['user', 'latestMessage'])
        ->where('admin_id', auth('admin')->id())
        ->orderByDesc('updated_at')
        ->get();

    // Nếu chưa có conversation nào thì hiển thị trống
    $selectedConversation = $conversations->first();
    $messages = collect();

    if ($selectedConversation) {
        $messages = Message::where('conversation_id', $selectedConversation->id)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    return view('admin.chat.index', compact('conversations', 'selectedConversation', 'messages'));
}

    // ==================================================================
    // 3. ADMIN XEM CHI TIẾT 1 CUỘC TRÒ CHUYỆN (AJAX)
    // ==================================================================
    public function adminShowConversation($id)
{
    $conversation = Conversation::with(['user', 'messages.sender'])
        ->where('id', $id)
        ->where('admin_id', auth('admin')->id()) // BẮT BUỘC PHẢI LÀ ADMIN NÀY
        ->firstOrFail();

    return view('admin.chat.conversation_detail', [
        'conversation' => $conversation,
        'messages'     => $conversation->messages
    ]);
}

    // ==================================================================
    // 4. GỬI TIN NHẮN (dùng chung user & admin)
    // ==================================================================
    public function sendMessage(Request $request)
{
    $request->validate([
        'message'         => 'required|string|max:1000',
        'conversation_id' => 'nullable|integer|exists:conversations,id',
    ]);

    try {
        // XÁC ĐỊNH RÕ REQUEST ĐI TỪ ĐÂU
        $isAdminRoute = $request->is('admin/*'); // /admin/chat/send thì true

        if ($isAdminRoute) {
            // ĐANG Ở KHU VỰC ADMIN
            if (!auth('admin')->check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $senderId   = auth('admin')->id();
            $senderType = \App\Models\Admin::class;
        } else {
            // FRONTEND USER
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $senderId   = Auth::id();
            $senderType = \App\Models\User::class;
        }

        $conversation = null;

        // Nếu client gửi kèm conversation_id thì lấy ra
        if ($request->filled('conversation_id')) {
            $conversation = Conversation::find($request->conversation_id);
        }

        // ===== TRƯỜNG HỢP USER GỬI LẦN ĐẦU (CHƯA CÓ CONVERSATION) =====
        if (!$conversation && !$isAdminRoute) {
            $superAdmin = Admin::where('type', 'superadmin')->first()
                        ?? Admin::first();

            if (!$superAdmin) {
                return response()->json(['error' => 'Không có admin nào trong hệ thống'], 500);
            }

            $conversation = Conversation::firstOrCreate(
                ['user_id'  => $senderId],
                ['admin_id' => $superAdmin->id]
            );
        }

        // ===== TRƯỜNG HỢP ADMIN GỬI MÀ KHÔNG CÓ CONVERSATION =====
        if (!$conversation && $isAdminRoute) {
            return response()->json(['error' => 'Không tìm thấy cuộc trò chuyện'], 404);
        }

        // ===== KIỂM TRA QUYỀN =====
        $allowed =
            (!$isAdminRoute && $conversation->user_id  == $senderId) ||
            ( $isAdminRoute && $conversation->admin_id == $senderId);

        if (!$allowed) {
            return response()->json(['error' => 'Bạn không có quyền gửi tin trong cuộc trò chuyện này'], 403);
        }

        // ===== TẠO MESSAGE =====
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $senderId,
            'sender_type'     => $senderType,
            'message'         => $request->message,
            'is_read'         => false,
        ]);

        $conversation->touch();

        return response()->json([
            'status'          => 'success',
            'message'         => $message->load('sender'),
            'conversation_id' => $conversation->id,
            'updated_at'      => $conversation->updated_at,
        ]);
    } catch (\Exception $e) {
        Log::error('Send message error: ' . $e->getMessage() . ' | Line: ' . $e->getLine());
        return response()->json(['error' => 'Server error'], 500);
    }
}


    // ==================================================================
    // 5. LẤY TIN NHẮN (AJAX)
    // ==================================================================
    public function getMessages($conversationId)
    {
        try {
            $conversation = Conversation::findOrFail($conversationId);

            $userId  = Auth::id();
            $adminId = auth('admin')->id();

            if ($conversation->user_id !== $userId && $conversation->admin_id !== $adminId) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $messages = $conversation->messages()
                ->with('sender')
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json($messages);
        } catch (\Exception $e) {
            Log::error('Get messages error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}