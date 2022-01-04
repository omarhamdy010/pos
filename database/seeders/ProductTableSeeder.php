<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products= ['pro1','pro2','pro3'];

        foreach ($products as $product)
        {
            Product::create([
                'category_id'=>1,
                'ar'=>['name'=>$product,'description'=>$product . 'desc'],
                'en'=>['name'=>$product,'description'=>$product . 'desc'],
                'purchase_price'=>100 ,
                'sale_price'=>200,
                'stock'=>200,
            ]);
        }
        foreach ($products as $product)
        {
            Product::create([
                'category_id'=>2,
                'ar'=>['name'=>$product,'description'=>$product . 'desc'],
                'en'=>['name'=>$product,'description'=>$product . 'desc'],
                'purchase_price'=>100 ,
                'sale_price'=>200,
                'stock'=>200,
            ]);

            foreach ($products as $product)
            {
                Product::create([
                    'category_id'=>3,
                    'ar'=>['name'=>$product,'description'=>$product . 'desc'],
                    'en'=>['name'=>$product,'description'=>$product . 'desc'],
                    'purchase_price'=>100 ,
                    'sale_price'=>200,
                    'stock'=>200,
                ]);
            }
        }
    }
}
