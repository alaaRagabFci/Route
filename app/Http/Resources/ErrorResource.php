<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    protected $code;
    protected $message;
    protected $errors;

    public function __construct(int $code, $message = "Failed operation", $error = null)
    {
        JsonResource::withoutWrapping();

        $this->code = $code;
        $this->message = $message;

        if ($error != "" && !is_array($error) == false) {
            $this->errors = ["target" => $error];
        } else {
            $this->errors = $error;
        }
    }

    public function toArray($request)
    {
        return [
            "message" => $this->message,
            "errors" => $this->errors,
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->code);
    }
}
