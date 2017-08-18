<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config;

use Jht\CoreBundle\Lib\SlugObject\Builder\Inmueble\ConcreteCreator\InmuebleSlugObjectBuilderInterface;
use Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath\GeneratePathToInmobiliaria;
use Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath\GeneratePathToInmuebleDetails;
use Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath\GeneratePathToResults;
use Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters\GetLandingStrongExpressionParametersByCultureAndExpression;
use Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters\GetParametersByIdInmoN;
use Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters\GetParametersByInmueble;
use Jht\ModelBundle\Entity\Repository\InmobiliariaRepository;
use Jht\ModelBundle\Entity\Repository\OperacionRepository;
use Jht\ModelBundle\Entity\Repository\TipoInmuebleRepository;
use Jht\ModelBundle\Lib\Repository\Landing\LandingStrongExpressionSlugRepository;

/**
 * Class GenerateConfigFactory
 *
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config
 */
class GenerateConfigFactory
{
    const KEY_DETAILS = 'details';
    const KEY_INMOBILIARIA = 'inmobiliaria';
    const KEY_LANDING_STRONG_EXPRESSION = 'landing_strong_expression';
    const KEY_RESULTS = 'results';

    /**
     * @access private
     * @var OperacionRepository
     */
    private $operacionRepository;

    /**
     * @access private
     * @var TipoInmuebleRepository
     */
    private $tipoInmuebleRepo;

    /**
     * @access private
     * @var InmobiliariaRepository
     */
    private $inmobiliariaRepo;

    /**
     * @access private
     * @var InmuebleSlugObjectBuilderInterface
     */
    private $buildInmuebleSlugObject;

    /**
     * @access public
     * @param OperacionRepository $operacionRepository
     * @param TipoInmuebleRepository $tipoInmuebleRepo
     * @param InmobiliariaRepository $inmobiliariaRepo
     * @param InmuebleSlugObjectBuilderInterface $buildInmuebleSlugObject
     */
    public function __construct(
        OperacionRepository $operacionRepository,
        TipoInmuebleRepository $tipoInmuebleRepo,
        InmobiliariaRepository $inmobiliariaRepo,
        InmuebleSlugObjectBuilderInterface $buildInmuebleSlugObject
    ) {
        $this->operacionRepository = $operacionRepository;
        $this->tipoInmuebleRepo = $tipoInmuebleRepo;
        $this->inmobiliariaRepo = $inmobiliariaRepo;
        $this->buildInmuebleSlugObject = $buildInmuebleSlugObject;
    }

    /**
     * @access public
     * @param array $dependencies
     * @return GenerateConfigInterface
     */
    public function create(array $dependencies)
    {
        switch ($dependencies['type']) {
            case self::KEY_DETAILS:
                $getParameters = new GetParametersByInmueble(
                    $this->operacionRepository,
                    $this->tipoInmuebleRepo,
                    $dependencies['inmueble'],
                    $dependencies['culture']
                );
                $generateConfig = new Details(
                    $getParameters,
                    new GeneratePathToInmuebleDetails(),
                    $dependencies['culture']
                );
                break;
            case self::KEY_INMOBILIARIA:
                $getParameters = new GetParametersByIdInmoN(
                    $this->inmobiliariaRepo,
                    $dependencies['culture'],
                    $dependencies['id_inmo_n']
                );
                $generateConfig = new Inmobiliaria(
                    $getParameters,
                    new GeneratePathToInmobiliaria(),
                    $dependencies['culture']
                );
                break;
            case self::KEY_LANDING_STRONG_EXPRESSION:
                $getParameters = new GetLandingStrongExpressionParametersByCultureAndExpression(
                    $dependencies['culture'],
                    $dependencies['expression'],
                    new LandingStrongExpressionSlugRepository()
                );
                $generateConfig = new LandingStrongExpression($getParameters);
                break;
            case self::KEY_RESULTS:
                $generateConfig = new Results(
                    $dependencies['filterObject'],
                    $this->buildInmuebleSlugObject,
                    new GeneratePathToResults()
                );
                break;
            default:
                $generateConfig = new NullConfig();
        }

        return $generateConfig;
    }
}
