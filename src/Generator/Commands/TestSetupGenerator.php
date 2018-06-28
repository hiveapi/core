<?php

namespace HiveApi\Core\Generator\Commands;

use HiveApi\Core\Generator\GeneratorCommand;
use HiveApi\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;

/**
 * Class TestSuiteSetupGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class TestSetupGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hive:generate:test:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the Test Suite for this Container';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Test Suite';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Tests/*';

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
    protected $stubName = 'tests/suites/container.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {

        // containername as inputted and lower
        $containerName = $this->containerName;
        $_containerName = Str::lower($this->containerName);

        $suites = ['acceptance', 'api', 'unit'];

        foreach ($suites as $suite)
        {
            $this->call('hive:generate:test:suite:config', [
                '--container'   => $containerName,
                '--file'        => $suite,
                '--suite'       => $suite,
            ]);

            $testerName = Str::ucfirst($suite) . 'Tester';
            $this->call('hive:generate:test:suite:tester', [
                '--container'   => $containerName,
                '--file'        => $testerName,
                '--suite'       => $suite,
            ]);

            $this->call('hive:generate:misc:gitkeep', [
                '--container'   => $containerName,
                '--file'        => $testerName,
                '--path'        => '/Tests/Tests/' . $suite . '/',
            ]);

        }

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
        return 'codeception';
    }

    public function getDefaultFileExtension()
    {
        return 'yml';
    }

}

