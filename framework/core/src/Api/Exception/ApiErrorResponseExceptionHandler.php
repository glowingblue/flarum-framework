<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Api\Exception;

use Flarum\Foundation\ErrorHandling\HandledError;

class ApiErrorResponseExceptionHandler
{
    public function handle(ApiErrorResponseException $e): HandledError
    {
        return new HandledError(
            $e,
            'api_error_response',
            $e->getStatusCode()
        );
    }
}
