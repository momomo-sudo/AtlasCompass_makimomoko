<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'over_name' => '牧',
                'under_name' => '桃子',
                'over_name_kana' => 'マキ',
                'under_name_kana' => 'モモコ',
                'mail_address' => 'makimomoko@icloud.com',
                'sex' => '0',
                'birth_day' => '1999-06-08',
                'role' => 1,
                'password' => bcrypt('makimomoko'), // パスワードをハッシュ化
            ],
        ]);
    }
}
