<?php
/**
 * Part of Environmental.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom/environmental
 */

namespace Environmental;

use Environmental\Base\FlyEnvironmentLoader;
use League\Flysystem\Adapter\AbstractAdapter;
use Mockery;

class FlyEnvironmentLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function test_that_it_loads_default_env_file()
    {
        $adapter = Mockery::mock('League\Flysystem\Adapter\AbstractAdapter');
        $adapter->shouldReceive('read')
            ->with('.env')
            ->andReturn(
                array(
                    'contents' => "foo",
                    'path' => ".env",
                ));

        $environmentLoader = new FlyEnvironmentLoader($adapter);
        $this->assertEquals("foo", $environmentLoader->load());
    }
}
