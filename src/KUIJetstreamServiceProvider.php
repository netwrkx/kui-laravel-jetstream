<?php

namespace KUI\Jetstream;

use Illuminate\Support\ServiceProvider;
use KUI\Jetstream\Middleware\HandleTeamInvitationRequests;

class KUIJetstreamServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->router->aliasMiddleware('auth', HandleTeamInvitationRequests::class);

        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\ReplaceCommand::class,
            Console\TeamInvitationCommand::class,
        ]);
    }

    public function register()
    {
        //
    }
}
