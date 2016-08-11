<?php

namespace OpsWay\Migration\Reader\File;

use OpsWay\Migration\Reader\ReaderInterface;

class Csv implements ReaderInterface
{
    protected $file;
    protected $filename;

    public function __construct(array $params)
    {
        $this->filename = $params['filename'];
        $this->checkFileName();
    }

    /**
     * @return array|null
     */
    public function read()
    {
        if (!$this->file) {
            if (!($this->file = fopen($this->filename, 'r'))) {
                throw new \RuntimeException(sprintf('Can not open file "%s" for reading data.', $this->filename));
            }
        }
        return fgetcsv($this->file);
    }

    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }

    private function checkFileName()
    {
        if (!file_exists($this->filename)) {
            throw new \RuntimeException(sprintf('File "%s" not found.', $this->filename));
        }
    }
}
