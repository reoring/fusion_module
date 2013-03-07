<?php

namespace Reoring\FusionModule\Model;

use Reoring\Fusion\Container\ContainerAwareInterface;
use Reoring\Fusion\Container\ContainerInterface;

use Reoring\Fusion\Event\Event;
use Reoring\Fusion\Interfaces\InputInterface;

class Data implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function update(InputInterface $input)
    {
        $data = $this->container
                     ->get('eventbus')
                     ->emit('fusion.grid.datasource', new Event('filter'));

        return json_encode($data);
    }

    /*
    public function update(InputInterface $input)
    {
        return json_encode([['test', 'data'], ['test1', 'data1']]);
    }
    */
}