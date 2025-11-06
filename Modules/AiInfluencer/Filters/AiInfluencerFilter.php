<?php
/**
 * @package AiInfluencerFilter
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Khayeruzzaman <shakib.techvill@gmail.com>
 * @created 20-08-2025
 */

namespace Modules\AiInfluencer\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class AiInfluencerFilter extends Filter
{

    /**
     * Order the query results based on the given value.
     *
     * @param string $value The value determining the order direction. Use 'newest' for descending order.
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
     * Filter by features query string
     *
     * @param  string  $value
     * @return EloquentBuilder|QueryBuilder
     */
    public function features($value)
    {
        return $this->query->where('archives.type', $value);
    }

    /**
     * Filter by userId query string
     *
     * @param  string  $id
     * @return EloquentBuilder|QueryBuilder
     */
    public function userId($id)
    {
        return $this->query->join('archives_meta as meta_user', function ($join) use ($id) {
                        $join->on('archives.id', '=', 'meta_user.owner_id')
                            ->where('meta_user.key', '=', 'code_creator_id')
                            ->where('meta_user.value', $id);
                    })
                    ->select('archives.*')->distinct();
    }


    /**
     * Filter by search query string
     *
     * @param  string  $value
     * @return EloquentBuilder|QueryBuilder
     */
    public function search($value)
    {
        $value = gettype($value) == 'array' ? $value['value'] : $value;
        $value = xss_clean($value);

        return $this->query->where('archives.provider', 'like', "%$value%")
            ->orWhere(function ($query) use ($value) {
                $query->where('archives.title', 'like', "%$value%")
                    ->orWhere('archives.type', 'like', "%$value%")
                    ->orWhere('creators.name', 'like', "%$value%");
            });
    }
}
