<?php

namespace HiveApi\Core\Generator\Commands;

use HiveApi\Core\Generator\GeneratorCommand;
use HiveApi\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class TestSuiteTestCaseGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class TestSuiteTestCaseGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hive:generate:test:suite:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Test Case for a Test Suite.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Test Case';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Tests/Tests/{suite}/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{file-name}Cest';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'tests/suites/configs/empty.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['suite', null, InputOption::VALUE_OPTIONAL, 'The name of the suite this test case should be created for.'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $suite = Str::lower($this->checkParameterOrChoice('suite', 'Select the Test Suite you want to create the Test Case for.', ['ACCEPTANCE', 'API', 'UNIT']));

        $this->stubName = 'tests/suites/tests/' . $suite . '.stub';

        $customFilename = $this->fileName;

        // containername as inputted and lower
        $containerName = $this->containerName;
        $_containerName = Str::lower($this->containerName);

        return [
            'path-parameters' => [
                'container-name' => $containerName,
                'suite' => $suite,
            ],
            'stub-parameters' => [
                '_container-name' => $_containerName,
                'container-name'  => $containerName,
                'class-name'      => $customFilename,
            ],
            'file-parameters' => [
                'file-name' => $customFilename,
            ],
        ];
    }

    public function getDefaultFileName()
    {
        return 'TestCaseCest';
    }

}

