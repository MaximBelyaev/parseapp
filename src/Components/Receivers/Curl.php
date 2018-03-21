<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Receivers;

    class Curl implements ReceiverInterface
    {
        /**
         * @inheritdoc
         */
        public function getUrlData($url)
        {
            $options = [
                CURLOPT_USERAGENT      =>
                    'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120,
                CURLOPT_MAXREDIRS      => 10,
            ];

            $ch = curl_init($url);
            curl_setopt_array($ch, $options);

            $content = curl_exec($ch);
            $result  = array_merge(curl_getinfo($ch), [
                'errorCode'    => curl_errno($ch),
                'errorMessage' => curl_error($ch),
                'content'      => $content,
            ]);

            return $result;
        }
    }