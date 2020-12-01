<?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Sfneal\Dompdf;

/**
 * Create canvas instances
 *
 * The canvas factory creates canvas instances based on the
 * availability of rendering backends and config options.
 *
 * @package dompdf
 */
class CanvasFactory
{
    /**
     * Constructor is private: this is a static class
     */
    private function __construct()
    {
    }

    /**
     * @param Dompdf $dompdf
     * @param string|array|null $paper
     * @param string|null $orientation
     * @param string|null $class
     *
     * @return Canvas
     */
    static function get_instance(Dompdf $dompdf, $paper = null, $orientation = null, $class = null)
    {
        $backend = strtolower($dompdf->getOptions()->getPdfBackend());

        if (isset($class) && class_exists($class, false)) {
            $class .= "_Adapter";
        } else {
            if (($backend === "auto" || $backend === "pdflib") &&
                class_exists("PDFLib", false)
            ) {
                $class = "Sfneal\\Dompdf\\Adapter\\PDFLib";
            }

            else {
                if ($backend === "gd" && extension_loaded('gd')) {
                    $class = "Sfneal\\Dompdf\\Adapter\\GD";
                } else {
                    $class = "Sfneal\\Dompdf\\Adapter\\CPDF";
                }
            }
        }

        return new $class($paper, $orientation, $dompdf);
    }
}
