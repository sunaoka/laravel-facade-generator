<?php

namespace Sunaoka\LaravelFacadeGenerator\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ProviderMakeCommand extends GeneratorCommand
{
    protected $hidden = true;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:provider-for-facade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service provider class for facade';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Provider';

    /**
     * @var string
     */
    protected $serviceNamespace;

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     *
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $class = parent::buildClass($name);

        $serviceName = Str::replaceLast('Provider', '', $this->getNameInput());

        $class = str_replace('DummyServiceNamespace', $this->serviceNamespace . '\\' . $serviceName, $class);
        $class = str_replace('DummyService', $serviceName, $class);
        $class = str_replace('DummyFacade', Str::replaceLast('Service', '', $serviceName), $class);

        return $class;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/provider.stub';
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
        $this->serviceNamespace = $rootNamespace . '\Services';
        return $rootNamespace . '\Providers';
    }
}
