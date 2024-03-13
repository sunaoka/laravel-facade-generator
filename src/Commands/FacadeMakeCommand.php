<?php

namespace Sunaoka\LaravelFacadeGenerator\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

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
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $result = parent::handle();

        if ($result === false) {
            return false;
        }

        $baseName = $this->getNameInput();
        $facadeClass = $baseName.Config::get('facade-generator.suffix.facade');
        $serviceClass = $baseName.Config::get('facade-generator.suffix.service');
        $providerClass = $baseName.Config::get('facade-generator.suffix.provider');

        $this->call('facade:service', ['name' => $baseName]);
        $this->call('facade:provider', ['name' => $baseName]);

        if (Config::get('facade-generator.test')) {
            $this->call('make:test', ['name' => "{$serviceClass}Test"]);
        }

        if (version_compare(app()->version(), '11.0.0') >= 0) {
            $this->info(
                "  You must add a providers in `bootstrap/providers.php'.\n\n".
                "  return [\n".
                "      {$this->rootNamespace()}Providers\\{$providerClass}::class,\n".
                "  ];\n\n\n".
                "  and, You must add an aliases in `config/app.php'.\n\n".
                "  'aliases' => [\n".
                "      '{$baseName}' => {$this->rootNamespace()}Facades\\{$facadeClass}::class,\n".
                '  ],'
            );
        } else {
            $this->info(
                "You must add a providers and an aliases in `config/app.php'.\n\n".
                "'providers' => [\n".
                "    {$this->rootNamespace()}Providers\\{$providerClass}::class,\n".
                "];\n\n".
                "'aliases' => [\n".
                "    '{$baseName}' => {$this->rootNamespace()}Facades\\{$facadeClass}::class,\n".
                '],'
            );
        }

        return $result;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $class = parent::buildClass($name);

        $baseName = $this->getNameInput();
        $serviceClass = $baseName.Config::get('facade-generator.suffix.service');

        return str_replace(
            ['DummyService', 'DummyName'],
            [$serviceClass, $baseName],
            $class
        );
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name .= Config::get('facade-generator.suffix.facade');

        return parent::getPath($name);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $name .= Config::get('facade-generator.suffix.facade');

        return parent::replaceClass($stub, $name);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/facade.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Facades';
    }
}
