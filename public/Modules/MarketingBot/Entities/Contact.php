<?php

namespace Modules\MarketingBot\Entities;


use Str;
use App\Models\User;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\Metable;
use App\Traits\ModelTraits\hasFiles;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
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
    protected $metaTable = 'contact_metas';

    protected $fillable = [
        'user_id',
        'unique_identifier',
        'name',
        'phone',
        'country_code',
        'channel',
        'status',
        'last_contacted_at',
    ];

    protected $casts = [
        'last_contacted_at' => 'datetime',
    ];

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
     * Get the user that owns the contact.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
