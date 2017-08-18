<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters;

/**
 * Class GetParametersByUri
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters
 */
class GetParametersByUri implements GetParametersInterface
{
    const LOCALIZACION_STARTING_LEVEL = 3;
    /**
     * @access private
     * @var String
     */
    private $uri;

    /**
     * @access public
     * @param String $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @access public
     * @return array
     */
    public function get()
    {
        $this->uri = str_replace('http://', '', $this->uri);
        $this->uri = str_replace('https://', '', $this->uri);
        $this->uri = str_replace('front/', '', $this->uri);
        $this->uri = trim($this->uri, '/');
        $this->uri = trim($this->uri);

        $posGet = strrpos($this->uri, "?");

        // elimina los parametros get
        if ($posGet !== false) {
            $this->uri = substr($this->uri, 0, $posGet);
        }

        $uriArr = explode('/', $this->uri);

        // eliminar host
        $hostArr = explode('.', $uriArr[0]);
        $culture = $hostArr[0];
        if (!in_array($culture, array('ca', 'en', 'de', 'fr', 'it'))) {
            $culture = 'es';
        }
        unset($uriArr[0]);

        // eliminar frontend_dev.php, app_dev.php, app.php ...
        if (strrpos($uriArr[1], ".php") !== false) {
            unset($uriArr[1]);
            $uriArr = $this->arrangeValues($uriArr);
        }

        $uriArr['culture'] = $culture;

        $parameters[$culture] = $uriArr;

        return $parameters;
    }

    private function arrangeValues($uriArr)
    {
        $arrangedArr = array();
        $i = 1;
        foreach ($uriArr as $value) {
            $arrangedArr[$i] = $value;
            $i++;
        }

        return $arrangedArr;
    }
}
