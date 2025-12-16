<?php
/**
 * @package AvatarVoiceFilter
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Khayeruzzaman <shakib.techvill@gmail.com>
 * @created 03-06-2025
 */

namespace Modules\OpenAI\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class AvatarVoiceFilter extends Filter
{

    /**
     * Filter by userId query string
     *
     * @param  string  $id
     * @return EloquentBuilder|QueryBuilder
     */
    public function userId($id)
    {
        return $this->query->where('user_id', $id);
    }

    /**
     * Filter by gender query string
     * @param  string  $value
     * @return EloquentBuilder|QueryBuilder
     */
    public function gender($value)
    {
        return $this->query->where('gender', $value);
    }

    public function name($value)
    {
        return $this->query->where('name', 'LIKE', '%' . $value . '%');
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

        return $this->query->where(function ($query) use ($value) {
            $query->whereLike('name', $value)
                ->orWhereLike('providers', $value)
                ->orWhereHas('user', function ($q) use ($value) {
                    $q->where('name', 'like', '%' . $value . '%');
                });
        });
        
      
    }
}
