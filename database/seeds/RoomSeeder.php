<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //animals:
        $animals = array(
            "animal_1" => array(

                'animal' => array(
                    'id'          => 1, 
                    'name'       => 'Hiris',
                    'animal_type_fk' => 0,
                    'age'       => 28,
                    'body'        => ' kambario plotas, palyginus su standartiniu kambariu – didesnis. Kambarys padalintas į dvi zonas: miegamąją ir svetainės. Kartais jos yra atskiriamos dekoratyvine užuolaida, o kartais – tik grindų lygiu. Baldai čia geresni nei standartiniuose kambariuose, aptarnavimas – taip pat. Jie dažniausiai būna 5*, rečiau 4* viešbučiuose ir kainuoja apie 30 proc. brangiau negu standartiniai kambariai.',
                    'photo_fk'     =>'database/animals/vienas.jpg',

                ),

                'photos' => array(
                    'url'       => 'database/animals/vienas.jpg',
                    'ext'       => 'jpg',
                    'size'      => 16117,
                    'cover'     => 1,
                ),
            ),
            //Sekantys kambariai:
              "animal_2" => array(

                'animal' => array(
                    'id'          => 2, 
                    'name'       => 'Biris',
                    'animal_type_fk' => 1,
                    'age'       => 50,
                    'body'        => 'Dviejų kambarių numeris su prieškambariu. Sieninė spinta, šaldytuvas, odiniai baldai, kabelinė televizija, du televizoriai, oro kondicionierius, plati dvigulė lova, elektriniai šildytuvai, vonios kambarys, plaukų džiovintuvas, interneto ryšys ',
                    'photo_fk'     =>'database/animals/du.jpg',

                ),

                'photos' => array(
                    'url'       => 'database/animals/du.jpg',
                    'ext'       => 'jpg',
                    'size'      => 18883,
                    'cover'     => 1,
                ),
            ),
               "animal_3" => array(

                'animal' => array(
                    'id'          => 3, 
                    'name'       => 'Kairis',
                    'animal_type_fk' => 2,
                    'age'       => 68,
                    'body'        => 'du gretimi kambariai (pagal dydį – pusantro), skirti šeimai. Kiekviename iš jų įprastai stovi dvi lovos (vaikų kambaryje lovelė gali būti dviejų aukštų). Prieš rezervuojant šios kategorijos kambarį, vertėtų pasitikslinti, ar tarp kambarių yra durys (kartais tarp jų būna tiesiog palikta didelė ertmė). Dažniausiai jis kainuoja apie 30 proc. brangiau nei standartinis kambarys, kuriame pastatomos dvi papildomos lovelės.',
                    'photo_fk'     =>'database/animals/trys.jpg',

                ),

                'photos' => array(
                    'url'       => 'database/animals/trys.jpg',
                    'ext'       => 'jpg',
                    'size'      => 19604,
                    'cover'     => 1,
                ),
            ), 
              "animal_4" => array(

                'animal' => array(
                    'id'          => 4, 
                    'name'       => 'Kiris',
                    'animal_type_fk' => 3,
                    'age'       => 20,
                    'body'        => 'du gretimi kambariai (pagal dydį – pusantro), skirti šeimai. Kiekviename iš jų įprastai stovi dvi lovos (vaikų kambaryje lovelė gali būti dviejų aukštų). Prieš rezervuojant šios kategorijos kambarį, vertėtų pasitikslinti, ar tarp kambarių yra durys (kartais tarp jų būna tiesiog palikta didelė ertmė). Dažniausiai jis kainuoja apie 30 proc. brangiau nei standartinis kambarys, kuriame pastatomos dvi papildomos lovelės.',
                    'photo_fk'     =>'database/animals/keturi.jpg',

                ),

                'photos' => array(
                    'url'       => 'database/animals/keturi.jpg',
                    'ext'       => 'jpg',
                    'size'      => 20569,
                    'cover'     => 1,
                ),
            ), 

        );

        foreach ($animals as $usr) {
            //Registration:
            DB::table('animals')->insert([
                'id'             => $usr['animal']['id'],
                'name'          => $usr['animal']['name'],
                'animal_type_fk'    => $usr['animal']['animal_type_fk'],
                'age'          => $usr['animal']['age'],
                'body'           => $usr['animal']['body'],
                'photo_fk'           => $usr['animal']['photo_fk'],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);

            //Photo
            DB::table('photos')->insert([
                'url'       => $usr['photos']['url'],
                'ext'       => $usr['photos']['ext'],
                'size'      => $usr['photos']['size'],
                'cover'     => $usr['photos']['cover'],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
