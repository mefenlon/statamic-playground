<?php

namespace App\Models;

use App\Models\Scopes\TitleGlobalScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use StatamicRadPack\Runway\Routing\Traits\RunwayRoutes;
use StatamicRadPack\Runway\Traits\HasRunwayResource;

class Title extends Model
{
    use HasFactory;
    use HasRunwayResource;
    use RunwayRoutes;


    protected $with = ['runwayUri'];

    protected static function booted(): void
    {
//        TODO: Check Global scope after N+1 resolved
//        static::addGlobalScope(new TitleGlobalScope());
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }

    public function projects(): MorphToMany
    {
        return $this->morphToMany(Project::class, 'projectable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn () =>  Str::of($this->sort_title)->slug(),
        )->shouldCache();
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn () =>  !empty($this->display_title)  ? $this->display_title : $this->sort_title,
        )->shouldCache();
    }
}
