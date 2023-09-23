<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use HasFactory, Prunable, SoftDeletes;

    protected $table = "wishlistss";

    public function user(){
        return $this->belongsTo(User::class);
     }
     
     public function product(){
        return $this->belongsTo(Product::class);
     }

     public function prunable(): Builder{
        return $this->where('created_at', '<=', now()->subDays(14));
     }


}
