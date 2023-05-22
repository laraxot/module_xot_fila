<?php

declare(strict_types=1);

namespace Modules\Xot\Console;

use Illuminate\Console\Command;
use Modules\Xot\Services\StubService;
use Nwidart\Modules\Facades\Module;
// ----------------------------------------------------

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/*
-- CSV --
https://scotch.io/bar-talk/automate-tasks-by-creating-custom-artisan-command-in-laravel

-- nice example --
https://mattstauffer.com/blog/advanced-input-output-with-artisan-commands-tables-and-progress-bars-in-laravel-5.1/

https://themsaid.com/building-testing-interactive-console-20160409/
https://www.cloudways.com/blog/custom-artisan-commands-laravel/


//-- da leggere
https://medium.com/@tomgrohl/using-php-traits-for-laravel-eloquent-relationships-7357901a01a4
https://medium.com/@josepostiga/how-i-managed-to-control-chaos-with-laravel-d47b9444a451

*/

/**
 * Class CreateAllRepositoriesCommand.
 */
class CreateAllRepositoriesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'xot:create-all-repos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all repositories ';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modules = Module::all();
        // dddx($modules);
        // $this->info('Success ! User Created !');
        $all = [];
        foreach ($modules as $mod) {
            $models = getModuleModels($mod->getName());
            $all = array_merge($all, $models);
        }
        foreach ($all as $k => $v) {
            //  StubService::missingClass(['class' => $v, 'stub' => 'repository']);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            //  ['name', InputArgument::REQUIRED, 'nickname of user'],
            //  ['level', InputArgument::REQUIRED, 'level of user'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['list', null, InputOption::VALUE_OPTIONAL, 'list all users.', null],
        ];
    }
}
