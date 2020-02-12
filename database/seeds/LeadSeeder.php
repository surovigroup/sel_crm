<?php

use App\Lead;
use App\Status;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_BD');
        $status_count = Status::count();

        foreach(range(1,200) as $lead){
            $lead_data['user_created_id'] = 1;
            $lead_data['user_assigned_id'] = 1;
            $lead_data['name'] = $faker->name;
            $lead_data['phone'] = $faker->PhoneNumber;
            $lead_data['email'] = $faker->email;
            $lead_data['source'] = $this->get_random_element(['Facebook', 'Techplatoon', 'Daraz']);
            $lead_data['description'] = $faker->sentence;
            $lead_data['company'] = $faker->company;
            $lead_data['division'] = $faker->division;
            $lead_data['district'] = $faker->district;
            $lead_data['upazila'] = $faker->upazila;
            $lead_data['status_id'] = rand(1, $status_count);

            Lead::create($lead_data);
        }
        
    }

    public function get_random_element( array $array )
        {
            $range = count($array) - 1;
            $random_index = rand( 0, $range );
            return $array[ $random_index ];
        }
}
