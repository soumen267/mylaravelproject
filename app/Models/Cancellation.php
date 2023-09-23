<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cancellation extends Model
{
    use HasFactory, Notifiable;

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'billing_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
