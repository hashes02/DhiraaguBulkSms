<?php

namespace Hashes02\DhiraaguBulkSms\Services;

use GuzzleHttp\Client;

class SmsSender
{
    protected $client;
    protected $senderId;
    protected $clientId;
    protected $authorization;

    public function __construct($senderId, $clientId, $authorization)
    {
        $this->client = new Client([
            'base_uri' => 'https://bulksms.dhiraagu.com.mv/portalapi/',
            'timeout'  => 2.0,
        ]);
        $this->senderId = $senderId;
        $this->clientId = $clientId;
        $this->authorization = $authorization;
    }

    public function sendSms($message, $recipient)
    {
        $response = $this->client->get('getCgiData', [
            'query' => [
                'senderId'       => $this->senderId,
                'clientId'       => $this->clientId,
                'dMode'          => 1,
                'UserData'       => $message,
                'number'         => $recipient,
                'flag'           => 0,
                'distList'       => '',
                'Date'           => date('d/m/Y'),
                'Hour'           => date('H'),
                'Minute'         => date('i'),
                'Second'         => date('s'),
                'Flash'          => 0,
                'param'          => 'Text',
                'language'       => 1,
                'defered'        => 0,
                'conCat'         => 0,
                'ValidityPeriod' => 1440,
            ],
            'headers' => [
                'Accept'           => '*/*',
                'Accept-Language'  => 'en-GB,en-US;q=0.9,en;q=0.8,dv;q=0.7',
                'Authorization'    => 'Basic ' . $this->authorization,
                'Connection'       => 'keep-alive',
                'Content-Type'     => 'application/json',
                'Referer'          => 'https://bulksms.dhiraagu.com.mv/portal/newMessage/normalMessage',
                'User-Agent'       => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                'sec-ch-ua'        => '"Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
                'sec-ch-ua-mobile' => '?0',
                'sec-ch-ua-platform' => '"Windows"'
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
