<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodTeam extends Model
{
    use HasFactory;

    protected $table = 'cod_mobile_team';

    protected $fillable = [
        'name',
        'class',
        'rollno',
        'phone_no',
        'email',
        'pay_mode',
        'transaction_id',
        'college',
        'amount',
        'added_by',
        'verified',
        'slot',
    ];

    protected $casts = [
        'verified' => 'boolean',
    ];
}
