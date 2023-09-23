<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'image',
        'status',
        'description'
    ];

    protected $dates = ['deleted_at'];
    
    public $sortable = ['name', 'sku','status'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
     }

     public function view()
     {
         return $this->hasMany(View::class);
     }

     public function coupon()
     {
         return $this->hasMany(Coupon::class);
     }

}
