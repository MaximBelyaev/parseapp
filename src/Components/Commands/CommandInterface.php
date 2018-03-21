<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Commands;


    interface CommandInterface
    {
        /**
         * This function is triggered to run a command
         *
         * @param $params array
         */
        public function execute($params = []);
    }