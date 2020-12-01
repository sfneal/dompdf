<?php
namespace Sfneal\Dompdf\Tests;

use Sfneal\Dompdf\Tests\TestCase;
use Sfneal\Dompdf\Autoloader;

class AutoloaderTest extends TestCase
{
    public function testAutoload()
    {
        Autoloader::register();

        $declared = get_declared_classes();
        $declaredCount = count($declared);
        Autoloader::autoload('Foo');
        $this->assertEquals($declaredCount, count(get_declared_classes()), 'Sfneal\\DompdfAutoloader::autoload() is trying to load classes outside of the Dompdf namespace');
        Autoloader::autoload('Dompdf\Dompdf');
        $this->assertTrue(in_array('Dompdf\Dompdf', get_declared_classes()), 'Sfneal\\DompdfAutoloader::autoload() failed to autoload the Dompdf\Dompdf class');
    }
}