<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainOffice extends Model
{
    protected $table = 'main_offices';
    protected $fillable = ['office_id', 'office_name', 'office_admin', 'subOfficeCount'];

    // Define the relationship
    public function subOffices()
    {
        return $this->hasMany(SubOffice::class, 'main_office_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'main_office_id');
    }
        protected static function boot()
    {
        parent::boot();

        static::deleting(function ($mainOffice) {
            $mainOffice->subOffices()->delete();
            $mainOffice->services()->delete();
        });
    }


    
}
