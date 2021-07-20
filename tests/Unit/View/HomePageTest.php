<?php

namespace Tests\Unit\View;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function testVariableInPage()
    {
        $response = $this->get('/');

        $data = $response->getOriginalContent()->getData();

        $response->assertViewIs('home');

        $this->assertTrue($data['categories']->count() > 0);

        $response->assertViewHas('categories');

        $response->assertSuccessful();
    }

    public function testComponentInPage()
    {
        $response = $this->get('/');

        $response->assertSee('slides');
        $response->assertSee('about');
        $response->assertSee('slogan');
        $response->assertSee('menu-box');

        $response->assertSeeText(trans('homepage.welcome'));
        $response->assertSeeText(trans('homepage.little_history'));
        $response->assertSeeText(trans('homepage.slogan'));
        $response->assertSeeText(trans('homepage.special_menu'));
    }
}
