<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


use Symfony\Component\Console\Output\ConsoleOutput;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        Gate::define('Admin', function (Request $request) {

            $output = new ConsoleOutput();
            $output->writeln($request);
                return true;


            $usertype = $request->header('Role');

           

            if( $usertype == 'Admin'){
                  $output = new ConsoleOutput();
                $output->writeln('Admin ROle detected');
                return true;
            }else return false;
        });

        //
        /*
        Auth::provider('legacy', function ($app, array $config) {
            return new LegacyUserProvider($config['model']);
        });*/ //needs legacyuserprovider...
    }
}
