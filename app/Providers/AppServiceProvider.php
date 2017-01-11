<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Webs\Web;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));

        if (! $this->app->runningInConsole()) {
            if ($this->app->environment() === 'dev') {
                $web = Web::where('subdomain', 'dev')->first();
                $this->app->bind('App\Models\Webs\Web', function () use ($web) {
                    return $web;
                });
            } else {
                $request = app('Illuminate\Http\Request');

                $domain = strrchr($request->getHost(), '.');
                $host = str_replace($domain, '', str_replace('www.', '', $request->getHost()));

                if (strstr($host, '.')) {
                    $findBy = 'subdomain';
                    $host = strstr($host, '.', true);
                } else {
                    $findBy = 'domain';
                    $host = $host . $domain;
                }

                $web = Web::where($findBy, $host)->with('config')->first();

                if (! $web) {
                    abort(404);
                }

                $this->app->bind('App\Models\Webs\Web', function () use ($web) {
                    return $web;
                });
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
