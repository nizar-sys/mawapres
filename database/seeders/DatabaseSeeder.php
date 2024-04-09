<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use App\Models\Produk;
use App\Models\StockInProduct;
use App\Models\StockOutProduct;
use App\Models\StokProduk;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            UserSeeder::class
        ]);
        Produk::factory(10)->create();
        ProductColor::factory(20)->create();
        Vendor::factory(15)->create();
        StokProduk::factory(1)->create();
    }
}
