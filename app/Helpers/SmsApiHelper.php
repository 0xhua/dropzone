<?php

namespace App\Helpers;

use Humans\Semaphore\Client;

class SmsApiHelper
{

    private $client;

    public function __construct()
    {
        $this->client = new Client(config('sms.key'), config('sms.sender'));
    }

    public function send_sms($receiver,$message){
        $this->client->message()->send($receiver, $message);
    }
}
