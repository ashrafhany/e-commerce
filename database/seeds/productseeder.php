<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
           [
            'name'=>'Oppo A9 2020',
            'price'=>"200",
            'description'=>"Oppo A9 2020 ( 128GB , 8 GB ) Purple Mobile Phones Online",
            'category'=>"mobile",
            'gallery'=>"https://n4.sdlcdn.com/imgs/i/z/z/Oppo-CPH1937-128GB-8-GB-SDL620941282-2-23633.png" 
           ],
           [
            'name'=>'The Samsung 8000',
            'price'=>"300",
            'description'=>"The Samsung 8000 series really is a revolution in home viewing. With its huge LED screens you are able to watch movies and TV in HD on its super bright LED screen",
            'category'=>"TV",
            'gallery'=>"https://www.gadgetzebra.com/wp-content/uploads/2019/11/samsung-smart-tv.jpg"
           ],
           [
            'name'=>'LG Smart HD ',
            'price'=>"300",
            'description'=>"LG Smart HD TV 32 inch",
            'category'=>"TV",
            'gallery'=>"https://www.lg.com/au/images/tvs/md05804329/gallery/32LJ550D_d1_210917.jpg"
           ],
           [
            'name'=>'LG GSL460ICEV American-Style Fridge Freezer',
            'price'=>"500",
            'description'=>"179 x 91.2 x 71.7 cm (H x W x D)
            Fridge: 400 litres / Freezer: 206 litres
            Total frost free
            Water & ice dispenser (requires plumbing)
            Fan cooling creates the ideal conditions in your fridge",
            'category'=>"fridges",
            'gallery'=>"https://th.bing.com/th/id/OIP.BKIX34T3O6bp1ly9-GOsogHaGk?pid=ImgDet&rs=1"
           ]
        ]);
    }
}
