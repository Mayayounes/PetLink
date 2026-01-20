<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Adoption;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 30 users
        
        $users = User::factory(30)->create();
        // Define unique pet names for each category (only one pet per species)
        $pets = Pet::factory()->count(50)->create();
        
        // Define date range for future appointments
        $minDate = Carbon::now();
        $maxDate = Carbon::now()->addMonth()->endOfMonth();
        
        // Create 15 appointments with future dates
        foreach (Appointment::factory(15)->make() as $appointment) {
            $appointmentDate = Carbon::createFromTimestamp(
                rand($minDate->timestamp, $maxDate->timestamp)
            );
            
            Appointment::create([
                'date' => $appointmentDate->format('Y-m-d'),
                'user_id' => $appointment->user_id,
            ]);
        }

        // Create 10 adoptions
        Adoption::factory(10)->create();

        // Create 103 products
        foreach (Product::factory(250)->make() as $product) {
            Product::firstOrCreate(
                ['name' => $product->name],
                $product->toArray()
            );
        }

        // Create 20 orders
        $orders = Order::factory(20)->create();

        // Create 1–20 products per order
        foreach ($orders as $order) {
            $numProducts = rand(1, 20);
            $selectedProducts = Product::all()->random($numProducts);

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 10);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $quantity * $product->price_of_single_product,
                ]);
            }
        }
    }

    
}
