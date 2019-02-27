<?php

declare(strict_types=1);

/**
 * This file is part of Laravel Zero.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace LaravelZero\Framework\Providers\Build;

use Phar;

/**
 * @internal
 */
final class Build
{
    /**
     * The name of the environment file.
     *
     * @var string
     */
    private $dotEnvFilename = '.env';

    /**
     * Checks if the application is running from a Phar file.
     *
     * @return bool
     */
    public function isRunning(): bool
    {
        return Phar::running() !== '';
    }

    /**
     * Returns the directory path from where the Phar is running.
     *
     * @return string
     */
    public function getPath(): string
    {
        return dirname(Phar::running(false));
    }

    /**
     * Returns the .env path with Phar running.
     *
     * @return string
     */
    public function environmentFilePath(): string
    {
        return $this->getPath().DIRECTORY_SEPARATOR.$this->dotEnvFilename;
    }

    /**
     * Checks if the build is running and there's an available environment file.
     *
     * @return bool
     */
    public function canUseEnvironmentFile(): bool
    {
        return $this->isRunning() && file_exists($this->environmentFilePath());
    }

    /**
     * The filename for environment file.
     *
     * @return string
     */
    public function getDotEnvFilename(): string
    {
        return $this->dotEnvFilename;
    }
}
