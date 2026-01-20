<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        $categories = [
            'Litter' => [
                'DOODZY CAESAR Cat Litter Fast Clumping Natural Bentonite 5L (Lavender)',
                'JOY CAT LITTER 10KG FOR CATS & DOG (apple)',
                'My Dear 100% Fast Collecting Dark Cat Litter, 5 Liter with Scent (5L, Lavender)',
                'ACE Cat Litter Marseille Soap 5L',
                'Premium Wood Odour Eliminator for Cats and Dogs 15K'
            ],
            'Wet Food' => [
                'Kippy Cat with Chicken',
                'Purina Friskies Chicken Chunks in Gravy Wet Cat Food Pouch 85g',
                'Rich Wet Food with Tuna for Dogs',
                'Teddy Pet Food Dog Original Beef 400Gm',
                'GROOVY Fresh Food 400g Wet Food',
                'BestPet Adult Wet Cat Food Lamb 400g Can'
            ],
            'Treats' => [
                'Dreamies Cheese Flavor Pet Food 60Gm',
                'Rich Sticks for Dogs Beef and Chicken Flavor (14 piesec, Chicken)',
                'Orgo Organic Biscuits Treats for Puppy 150gs',
                'Wanpee Tasty Tuna Liquid Cat Treat',
                'K9 Meaty Sticks Treats For Cats 3 sticks Pack (3 Sticks Pack, Duck)'
            ],
            'Bird Food' => [
                'Pablo Super Premium Food Blend For Budgie Seed Mix 900gm',
                'All Natural Bird Food, 750g',
                'Birdo Golden Mix For Parrots (500g)',
                'Coco Eat a Parrot (800g)',
                'Pablo Mix Seed Blend For Birds 900 Grams'
            ],
            'Toys' => [
                'NEWKIBOU Interactive Cat Toy, LED Light Up Electric Ball 360° Automatic Rotating Ball for Indoor Kittens (Pink)',
                'Vealind Cat Ball Three Tier Cat Tower Track Interactive Pet Toy 3 Level Colourful Balls in a Circle Tower Fun Mental Physical Exercise Puzzle for Cats',
                'Cotton Toy Bitten Rope for Dogs 49 cm',
                'Soft Plush Squeaky Dog Cat Ball',
                'Tres Gatos Three Cats Scratching Post Cat 2 Tiers 2 Pom Pom Balls Made Spain Sisal Column 6 mm Pet Toy (Beige)',
                'Pet Toys Resistant To Bite Bone Dog Puppy Molars Rubber Ball Play For Teeth',
                'Regerly Cat Balls, 20 Pieces Cat Toy Ball Rainbow Striped Sponge Ball',
                'Plastic Flying Saucer Toy for Dogs Green'
            ],
            'Beds' => [
                'Ariika Snoozy Pet Bed Small 40x60x20 Grey Fur Suitable for Dogs & Cats Removable Cover Round Bed of High Grade Fiber Filling',
                'Moro Moro Circular Bed for Cats and Dogs Rose and Fuchia',
                'Hero Dog Dog Beds for Large Dogs Crate Bed Pad Mat 42 in Soft Kennel Pads',
                'MEWTOGO Large Winter Warm Bird Nest House',
                'Hanging Hammock Velvet Shed Hut Cage Plush Fluffy Birds'
            ],
            'Cages & Carriers' => [
                'Generic Two Part Bird Cage',
                'Large Bird Cage for Parrots Parakeets',
                'Fish Tank Aquarium Medium 16 Liter with Filter & Decorations',
                'Stefanplast Gulliver',
                'Backpack Carrier Bubble Carrying Bag for Small Medium Dogs Cats',
                'Stefanplast Gulliver 2 Light Grey with Plastic Door',
                'Duty Dog Crates for Large Dogs',
                'Pet Carrier with Plastic Door'
            ],
            'Health Supplements' => [
                'Advanced Immune Support & Nutritional Supplement Tablets for Dogs (60 Tablets)',
                'Amino Acids Bundle of Nutrients 100ml for Dog and Cat',
                'Omni Guard Fit Guard Plus for Dogs & Cats Immune Booster & Good Appetizer 100 ML',
                'Trixie Dentinos with Vitamins',
                'Calcium Bone For Dogs Contains Vitamins And Minerals'
            ],
            'Leashes' => [
                'Ultra Light Escape Proof Kitten Collar Cat Walking Jacket Soft and Comfortable (M)',
                'Cat Collar Harness Leash Adjustable Nylon Pet Traction Cat',
                'Dog Leash with Adjustable Collar Set',
                'Small LED Dog Leash',
                'PHOEPET No Pull Dog Harness Medium Reflective Front Clip Vest with Handle'
            ],
           
            'Grooming Supplies' => [
                'Pet Grooming Gloves for Dog and Cat',
                'Necomi 3 in 1 Steam Cat Brush',
                'Waterproof Paw Hair Trimmer, Cat Clipper',
                'Pet Grooming Bath Massage Brush with Soap and Shampoo',
                '2 in 1 Pet Hair Dryer and Dog Grooming Kit with Pet Hair Brush',
                'Stainless Steel Comfort Flea Hair Grooming Tools Deworming Brush',
                'Pet Nail Clipper for Dogs and Cats',
                'Pet Hair Lint Roller'
            ],
            'Training Pads' => [
                'Pet Training Pee Pads',
                'DOODZY Pads Dog Training',
                'Heavy Duty Dog Training Pads',
                'Groovy Training Pads 60 x 90cm'
            ],
            'Pet Apparel' => [
                'Cat Hoodie Fleece Puppy Clothes Warm Sweater',
                'Cat Clothes (Black)',
                'Male Cat Clothes (Grey)',
                'Hand Made Crochet Dog Sweater',
                'Dog Summer Hoodie',
                'Cat Hoodie',
                'Small Dog Jumper',
                'Dog Dress',
                'AirTag Cat Collar',
                'Strawberry Collar',
                'Lovely Cats & Dogs Puppy Lace Collar',
                'Bell Collar for Cats',
                'Recovery Pet Cone',
                'Pet Collar',
                'Dog Collar',
                'Pet Dog Cat Collar',
                'Cats & Dogs Puppy Lace Collar with Bell'
            ],
            'Aquarium Supplies' => [
                'Interpet Aquarium Fish Net, Small',
                'Aquarium Jellyfish Luminous Glowing Light Effect Fish Tank',
                'Meridian Gravel for Decoration',
                'Small Sea Shells about 100pcs',
                'Small Fish Tank Filter Pumps',
                '2PCS Artificial Aquarium Plants Plastic Fish Tank',
                'Mini White Silica Sand for Fire Pits, Aquariums and Landscaping'
            ],
            'Feeding Bowls' => [
                'Feeders for Cats with Automatic Drinker',
                'Heavy Duty Double Slow Feeder',
                'Elevated Pet Bowl for Small Dogs and Cats',
                '2Pcs Parrot Food Water Bowls,Bird Feeding Dish Cups Set',
                '2 Pcs Small Pet Drinking and Eating Water Bowl',
                'Stainless Steel Dog & Cat Bowl'
            ],
            'Pet Cleaning Products' => [
                'Omni Guard Anti Parasitic Cats And Dogs Shampoo',
                'Natural Panthenol Shampoo for Cats & Dogs',
                'Omniguard Dry Shampoo for Cats & Dogs',
                'Orgo Perfume Lavender For Cats & Dogs',
                'Orgo Perfume Lollipop for Cats and Dogs',
                'White Pets Wipes, 54 pcs',
                'Pet Washing Glove Wipes for Dog and Cat',
                '60 Pcs Gentle Eye Cleaning Wipes for Dogs and Cats',
                'Wipes for Dogs and Cats'
            ]
        ];

        $category = $this->faker->randomElement(array_keys($categories));
        $productName = $this->faker->randomElement($categories[$category]);
        $productImage = 'img/' . str_replace(' ', '-', $productName) . '.jpg';

        return [
            'name' => $productName,
            'price_of_single_product' => $this->faker->randomFloat(2, 5, 700),
            'category' => $category,
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => $productImage, 
        ];
    }
}
