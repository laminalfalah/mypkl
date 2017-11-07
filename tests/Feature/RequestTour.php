<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestTour extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
             ->see('Request Tour')
             ->click('Request Tour')
             ->landOn('/tour/request')
             ->submitForm('submit', [

             ])
             ->notSeeInDatabase('request_tours', [

             ])
             ->see('Field Kosong');
    }
}
