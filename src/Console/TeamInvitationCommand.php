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
    protected $signature = 'kui-jetstream:invitation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Improving The Team Invitation Flow.';

    protected $isVite = false;

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

        $this->replaceInertia();
    }

    public function replaceInertia()
    {
        // Components + Pages...
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Components'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Composables'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Pages'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Toast'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia/js/Components', resource_path('js/Components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia/js/Composables', resource_path('js/Composables'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia/js/Layouts', resource_path('js/Layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia/js/Pages', resource_path('js/Pages'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia/js/Toast', resource_path('js/Toast'));


        copy(__DIR__ . '/../../stubs/inertia/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__ . '/../../stubs/inertia/css/app.css', resource_path('css/app.css'));

        if(!$this->isVite) {
            
        } else {
            copy(__DIR__ . '/../../stubs/inertia/views/app.vite.blade.php', resource_path('views/app.blade.php'));
            copy(__DIR__ . '/../../stubs/inertia/vite.config.js', base_path('vite.config.js'));
            copy(__DIR__ . '/../../stubs/inertia/js/app.vite.js', resource_path('js/app.js'));
            copy(__DIR__ . '/../../stubs/common/postcss.config.js', base_path('postcss.config.js'));
        }

        if($this->option('teams')) {
            (new Filesystem)->ensureDirectoryExists(resource_path('js/Pages/Teams'));
            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia/js/Teams', resource_path('js/Pages/Teams'));
        }
        
        $this->info('Jetstream ui scaffolding replaced successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
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
