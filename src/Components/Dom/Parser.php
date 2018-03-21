<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Components\Dom;

    use DOMDocument, DOMElement;
    use ParseApp\Components\DomainData;
    use ParseApp\Components\Receivers\ReceiverInterface;
    use ParseApp\Helpers\Url;

    class Parser
    {
        private $document, $receiver, $data;

        /**
         * Parser constructor.
         * @param DOMDocument $document
         * @param ReceiverInterface $receiver
         */
        public function __construct(DOMDocument $document, ReceiverInterface $receiver)
        {
            $this->document = $document;
            $this->receiver = $receiver;
        }

        public function collectImagesData()
        {
            $data = [];
            foreach ($this->document->getElementsByTagName('img') as $image) {
                /**
                 * @var $image DOMElement
                 */
                $data[] = $image->getAttribute('src');
            }

            return $data;
        }

        /**
         * Recursively collecting HOST => [URL => images] structure data for internal links
         *
         * @param $url
         * @return DomainData
         */
        public function collectData($url)
        {
            echo 'URL: ' . $url . PHP_EOL;

            $urlData = $this->receiver->getUrlData($url);

            $dom = $this->document;
            @$dom->loadHTML($urlData['content']);

            $this->data[$url] = ['images' => $this->collectImagesData()];

            foreach ($this->getInternalLinks($urlData) as $url) {
                if (!isset($this->data[$url])) {
                    $this->collectData($url);
                }
            }

            return new DomainData(parse_url($urlData['url'], PHP_URL_HOST), $this->data);
        }

        /**
         * Getting internal links from the page
         *
         * @param $urlData
         * @return array
         */
        public function getInternalLinks($urlData)
        {
            $internalLinks = [];

            $baseUrl     = $urlData['url'];
            $baseUrlData = parse_url($baseUrl);

            foreach ($this->document->getElementsByTagName('a') as $link) {
                /**
                 * @var $link DOMElement
                 */
                $href     = $link->getAttribute('href');
                $hrefData = parse_url($href);

                /**
                 * Finding out if the URL is internal
                 */
                if ((!empty($hrefData['host']) && ($baseUrlData['host'] == $hrefData['host'])) ||
                    !isset($hrefData['scheme'])) {
                    $newUrl = Url::generateFullUrl($baseUrl, $href);

                    if (!in_array($newUrl, $internalLinks)) {
                        $internalLinks[] = $newUrl;
                    }
                }
            }

            return $internalLinks;
        }
    }