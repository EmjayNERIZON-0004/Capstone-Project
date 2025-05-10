<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Accounts extends Model
{
    protected $table = 'accounts';

    protected $fillable = ['accountID', 'passcode', 'account_type', 'last_login'];
    protected $hidden = ['passcode']; // Ensures passcode isn't exposed in queries

    public function setPasscodeAttribute($value)
    {
        $this->attributes['passcode'] = Hash::make($value);
    }
}
