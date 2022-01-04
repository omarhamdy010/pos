<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients=['clients1','clients2','clients3'];

        foreach ($clients as $client)
        {
            Client::create([
                'name'=>$client,
                'phone'=>$client . ' phone',
                'address'=>$client . ' address'
            ]);
        }
    }
}
