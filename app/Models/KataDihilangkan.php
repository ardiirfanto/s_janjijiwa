<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KataDihilangkan extends Model
{
    use HasFactory;

    protected $table = "kata_dihilangkan";

    public $timestamp = false;

    protected $fillable = [
        "kata"
    ];

}
