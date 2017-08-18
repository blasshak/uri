<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters;

use Jht\CoreBundle\Lib\Utils\Culture;
use Jht\ModelBundle\Entity\Operacion;
use Jht\ModelBundle\Entity\Repository\OperacionRepository;
use Jht\ModelBundle\Entity\Repository\TipoInmuebleRepository;
use Jht\ModelBundle\Lib\Repository\TranslationRepository;

/**
 * Class GetParametersByInmueble
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters
 */
class GetParametersByInmueble implements GetParametersInterface
{
    /**
     * @access private
     * @var OperacionRepository
     */
    private $operacionRepo;

    /**
     * @access private
     * @var TipoInmuebleRepository
     */
    private $tipoInmuebleRepo;

    /**
     * @access private
     * @var array
     */
    private $inmueble;

    /**
     * @access private
     * @var String
     */
    private $culture;

    /**
     * @access public
     * @param OperacionRepository $operacionRepo
     * @param TipoInmuebleRepository $tipoInmuebleRepo
     * @param array $inmueble
     * @param String $culture
     */
    public function __construct(
        OperacionRepository $operacionRepo,
        TipoInmuebleRepository $tipoInmuebleRepo,
        array $inmueble,
        $culture
    ) {
        $this->operacionRepo = $operacionRepo;
        $this->tipoInmuebleRepo = $tipoInmuebleRepo;
        $this->inmueble = $inmueble;
        $this->culture = $culture;
    }

    /**
     * @access public
     * @return array
     */
    public function get()
    {
        $parameters = array();

        if (empty($this->inmueble['tipo_id'])
            || empty($this->inmueble['operacion_id'])
            || empty($this->inmueble['referencia'])) {
            return $parameters;
        }

        $tipoUrlCultures = $this->tipoInmuebleRepo->findNombreSlugById($this->inmueble['tipo_id']);
        $tipoUrl = $tipoUrlCultures[$this->culture];

        if ($this->inmueble['operacion_id'] == Operacion::COMPRA) {
            $operacionUrl = TranslationRepository::getVenta($this->culture);
        } else {
            $operacionUrlCultures = $this->operacionRepo->findNombreSlugById($this->inmueble['operacion_id']);
            $operacionUrl = $operacionUrlCultures[$this->culture];
        }

        $parameters = array(
            'culture' => $this->culture,
            'tipo_inmueble' => $tipoUrl,
            'operacion' => $operacionUrl,
            'inmueble' => TranslationRepository::getInmueble($this->culture),
            'referencia' => $this->inmueble['referencia'],
        );

        return $parameters;
    }
}
