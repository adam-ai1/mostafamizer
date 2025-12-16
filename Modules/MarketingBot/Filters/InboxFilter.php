<?php
/**
 * @package InboxFilter
 * @author TechVillage <support@techvill.org>
 * @created 2025-01-XX
 */

namespace Modules\MarketingBot\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class InboxFilter extends Filter
{
    /**
     * Filter by search query string
     *
     * @param  string  $value
     * @return EloquentBuilder|QueryBuilder
     */
    public function search($value)
    {
        $value = is_array($value) ? $value['value'] : $value;
        $value = trim($value);

        $value = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);

        return $this->query->where('archives.title', 'like', '%' . $value . '%');
    }

    /**
     * Filter by channel
     *
     * @param string $value The value of the channel (whatsapp, telegram, or empty for all)
     * @return EloquentBuilder|QueryBuilder
     */
    public function channel($value)
    {
        if (empty($value) || $value === 'all' || strtolower($value) === 'all channel') {
            return $this->query;
        }

        $value = trim($value);
        
        // Filter by channel value (case-insensitive)
        return $this->query->whereRaw('LOWER(c.value) = ?', [strtolower($value)]);
    }
}

