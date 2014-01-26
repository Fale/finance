<?php

class NoteTypesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NoteType::create(array('id' => 1, 'name' => 'Generic', 'html' => 'generic'));
        NoteType::create(array('id' => 2, 'name' => 'Important', 'html' => 'important'));
        NoteType::create(array('id' => 3, 'name' => 'Meeting', 'html' => 'meeting'));
        NoteType::create(array('id' => 4, 'name' => 'Split', 'html' => 'split'));
        NoteType::create(array('id' => 5, 'name' => 'Google', 'html' => 'google'));
    }

}
