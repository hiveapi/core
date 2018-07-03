<?php

namespace HiveApi\Core\Exceptions;

use HiveApi\Core\Abstracts\Exceptions\Exception;
use HiveApi\Core\Abstracts\Transformers\Transformer;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class InvalidTransformerException
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class InvalidTransformerException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Transformers must extend the ' . Transformer::class . ' class.';

}
