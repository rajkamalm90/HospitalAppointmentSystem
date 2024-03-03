<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contacts extends Model
{
    use HasFactory,SoftDeletes;
    // In your Contact model
protected $fillable = ['name', 'email', 'phone', 'subject', 'message'];

}
