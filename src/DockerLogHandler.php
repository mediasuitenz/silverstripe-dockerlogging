<?php

namespace MadeCurious\DockerLogging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class DockerLogHandler extends AbstractProcessingHandler
{
    /**
     * @var resource
     */
    private $stream;

    /**
     * Constructor
     */
    public function __construct(
        $level = Logger::DEBUG,
        bool $bubble = true,
    )
    {
        parent::__construct($level, $bubble);

    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }

        parent::close();
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if (!is_resource($this->stream)) {
            $this->stream = fopen("php://stdout", 'w');
        }
        $record['source'] = 'silverstripe';
        fwrite($this->stream, (string)$record['formatted']);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new JsonFormatter();
    }
}
