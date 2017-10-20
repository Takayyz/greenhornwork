<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->adminLogin();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHoge()
    {
        $this->get('admin/store')->assertStatus(200);
    }

    /** @test */
    public function index()
    {
        $this->get('admin/store/create')->assertStatus(200);
    }
}
