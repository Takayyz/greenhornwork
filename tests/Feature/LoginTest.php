<?php

namespace Tests\Feature;

use Tests\TestCase;
use DB;
use App\Entities\AdminUsers;
use Artisan;

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
    public function setUp()
    {
      parent::setUp();
      $this->call(
        'GET',
        'admin/login'
      );

    }

    public function testLoginPageIn()
    {
      $responce = $this->call(
        'GET',
        'admin/login'
     );
      $this->assertEquals(200,$responce->getStatusCode());
      $this->assertContains('管理者ユーザー名',$responce->content());
      $this->assertContains('パスワード',$responce->content());
    }

    public function testUserLoginSuccess()
    {
      $this->post('admin/login', $this->user)
      ->assertRedirect('/admin');
    }

    public function testUserLoginError()
    {
      $this->post('admin/login', $this->errorUser)
      ->assertRedirect('admin/login');
    }
}
