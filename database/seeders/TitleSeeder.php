<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create one known project
        $project = Project::firstOrCreate([
            'name' => 'Runway',
            'text' => 'My test project'
        ]);

        //Create one known city
        $city = City::firstOrCreate([
            'name' => 'Annapolis',
            'state' => 'MD'
        ]);

        $tag_published = Tag::firstOrCreate([
            'name' => 'Published',
            'slug' => 'published',
            'type' => 'publication_status'
        ]);

        $tag_forthcoming = Tag::firstOrCreate([
            'name' => 'Forthcoming',
            'slug' => 'forthcoming',
            'type' => 'publication_status'
        ]);

        $tag_staged = Tag::firstOrCreate([
            'name' => 'Staged',
            'slug' => 'staged',
            'type' => 'publication_status'
        ]);

        //Generate random titles
        Title::factory()
            ->count(100)
            ->hasProjects(1)
            ->hasCities(1)
            ->create();

        //Attach known project, city and published tag to 25 titles
        $titles = Title::withoutGlobalScopes()->take(25)->get()->each(function (Title $title) use ($city,$project, $tag_published) {
            $title->cities()->save($city);
            $title->projects()->save($project);
            $title->tags()->save($tag_published);
        });

        //Attach known project, city and forthcoming tag to 25 titles
        $titles = Title::withoutGlobalScopes()->skip(25)->take(25)->get()->each(function (Title $title) use ($city,$project, $tag_forthcoming) {
            $title->cities()->save($city);
            $title->projects()->save($project);
            $title->tags()->save($tag_forthcoming);
        });

        $titles = Title::withoutGlobalScopes()->skip(50)->take(25)->get()->each(function (Title $title) use ($city,$project, $tag_staged) {
            $title->tags()->save($tag_staged);
        });
    }
}
