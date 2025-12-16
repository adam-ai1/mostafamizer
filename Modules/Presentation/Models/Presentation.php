<?php

namespace Modules\Presentation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic',
        'style',
        'language',
        'slides_count',
        'slides',
    ];

    protected $casts = [
        'slides' => 'array',
        'slides_count' => 'integer',
    ];

    /**
     * Get the user that owns the presentation
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
