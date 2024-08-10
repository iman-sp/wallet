<?php

namespace App\Http\Resources\Transaction;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'updated_at' => Carbon::parse($this->getRawOriginal('updated_at'))->getTimestamp(),
            'created_at' => Carbon::parse($this->getRawOriginal('created_at'))->getTimestamp(),
        ];
    }
}
