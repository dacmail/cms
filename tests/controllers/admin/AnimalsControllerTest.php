<?php

use App\Models\Animals\Animal;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnimalsControllerTest extends TestCase
{
    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_check_animals_list()
    {
        $animals = factory(Animal::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::index')
            ->see('Listado de Animales')
            ->seeInDatabase('animals', [
                'id' => $animals[0]->id,
                'name' => $animals[0]->name
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_check_animals_deleted_list()
    {
        $animals = factory(Animal::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::deleted')
            ->see('Listado de Animales eliminados')
            ->seeInDatabase('animals', [
                'id' => $animals[0]->id,
                'name' => $animals[0]->name
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_create_animal()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::create')
            ->see('Nueva ficha')
            ->type('Suky', 'name')
            ->press('Crear ficha')
            ->seeInDatabase('animals', [
                'id' => 1,
                'name' => 'Suky'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_edit_animal()
    {
        factory(Animal::class)->create([
            'web_id' => 1,
            'name' => 'Ahri',
            'microchip' => 'Old'
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals', [
                'id' => 1,
                'name' => 'Ahri',
                'microchip' => 'Old'
            ])
            ->visitRoute('admin::panel::animals::edit', ['id' => 1])
            ->see('Ficha de Ahri')
            ->type('Awesome', 'microchip')
            ->press('Actualizar')
            ->seeInDatabase('animals', [
                'id' => 1,
                'name' => 'Ahri',
                'microchip' => 'Awesome'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_delete_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1,
            'name' => 'Turko',
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals', [
                'id' => 1,
                'name' => 'Turko'
            ])
            ->visitRoute('admin::panel::animals::delete', ['id' => 1])
            ->notSeeInDatabase('animals', [
                'id' => 1,
                'name' => 'Turko',
                'deleted_at' => null
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_delete_animal_translation()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1,
            'name' => 'Suky',
            'es' => [
                'text' => '¡Soy la mejor!'
            ],
            'en' => [
                'text' => 'I\'m the best!'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals_translations', [
                'locale' => 'es',
                'text' => '¡Soy la mejor!'
            ])
            ->seeInDatabase('animals_translations', [
                'locale' => 'en',
                'text' => 'I\'m the best!'
            ])
            ->visitRoute('admin::panel::animals::delete_translation', ['id' => 1])
            ->notSeeInDatabase('animals_translations', [
                'locale' => 'es',
                'text' => '¡Soy la mejor!'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_restore_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1,
            'name' => 'Turko',
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals', [
                'id' => 1,
                'name' => 'Turko'
            ])
            ->visitRoute('admin::panel::animals::delete', ['id' => 1])
            ->notSeeInDatabase('animals', [
                'id' => 1,
                'name' => 'Turko',
                'deleted_at' => null
            ])
            ->visitRoute('admin::panel::animals::restore', ['id' => 1])
            ->seeInDatabase('animals', [
                'id' => 1,
                'name' => 'Turko',
                'deleted_at' => null
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_check_animals_health_list()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        factory(\App\Models\Animals\Health::class, 5)->create([
            'animal_id' => $animal->id
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::health::index', ['id' => $animal->id])
            ->see("Ficha de {$animal->name}")
            ->countElements('table.table-center tbody tr', 5);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_create_health_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::health::create', ['id' => $animal->id])
            ->see("Añadir salud a la ficha de {$animal->name}")
            ->type('Titulo', 'title')
            ->select('treatment', 'type')
            ->press('Añadir')
            ->seeInDatabase('animals_health', [
                'animal_id' => $animal->id,
                'title' => 'Titulo'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_edit_health_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        $health = factory(\App\Models\Animals\Health::class)->create([
            'animal_id' => $animal->id,
            'title' => 'Titulo salud'
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals_health', [
                'animal_id' => $animal->id,
                'title' => 'Titulo salud'
            ])
            ->visitRoute('admin::panel::animals::health::edit', ['id' => $health->id, 'animal_id' => $animal->id])
            ->see('Titulo salud')
            ->type('Otro titulo', 'title')
            ->press('Actualizar')
            ->seeInDatabase('animals_health', [
                'id' => $health->id,
                'animal_id' => $animal->id,
                'title' => 'Otro titulo'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_delete_health_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        $health = factory(\App\Models\Animals\Health::class)->create([
            'animal_id' => $animal->id
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals_health', [
                'id' => $health->id
            ])
            ->visitRoute('admin::panel::animals::health::delete', ['id' => $health->id, 'animal_id' => $animal->id])
            ->notSeeInDatabase('animals_health', [
                'id' => $health->id,
                'deleted_at' => null
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_check_animals_sponsorships_list()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        factory(\App\Models\Animals\Sponsorship::class, 5)->create([
            'animal_id' => $animal->id
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::sponsorships::index', ['id' => $animal->id])
            ->see("Apadrinamientos de {$animal->name}")
            ->countElements('table.table-center tbody tr', 5);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_create_sponsorships_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::animals::sponsorships::create', ['id' => $animal->id])
            ->see("Añadir apadrinamiento a la ficha de {$animal->name}")
            ->type('Alicia', 'name')
            ->select('visible', 'visible')
            ->select('active', 'status')
            ->select('day', 'donation_time')
            ->press('Añadir')
            ->seeInDatabase('animals_sponsorships', [
                'animal_id' => $animal->id,
                'name' => 'Alicia'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_edit_sponsorships_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        $sponsorships = factory(\App\Models\Animals\Sponsorship::class)->create([
            'animal_id' => $animal->id,
            'name' => 'Jaime'
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals_sponsorships', [
                'animal_id' => $animal->id,
                'name' => 'Jaime'
            ])
            ->visitRoute('admin::panel::animals::sponsorships::edit', ['id' => $sponsorships->id, 'animal_id' => $animal->id])
            ->see('Jaime')
            ->type('Otro nombre', 'name')
            ->press('Actualizar')
            ->seeInDatabase('animals_sponsorships', [
                'id' => $sponsorships->id,
                'animal_id' => $animal->id,
                'name' => 'Otro nombre'
            ]);
    }

    /**
     * @test
     * @group admin/panel/animals
     */
    public function test_delete_sponsorships_animal()
    {
        $animal = factory(Animal::class)->create([
            'web_id' => 1
        ]);

        $sponsorships = factory(\App\Models\Animals\Sponsorship::class)->create([
            'animal_id' => $animal->id
        ]);

        $this->actingAs($this->authUser())
            ->seeInDatabase('animals_sponsorships', [
                'id' => $sponsorships->id
            ])
            ->visitRoute('admin::panel::animals::sponsorships::delete', ['id' => $sponsorships->id, 'animal_id' => $animal->id])
            ->notSeeInDatabase('animals_sponsorships', [
                'id' => $sponsorships->id,
                'deleted_at' => null
            ]);
    }
}
