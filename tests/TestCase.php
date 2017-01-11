<?php

use App\Models\Webs\Web;
use App\Models\Users\User;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();

        $this->prepareForTests();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Prepare set up for tests
     */
    public function prepareForTests()
    {
        Artisan::call('migrate:refresh');

        $web = new Web;
        $web->subdomain = 'testing';
        $web->installed = 1;
        $web->save();

        $web->users()->create([
            'name' => 'Testing',
            'email' => 'testing@protecms.com',
            'password' => 'testing',
            'type' => 'admin',
            'status' => 'active'
        ]);

        $web->setConfigs(config('protecms.webs.config.default'));

        $this->app->bind('App\Models\Webs\Web', function () use ($web) {
            return $web;
        });
    }

    /**
     * Verify the number of dom elements
     * @param  string   $selector the dom selector (jquery style)
     * @param  int      $number   how many elements should be present in the dom
     * @return $this
     */
    public function countElements($selector, $number)
    {
        $this->assertCount($number, $this->crawler->filter($selector));
        return $this;
    }

    /**
     * @param $values
     * @param $name
     * @return $this
     */
    protected function typeArray($values, $name)
    {
        $this->inputs[$name] = $values;

        return $this;
    }

    /**
     * @return mixed
     */
    public function authUser()
    {
        return User::where('email', 'testing@protecms.com')->first();
    }

    /**
     * @param $path
     * @return UploadedFile
     */
    public function prepareFileUpload($path)
    {
        TestCase::assertFileExists($path);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $mime = finfo_file($finfo, $path);

        return new UploadedFile($path, null, $mime, null, null, true);
    }
}
