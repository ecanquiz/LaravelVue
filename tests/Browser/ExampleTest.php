<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertTitle('Laravel')
                    ->assertSee("Iniciar sesión")
                    ->clickLink("Iniciar sesión")
                    ->pause(1000)
                    ->assertPathIs("/login")
                    ->assertSee("Correo Electrónico")
                    ->assertSee("Contraseña")
                    ->assertSee("Recuérdame")
                    ->assertSee("¿Olvidaste tu contraseña?")
                    ->assertSee("Iniciar sesión");
        });
    }
}
