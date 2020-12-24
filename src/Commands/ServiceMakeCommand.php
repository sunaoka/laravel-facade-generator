<?php

namespace Sunaoka\LaravelFacadeGenerator\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = true;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'facade:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class for facade';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Get the destination class path.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name .= Config::get('facade-generator.suffix.service');
        return parent::getPath($name);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $name .= Config::get('facade-generator.suffix.service');
        return parent::replaceClass($stub, $name);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/service.stub';
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
        return $rootNamespace . '\Services';
    }
}
