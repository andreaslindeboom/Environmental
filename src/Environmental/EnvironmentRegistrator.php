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

use Environmental\Base\EnvironmentLoader;

class EnvironmentRegistrator {

    protected $loader;

    function __construct(EnvironmentLoader $loader)
    {
        $this->loader = $loader;
    }

    function register()
    {
        $envFileContent = $this->loader->load();
        $envFileLines = explode("\n", $envFileContent);

        foreach ($envFileLines as $line) {
            if (strpos($line, '=') === false) {
                continue;
            }

            $line = str_replace(array('"', "'"), '', $line);
            list($name, $value) = explode('=', $line);
            putenv($name . '=' . $value);
        }
    }

}