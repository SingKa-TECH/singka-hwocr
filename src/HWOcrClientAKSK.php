<?php


namespace SingKa\HwOcr;

use SingKa\HwOcr\Signer;
use SingKa\HwOcr\Request;

class HWOcrClientAKSK
{
    protected $appKey;
    protected $appSecret;
    protected $httpEndPoint;
    protected $uri;

    /* init method */
    public function __construct($appKey, $appSecret, $regionName, $uri)
    {
        if (empty($appKey)){
            echo "appKey can not be empty";
            return;
        }
        if (empty($appSecret)){
            echo "appSecret can not be empty";
            return;
        }
        if (empty($regionName)){
            echo "regionName can not be empty";
            return;
        }
        if (empty($uri)){
            echo "uri can not be empty";
            return;
        }
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->httpEndPoint = "ocr." . $regionName . ".myhuaweicloud.com";;
        $this->uri = $uri;
    }

    /* AkSk recognise method */
    public function RequestOcrAkSkService($imagePath, $options=array())
    {
        $error = [];
        if (empty($this->uri)){
            $error["msg"] = "uri can not be empty";
            $error["code"] = 4000;
            return json_encode($error);
        }
        if (empty($imagePath)){
            $error["msg"] = "imagePath can not be empty";
            $error["code"] = 4000;
            return json_encode($error);
        }

        $signer = new Signer();
        $signer->AppKey = $this->appKey;
        $signer->AppSecret = $this->appSecret;

        $req = new Request();
        $req->method = "POST";
        $req->scheme = "https";
        $req->host = $this->httpEndPoint;
        $req->uri = $this->uri;

        $data = array();
        if (stripos($imagePath, 'http://') !== false || stripos($imagePath, 'https://') !== false) {
            $data['url'] = $imagePath;
        } else {
            if($fp = fopen($imagePath,"rb", 0))
            {
                $gambar = fread($fp,filesize($imagePath));
                fclose($fp);

                $fileBase64 = chunk_split(base64_encode($gambar));
            } else {
                $error["msg"] = "image get failure";
                $error["code"] = 4001;
                return json_encode($error);
            }
            $data['image'] = $fileBase64;
        }

        if(!empty($options)){
            $data = array_merge($data, $options);
        }

        $headers = array(
            "Content-Type" => "application/json"
        );

        $req->headers = $headers;
        $req->body = json_encode($data);

        $curl = $signer->Sign($req);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status == 200) {
            curl_close($curl);
            return $response;
        } else {
            $error["code"] = $status;
            if (empty($response)) {
                $error["msg"] = curl_error($curl);
            } else {
                $error["msg"] = $response;
            }
            curl_close($curl);
            return json_encode($error);
        }
    }
}