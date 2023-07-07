<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdherentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nom' => $this->faker->lastName,
            'Prenom' => $this->faker->firstName,
            'Affiliation'=> $this->faker->unique()->regexify('[0-9]{9}'),
            'CIN' =>  $this->faker->unique()->regexify('[A-Z]{2}[0-9]{3}'),
            'DateNaissance' => $this->faker->dateTimeBetween("1950-01-01", "2022-12-30"),
            'Adresse'=> $this->faker->address,
            'GSM' => $this->faker->unique()->phoneNumber,
            'Fixe' => $this->faker->unique()->phoneNumber,
            'Genre' => array_rand(["H", "F"], 1),

            /* 'numeroPieceIdentite' => $this->faker->unique()->bankAccountNumber, 
            'email' => $this->faker->unique()->safeEmail(),*/
            /* 'photo' => $this->faker->imageUrl(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password */
        ];



    }



    
}
