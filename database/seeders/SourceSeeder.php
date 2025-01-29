<?php

namespace Database\Seeders;

use App\Constants\ExternalPlatforms\ExternalPlatforms;
use App\Constants\Models\BaseColumns;
use App\Constants\Models\CategoryColumns;
use App\Constants\Models\SourceColumns;
use App\Services\ServiceHelper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws BindingResolutionException
     * @throws ConnectionException
     */
    public function run(): void
    {
        $newsApiService = ServiceHelper::newsApiService();
        $response = $newsApiService->fetchSources();
        $categories = $response->collect('sources')->pluck('category')->unique()
            ->map(fn($category) => [
                'name' => $category,
                'external_id' => $category
            ])->values()->toArray();
        $sources = $response->collect('sources');

        DB::table(CategoryColumns::TABLE)->insert($categories);

        $generalCategory = DB::table(CategoryColumns::TABLE)->where(CategoryColumns::NAME, 'general')->first();

        if (!$generalCategory) {
            DB::table(CategoryColumns::TABLE)->insert([
                SourceColumns::NAME => 'general',
                SourceColumns::EXTERNAL_ID => 'general',
            ]);
            $generalCategory = DB::table(CategoryColumns::TABLE)->where(CategoryColumns::NAME, 'general')->first();
        }

        DB::table(SourceColumns::TABLE)->insert([
            [
                SourceColumns::NAME => ExternalPlatforms::DISPLAY_VALUE[ExternalPlatforms::NEWS_API],
                SourceColumns::EXTERNAL_ID => ExternalPlatforms::NEWS_API,
                SourceColumns::CATEGORY_ID => $generalCategory?->id,
            ],
            [
                SourceColumns::NAME => ExternalPlatforms::DISPLAY_VALUE[ExternalPlatforms::GUARDIAN_NEWS],
                SourceColumns::EXTERNAL_ID => ExternalPlatforms::GUARDIAN_NEWS,
                SourceColumns::CATEGORY_ID => $generalCategory?->id,
            ],
        ]);

        foreach ($sources as $source) {
            $categoryName = $source['category'];
            $category = DB::table(CategoryColumns::TABLE)->where(CategoryColumns::NAME, $categoryName)->first();
            DB::table(SourceColumns::TABLE)->insert([
                SourceColumns::NAME => $source['name'],
                SourceColumns::EXTERNAL_ID => $source['id'],
                SourceColumns::CATEGORY_ID => $category?->id ?? $generalCategory?->id,

            ]);
        }

        $guardianNewsService = ServiceHelper::guardianApiService();
        $sections = $guardianNewsService->fetchSections()->collect('response.results');
        foreach ($sections as $section) {
            DB::table(CategoryColumns::TABLE)->updateOrInsert([
                SourceColumns::NAME => $section['webTitle'],
                SourceColumns::EXTERNAL_ID => $section['id'],
            ]);
        }

    }
}
