<?php

namespace Service;

/**
 * Description of CurlService
 *
 * @author leandro <leandro@leandroleite.info>
 */
class CurlService {

    protected $options;
    protected $response;
    protected $info;
    protected $responseHeaders;

    public function __construct() {
        $this->options = $this->getDefaultOptions();
    }

    public function get($url) {
        $this->setOption(CURLOPT_URL, $url);
        $this->setOption(CURLOPT_POST, false);
        return $this;
    }

    public function post($url, array $postParam = array()) {
        $this->setOption(CURLOPT_URL, $url);
        $this->setOption(CURLOPT_POST, true);
        $this->setData($postParam);
        return $this;
    }

    public function formPost($url, array $postParam = array()) {
        $this->post($url, $postParam);
        $this->setHeaders(array('Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'));
        return $this;
    }

    public function getResponse($key = false) {
        return !$key ? $this->response : $this->response[$key];
    }

    public function getResponseHeader($key = false) {
        return !$key ? $this->responseHeaders : $this->responseHeaders[$key];
    }

    public function setData(array $data) {
        $array = array();
        if (isset($this->options[CURLOPT_POSTFIELDS]))
            $array = $this->options[CURLOPT_POSTFIELDS];

        $this->options[CURLOPT_POSTFIELDS] = http_build_query(array_merge($array, $data));

        return $this;
    }

    public function setUrl($url) {
        $this->setOption(CURLOPT_URL, $url);
        return $this;
    }

    public function setOption($key, $value) {
        $this->options[$key] = $value;
    }

    public function setHeaders(array $headers) {

        $this->setOption(CURLOPT_HTTPHEADER, $headers);
        return $this;
    }

    public function getDefaultOptions() {
        return array(
            CURLOPT_POST => false,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
        );
    }

    public function getHttpCode() {
        return curl_getinfo($this->info, CURLINFO_HTTP_CODE);
    }

    public function fetch() {
        $curl = curl_init();
        curl_setopt_array($curl, $this->options);
        $this->response = curl_exec($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $this->responseHeaders = substr($this->response, 0, $headerSize);
        $this->response = substr($this->response, $headerSize);
        $this->info = curl_getinfo($curl);
        curl_close($curl);
        return $this->response;
    }

}
