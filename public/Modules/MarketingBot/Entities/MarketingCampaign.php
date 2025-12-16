<?php

namespace Modules\MarketingBot\Entities;

use Str;
use App\Models\User;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\Metable;
use App\Traits\ModelTraits\hasFiles;
use App\Traits\ModelTraits\Filterable;
use Modules\OpenAI\Entities\EmbededResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarketingCampaign extends Model
{
    use HasFactory;
    use hasFiles;
    use Metable;
    use ModelTrait;
    use Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'marketing_campaigns';

    /**
     * The table associated with the model's meta data.
     *
     * @var string
     */
    protected $metaTable = 'marketing_campaign_metas';

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
     * Retrieve training materials associated with the campaign.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trainedMaterials()
    {
        return $this->hasMany(EmbededResource::class, 'user_id', 'user_id')
            ->where('category', 'campaign')
            ->whereNull('parent_id')
            ->whereHas('metas', fn($q) => $q->where('key', 'state')->where('value', 'Trained'))
            ->whereHas('metas', fn($q) => $q->where('key', 'campaign_id')->whereColumn('value', 'marketing_campaigns.id'));
    }
}
