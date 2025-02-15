<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorPage extends Model
{
    protected $fillable = [
        'error_code',
        'title',
        'description'
    ];
}
