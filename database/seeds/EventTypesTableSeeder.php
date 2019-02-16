<?php

use App\EventType;
use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            ['id' => 1, 'name' => 'less'],
            ['id' => 2, 'name' => 'more']
        ];
        foreach($events as $event){
            EventType::create($event);
        }
    }
}
