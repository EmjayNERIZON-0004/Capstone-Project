<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoTransaction extends Model
{
    protected $table = 'no_transaction';

    protected $fillable = [
        'main_office_id',
        'month_year',
        'number_transaction',
    ];
    public function mainOffice()
    {
        return $this->belongsTo(MainOffice::class, 'main_office_id');
    }
}
