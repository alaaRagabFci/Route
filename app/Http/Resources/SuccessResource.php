<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class SuccessResource extends JsonResource
{
    protected $code;
    protected $message;
    protected $data;

    public function __construct(int $code = Response::HTTP_OK, $message = "", $data = ""){

        $this->code = $code;
        $this->message = $message != "" ? $message : __('auth.successful_operation');
        $this->data = $data;
    }

    public function toArray($request)
    {
        return [
            "message" => $this->message,
            "data" => $this->data,
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->code);
    }
}
