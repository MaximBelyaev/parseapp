<?php
    /**
     * Created by PhpStorm.
     * User: Maxim Belyaev
     */

    namespace ParseApp\Helpers;


    class Url
    {
        /**
         * Small and dirty replacement of http_build_url which requires pecl_http package which
         * can't be used in this task
         *
         * @param $url
         * @param $href
         * @return string
         */
        public static function generateFullUrl($url, $href)
        {
            if (strpos($href, 'http') !== 0) {
                $path    = '/' . ltrim($href, '/');
                $urlData = parse_url($url);
                $href    = $urlData['scheme'] . '://';
                if (isset($urlData['user']) && isset($urlData['pass'])) {
                    $href .= $urlData['user'] . ':' . $urlData['pass'] . '@';
                }
                $href .= $urlData['host'];

                if (isset($urlData['port'])) {
                    $href .= ':' . $urlData['port'];
                }

                $href .= $path;
            }

            return $href;
        }
    }