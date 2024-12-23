<?php

namespace App\Models;

use App\Observers\ObservesWrites;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organisation extends Model
{
    /** @use HasFactory<\Database\Factories\OrganisationFactory> */
    use HasFactory,
        ObservesWrites;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'color',
        'address',
        'vision_statement',
        'mission_statement'
    ];

    /**
     *
     * @return BelongsToMany
     *
     */
    public function structures(): BelongsToMany
    {
        return $this->belongsToMany(Structure::class)->withPivot([
            'line_manager',
            'structure_path'
        ])->withTimestamps();
    }
}
