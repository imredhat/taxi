
<?php
namespace App\Controllers;

use Nevercom\IriPG\IPG\Gateways\SamanKish\SamanKishIPG; // Ensure this path is correct and the class exists

if (!class_exists('Nevercom\IriPG\IPG\Gateways\SamanKish\SamanKishIPG')) {
    throw new \Exception('Class Nevercom\IriPG\IPG\Gateways\SamanKish\SamanKishIPG not found');
}


class SamanKish extends SamanKishIPG {
    protected $merchantId   = '14642597';
    protected $terminalId   = '14642597';
    protected $userName     = '6259267';
    protected $userPassword = '6259267';
}