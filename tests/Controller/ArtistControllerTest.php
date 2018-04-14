<?php

namespace Tests\Controller;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistControllerTest extends DuskTestCase{

    /** @test */
    public function index()
    {
        $this->browse(function ($browser) {
            $browser->visit('database/index')
                    ->assertSee('アーティスト一覧');
        });
    }
}
