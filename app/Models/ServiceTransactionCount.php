<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTransactionCount extends Model
{
    protected $fillable = ['service_id', 'transaction_count', 'quarter','year']; 

}
