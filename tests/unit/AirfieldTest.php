<?php

class AirfieldTest extends TestCase
{
    /** @test */
    public function it_can_create_a_new_airfield(){
        $airport = \CTP\Models\Airfield::buildFromIcao("CYUL");

        $airport->save();
    }

    /** @test */
    public function it_throws_duplicate_icao_exception_when_trying_to_use_the_same_icao(){

    }

    /** @test */
    public function it_throws_duplicate_iata_exception_when_trying_to_use_the_same_iata(){

    }

    /** @test */
    public function it_returns_the_correct_number_of_votes(){
        
    }

    /** @test */
    public function it_returns_the_correct_event(){

    }
}
