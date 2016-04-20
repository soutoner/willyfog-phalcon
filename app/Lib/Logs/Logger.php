<?php

namespace App\Lib\Logs;

use DateTime;

/**
 * Class Logger.
 */
abstract class Logger
{
    /**
     * Name of the log file.
     *
     * @var string
     */
    public $file;

    /**
     * Log levels.
     */
    const INFO = 'info';
    const WARNING = 'warning';
    const SUCCESS = 'success';
    const ERROR = 'error';

    /**
     * Logger constructor.
     *
     * @param string $filename    : filename of the log file
     * @param string $path        : path of the log. Relative to APP_PATH. It must exist!!!
     * @param bool   $timestamped : Whether to timestamp log file name or not
     */
    public function __construct($filename = 'willyfog.log', $path = '', $timestamped = true)
    {
        $this->path = APP_PATH . '/log/' . $path;
        $date = new DateTime();
        if ($timestamped) {
            $this->file = $this->path . $date->getTimestamp() . '_' . $filename;
        } else {
            $this->file = $this->path . $filename;
        }
    }
}
