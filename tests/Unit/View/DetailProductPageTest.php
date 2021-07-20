<?php

namespace Tests\Unit\View;

use Tests\TestCase;

class DetailProductPageTest extends TestCase
{
    public function testVariableInPage()
    {
        $response = $this->get('/products/5');

        $data = $response->getOriginalContent()->getData();

        $response->assertViewIs('product-detail');

        $response->assertViewHas('product');

        $this->assertTrue($data['product']->price > 0);
        $this->assertTrue($data['product']->images->count() > 0);

        $response->assertSuccessful();
    }

    public function testComponentInPage()
    {
        $response = $this->get('/products/5');

        $response->assertSee('heading');
        $response->assertSee('details_product');
        $response->assertSee('list_ratings');
        $response->assertSee('form_add_rating');
        $response->assertSee('rating-block');
    }
}
