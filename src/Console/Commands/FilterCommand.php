<?php

namespace HtetOoZin\EloquentFilter\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use HtetOoZin\EloquentFilter\StubGenerator;

class FilterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent filter class';

    /**
     * Create a new command instance.
     * @param Filesystem $files, StubGenerator $stubGenator
     */
    public function __construct(private Filesystem $files, private StubGenerator $stub)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $className = $this->stub->getSingularClassName($this->argument('class'));

        $path = $this->stub->getFilePath($className);

        if ($this->files->exists($path)) {

            $style = $this->stub->getConsoleStyle('red');
            $this->output->getFormatter()->setStyle('alert', $style);

            return $this->line('<alert>' . 'ERROR' . '</alert>' . " {$className}.php already exists.");
        }

        $contents = $this->stub->getSourceFile($this->argument('class'));


        $this->stub->makeDirectory(dirname($path));

        $this->files->put($path, $contents);

        $style = $this->stub->getConsoleStyle('blue');

        $this->output->getFormatter()->setStyle('alert', $style);
        $this->line('<alert>' . 'INFO' . '</alert>' . " Filter [app/Filters/{$className}.php] created successfully.");
    }
}
