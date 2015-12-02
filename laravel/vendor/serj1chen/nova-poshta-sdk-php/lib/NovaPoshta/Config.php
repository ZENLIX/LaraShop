<?php

namespace NovaPoshta;
use NovaPoshta\Core\Logger\InterfaceLogger;

/**
 * Конфиг
 *
 * Class Config
 * @package NovaPoshta
 */
class Config
{
    /**
     * Формат данных в формате JSON
     */
    const FORMAT_JSON = 'json';
    /**
     * Формат данных в формате JSONRPC2
     */
    const FORMAT_JSONRPC2 = 'jsonrpc2';
    /**
     * Формат данных в формате XML
     */
    const FORMAT_XML = 'xml';

    /**
     * Возвращать данные на русском языке
     */
    const LANGUAGE_UA = 'ua';
    /**
     *  Возвращать данные на русском языке с API Новой почты (если єто предвидено API Новой почты)
     */
    const LANGUAGE_RU = 'ru';
    /**
     * Возвращать данные на английский языке с API Новой почты (если єто предвидено API Новой почты)
     */
    const LANGUAGE_EN = 'en';

    /**
     * @var string API ключ
     */
    protected static $apiKey = '';
    /**
     * @var string формат по умолчанию для передачи данных
     */
    protected static $format = self::FORMAT_JSONRPC2;
    /**
     * @var string язык по умолчанию для передачи данных
     */
    protected static $language = self::LANGUAGE_UA;
    /**
     * @var string URL API2
     */
    protected static $urlApi = 'https://api.novaposhta.ua/v2.0/';
    /**
     * @var string URL личного кабинета Новой Почты
     */
    protected static $urlMyNovaPoshta = 'https://my.novaposhta.ua';

    /**
     * @var InterfaceLogger
     */
    protected static $classLogger;

    /**
     * Возвращает API ключ
     *
     * @return string
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * Устанавливает API ключ
     *
     * @param string $value
     */
    public static function setApiKey($value)
    {
        self::$apiKey = $value;
    }

    /**
     * Возвращает формат передачи данных
     *
     * @return string
     */
    public static function getFormat()
    {
        return self::$format;
    }

    /**
     * Устанавливает формат передачи данных
     *
     * @param string $value
     */
    public static function setFormat($value)
    {
        self::$format = $value;
    }

    /**
     * Возвращает язык для ответа с Новой почты
     *
     * @return string
     */
    public static function getLanguage()
    {
        return self::$language;
    }

    /**
     * Устанавливает язык для ответа с Новой почты
     *
     * @param string $value
     */
    public static function setLanguage($value)
    {
        self::$language = $value;
    }

    /**
     * Возвращает URL API2
     *
     * @return string
     */
    public static function getUrlApi()
    {
        return self::$urlApi . self::$format . '/';
    }

    /**
     * Возвращает URL кабинета Новой Почты
     *
     * @return string
     */
    public static function getUrlMyNovaPoshta()
    {
        return self::$urlMyNovaPoshta;
    }

    /**
     * Установить класс для логирования
     *
     * @param InterfaceLogger $logger
     */
    public static function setClassLogger(InterfaceLogger $logger)
    {
        self::$classLogger = $logger;
    }

    /**
     * Получить класс для логирования
     *
     * @return InterfaceLogger
     */
    public static function getClassLogger()
    {
        return self::$classLogger;
    }
}