<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Data;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::truncate();

        $data = [
            [
                'humanid'       => '89201',
                'nama'      => 'Ardi Saputra',
                'fakultas'  => 'Ilmu Komputer',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
            [
                'humanid'       => '89202',
                'nama'      => 'Imron Yusran',
                'fakultas'  => 'Ilmu Komputer',
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
        ];

        Data::insert($data);
    }
}
