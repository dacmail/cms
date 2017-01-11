<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    /**
     * @group auth
     */
    public function test_check_login_form()
    {
        $this->visitRoute('auth::login')
            ->see('Acceder al panel')
            ->type('testing@protecms.com', 'email')
            ->type('testing', 'password')
            ->press('Acceder')
            ->see('Panel de Administración | ProteCMS');
    }

    /**
     * @group auth
     */
    public function test_fail_login_form()
    {
        $this->visitRoute('auth::login')
            ->see('Acceder al panel')
            ->type('testing@protecms.com', 'email')
            ->type('wrong', 'password')
            ->press('Acceder')
            ->see('El correo electrónico o la contraseña no son válidos');
    }

    /**
     * @group auth
     */
    public function test_check_logout()
    {
        $this->actingAs($this->authUser())
            ->visitRoute('admin::panel::index')
            ->see('Panel de Administración | ProteCMS')
            ->visitRoute('auth::logout')
            ->see('Acceder al panel');
    }
}
