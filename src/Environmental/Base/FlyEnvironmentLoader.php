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
    private $environmentFilePath;

    function __construct(AbstractAdapter $adapter, $environmentFilePath = '.env')
    {
        $this->adapter = $adapter;
        $this->environmentFilePath = $environmentFilePath;
    }

    public function load()
    {
        $flyResult = $this->adapter->read($this->environmentFilePath);

        if (! $flyResult) {
            throw new NonExistantFile($this->environmentFilePath);
        }

        return $flyResult['contents'];
    }
}
