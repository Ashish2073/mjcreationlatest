<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Authenticatable
{
    use HasFactory;
    protected $table = "vendors";
    protected $fillable = [
        'name',
        'email',
        'otp',
        'otp_created_at',
        'email_verified_at',
        'password',
    ];


}
