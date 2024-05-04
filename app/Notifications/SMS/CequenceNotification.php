<?php

namespace App\Notifications\SMS;

use App\Enums\CequenceConstantsEnum;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class CequenceNotification extends SMSNotification
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    protected function getAuthorizationKey(): string
    {
        try {
            $jsonData = [
                'apiKey' => config('cequence.api_key'),
                'userName' => config('cequence.user_name'),
            ];

            $jsonString = json_encode($jsonData);

            $response = $this->httpClient->request('POST', 'https://apis.cequens.com/auth/v1/tokens/', [
                'body' => $jsonString,
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);

            return $response->getBody();
        } catch (GuzzleException $exception) {
            Log::error('Error while obtaining Cequence authorization token', ['exception' => $exception]);
            // Handle or re-throw the exception as needed
        }
    }

    public function send(string $text, string $recipients): void
    {
        try {
            $requestData = [
                'senderName' => config('cequence.sender_name'),
                'messageType' => CequenceConstantsEnum::MESSAGE_TYPE_TEXT,
                'shortURL' => true,
                'messageText' => $text,
                'recipients' => $recipients,
            ];

            $jsonData = json_encode($requestData, JSON_UNESCAPED_SLASHES);

            $this->httpClient->request('POST', 'https://apis.cequens.com/sms/v1/messages', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('cequence.token'),
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
                'body' => $jsonData,
            ]);
        } catch (GuzzleException $exception) {
            Log::error('Error while sending Cequence message', ['exception' => $exception]);
        }
    }
}
