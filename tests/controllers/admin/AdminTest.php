<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    /**
     * @test
     * @group admin
     */
    public function it_check_dashboard()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::index')
            ->see('Escritorio');
    }

    /**
     * @test
     * @group admin
     */
    public function it_check_design()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::design::index')
            ->see('Diseño');
    }

    /**
     * @test
     * @group admin
     */
    public function it_check_calendar()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::calendar::index')
            ->see('Calendario');
    }

    /**
     * @test
     * @group admin
     */
    public function it_check_finances()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::finances::index')
            ->see('Finanzas');
    }

    /**
     * @test
     * @group admin
     */
    public function it_check_support()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::support::index')
            ->see('Soporte');
    }
}
