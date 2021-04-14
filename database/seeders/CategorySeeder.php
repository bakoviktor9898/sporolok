<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::create(['name' => 'Tejtermékek, tojás']);
        $child = Category::create([
            'name'      => 'Tejek, tejitalok',
            'parent_id' => $parent->id
        ]);
        $grandChild = Category::create([
            'name'      => 'Hűtést igénylő tejek',
            'parent_id' => $child->id
        ]);
    }
}
