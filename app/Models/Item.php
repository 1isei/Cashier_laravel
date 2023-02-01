<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Transaction;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class, 'item_id');
    }

    public function transaction(){
        return $this->hasManyThrough(Transaction::class, TransactionDetail::class);
    }
}