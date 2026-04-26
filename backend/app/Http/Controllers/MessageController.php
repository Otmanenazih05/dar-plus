<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Conversation;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private function getAuthorizedConversation(int $conversationId, int $userId): Conversation
    {
        return Conversation::where('id', $conversationId)
            ->where(function ($q) use ($userId) {
                $q->where('buyer_id', $userId)->orWhere('seller_id', $userId);
            })
            ->firstOrFail();
    }

    public function index(Request $request, $conversationId)
    {
        $conversation = $this->getAuthorizedConversation($conversationId, $request->user()->id);

        $messages = $conversation->messages()
            ->with('sender')
            ->oldest()
            ->get();

        return MessageResource::collection($messages);
    }

    public function store(Request $request, $conversationId)
    {
        $conversation = $this->getAuthorizedConversation($conversationId, $request->user()->id);

        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'body'      => $data['body'],
        ]);

        $conversation->update(['last_message_at' => now()]);

        $recipientId = $conversation->buyer_id === $request->user()->id
            ? $conversation->seller_id
            : $conversation->buyer_id;

        $conversation->load('property');

        (new NotificationService())->newMessage($recipientId, [
            'sender_name'     => $request->user()->name,
            'sender_id'       => $request->user()->id,
            'property_title'  => $conversation->property->title,
            'property_id'     => $conversation->property_id,
            'conversation_id' => $conversation->id,
            'body'            => $data['body'],
        ]);

        $message->load('sender');

        return new MessageResource($message);
    }

    public function markRead(Request $request, $conversationId)
    {
        $conversation = $this->getAuthorizedConversation($conversationId, $request->user()->id);

        $conversation->messages()
            ->where('sender_id', '!=', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'Messages marked as read.']);
    }
}
