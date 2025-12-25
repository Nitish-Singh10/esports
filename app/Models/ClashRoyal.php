<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClashRoyal extends Model
{
    use HasFactory;

    // Table name (Laravel would expect clash_royals)
    protected $table = 'clash_royal';

    // Mass assignable fields
    protected $fillable = [
        'team_id',
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

    // Type casting
    protected $casts = [
        'verified' => 'boolean',
    ];
}
