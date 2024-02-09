<?php

namespace App\Services\paytech;

use App\Repository\ModelSmsRepository;

class PayTechfunction
{

    private $paytechService;
    private $modelSmsRepository;
    public function __construct(
        ModelSmsRepository $modelSmsRepository,
        PaytechService $paytechService,
    ) {
        $this->paytechService = $paytechService;
        $this->modelSmsRepository = $modelSmsRepository;
    }

    public function sendSMS($receiver, $message)
    {
        $response = $this->paytechService->sendSMS($receiver, $message);
        return $response;
    }


    public function soldeSMS()
    {
        $response = $this->paytechService->getSolde();
        return $response;
    }

    public function statSMS()
    {
        $response = $this->paytechService->getStat();
        return $response;
    }

    public function historySms()
    {
        $response = $this->paytechService->purchaseorders();
        return $response;
    }

    public function setToken()
    {
        $response = $this->paytechService->setToken();
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

            $response = $this->paytechService->sendSMS($receiver, $message);
            return true;
        } catch (\Throwable $th) {
            // dd($th);
            return false;
        }
    }
}
