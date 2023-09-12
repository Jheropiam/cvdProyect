<?php

namespace App\Custom;

require_once 'phpqrcode/qrlib.php';

class Qrlib
{
    private $name;
    private $path;

    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
    }

    public function makeQR(): string
    {
        \QRcode::png($this->name, $this->path, QR_ECLEVEL_L, 20, 3);
        return $this->path; 
    }

    public function dropImgQR() 
    {
        unlink($this->path);
    }
}