<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class MakeTemplate extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make back and frontend files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $rootPath = dirname(base_path());

        $path = $rootPath.'/frontend/src/views/crafted';
        $this->files->makeDirectory(dirname($path), 0777, true, true);

        $this->files->put($path, '$this->sortImports($this->buildClass($name))');

    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
