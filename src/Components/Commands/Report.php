<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Commands;

    use ParseApp\Components\DataStorageManager;
    use ParseApp\Components\Receivers\ReceiverInterface;
    use Exception;

    class Report implements CommandInterface
    {
        private $receiver;

        /**
         * Report constructor.
         * @param ReceiverInterface $receiver
         */
        public function __construct(ReceiverInterface $receiver)
        {
            $this->receiver = $receiver;
        }

        /**
         * Getting data for a given domain from storage
         *
         * @param array $params
         * @throws Exception
         */
        public function execute($params = [])
        {
            $this->validateInput($params);

            $urlData = $this->receiver->getUrlData($params['domain']);
            $domain  = parse_url($urlData['url'], PHP_URL_HOST);
            /**
             * @var $dataManager DataStorageManager
             */
            $dataManager = new DataStorageManager();
            $data        = $dataManager->getDomainData($domain);

            echo $data ? $data->getStringOutput() : 'No data is found for this domain.';
        }

        /**
         * @param $params
         * @throws Exception
         */
        public function validateInput($params)
        {
            if (!$params['domain']) {
                throw new Exception('Domain parameter is missing');
            }
        }
    }