<?php

use App\Kurir;
use Illuminate\Database\Seeder;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kode' => 'jne', 'nama_kurir' => 'JNE' ],
            ['kode' => 'pos', 'nama_kurir' => 'POS' ],
            ['kode' => 'tiki', 'nama_kurir' => 'TIKI' ]
        ];
        Kurir::insert($data);
    }
}
