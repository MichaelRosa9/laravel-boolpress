<?php

use App\Category;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['HTML', 'CSS', 'Javascript', 'PHP'];
        foreach ($data as $value) {
            $new_category = new Category();
            $new_category->name = $value;
            $new_category->slug = Str::slug($value, '-');
            $new_category->save();
        }
    }
}
