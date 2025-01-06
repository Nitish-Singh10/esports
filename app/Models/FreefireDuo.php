<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreefireDuo extends Model
{
    use HasFactory;

    protected $table = 'freefire_duo';


    protected $fillable = [
        'name',
        'class',
        'rollno',
        'phone_no',
        'email',
        'pay_mode',
        'transaction_id',
        'amount',
    ];
}
