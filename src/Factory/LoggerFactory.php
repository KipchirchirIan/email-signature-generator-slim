<?php


namespace App\Factory;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
/**
 * Class LoggerFactory
 *
 * @package App\Factory
 */
final class LoggerFactory
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var int
     */
    private $level;

    /**
     * LoggerFactory constructor.
     *
     * @param array $settings The settings
     */
    public function __construct(array $settings)
    {
        $this->path = (string)$settings['path'];
        $this->level = (int)$settings['level'];
    }

    /**
     * @var array Handler
     */
    private $handler = [];

    /**
     * Build the logger.
     *
     * @param string $name The name
     *
     * @return LoggerInterface The logger
     */
    public function createInstance(string $name): LoggerInterface
    {
        $logger = new Logger($name);

        foreach ($this->handler as $handler) {
            $logger->pushHandler($handler);
        }

        $this->handler = [];

        return $logger;
    }

    /**
     * Add rotating file logger handler
     *
     * @param string $filename The filename
     * @param int|null $level The level (Optional)
     *
     * @return LoggerFactory The logger factory
     */
    public function addFileHandler(string $filename, int $level = null): self
    {
        $filename = sprintf('%s/%s', $this->path, $filename);

        $rotatingFileHandler = new RotatingFileHandler(
            $filename,
            0,
            $level ?? $this->level,
            true,
            0777
        );

        // The last "true" here tells Monolog to remove empty []'s
        $rotatingFileHandler->setFormatter(
            new LineFormatter(null, null, false, true)
        );

        $this->handler[] = $rotatingFileHandler;

        return $this;
    }

    /**
     * Add a console logger
     *
     * @param int|null $level The level (Optional)
     * @return self The instance
     */
    public function addConsoleHandler(int $level = null): self
    {
        $streamHandler = new StreamHandler('php://stdout', $level ?? $this->level);
        $streamHandler->setFormatter(
            new LineFormatter(null, null, false, true)
        );

        $this->handler[] = $streamHandler;

        return $this;
    }
}