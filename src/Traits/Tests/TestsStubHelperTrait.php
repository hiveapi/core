<?php

namespace HiveApi\Core\Traits\Tests;

use InvalidArgumentException;

trait TestsStubHelperTrait
{
    /**
     * Loads a Stub and replaces its placeholders
     *
     * @param        $fileName
     * @param array  $vars
     * @param string $startPattern
     * @param string $endPattern
     *
     * @return mixed|string
     */
    public function loadAndPrepareStub($fileName, array $vars = [], $startPattern = '{{', $endPattern = '}}')
    {
        // repeat our patterns
        $startPatterns = array_fill(0, count($vars), $startPattern);
        $endPatterns = array_fill(0, count($vars), $endPattern);

        // load the stub and replace the placeholders
        $stub = $this->loadFileFromDataDirectory($fileName);
        $stub = str_replace(array_map([$this, 'maskStubVariables'], array_keys($vars), $startPatterns, $endPatterns), array_values($vars), $stub);

        return $stub;
    }

    /**
     * Load a given file from the "data" directory defined in the suite
     *
     * @param $filename
     *
     * @return string
     */
    private function loadFileFromDataDirectory($filename)
    {
        // get the absolute path on disk for this codeception instance
        $filePath = codecept_data_dir() . $filename;

        $this->checkIfFileExists($filePath);

        $stub = file_get_contents($filePath);
        return $stub;
    }

    /**
     *
     * Checks, if the given file exists and is readable.
     *
     * This method is used, e.g., in the attachFile() method to append the file to a request (e.g., for uploading)
     *
     * @param $filePath
     *
     * @throws InvalidArgumentException
     */
    private function checkIfFileExists($filePath)
    {
        if (!file_exists($filePath)) {
            throw new InvalidArgumentException("File does not exist: $filePath");
        }

        if (!is_readable($filePath)) {
            throw new InvalidArgumentException("File is not readable: $filePath");
        }
    }

    /**
     * Masks variables in the data files (stubs)
     *
     * @param        $key
     * @param string $startPattern
     * @param string $endPattern
     *
     * @return string
     */
    private function maskStubVariables($key, $startPattern = '{{', $endPattern = '}}')
    {
        return $startPattern . $key . $endPattern;
    }
}