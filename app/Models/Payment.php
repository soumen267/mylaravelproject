<?php

namespace App\Models;

use App\Mail\OrderConfirmation;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory,SoftDeletes,Sortable;

    public $sortable = ['order_id','created_at'];

    // public static function boot() {
  
    //     parent::boot();
  
    //     static::created(function ($item) {
                
    //         $adminEmail = "soumen8412@gmail.com";
    //         Mail::to($adminEmail)->send(new OrderConfirmation($item));
    //     });
    // }
    protected $foreignkey = 'productname';
    public function billing()
    {
        return $this->belongsTo(Billing::class, 'billing_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productname');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
