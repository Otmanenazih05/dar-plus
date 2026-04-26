<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function send(int $userId, string $type, array $data): Notification
    {
        return Notification::create([
            'user_id' => $userId,
            'type'    => $type,
            'data'    => $data,
        ]);
    }

    public function newMessage(int $recipientId, array $context): Notification
    {
        return $this->send($recipientId, 'new_message', [
            'sender_name'     => $context['sender_name'],
            'sender_id'       => $context['sender_id'],
            'property_title'  => $context['property_title'],
            'property_id'     => $context['property_id'],
            'conversation_id' => $context['conversation_id'],
            'message_preview' => mb_substr($context['body'], 0, 100),
        ]);
    }

    public function listingSaved(int $sellerId, array $context): Notification
    {
        return $this->send($sellerId, 'listing_saved', [
            'buyer_name'     => $context['buyer_name'],
            'buyer_id'       => $context['buyer_id'],
            'property_title' => $context['property_title'],
            'property_id'    => $context['property_id'],
        ]);
    }

    public function listingPublished(int $sellerId, array $context): Notification
    {
        return $this->send($sellerId, 'listing_published', [
            'property_title' => $context['property_title'],
            'property_id'    => $context['property_id'],
        ]);
    }

    public function priceChanged(int $userId, array $context): Notification
    {
        return $this->send($userId, 'price_changed', [
            'property_title' => $context['property_title'],
            'property_id'    => $context['property_id'],
            'old_price'      => $context['old_price'],
            'new_price'      => $context['new_price'],
        ]);
    }
}
