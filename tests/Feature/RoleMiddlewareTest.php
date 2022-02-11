<?php
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase, UserTestable;

    public function test_role_middleware_not_logged_in()
    {
        $response = $this->get(route("users"));
        $response->assertStatus(302);
    }

    public function test_role_middleware_deny_role()
    {
        $this->actingAs(UserTestable::userCommon());
        $response = $this->get(route("users"));
        $response->assertStatus(403);
    }

    public function test_role_middleware_allow_role()
    {
        $this->actingAs(UserTestable::userAdmin());
        $response = $this->get(route("users"));
        $response->assertStatus(200);
    }
}
