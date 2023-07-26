<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // app/Models/Media.php
    protected $fillable = ['title', 'type', 'filename', 'description'];

}
