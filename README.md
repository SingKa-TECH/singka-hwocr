# 华为云OCR文字识别

#### 介绍
本项目集成了华为云OCR文字识别业务，支持ThinkPHP5.0、ThinkPHP5.1和ThinkPHP6.0，由宁波晟嘉网络科技有限公司维护。

#### 安装教程

使用 `composer require singka/singka-hwocr` 命令行安装即可。

#### 使用示例（基于ThinkPHP6.0）


```php
<?php
// +----------------------------------------------------------------------
// | 胜家云 [ SingKa Cloud ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2020 https://www.singka.net All rights reserved.
// +----------------------------------------------------------------------
// | 宁波晟嘉网络科技有限公司
// +----------------------------------------------------------------------
// | Author: ShyComet <shycomet@qq.com>
// +----------------------------------------------------------------------
namespace app\home\controller;

use SingKa\HwOcr\HwOcr;

class Index extends Base
{
    /**
    * OCR文字识别示例
    *
    * @appKey       华为云appKey
    * @appSecret    华为云appSecret
    * @regionName   资源所在区域
    */
    public function ocrDemo()
    {
        $config['appKey'] = 'YXMWB********PKZY';
        $config['appSecret'] = 'wC2*em*7*********EDP';
        $config['regionName'] = 'cn-north-4';
        //分别传入配置、OCR识别类型、图片地址或Base64码和其他参数
        $result = HwOcr::AkskRequest($config, 'business-license', 'http://tuoxing.shop/ocr/data/business-license-demo.jpg', []);
        return json(json_decode($result, true));
    }
  
}
```

#### 其他说明

相关材料请查阅：
[华为云文字识别](https://support.huaweicloud.com/ocr/index.html)
[SDK简介](https://support.huaweicloud.com/sdkreference-ocr/ocr_04_0016.html)
[API概览](https://support.huaweicloud.com/api-ocr/ocr_03_0047.html)

作者联系方式：shycomet@163.com