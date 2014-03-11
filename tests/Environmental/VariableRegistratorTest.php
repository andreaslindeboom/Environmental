<?php
 /**
 * Part of Environmental.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom/minion
 */

namespace Environmental;

use Environmental\Factory\EnvironmentLoaderFactory;
use Environmental\EnvironmentRegistrator;

class VariableRegistratorTest extends \PHPUnit_Framework_TestCase {

    public function test_that_loaded_vars_are_accessible()
    {
        $loader = EnvironmentLoaderFactory::getEnvironmentLoaderWithOneVariable();

        $registrator = new EnvironmentRegistrator($loader);
        $registrator->register();

        $this->assertEquals('bar', getenv('FOO'));

        $loader = EnvironmentLoaderFactory::getEnvironmentLoaderWithTwoVariables();
        $registrator = new EnvironmentRegistrator($loader);
        $registrator->register();

        $this->assertEquals('bar', getenv('FOO'));
        $this->assertEquals('qux', getenv('BAZ'));


    }

    public function test_that_custom_filesystem_abstraction_can_be_used()
    {
        // this only makes sense when the storage part is implemented
        // way to go about it: implement EnvironmentLoader interface and pass it to storage
    }

}
 