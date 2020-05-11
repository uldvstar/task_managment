<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crude:generator {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all files required for crude operations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $name = $this->argument('name');
        $this->info( Str::plural(Str::studly($name)));
//        $this->controller($name);
    }


    protected function getStub($path) {
        return file_get_contents(app_path('Stubs/Controller/Controller.stub'));
    }

    protected function controller($name) {
        $template = str_replace([
            '{{categoryNameStudlyCasePlural}}',
            '{{type}}',
            '{{modelNameStudlyCasePlural}}'
        ], [
            Str::plural(Str::studly('Account')),
            'lists',
            Str::plural(Str::studly($name))
        ], $this->getStub(''));

        file_put_contents(app_path('/Http/Controllers/TestGeneratedController.php'), $template);
    }
}
