<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Savers;


    interface SaverInterface
    {
        /**
         * Save data depending on class logic
         *
         * @param array $data
         * @return string|boolean
         */
        public function save($data);
    }