<?php

require __DIR__ . '/vendor/autoload.php';
require 'src/FortuneAlgorithm.php';

use dronca\FortuneAlgorithm\FortuneAlgorithm;



// $iInputNumber = 4032013; // 1777 * 2269
$iInputNumber = 4104330577; // 41047 * 99991

// $iInputNumber = 19923108241787117701; // 5915587277 * 3367900313

// https://en.wikipedia.org/wiki/RSA_numbers
// RSA-100: 37975227936943673922808872755445627854565536638199 × 40094690950920881030683735292761468389214899724061
// $iInputNumber = '1522605027922533360535618378132637429718068114961380688657908494580122963258952897654000350692006139';



$oFortuneAlgorithm = new FortuneAlgorithm($iInputNumber);
$oFortuneAlgorithm->find();
