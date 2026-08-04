<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Api\Exception;

use Exception;

/**
 * Thrown when an internal API request made through {@see \Flarum\Api\Client}
 * fails and returns a JSON:API error document instead of the expected data.
 *
 * The API client's own error handling middleware has already reported the
 * underlying exception, so this exception is mapped to an error page without
 * being reported a second time
 * ({@see \Flarum\Api\Exception\ApiErrorResponseExceptionHandler}).
 */
class ApiErrorResponseException extends Exception
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * The decoded response body, usually a JSON:API error document.
     *
     * @var object|null
     */
    protected $document;

    /**
     * @param int $statusCode
     * @param object|null $document
     */
    public function __construct(int $statusCode, $document = null)
    {
        // A status below 400 means the response body was malformed rather
        // than a proper error response; treat that as a server error.
        $this->statusCode = $statusCode >= 400 ? $statusCode : 500;
        $this->document = is_object($document) ? $document : null;

        parent::__construct("Internal API request failed with status $statusCode");
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return object|null
     */
    public function getDocument()
    {
        return $this->document;
    }
}
