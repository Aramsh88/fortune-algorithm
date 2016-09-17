<?php namespace Albertobravi\FortuneAlgorithm;

use Monolog\Logger as Monologger;
use Monolog\Handler\StreamHandler;

/**
 * @author Albertobravi
 */
class Logger {

    private $oLogger;

    public function __construct()
    {
        $oLogger = new Monologger('fortune_logger');
        $oLogger->pushHandler(new StreamHandler('./logs/fortune_log.txt', Monologger::DEBUG));

        $this->oLogger = $oLogger;
    }

    public function log($message) {
        $this->oLogger->addInfo($message);
        echo $message . "\n";
    }
}
