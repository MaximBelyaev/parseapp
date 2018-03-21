<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components;


    use ParseApp\Components\Commands\CommandInterface;

    class Invoker
    {
        /**
         * @var CommandInterface
         */
        private $command;

        /**
         * Command setter
         *
         * @param CommandInterface $cmd
         */
        public function setCommand(CommandInterface $cmd)
        {
            $this->command = $cmd;
        }

        /**
         * Executing the command
         *
         * @param $params array
         */
        public function run($params = [])
        {
            $this->command->execute($params);
        }
    }