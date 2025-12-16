<?php

namespace Modules\OpenAI\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MediaManager\Http\Models\ObjectFile;
use App\Traits\ModelTraits\hasFiles;
use App\Traits\ModelTraits\Metable;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use App\Models\User;
use Str;

class VideoJob extends Model
{
    use HasFactory;
    use hasFiles;
    use Metable;
    use ModelTrait;
    use Filterable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $fillable = [
        'user_id','unique_identifier','provider','provider_task_id','status','result_url', 'error','attempt','max_attempts','next_check_at'
    ];

    protected $casts = [
        'next_check_at' => 'datetime',
    ];

    /**
     * Relation with User model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Boot the model.
     *
     * If the 'public_id' field is not set, it will be set to a unique uuid.
     */
    protected static function booted() {
        static::creating(function ($m) {
            $m->public_id = $m->public_id ?: (string) Str::uuid();
        });
    }

    

}


