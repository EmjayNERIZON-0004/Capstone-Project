<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class survey_verification extends Model
{
    protected $table = 'survey_verification';

    protected $fillable = ['transaction_no', 'status'];

    public $timestamps = true;
}
