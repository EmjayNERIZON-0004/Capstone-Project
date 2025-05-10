<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class survey_responses extends Model
{ protected $fillable = [
    'age', 'sex', 'customerType', 'main_office', 'office_transacted_with', 'service_availed',
    'aware_of_citizen_charter', 'saw_citizen_charter', 'used_citizen_charter',
    'sqd1', 'sqd2', 'sqd3', 'sqd4', 'sqd5', 'sqd6', 'sqd7', 'sqd8','remarks_type', 'remarks','sentiment'
];
}
