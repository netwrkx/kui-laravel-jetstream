<?php

namespace KUI\Jetstream\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class TeamInvitationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kui-jetstream:invitation {stack : The development stack that should be replaced (mariogiancini,jetstream)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Improving The Team Invitation Flow.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->writeLogo();

        if ($this->argument('stack') === 'mariogiancini') {
            return $this->replaceDefaults();
        }

        if ($this->argument('stack') === 'jetstream') {
            return $this->replaceMariogiancini();
        }
    }

    public function replaceDefaults()
    {
        // CreateNewUser
        $this->comment('Processing CreateNewUser.php');
        $this->replaceInFolder('CreateNewUser.php', app_path('Actions/Fortify'), '/../../stubs/custom/app/Actions/Fortify/');
        $this->comment('');
        
        // UserLoggedIn
        $this->comment('Processing UserLoggedIn.php');
        $this->replaceInFolder('UserLoggedIn.php', app_path('Actions/Fortify'), '/../../stubs/custom/app/Actions/Fortify/');
        $this->comment('');

        // TeamInvitationController
        $this->comment('Processing TeamInvitationController.php');
        $this->replaceInFolder('TeamInvitationController.php', app_path('Http/Controllers'), '/../../stubs/custom/app/Http/Controllers/');
        $this->comment('');

        // Authenticate
        $this->comment('Processing Authenticate.php');
        $this->replaceInFolder('Authenticate.php', app_path('Http/Middleware'), '/../../stubs/custom/app/Http/Middleware/');
        $this->comment('');

        // RedirectIfAuthenticated
        $this->comment('Processing RedirectIfAuthenticated.php');
        $this->replaceInFolder('RedirectIfAuthenticated.php', app_path('Http/Middleware'), '/../../stubs/custom/app/Http/Middleware/');
        $this->comment('');

        // User
        $this->comment('Processing User.php');
        $this->replaceInFolder('User.php', app_path('Models'), '/../../stubs/custom/app/Models/');
        $this->comment('');

        // JetstreamServiceProvider
        $this->comment('Processing JetstreamServiceProvider.php');
        $this->replaceInFolder('JetstreamServiceProvider.php', app_path('Providers'), '/../../stubs/custom/app/Providers/');
        $this->comment('');

        // team-invitation.blade
        $this->comment('Processing team-invitation.blade.php');
        $this->replaceInFolder('team-invitation.blade.php', resource_path('views/emails'), '/../../stubs/custom/inertia/views/emails/');
        $this->comment('');

        // web
        $this->comment('Processing web.php');
        $this->replaceInFolder('web.php', base_path('routes'), '/../../stubs/custom/routes/');
        $this->comment('');
        
        $this->info('Jetstream ui scaffolding replaced successfully.');
        $this->comment('Please execute the "composer dumpautoload" command to build your assets.');
    }

    public function replaceMariogiancini()
    {
        // CreateNewUser
        $this->comment('Processing CreateNewUser.php');
        $this->replaceInFolder('CreateNewUser.php', app_path('Actions/Fortify'), '/../../stubs/defaults/app/Actions/Fortify/');
        $this->comment('');
        
        // UserLoggedIn
        $this->comment('Processing UserLoggedIn.php');
        $this->replaceInFolder('UserLoggedIn.php', app_path('Actions/Fortify'), '/../../stubs/defaults/app/Actions/Fortify/', false);
        $this->comment('');

        // TeamInvitationController
        $this->comment('Processing TeamInvitationController.php');
        $this->replaceInFolder('TeamInvitationController.php', app_path('Http/Controllers'), '/../../stubs/defaults/app/Http/Controllers/', false);
        $this->comment('');

        // Authenticate
        $this->comment('Processing Authenticate.php');
        $this->replaceInFolder('Authenticate.php', app_path('Http/Middleware'), '/../../stubs/defaults/app/Http/Middleware/');
        $this->comment('');

        // RedirectIfAuthenticated
        $this->comment('Processing RedirectIfAuthenticated.php');
        $this->replaceInFolder('RedirectIfAuthenticated.php', app_path('Http/Middleware'), '/../../stubs/defaults/app/Http/Middleware/');
        $this->comment('');

        // User
        $this->comment('Processing User.php');
        $this->replaceInFolder('User.php', app_path('Models'), '/../../stubs/defaults/app/Models/');
        $this->comment('');

        // JetstreamServiceProvider
        $this->comment('Processing JetstreamServiceProvider.php');
        $this->replaceInFolder('JetstreamServiceProvider.php', app_path('Providers'), '/../../stubs/defaults/app/Providers/');
        $this->comment('');

        // team-invitation.blade
        $this->comment('Processing team-invitation.blade.php');
        $this->replaceInFolder('team-invitation.blade.php', resource_path('views/emails'), '/../../stubs/defaults/inertia/views/emails/');
        $this->comment('');

        // web
        $this->comment('Processing web.php');
        $this->replaceInFolder('web.php', base_path('routes'), '/../../stubs/defaults/routes/');
        $this->comment('');
        
        $this->info('Jetstream ui scaffolding replaced successfully.');
        $this->comment('Please execute the "composer dumpautoload" command to build your assets.');
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFolder($filename, $path, $stub, $copy = true)
    {
        (new Filesystem)->ensureDirectoryExists($path);
        if(file_exists($path.'/'.$filename)) {
            $status  = unlink($path.'/'.$filename) ? 'The file '.$filename.' from '.$path.' has been deleted' : 'Error deleting '.$filename;
            $this->info($status);
            
            if($status == 'The file '.$filename.' from '.$path.' has been deleted' && $copy == true){
                copy(__DIR__ . $stub.$filename, $path.'/'.$filename);
                $this->info($filename.' successfully copied');
            }
        }
        else {
            $this->info('The file '.$filename.' from '.$path.' does not exist');
            $this->comment('');
            
            if($copy == true){
                $this->comment('Copying '.$filename.' into '.$path);
                copy(__DIR__ . $stub.$filename, $path.'/'.$filename);
                $this->info($filename.' successfully copied');
            }
        }
    }

    protected function writeLogo()
    {
        $logo = PHP_EOL . '<fg=bright-blue>
██╗  ██╗     ██╗   ██╗██╗
██║ ██╔╝     ██║   ██║██║
█████╔╝█████╗██║   ██║██║
██╔═██╗╚════╝██║   ██║██║
██║  ██╗     ╚██████╔╝██║
╚═╝  ╚═╝      ╚═════╝ ╚═╝
        </>' . PHP_EOL;

        return $this->line($logo);
    }
}
