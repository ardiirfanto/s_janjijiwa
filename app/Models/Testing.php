<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $fillable = [
        "nama_testing",
        "tgl_testing"
    ];
}
