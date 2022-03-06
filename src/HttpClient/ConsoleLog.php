<?php

declare(strict_types=1);

/*
 * Copyright (c) Ne-Lexa
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\HttpClient;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class ConsoleLog extends AbstractLogger
{
    public function __construct()
    {
        if (!\defined('STDOUT')) {
            \define('STDOUT', fopen('php://stdout', 'wb'));
        }

        if (!\defined('STDERR')) {
            \define('STDERR', fopen('php://stderr', 'wb'));
        }
    }

    public function log($level, $message, array $context = []): void
    {
        $stream = LogLevel::DEBUG === $level || LogLevel::INFO === $level ? \STDOUT : \STDERR;
        fwrite($stream, '[' . strtoupper($level) . '] ' . $message . \PHP_EOL);
        if (!empty($context)) {
            fwrite($stream, var_export($context, true) . \PHP_EOL);
        }
    }
}
