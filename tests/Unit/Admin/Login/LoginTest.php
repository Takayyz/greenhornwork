<?php

namespace Tests\Unit\Admin\Login;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->call('GET', 'admin/login');
    }

    public function testLoginSuccess()
    {
        $this->post('admin/login', ["name" => "admin", "password" => "1234"])
             ->assertRedirect('/admin');
    }

    public function testLoginFail()
    {
        $this->post('admin/login', ["name" => "test", "password" => "err000"])
             ->assertRedirect('admin/login');
    }
}
