<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components;

    use ParseApp\Components\Savers\Json;

    class DataStorageManager
    {
        private $saver;

        private $dataStorage = __DIR__ . '/../../data/storage/data.json';

        public function __construct()
        {
            $this->saver = new Json($this->dataStorage);
        }

        /**
         * I've decided to use only one JSON file here instead of DB because this task doesn't really
         * require it I think
         *
         * @param DomainData $data
         * @return bool|string
         */
        public function storeData($data)
        {
            $newData = [$data->getDomain() => $data->getData()];

            if ($existingData = $this->getDataStorageArray()) {
                $newData = array_merge($existingData, $newData);
            }

            return $this->saver->save($newData);
        }

        /**
         * Getting data for domain if present in the storage
         *
         * @param $domain
         * @return null|DomainData
         */
        public function getDomainData($domain)
        {
            $data = $this->getDataStorageArray();

            return !empty($data[$domain]) ? new DomainData($domain, $data[$domain]) : null;
        }

        public function getDataStorageArray()
        {
            return json_decode(file_get_contents($this->dataStorage), true);
        }
    }