<?php

namespace App\Lib\Logs;

class HTMLLogger extends Logger
{
    /**
     * CSS colors to be used when logging.
     *
     * @var array
     */
    public $colors = [
        'success'   => 'green',
        'error'     => 'red',
        'warn'      => 'yellow'
    ];

    public function __construct($filename = 'log.html', $path = '', $timestamped = true)
    {
        parent::__construct($filename, $path, $timestamped);
    }

    public function info($message)
    {
        $html = '<p>' . $message . "</p>\n";
        $this->writelog($html);
    }

    public function success($message)
    {
        $html = "<p style='color: {$this->colors['success']}'>" . $message . "</p>\n";
        $this->writelog($html);
    }

    public function error($message)
    {
        $html = "<p style='color: {$this->colors['error']}'>" . $message . "</p>\n";
        $this->writelog($html);
    }

    public function warn($message)
    {
        $html = "<p style='color: {$this->colors['warn']}'>" . $message . "</p>\n";
        $this->writelog($html);
    }

    public function pre($message)
    {
        if (is_array($message)) {
            $message = print_r($message, true);
        }
        $html = '<pre>' . $message . "</pre>\n";
        $this->writelog($html);
    }

    public function hr()
    {
        $html = "<hr>\n";
        $this->writelog($html);
    }

    private function writelog($html)
    {
        if (getenv('APP_ENV') != 'test') {
            file_put_contents($this->file, $html, FILE_APPEND);
        }
    }
}
