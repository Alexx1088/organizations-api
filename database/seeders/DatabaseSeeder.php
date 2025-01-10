<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();

        $buildings = Building::factory()
            ->count(5)
            ->create();

        $organizations = collect();

        $buildings->each(function ($building) use (&$organizations) {

            $orgs = Organization::factory()
                ->count(3)
                ->hasPhones(3)
                ->create([
                    'building_id' => $building->id,
                ]);

            $organizations = $organizations->merge($orgs);
        });

        $activities = $this->createActivities();

        $this->attachActivitiesToOrganizations($organizations, $activities);
    }

    /**
     * Create the shared hierarchy of activities.
     */
    protected function createActivities(): \Illuminate\Support\Collection
    {
        $rootActivities = Activity::factory(5)->create();
        $activities = collect($rootActivities);

        foreach ($rootActivities as $root) {
            $secondLevelActivities = Activity::factory(3)->withParent($root->id)->create();
            $activities = $activities->merge($secondLevelActivities);

            foreach ($secondLevelActivities as $secondLevel) {
                $thirdLevelActivities = Activity::factory(2)->withParent($secondLevel->id)->create();
                $activities = $activities->merge($thirdLevelActivities);
            }
        }

        return $activities;
    }

    /**
     * Attach a subset of activities to each organization.
     */
    protected function attachActivitiesToOrganizations($organizations, $activities): void
    {
        $organizations->each(function ($organization) use ($activities) {
            $rootActivity = $activities->whereNull('parent_id')->random();
            $secondLevelActivity = $activities->where('parent_id', $rootActivity->id)->random();
            $thirdLevelActivity = $activities->where('parent_id', $secondLevelActivity->id)->random();

            $organization->activities()->attach([
                $rootActivity->id,
                $secondLevelActivity->id,
                $thirdLevelActivity->id,
            ]);
        });
    }
}
