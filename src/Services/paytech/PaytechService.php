<?php

namespace App\Services\paytech;

use App\Repository\ParametreRepository;
use App\Services\ConfigurationService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

class PaytechService
{

    private $apiKey;
    private $apiSecret;
    private $baseUrl;
    private $config;
    private $entityManager;
    private $configRepo;


    public function __construct(
        string $apiKey,
        string $apiSecret,
        string $baseUrl,
        ConfigurationService $config,
        ParametreRepository $repo,
        EntityManagerInterface $entityManager,
    ) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->baseUrl = $baseUrl;

        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->configRepo = $repo;
    }

    public function processPayment(array $requestData): array
    {

        /**
         *item_name:"Iphone 7",
         * item_price:"560000",
         * currency:"XOF",
         *ref_command:"HBZZYZVUZZZV",
         *command_name:"Paiement Iphone 7 Gold via PayTech",
         *env:"test",
         *ipn_url:"https://domaine.com/ipn",
         *success_url:"https://domaine.com/success",
         *cancel_url:"https://domaine.com/cancel",
         */


        // Supposons que $item est un objet passé dans les données de la requête
        $item = $requestData['client'];
        // Supposons que $id est un identifiant passé dans les données de la requête
        $id = $requestData['id'];

        // Construire le corps de la requête
        $queryData = [
            'item_name' => "Lavage Complet",
            'item_price' => "5000",
            "currency" => "XOF",
            "ref_command" => "ref reservaton",
            "env" => "test",
            'command_name' => "Paiement {$item['name']} Gold via PayTech",
        ];

        $customFields = [
            'item_id' => $id,
            'time_command' => time(),
            'ip_user' => $_SERVER['REMOTE_ADDR'],
            'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE']
        ];

        // Construire l'objet PayTech et envoyer la requête
        $payTech = new PayTech($this->apiKey, $this->apiSecret);
        $response = $payTech->setQuery($queryData)
            ->setCustomField($customFields)
            ->setTestMode(true)
            ->setCurrency($item['currency'])
            ->setRefCommand(uniqid())
            ->setNotificationUrl([
                'ipn_url' => $this->baseUrl . '/ipn.php', // seulement en https
                'success_url' => $this->baseUrl . '/index.php?state=success&id=' . $id,
                'cancel_url' => $this->baseUrl . '/index.php?state=cancel&id=' . $id
            ])
            ->send();

        return $response;
    }
}
