<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $repositoryClass;

    private $module;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $model;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle(){

        $this->setRepositoryClass();

        $path = $this->getPath($this->repositoryClass);
        if ($this->alreadyExists($this->repositoryClass)) {
            $this->error($this->type.' already exists!');

            return false;
        }
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($this->repositoryClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created Repository :</info> $this->repositoryClass");
    }

    /**
     * Set repository class name
     *
     * @return  void
     */
    private function setRepositoryClass()
    {
        $name = ucwords(strtolower($this->argument('name')));

        $this->model = $name;

        // $modelClass = $this->parseName($name);
        $modelClass = $name;

        $this->repositoryClass = $modelClass . 'Repository';
        $this->module = $this->argument('module');
        return $this;
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
        
        if(!$this->argument('name')){
            throw new InvalidArgumentException("Missing required argument model name");
        }

        $stub = parent::replaceClass($stub, $name);
        $stub = str_replace('DummyModule', $this->module, $stub);
        $stub = str_replace('LowerDummyModel', strtolower($this->module), $stub);
        return str_replace('DummyModel', $this->model , $stub);
    }

    /**
     * 
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  base_path('stubs/Repository.stub');
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        // return $rootNamespace . '\Repo';
        return 'Modules/'.$this->module.'/Repositories';
    }

      /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return $this->rootNamespace();
    }

      /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Modules\\'.$this->module.'\Repositories';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
            ['module', InputArgument::REQUIRED, 'The name of the Module.'],
        ];
    }

    public function getPath($name){
        return base_path().'/Modules/'.$this->module.'/Repositories/'.str_replace('\\', '/', $name).'.php';
    }

    public function alreadyExists($name){
        return $this->files->exists($this->getPath($name));
    }
}