<?php

namespace SingKa\HwOcr;

use SingKa\HwOcr\HWOcrClientAKSK;
use SingKa\HwOcr\HWOcrClientToken;

class HwOcr
{
    static public function TokenRequest($config, $type, $imagePath, $option = '') {
        if ($type == 'ocr_form') {
            $uri = '/v1.0/ocr/action/'.$type;
        } else {
            $uri = '/v1.0/ocr/'.$type;
        }
        $ocrServer = new HWOcrClientToken(
            $config['username'],
            $config['password'],
            $config['domainName'],
            $config['regionName'],
            $uri
        );

        $result =  $ocrServer->RequestOcrResult($imagePath, $option);
        return $result;
    }

    static public function AkskRequest($config, $type, $imagePath, $option = '') {
        if ($type == 'ocr_form') {
            $uri = '/v1.0/ocr/action/'.$type;
        } else {
            $uri = '/v1.0/ocr/'.$type;
        }
        $akskAuth = new HWOcrClientAKSK(
            $config['appKey'],
            $config['appSecret'],
            $config['regionName'],
            $uri
        );
        $result =  $akskAuth->RequestOcrAkSkService($imagePath, $option);
        return $result;
    }
}