<?php

namespace App\Services;

use App\Repository\ParametreRepository;
use App\Services\ConfigurationService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

class OrangeSMSService
{

    private $client;
    private $apiUrl;
    private $senderName;
    private $apiKey;
    private $access_token;
    private $config;
    private $entityManager;
    private $configRepo;
    private $smsRepository;

    public function __construct(
        string $apiUrl,
        string $senderName,
        string $apiKey,
        ConfigurationService $config,
        ParametreRepository $repo,
        EntityManagerInterface $entityManager,

    ) {
        $this->apiUrl = $apiUrl;
        $this->senderName = $senderName;
        $this->apiKey = $apiKey;
        $this->client = new Client();
        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->configRepo = $repo;
        $this->validateToken();
    }


    public function sendSMS(string $recipient, string $message)
    {


        $sendSMS = $this->config->get('sendSMS');

        if ($sendSMS == 'enable') {

            $apiUrl = 'https://api.orange.com/smsmessaging/v1/outbound/tel:+221' . $this->senderName . '/requests';

            $response = $this->client->request('POST', $apiUrl, [
                'json' => [
                    'outboundSMSMessageRequest' => [
                        'address' => 'tel:+221' . $recipient,
                        'outboundSMSTextMessage' => [
                            'message' => $message
                        ],
                        "senderAddress" => 'tel:+221' . $this->senderName,
                        "senderName" => "SIMLAIT"
                    ]
                ],
                'headers' => [
                    'Authorization' => $this->access_token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $responseBody = $response->getBody();

            if ($response->getStatusCode() === 201) {
                return "Message Envoyé";
            }

            if ($response->getStatusCode() == 401) {
                $this->getToken();
                return "Message Non Envoyé, token invalide";
            }
            if ($response->getStatusCode() == 500) {
                return $response->getBody();
            }
            if ($response->getStatusCode() == 403) {
                return $response->getBody();
            }

            return $response->getStatusCode() === 201;
        }

        return true;
    }

    public function getToken()
    {
        try {
            $response =  $this->client->post('https://api.orange.com/oauth/v3/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->apiKey,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    "grant_type" => "client_credentials"
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody()->getContents(), true);
                $this->access_token = "Bearer " . $result['access_token'];
                $config = $this->configRepo->findOneBy(['cle' => 'smsToken']);
                $config->setValeur($this->access_token);
                $this->entityManager->persist($config);
                $this->entityManager->flush();
            }
        } catch (\Throwable $th) {
            $this->validateToken();
        }
    }

    public function setToken()
    {
        try {
            $response =  $this->client->post('https://api.orange.com/oauth/v3/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->apiKey,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    "grant_type" => "client_credentials"
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody()->getContents(), true);
                $this->access_token = "Bearer " . $result['access_token'];
                $config = $this->configRepo->findOneBy(['cle' => 'smsToken']);
                $config->setValeur($this->access_token);
                $this->entityManager->persist($config);
                $this->entityManager->flush();
                return $this->access_token;
            }
        } catch (\Throwable $th) {
            $this->validateToken();
        }
    }

    public  function getSolde()
    {
        try {
            $response =  $this->client->get('https://api.orange.com/sms/admin/v1/contracts', [
                'headers' => [
                    'Authorization' => $this->access_token,
                    'Content-Type' => 'application/json'
                ]
            ]);
            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody()->getContents(), true);
                return $result;
            }
        } catch (\Throwable $th) {
            $this->validateToken();
        }
    }

    public  function getStat()
    {
        $response =  $this->client->get('https://api.orange.com/sms/admin/v1/statistics', [
            'headers' => [
                'Authorization' => $this->access_token,
                'Content-Type' => 'application/json'
            ]
        ]);
        if ($response->getStatusCode() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }
    }

    public  function purchaseorders()
    {
        $response =  $this->client->get('https://api.orange.com/sms/admin/v1/purchaseorders', [
            'headers' => [
                'Authorization' => $this->access_token,
                'Content-Type' => 'application/json'
            ]
        ]);
        if ($response->getStatusCode() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }
    }


    public function validateToken()
    {
        $token = $this->config->get('smsToken');
        $this->access_token = $token;

        try {
            $response =  $this->client->get('https://api.orange.com/sms/admin/v1/purchaseorders', [
                'headers' => [
                    'Authorization' => $this->access_token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return true;
            }
        } catch (\Throwable $th) {
            $this->getToken();
        }
    }
}
