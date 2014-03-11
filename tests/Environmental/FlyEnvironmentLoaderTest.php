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

use Environmental\Factory\EnvironmentLoaderFactory;

class FlyEnvironmentLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function test_that_it_loads_default_env_file()
    {
        $loader = EnvironmentLoaderFactory::getEnvironmentLoaderWithOneVariable();

        $this->assertEquals("FOO=bar", $loader->load());
    }

    public function test_that_it_loads_custom_env_file()
    {
        $customEnv = '.customenv';

        $loader = EnvironmentLoaderFactory::getEnvironmentLoaderWithOneVariable($customEnv);

        $this->assertEquals("FOO=bar", $loader->load($customEnv));
    }
}
