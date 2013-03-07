<?php

namespace Reoring\FusionModule;

require(dirname(__FILE__) . "../../../../vendor/autoload.php");

use Reoring\Fusion\Context;

use Reoring\Fusion\Interfaces\InputInterface;
use Reoring\Fusion\Protocol\ModuleProtocol;

/**
 * Class FusionModule
 *
 * @package Reoring\FusionModule
 */
class GridDatasourceModule implements ModuleProtocol
{
    private $moduleRoot;

    public function __construct()
    {
        $this->moduleRoot = dirname(__FILE__);
    }

    public function getIdentity()
    {
        return 'fusion.grid_datasource';
    }

    public function getManifest()
    {
        return ['fusion.grid.datasource'
                  => ['filter' =>
                         ['dispatch' => '\Reoring\FusionGridModule\Model\Data::filter']]];
    }

    /**
     * @param \Reoring\Fusion\Context $context
     */
    public function setup(Context $context)
    {
    }

    /**
     * @param \Reoring\Fusion\Context $context
     * @param \Reoring\Fusion\Interfaces\InputInterface $input
     *
     * @return array|\Reoring\Fusion\Interfaces\OutputInterface
     */
    public function run(Context $context, InputInterface $input)
    {
    }
}