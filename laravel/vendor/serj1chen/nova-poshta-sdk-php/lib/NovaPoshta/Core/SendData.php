<?php

namespace NovaPoshta\Core;

use NovaPoshta\Config;
use NovaPoshta\Core\Logger\BaseLogger;
use NovaPoshta\Core\Logger\DataLogger;
use NovaPoshta\Core\Serializer\SerializerBatchInterface;
use NovaPoshta\Core\Serializer\SerializerFactory;
use NovaPoshta\Models\DataContainer;
use NovaPoshta\Models\DataContainerResponse;

/**
 * Class SendData
 * @package NovaPoshta\Core
 */
class SendData
{
    private static $instance;
    private $serializer;
    protected $dataBatch = array();
    private static $countBatch = 0;

    protected function __construct()
    {
        $this->serializer = SerializerFactory::getSerializer();
    }

    /**
     * @return SendData
     */
    protected static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function send(DataContainer $dataContainer, $isBatch = false)
    {
        return self::instance()->_send($dataContainer, $isBatch);
    }

    public static function getResponseBatch()
    {
        return self::instance()->_getResponseBatch();
    }

    /**
     * Отправить запрос
     *
     * @param DataContainer $dataContainer
     * @param bool $isBatch
     * @return bool|int|mixed|DataContainerResponse
     * @throws NovaPoshtaException
     */
    protected function _send(DataContainer $dataContainer, $isBatch = false)
    {
        $logger = new DataLogger();

        $dataContainer->apiKey = Config::getApiKey();
        $dataContainer->language = Config::getLanguage();
        $dataContainer->id = $this->getIdBatch();

        if($isBatch){
            if(!$this->serializer instanceof SerializerBatchInterface){
                throw new NovaPoshtaException('NovaPoshta\Core\Serializer\SendData_NO_BATCH');
            }
            $this->dataBatch[$dataContainer->id] = $dataContainer;
            return $dataContainer->id;
        }

        $logger->toData = $dataContainer;

        $data = $this->serializer->serializeData($dataContainer);

        $logger->toOriginalData = $data;

        $response = $this->query($data);

        $logger->fromOriginalData = $response;

        if($response){
            $response = $this->serializer->unserializeData($response);
        } else {
            $response = new DataContainerResponse();
            $response->success = false;
            $response->errors[] = array('DataSerializerJSON.ERROR_REQUEST');
        }

        $logger->fromData = $response;

        BaseLogger::setDataLogger($logger);

        return $response;
    }

    /**
     * @return array
     */
    protected function _getResponseBatch()
    {
        if(empty($this->dataBatch)){
            return array();
        }

        $data = $this->serializer->serializeBatchData($this->dataBatch);
        $response = $this->query($data);
        $response = $this->serializer->unserializeBatchData($response);

        $responseDataContainers = array();
        foreach($response as $key => $item){
            $responseDataContainers[$item->id] = $item;
        }

        $this->dataBatch = array();

        return $responseDataContainers;
    }

    /**
     * @return int
     */
    protected function getIdBatch()
    {
        return ++self::$countBatch;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    protected function query($data)
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, Config::getUrlApi());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/plain"));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $response = curl_exec($ch);

            curl_close($ch);

            return $response;
        } catch (\Exception $e) {
            return false;
        }
    }
}