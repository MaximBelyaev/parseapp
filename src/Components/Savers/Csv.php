<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Savers;


    class Csv implements SaverInterface
    {
        private $fileFolderPath = __DIR__ . '/../../../data';

        /**
         * @inheritdoc
         */
        public function save($data)
        {
            $fileName = 'parse_report_' . time() . ".csv";
            $fullPath = $this->fileFolderPath . '/' . $fileName;

            $handler = fopen($fullPath, 'w');

            foreach ($data as $fields) {
                fputcsv($handler, $fields, ';');
            }

            fclose($handler);

            return $fullPath;

        }
    }