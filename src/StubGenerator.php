<?php

namespace HtetOoZin\EloquentFilter;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class StubGenerator
{
    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(private Filesystem $files)
    {
    }


    /**
     * Return the stub file path
     *
     */
    private function getStubPath(): string
    {
        return __DIR__ . '/stubs/filter.stub';
    }

    /**
     *
     * Map the stub variables present in stub to its value
     * 
     * @param string $name
     *
     */
    public function getStubVariables($name): array
    {
        return [
            'namespace'   => 'App\\Filters',
            'class'       => $this->getSingularClassName($name),
        ];
    }


    /**
     * Return the Singular Capitalize Name
     * @param string $name
     */
    public function getSingularClassName($name): string
    {
        $filter = Str::contains($name, 'filter', true);

        $className = !$filter ? $name : Str::replaceArray('filter', ['Filter'], $name);

        return ucwords($className);
    }


    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     */
    public function makeDirectory($path): string
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    private function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the stub path and the stub variables
     * 
     * @param $name
     *
     */
    public function getSourceFile($name): mixed
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables($name));
    }

    /**
     * Get the output console style
     * 
     * @param $color
     *
     */
    public function getConsoleStyle($color = 'blue'): OutputFormatterStyle
    {
        return new OutputFormatterStyle('white', $color, ['bold', 'blink']);
    }

    /**
     * Get the full path of generate class
     * 
     * @param $name
     *
     */
    public function getFilePath($name): string
    {
        return base_path('app/Filters/' . $name) . '.php';
    }
}
