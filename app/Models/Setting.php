<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'navmenu',
        'info',
        'custominfo',
        'contactinfo',
        'quickview',
        'footerbackground',
        'headerbackground'
    ];

        public function images()
        {
            return $this->hasMany(Image::class, 'setting_id');
        }
}
