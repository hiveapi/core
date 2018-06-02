<?php

namespace HiveApi\Core\Exceptions;

use HiveApi\Core\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class ClassDoesNotExistException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ClassDoesNotExistException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Class does not exist.';

}
