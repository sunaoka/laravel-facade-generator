<?php

namespace Sunaoka\LaravelFacadeGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class FacadeMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:facade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new facade, service and service provider class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Facade';

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $result = parent::handle();

        if ($result === false) {
            return $result;
        }

        $nameInput = $this->getNameInput();

        $this->call('make:service', ['name' => "${nameInput}Service"]);
        $this->call('make:provider-for-facade', ['name' => "${nameInput}ServiceProvider"]);

        $this->info(str_repeat('=', 80));
        $this->info("You must register a providers and an alias for the facade in `config/app.php'.");
        $this->info(str_repeat('-', 80));
        $this->info("'providers' => [\n    App\Providers\\${nameInput}ServiceProvider::class,\n],");
        $this->info("'aliases' => [\n    '${nameInput}' => App\Facades\\${nameInput}::class,\n],");

        return $result;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/facade.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Facades';
    }
}
