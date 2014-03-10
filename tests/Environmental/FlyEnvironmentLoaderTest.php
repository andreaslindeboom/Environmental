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
        $loader = $this->getEnvironmentLoader();

        $this->assertEquals("foo", $loader->load());
    }

    public function test_that_it_loads_custom_env_file()
    {
        $customEnv = '.customenv';

        $loader = $this->getEnvironmentLoader($customEnv);

        $this->assertEquals("foo", $loader->load($customEnv));
    }

    /**
     * @param $filePath
     * @return FlyEnvironmentLoader
     */
    public function getEnvironmentLoader($filePath = null)
    {
        if (! $filePath) {
            $filePath = '.env';
        }

        $adapter = Mockery::mock('League\Flysystem\Adapter\AbstractAdapter');
        $adapter->shouldReceive('read')
            ->with($filePath)
            ->andReturn(
                array(
                    'contents' => "foo",
                    'path' => $filePath,
                ));

        return new FlyEnvironmentLoader($adapter);
    }
}
