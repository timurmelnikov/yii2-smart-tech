<?php

namespace app\components;

/**
 * Class Captcha
 * @package app\components
 */
class Captcha
{
    /**
     * Базовый URL
     */
    const BASE_URL = 'http://kgd.gov.kz/apps/services/CaptchaWeb/generate?uid=';

    /**
     * ID капчи
     *
     * @var string
     */
    private $id;

    /**
     * Картинка капчи в base64
     *
     * @var string
     */
    private $picture;

    /**
     * Конструктор класса Captcha
     */
    public function __construct()
    {
        $this->generateId();
        $this->requestPicture();
    }

    /**
     * Генератор ID капчи
     * Оказалось, работает с любой строкой
     *
     * @return void
     */
    private function generateId()
    {
        $this->id = uniqid(md5(time()), false);
    }

    /**
     * Получает base64 картинки с сервиса kgd.gov.kz
     *
     * @return void
     */
    private function requestPicture()
    {
        $this->picture = file_get_contents(self::BASE_URL . $this->getId());
        $this->picture = base64_encode($this->picture);
    }

    /**
     * Получить ID капчи
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Получить base64 картинки капчи
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
