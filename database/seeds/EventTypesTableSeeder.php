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
            ['id' => 1, 'event_type_name' => 'less'],
            ['id' => 2, 'event_type_name' => 'more']
        ];
        foreach($events as $event){
            EventType::create($event);
        }
    }
}
