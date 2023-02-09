<?php

use App\Category;
use App\Company;
use App\Job;
use App\Location;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::pluck('id');
        $companies = Company::pluck('id');
        $locations = Location::pluck('id');
        $faker = Faker\Factory::create();

        foreach(range(1, 7) as $id)
        {
            $job = new Job;
            $job->title = $faker->unique()->jobTitle;
            $job->short_description = $faker->sentence;
            $job->full_description = $faker->paragraph;
            $job->requirements = $faker->paragraph;
            $job->job_nature = "Full-time";
            $job->company_id = $companies->random();
            $job->location_id = $locations->random();
            $job->address = $faker->unique()->address;
            $job->salary = "15k - 25k";
            $job->top_rated = rand(0, 1);
            $job->external_id = 1;
            $job->hash = 1;
            $job->organization=1;
            //$table->string('position_name'); title
            //$table->string('description'); full_description
            $job->headcount=1;
            $job->creator=1;
            $job->salary_min=1;
            $job->salary_max=1;
            $job->currency=1;
            $job->owner=1;
          //  $table->string('address'); address
            $job->zipcode=1;
          //  $table->string('contract_details'); // job_nature
            $job->is_published=1;
            $job->is_remote = 1;
            $job->status = 1;
            //$table->string('created_at'); created_at
            //$table->string('updated_at'); updated_at
            $job->career_page_url = 1;
            $job->is_pinned_in_career_page = false;
            $job->industry = 1;
            $job->save();
            $job->categories()->sync($categories->random(rand(1,3)));
        }
    }
}
