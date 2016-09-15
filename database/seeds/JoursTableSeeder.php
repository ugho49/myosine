<?php

use Illuminate\Database\Seeder;
use App\Jour;

class JoursTableSeeder extends Seeder
{
    private $jours = [
        ["num" => 1, "libelle" => "Lundi"],
        ["num" => 2, "libelle" => "Mardi"],
        ["num" => 3, "libelle" => "Mercredi"],
        ["num" => 4, "libelle" => "Jeudi"],
        ["num" => 5, "libelle" => "Vendredi"],
        ["num" => 6, "libelle" => "Samedi"],
        ["num" => 7, "libelle" => "Dimanche"],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->jours as $jour) {
            Jour::create([
                'num' => $jour['num'],
                'libelle' => $jour['libelle']
            ]);
        }
    }
}
