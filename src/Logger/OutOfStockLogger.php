<?php

namespace OpsWay\Migration\Logger;

use OpsWay\Migration\Writer\File\Csv;

class OutOfStockLogger
{
    protected $csvWriter;

    public function __construct(array $params)
    {
        $this->csvWriter = new Csv($params);
    }

    public function __invoke($item, $status, $msg)
    {
        if ($item[3] == 0 && $item[4] == 0) {
            $this->csvWriter->write($item);
        }
    }
}
