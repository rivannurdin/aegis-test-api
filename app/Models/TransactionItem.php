<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TransactionItem extends Model
{
    use HasUuids;

    protected $table = 'transaction_items';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
