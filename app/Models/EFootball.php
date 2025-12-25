<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EFootball extends Model
{
    use HasFactory;

    // Table name (important because it's not plural)
    protected $table = 'e_football';

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

    // Casts
    protected $casts = [
        'verified' => 'boolean',
    ];
}
