<?php
/**
 * Part of Environmental.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom/environmental
 */

namespace Environmental\Base;

use Environmental\Base\Exceptions\NonExistantFile;
use League\Flysystem\Adapter\AbstractAdapter;

class FlyEnvironmentLoader implements EnvironmentLoader
{
    private $adapter;

    function __construct(AbstractAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function load($environmentFilePath = '.env')
    {
        $flyResult = $this->adapter->read($environmentFilePath);

        if (! $flyResult) {
            throw new NonExistantFile($environmentFilePath);
        }

        return $flyResult['contents'];
    }
}
