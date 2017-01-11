<?php

use App\Models\Partners\Partner;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartnersControllerTest extends TestCase
{
    /**
     * @test
     * @group admin/panel/partners
     */
    public function it_check_partners_list()
    {
        $partners = factory(Partner::class, 10)->create([
            'web_id' => 1,
            'name' => 'Socio',
            'donation' => 10
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::partners::index')
            ->see('Listado de Socios')
            ->seeInDatabase('partners', [
                'id' => $partners[0]->id,
            ]);
    }

    /**
     * @test
     * @group admin/panel/partners
     */
    public function it_check_partners_deleted_list()
    {
        $partners = factory(Partner::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::partners::deleted')
            ->see('Listado de Socios eliminados');
    }

    /**
     * @test
     * @group admin/panel/partners
     */
    public function it_create_partner()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::partners::create')
            ->see('Nuevo socio')
            ->type('Socio', 'name')
            ->type(10, 'donation')
            ->press('Crear socio')
            ->seeInDatabase('partners', [
                'id' => 1,
            ])
            ->seeRouteIs('admin::panel::partners::edit', ['id' => 1]);
    }

    /**
     * @test
     * @group admin/panel/partners
     */
    public function it_edit_partner()
    {
        $partner = factory(Partner::class)->create([
            'web_id' => 1,
            'name' => 'Socio',
            'donation' => 10
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('partners', [
                'id' => 1
            ])
            ->visitRoute('admin::panel::partners::edit', ['id' => 1])
            ->type('Otro nombre', 'name')
            ->press('Actualizar')
            ->seeInDatabase('partners', [
                'name' => 'Otro nombre'
            ]);
    }

    /**
     * @test
     * @group admin/panel/partners
     */
    public function it_delete_partner()
    {
        $partner = factory(Partner::class)->create([
            'web_id' => 1,
            'name' => 'Socio',
            'donation' => 10
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('partners', [
                'id' => 1
            ])
            ->visitRoute('admin::panel::partners::delete', ['id' => 1])
            ->notSeeInDatabase('partners', [
                'id' => 1,
                'deleted_at' => null
            ]);
    }

    /**
     * @test
     * @group admin/panel/partners
     */
    public function it_restore_partner()
    {
        $partner = factory(Partner::class)->create([
            'web_id' => 1,
            'name' => 'Socio',
            'donation' => 10
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('partners', [
                'id' => 1,
                'name' => 'Socio',
                'donation' => 10
            ])
            ->visitRoute('admin::panel::partners::delete', ['id' => 1])
            ->notSeeInDatabase('partners', [
                'id' => 1,
                'name' => 'Socio',
                'donation' => 10,
                'deleted_at' => null
            ])
            ->visitRoute('admin::panel::partners::restore', ['id' => 1])
            ->seeInDatabase('partners', [
                'id' => 1,
                'name' => 'Socio',
                'donation' => 10,
                'deleted_at' => null
            ]);
    }
}
