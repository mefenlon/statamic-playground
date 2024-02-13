<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use StatamicRadPack\Runway\Routing\Traits\RunwayRoutes;
use StatamicRadPack\Runway\Traits\HasRunwayResource;

class Tag extends Model
{
    use HasFactory;
    use HasRunwayResource;
    use RunwayRoutes;

    public function titles(): MorphToMany
    {
        return $this->morphedByMany(Title::class, 'taggable');
    }
}
