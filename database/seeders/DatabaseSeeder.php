<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
//use App\Models\User as ModelsUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user=new User();
        $user->name='htin kyaw';
        $user->email='htinkyaw@gmail.com';
        $user->password=bcrypt('12345678');
        $user->save();

        $user=new User();
        $user->name='min oo';
        $user->email='minoo@gmail.com';
        $user->password=bcrypt('12345678');
        $user->save();
        
        // \App\Models\User::factory(10)->create();
        $this->call(CategoryTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(PostTableSeeder::class);

        
    }
}
