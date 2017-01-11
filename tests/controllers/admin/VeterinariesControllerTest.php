<?php

use App\Models\Veterinarians\Veterinary;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VeterinariesControllerTest extends TestCase
{
    /**
     * @test
     * @group admin/panel/veterinarians
     */
    public function it_check_veterinarians_list()
    {
        $veterinarians = factory(Veterinary::class, 10)->create([
            'web_id' => 1,
            'name' => 'Veterinario',
            'contact_name' => 'Jaime'
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::veterinarians::index')
            ->see('Listado de Veterinarios')
            ->seeInDatabase('veterinarians', [
                'id' => $veterinarians[0]->id,
            ]);
    }

    /**
     * @test
     * @group admin/panel/veterinarians
     */
    public function it_check_veterinarians_deleted_list()
    {
        $veterinarians = factory(Veterinary::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::veterinarians::deleted')
            ->see('Listado de Veterinarios eliminados');
    }

    /**
     * @test
     * @group admin/panel/veterinarians
     */
    public function it_create_veterinary()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::veterinarians::create')
            ->see('Nuevo veterinario')
            ->type('Veterinario', 'name')
            ->type('Jaime', 'contact_name')
            ->press('Crear')
            ->seeInDatabase('veterinarians', [
                'id' => 1,
            ])
            ->seeRouteIs('admin::panel::veterinarians::edit', ['id' => 1]);
    }

    /**
     * @test
     * @group admin/panel/veterinarians
     */
    public function it_edit_veterinary()
    {
        $veterinary = factory(Veterinary::class)->create([
            'web_id' => 1,
            'name' => 'Veterinario',
            'contact_name' => 'Jaime'
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('veterinarians', [
                'id' => 1
            ])
            ->visitRoute('admin::panel::veterinarians::edit', ['id' => 1])
            ->type('Otro nombre', 'name')
            ->press('Actualizar')
            ->seeInDatabase('veterinarians', [
                'name' => 'Otro nombre'
            ]);
    }

    /**
     * @test
     * @group admin/panel/veterinarians
     */
    public function it_delete_veterinary()
    {
        $veterinary = factory(Veterinary::class)->create([
            'web_id' => 1,
            'name' => 'Veterinario',
            'contact_name' => 'Jaime'
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('veterinarians', [
                'id' => 1
            ])
            ->visitRoute('admin::panel::veterinarians::delete', ['id' => 1])
            ->notSeeInDatabase('veterinarians', [
                'id' => 1,
                'deleted_at' => null
            ]);
    }

    /**
     * @test
     * @group admin/panel/veterinarians
     */
    public function it_restore_veterinary()
    {
        $veterinary = factory(Veterinary::class)->create([
            'web_id' => 1,
            'name' => 'Veterinario',
            'contact_name' => 'Jaime'
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('veterinarians', [
                'id' => 1,
                'name' => 'Veterinario',
                'contact_name' => 'Jaime'
            ])
            ->visitRoute('admin::panel::veterinarians::delete', ['id' => 1])
            ->notSeeInDatabase('veterinarians', [
                'id' => 1,
                'name' => 'Veterinario',
                'contact_name' => 'Jaime',
                'deleted_at' => null
            ])
            ->visitRoute('admin::panel::veterinarians::restore', ['id' => 1])
            ->seeInDatabase('veterinarians', [
                'id' => 1,
                'name' => 'Veterinario',
                'contact_name' => 'Jaime',
                'deleted_at' => null
            ]);
    }
}
