<?php
/**
 * @link    http://dompdf.github.com/
 *
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace Sfneal\Dompdf\FrameReflower;

use Sfneal\Dompdf\Exception;
use Sfneal\Dompdf\FrameDecorator\Block as BlockFrameDecorator;
use Sfneal\Dompdf\FrameDecorator\Table as TableFrameDecorator;
use Sfneal\Dompdf\FrameDecorator\TableRow as TableRowFrameDecorator;

/**
 * Reflows table rows.
 */
class TableRow extends AbstractFrameReflower
{
    /**
     * TableRow constructor.
     *
     * @param TableRowFrameDecorator $frame
     */
    public function __construct(TableRowFrameDecorator $frame)
    {
        parent::__construct($frame);
    }

    /**
     * @param BlockFrameDecorator|null $block
     */
    public function reflow(BlockFrameDecorator $block = null)
    {
        $page = $this->_frame->get_root();

        if ($page->is_full()) {
            return;
        }

        $this->_frame->position();
        $style = $this->_frame->get_style();
        $cb = $this->_frame->get_containing_block();

        foreach ($this->_frame->get_children() as $child) {
            if ($page->is_full()) {
                return;
            }

            $child->set_containing_block($cb);
            $child->reflow();
        }

        if ($page->is_full()) {
            return;
        }

        $table = TableFrameDecorator::find_parent_table($this->_frame);
        $cellmap = $table->get_cellmap();
        $style->width = $cellmap->get_frame_width($this->_frame);
        $style->height = $cellmap->get_frame_height($this->_frame);

        $this->_frame->set_position($cellmap->get_frame_position($this->_frame));
    }

    /**
     * @throws Exception
     */
    public function get_min_max_width()
    {
        throw new Exception('Min/max width is undefined for table rows');
    }
}
