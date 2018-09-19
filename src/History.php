<?php

namespace Smtm\Http;

use Http\Client\Common\Plugin\Journal;
use Http\Client\Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class History implements Journal
{
    const STATUS = 'status';
    const REQUEST = 'request';
    const RESPONSE = 'response';
    const EXCEPTION = 'exception';
    const SUCCESS = 1;
    const FAILURE = 0;

    protected $records = [];

    public function addSuccess(RequestInterface $request, ResponseInterface $response)
    {
        $this->records[] = [
            self::STATUS => self::SUCCESS,
            self::REQUEST => $request,
            self::RESPONSE => $response,
        ];
    }

    public function addFailure(RequestInterface $request, Exception $exception)
    {
        $this->records[] = [
            self::STATUS => self::FAILURE,
            self::REQUEST => $request,
            self::RESPONSE => $exception,
        ];
    }
}