<?php

namespace Tests;

use App\Entities\AdminUsers;
use Illuminate\Contracts\Console\Kernel;
use Artisan;

trait CreatesApplication
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     *
     */
    protected $baseUrl = 'http://localhost/';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function prepareForTests()
    {
        Artisan::call('migrate');

        if(!AdminUsers::all()->count()){
            Artisan::call('db:seed');
        }
    }

    public function adminLogin()
    {
        $this->post('admin/login', ["name" => "admin", "password" => "1234"]);
    }

}
