<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\Property;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $conversations = Conversation::where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->with(['buyer', 'seller', 'property.coverMedia', 'lastMessage'])
            ->orderByDesc('last_message_at')
            ->get();

        return ConversationResource::collection($conversations);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;

        $conversation = Conversation::where('id', $id)
            ->where(function ($q) use ($userId) {
                $q->where('buyer_id', $userId)->orWhere('seller_id', $userId);
            })
            ->with(['buyer', 'seller', 'property.coverMedia', 'messages.sender'])
            ->firstOrFail();

        return new ConversationResource($conversation);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message'     => 'required|string|max:2000',
        ]);

        $property = Property::findOrFail($data['property_id']);

        if ($property->user_id === $request->user()->id) {
            return response()->json(['message' => 'You cannot message yourself about your own listing.'], 422);
        }

        $conversation = Conversation::firstOrCreate(
            [
                'buyer_id'    => $request->user()->id,
                'seller_id'   => $property->user_id,
                'property_id' => $property->id,
            ],
            ['last_message_at' => now()]
        );

        $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'body'      => $data['message'],
        ]);

        $conversation->update(['last_message_at' => now()]);

        $conversation->load(['buyer', 'seller', 'property.coverMedia', 'lastMessage']);

        return new ConversationResource($conversation);
    }
}
