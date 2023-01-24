<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $fillable = [
        "testing_detil_id",
        "kalimat",
        "kategori"
    ];
}
