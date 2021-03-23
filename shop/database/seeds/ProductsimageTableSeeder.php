<?php

use Illuminate\Database\Seeder;

class ProductsimageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Productsimage::class,210)->create();
    }
}
