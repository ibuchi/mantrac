<?php

namespace App\Models;

use App\Observers\ObservesWrites;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    /** @use HasFactory<\Database\Factories\StructureFactory> */
    use HasFactory,
        ObservesWrites;

    protected $fillable = [
        'name'
    ];
}
