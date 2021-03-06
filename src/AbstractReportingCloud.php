<?php

/**
 * ReportingCloud PHP Wrapper
 *
 * PHP wrapper for ReportingCloud Web API. Authored and supported by Text Control GmbH.
 *
 * @link      http://www.reporting.cloud to learn more about ReportingCloud
 * @link      https://github.com/TextControl/txtextcontrol-reportingcloud-php for the canonical source repository
 * @license   https://raw.githubusercontent.com/TextControl/txtextcontrol-reportingcloud-php/master/LICENSE.md
 * @copyright © 2018 Text Control GmbH
 */

namespace TxTextControl\ReportingCloud;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use TxTextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Abstract ReportingCloud
 *
 * @package TxTextControl\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
abstract class AbstractReportingCloud
{
    /**
     * Constants
     * -----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Default date/time format of backend is 'ISO 8601'
     *
     * Note, last letter is 'P' and not 'O':
     *
     * O - Difference to Greenwich time (GMT) in hours (e.g. +0200)
     * P - Difference to Greenwich time (GMT) with colon between hours and minutes (e.g. +02:00)
     *
     * Backend uses the 'P' variant
     *
     * @const DEFAULT_DATE_FORMAT
     */
    const DEFAULT_DATE_FORMAT = 'Y-m-d\TH:i:sP';

    /**
     * Default time zone of backend
     *
     * @const DEFAULT_TIME_ZONE
     */
    const DEFAULT_TIME_ZONE = 'UTC';

    /**
     * Default base URI of backend
     *
     * @const DEFAULT_BASE_URI
     */
    const DEFAULT_BASE_URI = 'https://api.reporting.cloud';

    /**
     * Default version string of backend
     *
     * @const DEFAULT_VERSION
     */
    const DEFAULT_VERSION = 'v1';

    /**
     * Default timeout of backend in seconds
     *
     * @const DEFAULT_TIMEOUT
     */
    const DEFAULT_TIMEOUT = 120;

    /**
     * Default test flag of backend
     *
     * @const DEFAULT_TEST
     */
    const DEFAULT_TEST = false;

    /**
     * Default debug flag of REST client
     *
     * @const DEFAULT_DEBUG
     */
    const DEFAULT_DEBUG = false;

    /**
     * Properties
     * -----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Backend API key
     *
     * @var string|null
     */
    protected $apiKey;

    /**
     * Backend username
     *
     * @var string|null
     */
    protected $username;

    /**
     * Backend password
     *
     * @var string|null
     */
    protected $password;

    /**
     * When true, API call does not count against quota
     * "TEST MODE" watermark is added to document
     *
     * @var bool|null
     */
    protected $test;

    /**
     * Backend base URI
     *
     * @var string|null
     */
    protected $baseUri;

    /**
     * Backend version string
     *
     * @var string|null
     */
    protected $version;

    /**
     * Backend timeout in seconds
     *
     * @var int|null
     */
    protected $timeout;

    /**
     * REST client to backend
     *
     * @var Client|null
     */
    protected $client;

    /**
     * Debug flag of REST client
     *
     * @var bool|null
     */
    protected $debug;

    /**
     * Set and Get Methods
     * -----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Return the API key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the API key
     *
     * @param string $apiKey API key
     *
     * @return ReportingCloud
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Return the username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username
     *
     * @param string $username Username
     *
     * @return ReportingCloud
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Return the password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the password
     *
     * @param string $password Password
     *
     * @return ReportingCloud
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return the base URI of the backend web service
     *
     * @return string
     */
    public function getBaseUri()
    {
        if (null === $this->baseUri) {
            $this->setBaseUri(self::DEFAULT_BASE_URI);
        }

        return $this->baseUri;
    }

    /**
     * Set the base URI of the backend web service
     *
     * @param string $baseUri Base URI
     *
     * @return ReportingCloud
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Get the timeout (in seconds) of the backend web service
     *
     * @return int
     */
    public function getTimeout()
    {
        if (null === $this->timeout) {
            $this->setTimeout(self::DEFAULT_TIMEOUT);
        }

        return $this->timeout;
    }

    /**
     * Set the timeout (in seconds) of the backend web service
     *
     * @param int $timeout Timeout
     *
     * @return ReportingCloud
     */
    public function setTimeout($timeout)
    {
        $this->timeout = (int) $timeout;

        return $this;
    }

    /**
     * Return the debug flag
     *
     * @return mixed
     */
    public function getDebug()
    {
        if (null === $this->debug) {
            $this->setDebug(self::DEFAULT_DEBUG);
        }

        return $this->debug;
    }

    /**
     * Set the debug flag
     *
     * @param bool $debug Debug flag
     *
     * @return ReportingCloud
     */
    public function setDebug($debug)
    {
        $this->debug = (bool) $debug;

        return $this;
    }

    /**
     * Return the test flag
     *
     * @return mixed
     */
    public function getTest()
    {
        if (null === $this->test) {
            $this->setTest(self::DEFAULT_TEST);
        }

        return $this->test;
    }

    /**
     * Set the test flag
     *
     * @param bool $test Test flag
     *
     * @return ReportingCloud
     */
    public function setTest($test)
    {
        $this->test = (bool) $test;

        return $this;
    }

    /**
     * Get the version string of the backend web service
     *
     * @return string
     */
    public function getVersion()
    {
        if (null === $this->version) {
            $this->version = self::DEFAULT_VERSION;
        }

        return $this->version;
    }

    /**
     * Set the version string of the backend web service
     *
     * @param string $version Version string
     *
     * @return ReportingCloud
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

     /**
     * Return the REST client of the backend web service
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (null === $this->client) {

            $authorization = function () {

                if (!empty($this->getApiKey())) {
                    return sprintf('ReportingCloud-APIKey %s', $this->getApiKey());
                }

                if (!empty($this->getUsername()) && !empty($this->getPassword())) {
                    $value = sprintf('%s:%s', $this->getUsername(), $this->getPassword());
                    return sprintf('Basic %s', base64_encode($value));
                }

                $message = 'Either the API key, or username and password must be set for authorization';
                throw new InvalidArgumentException($message);
            };

            $options = [
                'base_uri'              => $this->getBaseUri(),
                RequestOptions::TIMEOUT => $this->getTimeout(),
                RequestOptions::DEBUG   => $this->getDebug(),
                RequestOptions::HEADERS => [
                    'Authorization' => $authorization(),
                ],
            ];

            $client = new Client($options);

            $this->setClient($client);
        }

        return $this->client;
    }

    /**
     * Set the REST client of the backend web service
     *
     * @param Client $client REST client
     *
     * @return ReportingCloud
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
