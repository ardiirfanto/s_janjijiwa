<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    public $timestamp = false;

    protected $fillable = [
        'kalimat',
        'kategori'
    ];

}
