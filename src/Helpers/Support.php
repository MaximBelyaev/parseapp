<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Helpers;

    class Support
    {
        public static $commandsHelpData = [
            'parse'  => 'Options:' . PHP_EOL . '   --url     Page to start collecting data from' . PHP_EOL . PHP_EOL .
                'Example:' . PHP_EOL . 'php parse.php --url=google.com' . PHP_EOL . PHP_EOL . 'Help:' . PHP_EOL .
                'The parse command is used to recursively collect internal URLs and all images presented on pages ' .
                'data starting from a given URL',
            'report' => 'Options:' . PHP_EOL . '   --domain     Domain name to search links of' . PHP_EOL . PHP_EOL .
                'Example:' . PHP_EOL . 'php report.php --domain=google.com' . PHP_EOL . PHP_EOL . 'Help:' . PHP_EOL .
                'The report command is used to get previously saved by "parse" command results for a given domain',
            'help'   => 'Example:' . PHP_EOL . 'php help.php' . PHP_EOL . PHP_EOL . 'Help:' . PHP_EOL .
                'The help command shows detailed description and usage examples of all commands available in the ' .
                'Parse application',
        ];

        /**
         * Generating help message for CLI
         *
         * @return string
         */
        public static function getHelpMessage()
        {
            $message = 'Commands:' . PHP_EOL . PHP_EOL;

            foreach (self::$commandsHelpData as $commandName => $description) {
                $message .= $commandName . PHP_EOL . PHP_EOL . $description . PHP_EOL . PHP_EOL;
            }

            return $message;
        }
    }