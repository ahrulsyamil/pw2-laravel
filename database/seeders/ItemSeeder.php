<?php

namespace Database\Seeders;

use App\Models\ItemModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public $category = ['A', 'B', 'C', 'D'];
    public $supplier = ['X', 'Y', 'Z'];
    public $status = ['available', 'out of stock'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [];

        for ($i = 1; $i <= 17; $i++) {
            $items[] = [
                'name' => "Item {$i}",
                'qty' => mt_rand(1, 100),
                'price' => mt_rand(10000 * 10, 250000 * 10) / 10,
                'category' => "Category " . $this->category[mt_rand(0, 2)],
                'Supplier' => "Supplier " . $this->supplier[mt_rand(0, 2)],
                'location' => mt_rand(1, 10),
                'status' => $this->status[mt_rand(0, 1)],
                'description' => "Description {$i}",
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        ItemModel::insert($items);
    }
}
