<?php

namespace Sfneal\Dompdf\Frame;

use IteratorAggregate;
use Sfneal\Dompdf\Frame;

/**
 * Linked-list IteratorAggregate.
 */
class FrameList implements IteratorAggregate
{
    /**
     * @var Frame
     */
    protected $_frame;

    /**
     * @param Frame $frame
     */
    public function __construct($frame)
    {
        $this->_frame = $frame;
    }

    /**
     * @return FrameListIterator
     */
    public function getIterator()
    {
        return new FrameListIterator($this->_frame);
    }
}
