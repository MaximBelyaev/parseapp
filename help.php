<?php

    use ParseApp\Components\Invoker;
    use ParseApp\Components\Commands\Help;

    require __DIR__ . '/vendor/autoload.php';

    $invoker = new Invoker();
    $invoker->setCommand(new Help());
    $invoker->run();