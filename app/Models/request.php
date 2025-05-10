<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class request extends Model
{
    protected $fillable = ['main_office_id', 'request_type', 'status'];

    public function mainOffice()
    {
        return $this->belongsTo(MainOffice::class);
    }
}
