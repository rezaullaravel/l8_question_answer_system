<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveSetting extends Model
{
    use HasFactory;
    protected $fillable =[
        'approve_status',
    ];
}
