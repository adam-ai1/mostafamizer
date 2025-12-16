<?php

namespace Modules\MarketingBot\Entities;

use Str;
use App\Models\User;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\Metable;
use App\Traits\ModelTraits\hasFiles;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;
    use hasFiles;
    use Metable;
    use ModelTrait;
    use Filterable;

    /**
     * The table associated with the model's meta data.
     *
     * @var string
     */
    protected $metaTable = 'template_metas';

    /**
     * Boot the model.
     *
     * If the 'unique_identifier' field is not set, it will be set to a unique uuid.
     */
    protected static function booted() {
        static::creating(function ($m) {
            $m->unique_identifier = $m->unique_identifier ?: (string) Str::uuid();
        });
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
     * Returns an array of original template ids from the meta table.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function originalTemplateIds()
    {
        return $this->metas()->pluck('value', 'key') // [key => value]
            ->filter(function ($value, $key) {
                return $key === 'original_template_id';
            })
            ->values();
    }
}
