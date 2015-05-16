<?php

namespace SHOUTCLOUD;

class Exception extends \Exception
{
    /**
     * ERROR ERROR
     *
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(strtoupper($message), $code, $previous);
    }
}
