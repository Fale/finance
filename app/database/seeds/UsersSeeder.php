<?php

class UsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'id' => 1,
            'firstname' => 'Fabio',
            'lastname' => 'Locati',
            'email' => 'fabiolocati@gmail.com',
            'password' => Hash::make('dellelinux')
        ));
        User::create(array(
            'id' => 2,
            'firstname' => 'Silvia',
            'lastname' => 'Tullii',
            'email' => 'silvia.tullii@gmail.com',
            'password' => Hash::make('stockpio69')
        ));
    }

}