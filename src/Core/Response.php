<?php

namespace Leeflets\Core;

/**
 * Class Response
 * @package Leeflets\Core
 */
class Response implements ResponseInterface {

    /**
     * @var string
     */
    private $content;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var int
     */
    private $code;

    /**
     * Response constructor.
     *
     * @param string $content
     * @param array $headers
     * @param int $code
     */
    public function __construct($content, array $headers = [], $code = 200) {
        $this->content = $content;
        $this->headers = $headers;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function output() {
        return $this->content;
    }

    /**
     * @return array
     */
    public function headers() {
        return $this->headers;
    }
}