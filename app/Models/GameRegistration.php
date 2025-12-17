<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRegistration extends Model
{
    use HasFactory;

    protected $table = 'game_registrations';

    protected $fillable = [
        'game',
        'category',
        'amount',
        'full_name',
        'phone',
        'email',
        'college_name',
        'transaction_id',
        'verified',
    ];
}
