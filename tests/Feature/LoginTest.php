<?php

namespace Tests\Feature;

use Tests\TestCase;
use DB;

class LoginTest extends TestCase
{
    protected $user = [
      'name' => 'admin',
      'password' => '1234'
    ];

    protected $errorUser = [
      'name' => 'yuta',
      'password' => '0809'
    ];
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp(){
      parent::setUp();
      $this->prepareForTests();
    }

    public function testLoginPageIn()
    {
      $responce = $this->call(
        'GET',
        'admin/auth/login',
        [],
        [],
        [],
       ['HTTP_REFERER' => '/']
     );

      $this->assertEquals(200,$responce->getStatusCode());
    }

    public function testUserLoginSuccess()
    {
      $this->post('admin/login', $this->user)
       ->assertRedirect('/admin');
    }

    public function testUserLoginError()
    {
      $this->post('admin/login', $this->errorUser)
      ->assertStatus(302);
    }
}
