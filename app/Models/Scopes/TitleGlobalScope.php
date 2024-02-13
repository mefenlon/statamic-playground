<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TitleGlobalScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->

        whereHas('projects', function (Builder $query) {
            $query->where('name','Runway');
        })->
        whereHas('tags', function (Builder $query) {
            $query->whereIn('name', ['Published', 'Forthcoming'])
                ->where('type','publication_status');
        });
    }
}
