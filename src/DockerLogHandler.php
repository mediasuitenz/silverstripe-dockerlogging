<?php

namespace MadeCurious\DockerLogging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

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
    public function close(): void
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }

        parent::close();
    }

    /**
     * {@inheritdoc}
     */
    protected function write(LogRecord $record): void
    {
        if (!is_resource($this->stream)) {
            $this->stream = fopen("php://stdout", 'w');
        }
        $record->extra['source'] = 'silverstripe';

        fwrite($this->stream, (string)$record->formatted);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new JsonFormatter();
    }
}
