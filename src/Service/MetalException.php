<?php


namespace App\Service;


class MetalException extends \Exception
{
    /**
     * MetalException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }
}