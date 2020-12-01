<?php

namespace Sfneal\Dompdf\Tests\Css;

use Sfneal\Dompdf\Css\Style;
use Sfneal\Dompdf\Css\Stylesheet;
use Sfneal\Dompdf\Dompdf;
use Sfneal\Dompdf\Tests\TestCase;

class StyleTest extends TestCase
{
    public function testLengthInPt()
    {
        $dompdf = new Dompdf();
        $sheet = new Stylesheet($dompdf);
        $s = new Style($sheet);

        // PX
        $length = $s->length_in_pt('100px');
        $this->assertEquals(75, $length);

        // also check caps
        $length = $s->length_in_pt('100PX');
        $this->assertEquals(75, $length);

        // PT
        $length = $s->length_in_pt('100pt');
        $this->assertEquals(100, $length);

        // %
        $length = $s->length_in_pt('100%');
        $this->assertEquals(12, $length);
    }
}
