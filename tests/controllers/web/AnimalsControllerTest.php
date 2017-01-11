<?php

use App\Models\Animals\Animal;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;

class AnimalsControllersTest extends TestCase
{
    /**
     * @group web
     */
    public function test_check_animals_page()
    {
        factory(Animal::class, 5)->create(['visible' => 'visible']);

        factory(App\Models\Animals\Animal::class, 1)->create(['visible' => 'hidden']);

        $this->visitRoute('web::animals::index')
            ->countElements('.animals .animals-list .animal', 5);
    }

    /**
     * @group web
     */
    public function test_check_animals_page_with_filters()
    {
        factory(Animal::class, 2)->create(['visible' => 'visible', 'kind' => 'dog']);
        factory(Animal::class, 1)->create(['visible' => 'visible', 'kind' => 'cat']);
        factory(App\Models\Animals\Animal::class, 1)->create(['visible' => 'hidden']);

        $this->visit(route('web::animals::index') . '?especie=perros')
            ->countElements('.animals .animals-list .animal', 2);
    }

    /**
     * @group web
     */
    public function test_check_animals_single_page()
    {
        $animal = factory(Animal::class)->create(['visible' => 'visible']);

        $this->visitRoute('web::animals::show', ['id' => $animal->id])
            ->see("Ficha de {$animal->name}");
    }

    /**
     * @group web
     */
    // public function test_contact_animal_email()
    // {
    //     $animal = factory(Animal::class)->create(['visible' => 'visible']);

    //     Mail::shouldReceive('send')
    //         ->once()
    //         ->andReturnUsing(function ($view, $params, $other) use ($animal) {
    //             $this->assertEquals($view, 'emails.web.animal');
    //             $this->assertEquals($params['data']['name'], 'Jaime');
    //             $this->assertEquals($params['animal']['name'], $animal->name);
    //         });

    //     $this->json('POST', route('web::animals::contact', ['id' => $animal->id]), [
    //         'name' => 'Jaime',
    //         'email' => 'web@protecms.com',
    //         'phone' => '111222333',
    //         'subject' => 'Asunto',
    //         'message' => 'Mensaje'
    //     ])->assertRedirectedToRoute('web::animals::show', ['id' => $animal->id]);
    // }
}
