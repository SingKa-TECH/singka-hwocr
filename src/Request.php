<?php

namespace SingKa\HwOcr;


class Request
{
    public $method = '';
    public $scheme = '';
    public $host = '';
    public $uri = '';
    public $query = array();
    public $headers = array();
    public $body = '';
}