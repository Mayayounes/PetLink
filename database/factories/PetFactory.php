<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = \App\Models\Pet::class;

    private static $usedPetNames = []; // Track used names across all instances of this factory

    public function definition(): array
    {
        $petNames = [
            'MohoKoo', 'Bella', 'Max', 'Luna', 'Charlie', 'Milo', 'Simba', 'Rocky',
            'Coco', 'Chico', 'Zazu', 'Toto', 'Bubbles', 'Shadow', 'Fluffy', 'Whiskers',
            'Toby', 'Nala', 'Blue', 'Lucky', 'Ginger', 'Snowy', 'Spike', 'Peanut',
            'Mochi', 'Tiger', 'Chirpy', 'Dash', 'Oreo', 'Pickles', 'Trixie', 'Rex',
            'Bousi', 'Zizo', 'Felfel', 'Kimo', 'Tootoo', 'Farfoura', 'Hamama',
            'Lolo', 'Tamtam', 'Soso', 'Roro', 'Bebo', 'Misho', 'Simsim', 'Tita',
            'Batta', 'Ghazal', 'Manga', 'Karawan', 'Noona', 'Safroot', 'Luca', 'Kiko',
            'Sokara', 'Sokar', 'Sefroo', 'Basbosa', 'Bondo2', 'Beso', 'Zizi'
        ];

        // Remove used names from the list
        $availableNames = array_diff($petNames, self::$usedPetNames);

        // If there are no available names left, reset the used names
        if (empty($availableNames)) {
            self::$usedPetNames = [];
            $availableNames = $petNames; // Reset available names
        }

        // Randomly pick a name from the remaining available names
        $name = $this->faker->randomElement($availableNames);
        self::$usedPetNames[] = $name; // Add the chosen name to the used list

        $categories = ['Cat', 'Dog', 'Turtle', 'Parrot', 'Bird', 'Fish'];
        $category = $this->faker->randomElement($categories);
        
        $breeds = [
            'Cat' => ['Persian Cat', 'Siamese Cat', 'Maine Coon Cat', 'Bengal Cat', 'Sphynx Cat', 'Scottish Fold Cat', 'Himalayan Cat', 'Siberian Cat', 'American Bobtail Cat', 'American Shorthair Cat','Egyptian Mau Cat', 'Burmese Cat'],
            'Dog' => ['Labrador Retriever Dog', 'German Shepherd Dog', 'Golden Retriever Dog', 'Bull Dog', 'Beagle Dog', 'Siberian Husky Dog', 'Rottweiler Dog', 'English Cocker Spaniel Dog', 'Pomeranian Dog', 'Shih Tzu Dog'],
            'Turtle' => ['Box Turtle', 'Red Eared Slider Turtle'],
            'Parrot' => ['African Grey Parrot', 'Macaw Parrot', 'Cockatoo Parrot', 'Eclectus Parrot'],
            'Bird' => ['Canary Bird', 'Finch Bird', 'Cockatiel Bird', 'Love Bird', 'Parakeet Bird', 'Budgerigar Bird', 'Strigopidae Bird', 'Kingfisher Bird'],
            'Fish' => ['Betta Fish', 'Neon Tetra Fish', 'Gold Fish', 'Angel Fish', 'Tiger Barb Fish', 'Cherry Barb Fish', 'Discus Fish', 'Guppy Fish', 'Molly Fish', 'Swordtail Fish'],
        ];

        $breed = $this->faker->randomElement($breeds[$category]);

        $gender = $this->faker->randomElement(['male', 'female']);
        $age = $this->faker->numberBetween(1, 15);

        // Medical history logic
        $vaccinated = $this->faker->boolean;
        $neutered = ($category === 'Cat' || $category === 'Dog') ? $this->faker->boolean : null;
        $medicalHistory = $vaccinated ? 'Vaccinated' : 'Not Vaccinated';
        if (!is_null($neutered)) {
            $medicalHistory .= $neutered ? ' & Neutered' : ' & Not Neutered';
        }

        $image = $name === 'MohoKoo' ? 'img/Moho-Koo.jpg' : 'img/' . $name . '.jpg';

        return [
            'name' => $name,
            'category' => $category,
            'breed' => $breed,
            'gender' => $gender,
            'age' => $age,
            'medical_history' => $medicalHistory,
            'image' => $image,
        ];
    }
}
