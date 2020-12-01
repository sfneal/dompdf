<?php
/**
 * @link    http://dompdf.github.com/
 *
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace Sfneal\Dompdf\Positioner;

use Sfneal\Dompdf\FrameDecorator\AbstractFrameDecorator;

/**
 * Dummy positioner.
 */
class NullPositioner extends AbstractPositioner
{
    /**
     * @param AbstractFrameDecorator $frame
     */
    public function position(AbstractFrameDecorator $frame)
    {
    }
}
