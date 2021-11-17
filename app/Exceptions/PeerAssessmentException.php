<?php

namespace App\Exceptions;

use Exception;

class PeerAssessmentException extends Exception implements \JsonSerializable
{

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
       return [
           'errorCode' => $this->getCode(),
           'errorMessage' => $this->getMessage(),
       ];
    }
}
