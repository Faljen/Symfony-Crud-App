<?php


namespace App\Service;


use Psr\Log\LoggerInterface;

class LuckyNumber
{
    private $logger;
    private $max;

    public function __construct(int $max, LoggerInterface $logger)
    {
        $this->max = $max;
        $this->logger = $logger;
    }

    public function getNumber(): int
    {
        $randomNumber = random_int(1, $this->max);
        $this->logger->debug('Number is: ' . $randomNumber);
        try {
            return $randomNumber;
        } catch (\Exception $e) {
            throw new \Exception("Error!");
        }
    }
}