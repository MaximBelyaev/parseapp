<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components;


    class DomainData
    {
        private $domain, $data;

        /**
         * DomainData constructor.
         *
         * @param string $domain
         * @param array $data
         */
        public function __construct($domain, $data)
        {
            $this->domain = $domain;
            $this->data   = $data;
        }

        /**
         * Generating string output from data (CSV etc.)
         *
         * @return array
         */
        public function getArrayOutput()
        {
            $data   = [];
            $data[] = ['Host:', $this->getDomain()];

            foreach ($this->getData() as $url => $urlData) {
                $data[] = ['URL:', $url];

                if (!empty($urlData['images'])) {
                    $imagesArray = ['Images found:'];

                    foreach ($urlData['images'] as $image) {
                        $imagesArray[] = $image;
                    }

                    $data[] = $imagesArray;
                }
            }

            return $data;
        }

        /**
         * Generating string output from data (CLI etc.)
         *
         * @return string
         */
        public function getStringOutput()
        {
            $output = '';
            $output .= 'Host: ' . $this->getDomain() . PHP_EOL;

            foreach ($this->getData() as $url => $urlData) {
                $output .= 'URL: ' . $url . PHP_EOL;
                $output .= !empty($urlData['images']) ?
                    'Images found: ' . implode(', ', $urlData['images']) . PHP_EOL : '';
            }

            return $output;
        }

        /**
         * @return string
         */
        public function getDomain()
        {
            return $this->domain;
        }

        /**
         * @return array
         */
        public function getData()
        {
            return $this->data;
        }
    }