<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
            $browser->visit('http://chatdemo.dev.br/login')
                    ->type('email', 'wesley@eguana.com.br')
                    ->type('password', 'web123')
                    ->press('Login')
                    ->assertPathIs('/chat');

            $browser->visit('http://chatdemo.dev.br/chat')
                    ->type('message', 'Olá sou o dusk')
                    ->press('Enviar')
                    ->assertInputValue('message', '');
        });
    }
}
