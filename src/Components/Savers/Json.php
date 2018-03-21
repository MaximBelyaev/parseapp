<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Savers;


    class Json implements SaverInterface
    {
        private $file;

        private $fileFolderPath = __DIR__ . '../../../data';

        public function __construct($file = '')
        {
            $this->file = $file;
        }

        /**
         * @inheritdoc
         */
        public function save($data)
        {
            $fileName = $this->getFileName();

            $fp = fopen($fileName, 'w');

            if (fwrite($fp, json_encode($data)) && fclose($fp)) {
                return $fileName;
            }

            return false;
        }

        /**
         * @return string
         */
        private function getFileName()
        {
            return $this->file ?? $this->fileFolderPath . '/data_' . time() . '.json';
        }


        public function setFile($file)
        {
            $this->file = $file;
        }
    }