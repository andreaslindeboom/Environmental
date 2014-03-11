<?php
 /**
 * Part of Environmental.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom/minion
 */

namespace Environmental\Factory;

use Environmental\Base\FlyEnvironmentLoader;

class EnvironmentLoaderFactory {

    /**
     * @param $filePath
     * @return FlyEnvironmentLoader
     */
    public static function getEnvironmentLoaderWithOneVariable($filePath = null)
    {
        if (! $filePath) {
            $filePath = '.env';
        }

        $adapter = \Mockery::mock('League\Flysystem\Adapter\AbstractAdapter');
        $adapter->shouldReceive('read')
            ->with($filePath)
            ->andReturn(
                array(
                    'contents' => "FOO=bar",
                    'path' => $filePath,
                ));

        return new FlyEnvironmentLoader($adapter);
    }

    public static function getEnvironmentLoaderWithTwoVariables($filePath = null)
    {
        if (! $filePath) {
            $filePath = '.env';
        }

        $adapter = \Mockery::mock('League\Flysystem\Adapter\AbstractAdapter');
        $adapter->shouldReceive('read')
            ->with($filePath)
            ->andReturn(
                array(
                    'contents' => "FOO=bar\nBAZ=qux",
                    'path' => $filePath,
                ));

        return new FlyEnvironmentLoader($adapter);
    }

} 