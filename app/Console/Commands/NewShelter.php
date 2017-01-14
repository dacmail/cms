<?php

namespace App\Console\Commands;

use App\Models\Webs\Web;
use Illuminate\Console\Command;

class NewShelter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'protecms:newshelter 
                            {subdomain : Shelter\'s subdomain} 
                            {domain : Shelter\'s domain} 
                            {email : Shelter\'s email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new shelter';

    /**
     * Web model
     * 
     * @var \App\Models\Webs\Web
     */
    protected $web;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Web $web)
    {
        parent::__construct();

        $this->web = $web;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $web = $this->web;
            $web->domain = $this->argument('domain');
            $web->subdomain = $this->argument('subdomain');
            $web->email = $this->argument('email');
        $web->save();

        $this->info('Shelter created successfully');
    }
}
