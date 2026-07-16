<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id', 'reference', 'game_slug', 'game_name', 'package_name', 'amount',
    'player_id', 'payment_method', 'payer_number', 'transaction_id', 'status', 'admin_note',
])]
class Order extends Model
{
    use HasFactory;

    public const STATUSES = ['pending', 'processing', 'completed', 'cancelled'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
        ];
    }
}
