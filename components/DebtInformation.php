<?php


namespace app\components;

use yii\httpclient\Client;

/**
 * Class DebtInformation
 * @package app\components
 */
class DebtInformation
{

    /**
     * Базовый URL сервиса kgd.gov.kz
     */
    const BASE_URL = 'http://kgd.gov.kz/apps/services/culs-taxarrear-search-web/rest/search';

    private $antiCaptcha;


    /**
     * Конструктор класса DebtInformation
     */
    public function __construct()
    {
        $this->antiCaptcha = new AntiCaptcha();
    }


    /**
     * Получение информации от сервиса kgd.gov.kz
     *
     * @param string $iinBin
     * @return string
     */
    public function getInformation($iinBin)
    {
        $client = new Client(['baseUrl' => self::BASE_URL]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->addHeaders(['content-type' => 'application/json'])
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'iinBin' => $iinBin,
                'captcha-user-value' => $this->antiCaptcha->getSolutionText(),
                'captcha-id' => $this->antiCaptcha->getCaptchaID(),
            ])
            ->send();
        if ($response->isOk) {
            return $response->data;
        }
    }
}
