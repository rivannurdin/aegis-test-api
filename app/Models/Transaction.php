<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasUuids;

    const STATUS_PAID    = 1;
    const STATUS_REFUND  = 2;

    const STATUS = [
        self::STATUS_PAID    => [
            'value' => self::STATUS_PAID, 
            'label' => 'Paid'
        ],
        self::STATUS_REFUND  => [
            'value' => self::STATUS_REFUND, 
            'label' => 'Refund'
        ],
    ];

    protected $table = 'transactions';

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id');
    }
}
