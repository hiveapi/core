<?php

namespace HiveApi\Core\Generator\Commands;

use HiveApi\Core\Generator\GeneratorCommand;
use HiveApi\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class GitkeepGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GitkeepGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hive:generate:misc:gitkeep';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a gitkeep file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'GitKeep';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/{path}/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'gitkeep.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads from the console whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['path', null, InputOption::VALUE_OPTIONAL, 'The path within one container to create this file in.'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $path = $this->checkParameterOrAsk('path', 'Enter the path within a container to put a gitkeep file in.', '/');

        $path = trim($path);
        $path = trim($path, '/');

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
                'path' => $path,
            ],
            'stub-parameters' => [
                '_container-name' => Str::lower($this->containerName),
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    /**
     * Get the default file name for this component to be generated
     *
     * @return string
     */
    public function getDefaultFileName()
    {
        return '';
    }

    public function getDefaultFileExtension()
    {
        return 'gitkeep';
    }
}
