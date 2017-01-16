<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Import locations
        $files = ['countries.sql', 'states.sql', 'cities.sql'];

        foreach ($files as $file) {
            $sql = file_get_contents(database_path('seeds/dumps/' . $file));
            $statements = array_filter(array_map('trim', explode(';', $sql)));

            foreach ($statements as $stmt) {
                DB::statement($stmt);
            }
        }

        $permissions = [
            'admin',
            'admin.panel.stats',
            'admin.calendar',
            'admin.calendar.view',
            'admin.finances',
            'admin.finances.view',
            'admin.design',
            'admin.design.view',
            'admin.support',
            'admin.reports',
            'admin.tasks',
            'admin.tasks.view',
            'admin.panel.posts',
            'admin.panel.posts.view',
            'admin.panel.posts.crud',
            'admin.panel.pages',
            'admin.panel.pages.view',
            'admin.panel.pages.crud',
            'admin.panel.forms',
            'admin.panel.forms.view',
            'admin.panel.forms.crud',
            'admin.panel.files',
            'admin.panel.files.view',
            'admin.panel.files.crud',
            'admin.panel.users',
            'admin.panel.users.view',
            'admin.panel.partners',
            'admin.panel.partners.view',
            'admin.panel.veterinarians',
            'admin.panel.veterinarians.view',
            'admin.panel.animals',
            'admin.panel.animals.dog',
            'admin.panel.animals.dog.view',
            'admin.panel.animals.cat',
            'admin.panel.animals.cat.view',
            'admin.panel.animals.horse',
            'admin.panel.animals.horse.view',
            'admin.panel.animals.rodent',
            'admin.panel.animals.rodent.view',
            'admin.panel.animals.bird',
            'admin.panel.animals.bird.view',
            'admin.panel.animals.reptil',
            'admin.panel.animals.reptil.view',
            'admin.panel.animals.other',
            'admin.panel.animals.other.view',
            'admin.panel.temporaryhomes',
            'admin.panel.temporaryhomes.view'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'permission' => $permission
            ]);
        }
    }
}
