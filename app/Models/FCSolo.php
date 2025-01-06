<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FCSolo extends Model
{
    use HasFactory;

    protected $table = 'fc_solo';


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
