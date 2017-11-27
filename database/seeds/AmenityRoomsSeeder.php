<?php

use Illuminate\Database\Seeder;

class AmenityRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $amenity_animal = array(
            "Message_1" => array(
                'amenity_animal' => array(
                    'id'          => 1,
                    'animal_id'     => 1, 
                    'amenity_id'  => 3,    

                ),
            ),
            
            "message_2" => array(
                'amenity_animal' => array(
                    'id'          => 2,
                    'animal_id'     => 2, 
                    'amenity_id'  => 6,   
                ),
            ), 
            "message_5" => array(
                'amenity_animal' => array(
                    'id'          => 5,
                    'animal_id'     => 2, 
                    'amenity_id'  => 4,   
                ),
            ), 
            "message_3" => array(
                'amenity_animal' => array(
                    'id'          => 3,
                    'animal_id'     => 3, 
                    'amenity_id'  => 7,   
                ),
            ), 
             "message_8" => array(
                'amenity_animal' => array(
                    'id'          => 6,
                    'animal_id'     => 3, 
                    'amenity_id'  => 4,   
                ),
            ), 
            "message_7" => array(
                'amenity_animal' => array(
                    'id'          => 7,
                    'animal_id'     => 3, 
                    'amenity_id'  => 1,   
                ),
            ), 
            "message_4" => array(
                'amenity_animal' => array(
                    'id'          => 4,
                    'animal_id'     => 4, 
                    'amenity_id'  => 8,   
                ),
            ), 


        );

        foreach ($amenity_animal as $ameni) {
            DB::table('amenity_animals')->insert([
                'id'             => $ameni['amenity_animal']['id'],
                'animal_id'          => $ameni['amenity_animal']['animal_id'],
                'amenity_id'    => $ameni['amenity_animal']['amenity_id'],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
