<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'
                => $this->id,

            'uuid'
                => $this->uuid,

            'order_number'
                => $this->order_number,

            'type'
                => $this->type,

            'status'
                => $this->status,

            'payment_status'
                => $this->payment_status,

            'customer_name'
                => $this->customer_name,

            'customer_email'
                => $this->customer_email,

            'customer_phone'
                => $this->customer_phone,

            'delivery_address'
                => $this->delivery_address,

            'notes'
                => $this->notes,

            'subtotal'
                => $this->subtotal,

            'tax'
                => $this->tax,

            'delivery_fee'
                => $this->delivery_fee,

            'discount'
                => $this->discount,

            'total'
                => $this->total,

            'items'
                => OrderItemResource::collection(
                    $this->whenLoaded('items')
                ),

            'placed_at'
                => $this->placed_at,
        ];
    }
}
