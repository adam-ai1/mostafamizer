<?php

namespace Modules\MarketingBot\Filters;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CampaignFilter extends Filter
{
    /**
     * Filter by status
     *
     * @param  string  $value  The status value
     * @return EloquentBuilder|QueryBuilder
     */
    public function status($value)
    {
        if ($value == 'all') {
            return $this->query;
        }

        return $this->query->where('status', $value);
    }

    /**
     * Filter by training status
     *
     * @param  string  $value  The training status
     * @return EloquentBuilder|QueryBuilder
     */
    public function training($value)
    {
        if ($value == 'all') {
            return $this->query;
        }

        if ($value == 'trained') {
            return $this->query->whereHas('metas', function ($query) {
                $query->where('key', 'training_status')->where('value', 'trained');
            });
        }

        if ($value == 'not_trained') {
            return $this->query->whereDoesntHave('metas', function ($query) {
                $query->where('key', 'training_status')->where('value', 'trained');
            });
        }

        return $this->query;
    }

    /**
     * Filter by search query string
     *
     * @param  string  $value
     * @return EloquentBuilder|QueryBuilder
     */
    public function search($value)
    {

        if (empty($value) || $value == 'all') {
            return $this->query;
        }

        $value = is_array($value) ? $value['value'] : $value;
        $value = trim($value);

        $value = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);
        

        return $this->query->where(function ($query) use ($value) {
            $searchPattern = '%' . $value . '%';
            $query->where('title', 'like', $searchPattern)
                ->orWhere('content', 'like', $searchPattern)
                ->orWhere('channel', 'like', $searchPattern)
                ->orWhere('status', 'like', $searchPattern);
        });
    }

    /**
     * Order the query results based on the given value.
     *
     * @param  string  $value  The value determining the order direction.
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
}
