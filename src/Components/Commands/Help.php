<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Commands;

    use ParseApp\Helpers\Support;

    class Help implements CommandInterface
    {
        /**
         * Getting help message for CLI
         *
         * @inheritdoc
         */
        public function execute($params = [])
        {
            echo Support::getHelpMessage();
        }
    }