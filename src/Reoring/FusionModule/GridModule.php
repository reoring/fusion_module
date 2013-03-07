<?php

namespace Reoring\FusionModule;

require(dirname(__FILE__) . "../../../../vendor/autoload.php");

use Reoring\Fusion\Context;

use Reoring\Fusion\Library\BowerLibrary;
use Reoring\Fusion\Asset\JavaScriptAsset;

use Reoring\Fusion\Interfaces\InputInterface;

use Reoring\Fusion\Protocol\ModuleProtocol;

use Reoring\Fusion\Standard\StringAtom;
use Reoring\Fusion\Standard\AtomOutput;

/**
 * Class FusionModule
 *
 * @package Reoring\FusionModule
 */
class GridModule implements ModuleProtocol
{
    private $moduleRoot;
    private $atomDir;
    private $jsDir;

    public function __construct()
    {
        $this->moduleRoot = dirname(__FILE__);

        $this->atomDir = $this->moduleRoot . DIRECTORY_SEPARATOR . "atom" . DIRECTORY_SEPARATOR;
        $this->jsDir   = $this->moduleRoot . '/assets/js/';
    }

    public function getIdentity()
    {
        return 'fusion.grid';
    }

    public function getManifest()
    {
        return ['http' => ['update' =>
                              ['url'      => '/grid/update',
                               'dispatch' => '\Reoring\FusionModule\Model\Data::update']]];
    }

    /**
     * @param \Reoring\Fusion\Context $context
     */
    public function setup(Context $context)
    {
        $context->getLibraryManager()->add('jquery',     new BowerLibrary("jquery"));
        $context->getLibraryManager()->add('underscore', new BowerLibrary("underscore"));
        $context->getLibraryManager()->add('backbone',   new BowerLibrary("backbone"));
        $context->getLibraryManager()->add('fusion',     new BowerLibrary("fusion"));

        // explicit declaration
        $context->getAssetManager()->add('main.js', new JavaScriptAsset($this->jsDir . 'main.js'));
    }

    /**
     * @param \Reoring\Fusion\Context $context
     * @param \Reoring\Fusion\Interfaces\InputInterface $input
     *
     * @return array|\Reoring\Fusion\Interfaces\OutputInterface
     */
    public function run(Context $context, InputInterface $input)
    {
        $context->getLibraryManager()->using('jquery');
        $context->getLibraryManager()->using('fusion');

        $context->getAssetManager()->using('main.js');

        $params = $context->getModule()->getParameters();

        $tpl = file_get_contents($this->atomDir . "table.html.twig");

        // TODO remove direct dependency to the twig
        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);

        $output = new AtomOutput();
        $output->set('table',  new StringAtom($twig->render($tpl, $params)));

        return $output;
    }
}