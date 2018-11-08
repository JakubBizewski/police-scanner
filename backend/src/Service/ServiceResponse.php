<?php

namespace PoliceScanner\Service;

class ServiceResponse
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var bool
     */
    private $successful;

    /**
     * @var string
     */
    private $message;

    /**
     * @var object|null
     */
    private $responseObject;

    public function __construct(int $statusCode, string $message = "", $responseObject = null)
    {
        $this->statusCode = $statusCode;
        $this->successful = self::isCodeSuccessful($statusCode);
        $this->message = $message;
        $this->responseObject = $responseObject;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return object|null
     */
    public function getResponseObject()
    {
        return $this->responseObject;
    }

    private static function isCodeSuccessful(int $statusCode): bool
    {
        return substr((string) $statusCode, 0, 1) === "2";
    }
}
