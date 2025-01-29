<?php


namespace App\Messaging;


use JsonSerializable;

class Response implements JsonSerializable
{
    public $data;
    public $message;
    public $errors;

    public function __construct($data = null, $message = null, $errors = null)
    {
        $this->data = $data;
        $this->message = $message;
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $dataArray = [];

        if ($this->data)
            $dataArray['data'] = $this->data;

        if ($this->message)
            $dataArray['message'] = $this->message;

        if ($this->errors)
            $dataArray['errors'] = $this->errors;

        return $dataArray;
    }
}
