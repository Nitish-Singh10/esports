<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BgmiDuo extends Model
{
    use HasFactory;

    protected $table = 'bgmi_duo';


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
