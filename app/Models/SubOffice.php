<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubOffice extends Model
{
    protected $table = 'sub_offices';
    protected $fillable = ['sub_office_id', 'sub_office_name', 'main_office_id','sub_office_admin','servicesCount'];

    // Define the inverse relationship
    public function mainOffice()
    {
        return $this->belongsTo(MainOffice::class, 'main_office_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'sub_office_id');
    }
}
