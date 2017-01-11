<?php

use App\Models\Forms\Form;
use App\Models\Forms\Field;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FormsControllerTest extends TestCase
{
    /**
     * @test
     * @group admin/panel/forms
     */
    public function it_check_forms_list()
    {
        $forms = factory(Form::class, 10)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1,
                'subject' => 'Asunto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::forms::index')
            ->see('Listado de Formularios')
            ->seeInDatabase('forms', [
                'id' => $forms[0]->id,
            ])
            ->seeInDatabase('forms_translations', [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1,
                'subject' => 'Asunto'
            ]);
    }

    /**
     * @test
     * @group admin/panel/forms
     */
    public function it_check_forms_deleted_list()
    {
        factory(Form::class, 10)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1,
                'subject' => 'Asunto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::forms::deleted')
            ->see('Listado de Formularios eliminados');
    }

    /**
     * @group admin/panel/forms
     */
    public function test_edit_form()
    {
        $form = factory(Form::class)->create([
            'web_id' => 1,
            'es' => [
                'title' => 'Prueba',
                'slug' => 'prueba',
                'text' => 'Texto',
                'user_id' => 1,
                'subject' => 'Asunto'
            ]
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::forms::edit', ['id' => 1])
            ->see($form->title);
    }
}
