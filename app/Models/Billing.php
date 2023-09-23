<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Billing extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'firstname',
        'lastname',
        'companyname',
        'address_1',
        'address_2',
        'city',
        'zone_id',
        'postcode',
        'email',
        'telephone'
    ];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function cancell()
    {
        return $this->hasMany(Cancellation::class);
    }
}
