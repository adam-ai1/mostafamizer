<?php

namespace Modules\OpenAI\Entities;

use App\Traits\ModelTrait;
use App\Traits\ModelTraits\Metable;
use App\Traits\ModelTraits\hasFiles;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use hasFiles;
    use Metable;
    use ModelTrait;
    use Filterable;

    
   /**
     * The table associated with the model's meta data.
     *
     * @var string
     */
    protected $metaTable = 'avatar_metas';

    /**
     * Relation with User model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}