<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = "announcements";
    protected $fillable = [
        'title',
        'content',
        'start_date',
        'end_date',
        'active',
    ];
}
