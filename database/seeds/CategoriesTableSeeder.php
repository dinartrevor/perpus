<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrCategory = ['Fisika', 'IPA', 'Biologi', 'Politik', 'Comic'];
        $categories = Category::all();
        // if (is_null($categories)) {
            foreach($arrCategory as $category) {
                Category::create(['name' => $category]);
            }
        // }
    }
}
