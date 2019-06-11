<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
        	'nama_ibu' => 'Nur Laila',
        	'nama_suami' => 'Doni Ubaidillah',
        	'tempat_lahir' => 'Surabaya',
        	'tgl_lahir' => '1990-08-12',
        	'alamat' => 'Surabaya',
        	'rt' => 2,
        	'rw' => 1,
        	'kelurahan' => 'Sumberrejo',
        	'kecamatan' => 'Pakal',
        	'No_tlp' => '087465098365',
        	'agama' => '0',
        	'NIK' => 284926493846,
        	'No_KK' => 827359392683,
        	'No_BPJS' => 827359392683,
        	'gakin' => 0,
        	'jabatan' => 1,
		    'email' => 'admin@admin.com',
		    'password'  => bcrypt('admin123'),
		    'level' => 1,
            'user' => 1
		]);
    }
}
