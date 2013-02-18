<?php

namespace Reoring\FusionModule;

use Reoring\Fusion\Context;

use Reoring\Fusion\Asset\StringAsset;

use Reoring\Fusion\Interfaces\InputInterface;

use Reoring\Fusion\Protocol\ModuleProtocol;

use Reoring\Fusion\Standard\Atom;
use Reoring\Fusion\Standard\AtomOutput;

use Reoring\Fusion\Library\BowerLibrary;

/**
 * Class FusionModule
 *
 * @package Reoring\FusionModule
 */
class FusionModule implements ModuleProtocol
{
    public function getIdentity()
    {
        return 'fusion.sample';
    }

    /**
     * @param \Reoring\Fusion\Context $context
     */
    public function setup(Context $context)
    {
        $context->getLibraryManager()->add('jquery',     new BowerLibrary("jquery"));
        $context->getLibraryManager()->add('underscore', new BowerLibrary("underscore"));
        $context->getLibraryManager()->add('backbone',   new BowerLibrary("backbone"));

        $context->getAssetManager()->add("button", new StringAsset('$(function(){$("#atom1").click(function(){alert("here");});});'));
    }

    /**
     * @param \Reoring\Fusion\Context $context
     * @param \Reoring\Fusion\Interfaces\InputInterface $input
     *
     * @return array|\Reoring\Fusion\Interfaces\OutputInterface
     */
    public function run(Context $context, InputInterface $input)
    {
        // $context->getAssetManager()->using("button");

        $output = new AtomOutput();

        $params = $context->getModule()->getParameters();

        foreach ($params['button'] as $name => $value) {
            $output->set($name,  new Atom('<button id="'.$name.'">'.$value.'</button>'));
        }

        return $output;
    }
}