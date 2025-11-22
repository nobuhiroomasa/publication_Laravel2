<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    /**
     * @dataProvider publicPageRoutes
     */
    public function test_each_public_route_renders_expected_view(string $routeName, string $expectedView): void
    {
        $this->get(route($routeName))
            ->assertOk()
            ->assertViewIs($expectedView);
    }

    public static function publicPageRoutes(): array
    {
        return [
            ['home', 'pages.home'],
            ['menu', 'pages.menu'],
            ['access', 'pages.access'],
            ['contact', 'pages.contact'],
            ['reserve', 'pages.reserve'],
            ['gallery', 'pages.gallery'],
        ];
    }
}
