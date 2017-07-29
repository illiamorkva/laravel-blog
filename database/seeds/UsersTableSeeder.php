<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        //generate 3 users/author
        $faker = Factory::create();

        DB::table('users')->insert([
            [
                'name' => 'Illia Morkva',
                'slug' => 'illia-morkva',
                'email' => 'illia@gmail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'name' => 'Ivan Morkva',
                'slug' => 'ivan-morkva',
                'email' => 'ivan@gmail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250, 300))
            ],
            [
                'name' => 'Alex Morkva',
                'slug' => 'alex-morkva',
                'email' => 'alex@gmail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250, 300))
            ],
        ]);
    }
}
