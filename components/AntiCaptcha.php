<?php


namespace app\components;

use Yii;
use yii\httpclient\Client;

/**
 * Class AntiCaptcha
 * @package app\components
 */
class AntiCaptcha
{
    /**
     * Базовый URL сервиса anti-captcha
     */
    const BASE_URL = 'https://api.anti-captcha.com/';

    /**
     * Максимальное количество попыток получения результата решения капчи
     */
    const GET_TASK_MAX = 100;

    /**
     * Интервал в секундах между попытками получения результата решения капчи
     */
    const GET_TASK_INTERVAL = 2;

    /**
     * Ключ API сервиса anti-captcha
     *
     * @var string
     */
    private $clientKey;

    /**
     * ID Задачи решения капчи
     *
     * @var string
     */
    private $taskId;

    /**
     * Экземпляр объекта Captcha
     *
     * @var Captcha
     */
    private $captcha;

    /**
     * Текст решения капчи
     *
     * @var string
     */
    private $solutionText = '';

    /**
     * Конструктор класса AntiCaptcha
     *
     * @param Captcha $captcha
     */
    public function __construct()
    {
        $this->clientKey = Yii::$app->params['antiCaptcha']['clientKey'];
        $this->captcha = new Captcha();
    }

    /**
     * Постановка задачи на решение капчи сервису anti-captcha
     *
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    private function createTask()
    {
        $client = new Client(['baseUrl' => self::BASE_URL]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('createTask')
            ->addHeaders(['content-type' => 'application/json'])
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'clientKey' => $this->clientKey,
                'task' => [
                    'type' => 'ImageToTextTask',
                    'body' => $this->captcha->getPicture()
                ],
            ])
            ->send();
        if ($response->isOk) {
            return $response->data['taskId'];
        }
    }

    /**
     * Получение результатов задачи по решению капчи от сервиса anti-captcha
     *
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    private function getTaskResult()
    {
        $this->taskId = $this->createTask();
        sleep(self::GET_TASK_INTERVAL);
        for ($i = 0; $i < self::GET_TASK_MAX; $i++) {
            $client = new Client(['baseUrl' => self::BASE_URL]);
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('getTaskResult')
                ->addHeaders(['content-type' => 'application/json'])
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'clientKey' => $this->clientKey,
                    'taskId' => $this->taskId,
                ])
                ->send();
            if ($response->isOk && isset($response->data['solution']['text'])) {
                $this->solutionText = $response->data['solution']['text'];
                return;
            }
            sleep(self::GET_TASK_INTERVAL);
        }
    }

    /**
     * Возвращает ID решенной капчи
     *
     * @return string
     */
    public function getCaptchaID()
    {
        return $this->captcha->getId();
    }

    /**
     * Возвращает текст решенной капчи
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getSolutionText()
    {
        $this->getTaskResult();
        return $this->solutionText;

    }
}
