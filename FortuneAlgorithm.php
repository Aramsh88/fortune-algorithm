<?php

namespace dronca\FortuneAlgorithm;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use phpseclib\Math\BigInteger;


/**
 * Description of fortuneAlgorithm
 *
 * @author Droncalonca
 */
class FortuneAlgorithm {

    private $iInputNumber = null;

    private $oLogger;

    function __construct($iInputNumber) {
        try {
            // set up logger
            $this->setLogger();

            // check inputs
            $this->checkInputs($iInputNumber);
        } catch (Exception $e) {
            $this->log($e->getMessage());
        }
    }

    private function checkInputs($iInputNumber)
    {
        if (empty($iInputNumber)) {
            throw new \Exception("Input string not valid.");
        }
        $this->iInputNumber = $iInputNumber;
        $this->log("Input String (" . strlen($this->iInputNumber) . "): $this->iInputNumber");
    }

    private function setLogger() {
        $oLogger = new Logger('fortune_logger');
        $oLogger->pushHandler(new StreamHandler('./logs/fortune_log.txt', Logger::DEBUG));

        $this->oLogger = $oLogger;
    }

    private function log($message) {
        $this->oLogger->addInfo($message);
        echo $message . "\n";
    }

    /**
     * @param $iInputNumber
     * @return null|string
     */
    private function createRandomPrime($iInputNumber) {
        $strRandomResult = null;

        $iInputLength = strlen($iInputNumber) / 2;

        for ($i=0; $i < $iInputLength; $i++) {
            if ($i == 0) {
                $strRandomResult .= mt_rand(1, 9);
            } else if ($i < $iInputLength) {
                $aPossibleLastNumber = array(1, 3, 7, 9);
                $strRandomResult .= $aPossibleLastNumber[mt_rand(0, 3)];
            } else {
                $strRandomResult .= mt_rand(0, 9);
            }

        }

        return $strRandomResult;
    }

    function find() {
        try {
            $this->log("START SEARCHING...");

            $iStart = new BigInteger($this->iInputNumber);
            $i = 0;
            while (1) {
                $iRandomPrime = new BigInteger($this->createRandomPrime($this->iInputNumber));

                $iModInverse = $iStart->modInverse($iRandomPrime);
                if (!$iModInverse) {
                    list($quotient, $residue) = $iStart->divide($iRandomPrime);
                    if ($residue->toString() == 0) {
                        $this->log("FOUND - Random: $iRandomPrime - Quoziente: $quotient");
                        break;
                    }

                    $this->log("FALSE POSITIVE - Random: $iRandomPrime - Modulo: " . $iModInverse . " - Quoziente: $quotient");
                }

                $i++;
            }
        } catch (Exception $e) {
            $this->log($e->getMessage());
        }
    }
}
