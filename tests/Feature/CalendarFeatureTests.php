<?php

namespace Tests\Feature;

use App\Models\Calendar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarFeatureTests extends TestCase
{
   use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_homePage()
    {
        $response = $this->get('/Calendar');

        $response->assertStatus(200);
    }

    public function test_creating_event(){
        $response = $this->post('/calendar',[
            'title' => $this->faker->title(),
           'color' => 'red',
           'starts' => '2021-12-21 09:00:00',
           'ends' => '2021-12-21 11:00:00'
        ]);



        $response->assertStatus(201);
    }
    public function test_update_event(){
//        $user = Calendar::factory()->create();

        $event = Calendar::factory()->create();
         $this->put('calendar/'.$event->id,[
            'title' => "updated",
            'color' => 'skyblue',
            'starts' => '2021-12-21 13:00:00',
            'ends' => '2021-12-21 14:00:00'
        ]);

        $this->assertDatabaseHas('calendars',['id'=> $event->id ,
            'title' => "updated",
            'color' => 'skyblue',
            'starts' => '2021-12-21 13:00:00',
            'ends' => '2021-12-21 14:00:00']);
    }

    public function test_delete_event(){

        $event = Calendar::factory()->create();


        $this->delete('calendar/'.$event->id);

        $expectedCount = 0;
        $result = Calendar::count();
        $this->assertEquals(
            $expectedCount,
            $result
        );



    }

}
