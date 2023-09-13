<?php

namespace App\Custom;

use Illuminate\Support\Facades\Log;

class CvdController
{
    public static $version  = 0;

    public static function makeCvd ()
    {
        $body = self::setDigitBody();
        $sufijo = self::setSufijo();
        $bodyCvd =  self::$version . $body . $sufijo;

        $digitVerify = self::setDigitVerify($bodyCvd);
        
        $cvd = $bodyCvd . $digitVerify;
        return $cvd;
    }

    public static function verifyCvd(string $cvd): bool
    {
        if(!is_numeric($cvd) || strlen($cvd) !== 12 || $cvd[0] !== '0' ){
            return false;
        }

        $sum = 0;
        $size = strlen($cvd);

        for($i = 0; $i < $size; $i++){
            $digito = (int)$cvd[$i];
            if($i % 2 == 0){
                $digito *= 2;;
                if($digito > 9){
                    $digito -= 9;
                }
            }
            $sum += $digito;
        }
        $sum = $sum + $cvd[$size-1];

        if ($sum % 10 === 0){
            return false;
        }

        return true;
    }

    public static function setDigitVerify($numero) {
        $numero = strrev($numero);
        $suma = 0;
        
        for ($i = 0; $i < strlen($numero); $i++) {
            $digito = (int)$numero[$i];
            
            if ($i % 2 == 0) {
                $digito *= 2;
                if ($digito > 9) {
                    $digito -= 9;
                }
            }
            $suma += $digito;
        }
        $digitoVerificacion = (10 - ($suma % 10));
        
        return $digitoVerificacion;
    }

    public static function setDigitBody()
    {
        $startDate = '2021-01-01 00:00:00';
        $startDateTimestamp = (int) substr(strtotime($startDate)*1000, 0, 12); 
        
        $now = microtime(true);
        $milliseconds = (int) (substr($now * 1000, 0, 12));

        $timeDiff = $milliseconds - $startDateTimestamp;

        try {
            if(strlen($timeDiff) > 12){
                throw new \Exception('The difference between the time of 01-01-2021 00:00:00.000 and the current time is a number high to 12 digits');
            }
            $finalTime = str_pad($timeDiff, 12, '0', STR_PAD_LEFT);
            return $finalTime;
        } catch ( \Exception  $e) {
            Log::error('Ocurrio un error: ', $e->getMessage());
            return false;
        }
    }

    public static function setSufijo()
    {
        $numeroAleatorio = rand(1, 99);
        $numeroAleatorioConCeros = sprintf('%02d', $numeroAleatorio);
        return $numeroAleatorioConCeros;
    }
}