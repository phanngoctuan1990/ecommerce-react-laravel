<?php

use App\User;
use App\Image;
use App\Product;
use App\Category;
use App\PaymentMethod;
use App\ShippingOption;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        User::truncate();
        Category::truncate();
        Product::truncate();
        Image::truncate();
        PaymentMethod::truncate();
        ShippingOption::truncate();
        DB::statement("SET foreign_key_checks=1");

        User::create([
            'name' => 'tuan',
            'email' => 'tuan@gmail.com',
            'password' => Hash::make('secret'),
            'type' => 1
        ]);

        Category::create([
            'name' => 'electronics',
            'description' => 'electronics',
            'sub_category' => 'tv'
        ]);

        Category::create([
            'name' => 'books',
            'description' => 'books',
            'sub_category' => 'Book'
        ]);

        $current = now();

        Product::create([
            'name' => 'TV1',
            'description' => 'TV1 Description',
            'price' => '10',
            'original_price' => '9',
            'seller_name' => 'seller person',
            'ratings' => '4',
            'number_of_ratings' => '3',
            'is_fast_shipping' => 0,
            'category_id' => '1',
            'prev_price' => '6',
            'snack_bar_message' => 'snack',
            'time_stamp' => $current,
        ]);

        Product::create([
            'name' => 'Sapiens',
            'description' => 'A Brief History of Humankind',
            'price' => '15',
            'original_price' => '10',
            'seller_name' => 'seller person',
            'ratings' => '5',
            'number_of_ratings' => '2',
            'is_fast_shipping' => 1,
            'category_id' => '2',
            'prev_price' => '6',
            'snack_bar_message' => 'snack',
            'time_stamp' => $current,
        ]);

        Image::create([
            'image' => 0x8,
            'product_id' => 1,
        ]);
        $paymentMethods = [
            ['name' => 'Credit Card', 'created_at' => $current, 'updated_at' => $current],
            ['name' => 'Debit Card', 'created_at' => $current, 'updated_at' => $current]
        ];
        PaymentMethod::insert($paymentMethods);

        $shippingOptions = [
            ['shipping_method' => 'ORDER_PLACED', 'created_at' => $current, 'updated_at' => $current],
            ['shipping_method' => 'SHIPPED', 'created_at' => $current, 'updated_at' => $current],
            ['shipping_method' => 'IN_TRANSIT', 'created_at' => $current, 'updated_at' => $current],
            ['shipping_method' => 'DELIVERED', 'created_at' => $current, 'updated_at' => $current],
        ];
        ShippingOption::insert($shippingOptions);
    }
}
