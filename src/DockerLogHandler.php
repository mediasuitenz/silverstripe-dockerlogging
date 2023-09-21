<?php

namespace Madecurious\DockerLogging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class DockerMonologHandler extends AbstractProcessingHandler
{
    /**
     * @var resource
     */
    private $stream;

    /**
     * Constructor
     *
     * @param int $processId PID, this should be 1
     * @param int $fileDescriptor Accept 1: stdout, or 2: stderr
     * @param string|int $level Log level
     * @param bool $bubble
     * @param FormatterInterface|null $formatter
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
            pclose($this->stream);
        }

        parent::close();
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if (!is_resource($this->stream)) {
            $this->stream = popen("php://stdout", 'w');
        }

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
