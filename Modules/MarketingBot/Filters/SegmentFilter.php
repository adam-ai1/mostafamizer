<?php
/**
 * @package TemplateFilter
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Khayeruzzaman <shakib.techvill@gmail.com>
 * @created 14-10-2025
 */

namespace Modules\MarketingBot\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class SegmentFilter extends Filter
{
    /**
     * Filter by channel of segment
     *
     * @param string $value The value of the channel of segment
     * @return EloquentBuilder|QueryBuilder
     */
    public function channels($value)
    {

        return $this->query->where('channel', $value);
    }

    /**
     * Order the query results based on the given value.
     *
     * @param string $value The value determining the order direction. Use 'oldest' for ascending order.
     *                      Use 'newest' for descending order.
     * @return EloquentBuilder|QueryBuilder
     */
    public function orderBy($value)
    {
        if ($value == 'oldest') {
            return $this->query->orderBy('id', 'asc');
        } else {    
            return $this->query->orderBy('id', 'desc');
        }
    }

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

        // Only perform search if value is at least 2 characters to prevent server load from single-character searches
        if (strlen($value) >= 2) {
            return $this->query->where('name', 'like', '%' . $value . '%');
        }

        // Return unmodified query for short search terms (including empty strings)
        return $this->query;
    }
}
