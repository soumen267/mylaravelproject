<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'name',
        'description',
        'percentage',
        'maximum_value',
        'maximum_usage',
        'expires_at'
    ];

    protected $dates = ['deleted_at'];
    
    public $sortable = ['is_active'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }

}
