<?php

namespace App\Services;

use App\Repository\ModelSmsRepository;

class OrangeSMSfunction
{

    private $orangeSMSService;
    private $modelSmsRepository;
    public function __construct(
        ModelSmsRepository $modelSmsRepository,
        OrangeSMSService $orangeSmsService,
    ) {
        $this->orangeSMSService = $orangeSmsService;
        $this->modelSmsRepository = $modelSmsRepository;
    }

    public function sendSMS($receiver, $message)
    {
        $response = $this->orangeSMSService->sendSMS($receiver, $message);
        return $response;
    }


    public function soldeSMS()
    {
        $response = $this->orangeSMSService->getSolde();
        return $response;
    }

    public function statSMS()
    {
        $response = $this->orangeSMSService->getStat();
        return $response;
    }

    public function historySms()
    {
        $response = $this->orangeSMSService->purchaseorders();
        return $response;
    }

    public function setToken()
    {
        $response = $this->orangeSMSService->setToken();
        return $response;
    }



    public function sendMessage(
        string $receiver,
        string $code,
        array $data
    ) {

        // dd($data);
        $sms = $this->modelSmsRepository->findOneBy(['code' => $code]);
        $message = $sms->getMessage();

        if ($sms->getParametre() != null && count($sms->getParametre()) != 0) {

            $parametres = $sms->getParametre();
            foreach ($parametres as $value) {
                if ($value != '') {
                    $message = str_replace("[" . $value . "]", $data[$value], $message);
                }
            }
        }

        try {

            $response = $this->orangeSMSService->sendSMS($receiver, $message);
            return true;
        } catch (\Throwable $th) {
            // dd($th);
            return false;
        }
    }
}
