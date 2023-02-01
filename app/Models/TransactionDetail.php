<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Item;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
