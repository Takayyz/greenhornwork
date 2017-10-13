<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DB;

class LoginTest extends TestCase
{
    protected $resetDatabase = false;

    protected $user = [
      'name' => 'admin',
      'password' => '1234'
    ];

    protected $erroruser = [
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

      if ($this->resetDatabase) {
      Artisan::call('migrate:refresh --seed');

    }
    \DB::beginTransaction();
    }

    public function testLoginPageIn()
    {
      $this->resetDatabase = true;

      $responce = $this->call(
        'GET', //$method
        'admin/auth/login', //$uri
        [],//$parameters = []
        [],// $cookies = []
        [],//$files = []
       ['HTTP_REFERER' => '/']//$server = []
         //$content = null
     );

      $this->assertEquals(200,$responce->getStatusCode());
    }

    public function testUserLoginSuccess()
    {
      $this->resetDatabase = true;

      $this->post('admin/login', $this->user)
       ->assertRedirect('/admin');
    }

    public function testUserLoginError()
    {
      $this->reresetDatabase = false;

      $this->post('admin/login', $this->erroruser)
      ->assertStatus(302);
    }
}
