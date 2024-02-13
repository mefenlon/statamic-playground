<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use StatamicRadPack\Runway\Routing\Traits\RunwayRoutes;
use StatamicRadPack\Runway\Traits\HasRunwayResource;

class Project extends Model
{
    use HasFactory;
    use HasRunwayResource;
    use RunwayRoutes;

    public function titles(): MorphToMany
    {
        return $this->morphedByMany(Title::class, 'projectable');
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn () =>  Str::of($this->name)->slug(),
        )->shouldCache();
    }
}
