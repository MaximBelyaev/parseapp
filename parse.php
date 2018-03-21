<?php

    use ParseApp\Components\Invoker;
    use ParseApp\Components\Receivers\Curl;
    use ParseApp\Components\Commands\Parse;
    use ParseApp\Components\Dom\Parser;
    use ParseApp\Components\Savers\Csv;

    require __DIR__ . '/vendor/autoload.php';

    $params = getopt('', ['url:']);

    $invoker = new Invoker();
    $parser  = new Parse(
        new Parser((new DOMDocument()), (new Curl())),
        new Curl(),
        new Csv()
    );

    $invoker->setCommand($parser);
    $invoker->run($params);