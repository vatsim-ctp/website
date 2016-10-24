<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandingTest extends TestCase
{
    /** @test */
    public function it_displays_the_landing_page(){
        
    }

    /** @test */
    public function it_redirects_to_the_voting_page_when_voting_is_enabled(){

    }

    /** @test */
    public function it_doesnt_redirect_to_the_voting_page_when_voting_is_disabled(){

    }

    /** @test */
    public function it_doesnt_redirect_to_the_voting_page_when_voting_isnt_set(){

    }

    /** @test */
    public function it_redirects_to_the_main_site_when_it_is_enabled(){

    }
}
