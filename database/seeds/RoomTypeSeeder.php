<?php

use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          $groups = ['Šuo', 'Katė', 'Šinšila', 'Jūros kiaulytė'];
        foreach ($groups as $group) {
            DB::table('animal_types')->insert([
                'name' => $group,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
