<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WebTest extends TestCase
{
    /** @test */
    public function it_check_that_web_exists()
    {
        $this->seeInDatabase('webs', [
            'id' => 1,
            'subdomain' => 'testing'
        ]);
    }
}
