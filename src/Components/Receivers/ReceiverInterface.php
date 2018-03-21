<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Receivers;


    interface ReceiverInterface
    {
        /**
         * Get content/headers/another data from given URL
         *
         * @param $url
         * @return mixed
         */
        public function getUrlData($url);
    }