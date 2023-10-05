<?php

namespace MadeCurious\DockerLogging;

use Monolog\Processor\ProcessorInterface;

class DockerLogProcessor implements ProcessorInterface
{
    public function __invoke(array $record)
    {
        # Add silverstripe and ISO86001 timestamp to all requests
        $now = new \DateTime("now", new \DateTimeZone("UTC"));
        $record = ['source' => 'silverstripe', 'timestamp' => $now->format('c')] + $record;
        unset($record['datetime']);

        # If we're getting a request ID from nginx, include this
        if(isset($_SERVER['HTTP_X_REQUEST_ID'])) {
            $record['request_id'] = $_SERVER['HTTP_X_REQUEST_ID'];
        }

        # Set severity to harmonise with other sources
        $record['severity'] = strtolower($record['level_name']);

        return $record;
    }
}
