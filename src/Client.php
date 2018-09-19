<?php

namespace Smtm\Http;

use Http\Client\Common\Plugin\Journal;
use Http\Client\Exception;
use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\StreamFactory;
use Http\Message\UriFactory;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var HttpClient
     */
    protected $transport;

    /**
     * @var HttpAsyncClient
     */
    protected $asyncTransport;

    /**
     * @var UriFactory
     */
    protected $uriFactory;

    /**
     * @var StreamFactory
     */
    protected $streamFactory;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var Journal
     */
    protected $journal;

    /**
     * @param HttpClient|null $transport
     * @param HttpAsyncClient|null $asyncTransport
     * @param UriFactory|null $uriFactory
     * @param MessageFactory|null $messageFactory
     * @param StreamFactory|null $streamFactory
     * @param Journal|null $journal
     */
    public function __construct(
        HttpClient $transport = null,
        HttpAsyncClient $asyncTransport = null,
        UriFactory $uriFactory = null,
        MessageFactory $messageFactory = null,
        StreamFactory $streamFactory = null,
        Journal $journal = null
    ) {
        $this->transport = $transport;
        $this->asyncTransport = $asyncTransport;
        $this->uriFactory = $uriFactory;
        $this->messageFactory = $messageFactory;
        $this->streamFactory = $streamFactory;
        $this->journal = $journal;
    }

    public function communicate($method, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $uri = $this->uriFactory->createUri($uri);
        $request = $this->messageFactory->createRequest($method, $uri, $headers, $body);

        try {
            $response = $this->transport->sendRequest($request);
        } catch (Exception $e) {
            var_dump($e);
            $response = null;
        } catch (\Exception $e) {
            var_dump($e);
            $response = null;
        }

        return $response;
    }
}
