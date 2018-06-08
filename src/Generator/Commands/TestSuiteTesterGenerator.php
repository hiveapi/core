<?php

namespace HiveApi\Core\Generator\Commands;

use HiveApi\Core\Generator\GeneratorCommand;
use HiveApi\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class TestSuiteTesterGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class TestSuiteTesterGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hive:generate:test:suite:tester';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Tester for a Test Suite.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Test Suite Tester';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Tests/Tests/_support/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{file-name}';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'tests/suites/tester/empty.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['suite', null, InputOption::VALUE_OPTIONAL, 'The name of the suite this tester should be created for.'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $suite = Str::lower($this->checkParameterOrChoice('suite', 'Select the Test Suite you want to create the Tester for.', ['ACCEPTANCE', 'API', 'FUNCTIONAL', 'UNIT', 'CUSTOM']));

        $this->stubName = 'tests/suites/tester/' . $suite . '.stub';

        // containername as inputted and lower
        $containerName = $this->containerName;
        $_containerName = Str::lower($this->containerName);

        return [
            'path-parameters' => [
                'container-name' => $containerName,
            ],
            'stub-parameters' => [
                '_container-name' => $_containerName,
                'container-name'  => $containerName,
                'class-name'      => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    public function getDefaultFileName()
    {
        return 'Tester';
    }

}

