<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  
    protected $fillable = ['main_office_id', 'sub_office_id', 'service_name','services_type'];

    // Define relationships
    public function mainOffice()
    {
        return $this->belongsTo(MainOffice::class, 'main_office_id');
    }

    public function subOffice()
    {
        return $this->belongsTo(SubOffice::class, 'sub_office_id');
    }
}
