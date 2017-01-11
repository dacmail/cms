<?php

use App\Models\Files\File;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilesControllerTest extends TestCase
{
    /**
     * @test
     * @group admin/panel/files
     */
    public function it_check_files_list()
    {
        $files = factory(File::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::files::index')
            ->see('Listado de Archivos')
            ->seeInDatabase('files', [
                'id' => $files[0]->id,
            ]);
    }

    /**
     * @test
     * @group admin/panel/files
     */
    public function it_check_files_deleted_list()
    {
        factory(File::class, 10)->create([
            'web_id' => 1
        ]);

        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::files::deleted')
            ->see('Listado de Archivos eliminados');
    }

    /**
     * @test
     * @group admin/panel/files
     */
    public function it_edit_file()
    {
        factory(File::class)->create();

        $this->actingAs($this->authUser())
            ->seeInDatabase('files', [
                'id' => 1
            ])
            ->visitRoute('admin::panel::files::edit', ['id' => 1])
            ->seeStatusCode(200);
    }
}
