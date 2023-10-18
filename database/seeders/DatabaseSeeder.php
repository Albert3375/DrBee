<?php

namespace Database\Seeders;

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
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
        //Es necesario un valor por defecto en los descuento
        // $this->call(DiscountSeeder::class);
        //  //Para hacer testing es necesario tener información al respecto de los productos
        //  $this->call(ProductsSeeder::class);
        //  // $this->call(CategoriesSeeder::class);

        // $this->call(PriceRulesSeeder::class);
    }
}
