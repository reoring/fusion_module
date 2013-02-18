<?php

namespace Reoring\FusionModule;

use Reoring\Fusion\Asset\StringAsset;
use Reoring\Fusion\Context;
use Reoring\Fusion\Renderer;

/**
 * Class FusionModule
 *
 * @package Reoring\FusionModule
 */
class FusionTheme
{
    /**
     * @param \Reoring\Fusion\Context $context
     */
    public function prepare(Context $context)
    {
    }

    /**
     * @param \Reoring\Fusion\Context $context
     * @param $outputs
     * @return mixed
     */
    public function run(Context $context, $outputs)
    {
        $layout = $context->getModule()->getParameters();

        $moduleRoot = dirname(__FILE__);
        $atomDir = $moduleRoot . DIRECTORY_SEPARATOR . "theme" . DIRECTORY_SEPARATOR;

        $tpl = file_get_contents($atomDir . $layout);

        $renderer = new Renderer();
        $renderer->setLayout($tpl);

        foreach ($outputs as $moduleId => $atomOutput) {
            foreach ($atomOutput->get() as $name => $atom) {
                $renderer->buffering($moduleId . '.' . $name, $atom->getContents());
            }
        }

        return $renderer->rendering();
    }
}