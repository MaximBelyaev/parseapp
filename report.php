<?php

    use ParseApp\Components\Invoker;
    use ParseApp\Components\Commands\Report;
    use ParseApp\Components\Receivers\Curl;

    require __DIR__ . '/vendor/autoload.php';

    $params = getopt('', ['domain:']);

    $invoker = new Invoker();
    $report  = new Report(new Curl());

    $invoker->setCommand($report);
    $invoker->run($params);