<?php

namespace MadeCurious\DockerLogging;

use Monolog\Processor\ProcessorInterface;
use Monolog\LogRecord;

class DockerLogProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record)
    {
        # Add silverstripe and ISO86001 timestamp to all requests
        $now = new \DateTime("now", new \DateTimeZone("UTC"));
        $record->extra['source'] = 'silverstripe';
        $record->extra['timestamp'] = $now->format('c');

        # If we're getting a request ID from nginx, include this
        if(isset($_SERVER['HTTP_X_REQUEST_ID'])) {
            $record->extra['request_id'] = $_SERVER['HTTP_X_REQUEST_ID'];
        }

        # Set severity to harmonise with other sources
        $record->extra['severity'] = strtolower($record->level->name);

        return $record;
    }
}
