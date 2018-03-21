<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Commands;

    use ParseApp\Components\DataStorageManager;
    use ParseApp\Components\Dom\Parser;
    use ParseApp\Components\Receivers\ReceiverInterface;
    use ParseApp\Components\Savers\SaverInterface;
    use Exception;

    class Parse implements CommandInterface
    {
        private $parser, $receiver, $saver;

        /**
         * Parse constructor.
         * @param Parser $parser
         * @param ReceiverInterface $receiver
         * @param SaverInterface $saver
         */
        public function __construct(Parser $parser, ReceiverInterface $receiver, SaverInterface $saver)
        {
            $this->receiver = $receiver;
            $this->parser   = $parser;
            $this->saver    = $saver;
        }

        /**
         * Collecting parse data, saving it, generating CSV report
         *
         * @inheritdoc
         */
        public function execute($params = [])
        {
            $this->validateInput($params);
            $urlData    = $this->receiver->getUrlData($params['url']);
            $domainData = $this->parser->collectData($urlData['url']);

            /**
             * Storing data (JSON instead of database for this task to make it quicker)
             * @var $dataManager DataStorageManager
             */
            $dataManager = new DataStorageManager();
            $dataManager->storeData($domainData);

            /**
             * Making CSV report
             */
            $csv = $this->saver->save($domainData->getArrayOutput());

            echo 'Get your parsing CSV report here: ' . $csv;
        }

        /**
         * @param $params
         * @throws Exception
         */
        public function validateInput($params)
        {
            if (!$params['url']) {
                throw new Exception('URL parameter is missing');
            }
        }
    }