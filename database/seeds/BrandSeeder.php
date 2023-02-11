<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Product\Brand;
use App\Models\Admin\Product\ProductSet;

use App\Models\User\Member\Member;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $member = new Member;
            $member->avatar = 'anh-user '.$i;
            $member->name = 'ten user '.$i;
            $member->phone = '012384567'.$i;
            $member->address = 'thon a xa b huyen c tinh '.$i;
            $member->email = 'user00'.$i.'@gmail.com';
            $member->password = 'rhrtherkjgjtyuj'.$i;
            $member->save();
        }
    }
}
