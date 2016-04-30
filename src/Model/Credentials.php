<?php
namespace DAG\OneSky\Model;

/**
 * Class Credentials
 */
final class Credentials
{
    /** @var string */
    private $apiKey;

    /** @var string */
    private $apiSecret;

    /**
     * Credentials constructor.
     *
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }
}
