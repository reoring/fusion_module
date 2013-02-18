<?php

namespace Reoring\FusionModule\Model;

use Reoring\Fusion\Interfaces\InputInterface;

class Data
{
    public function update(InputInterface $input)
    {
        return json_encode([['test', 'data'], ['test1', 'data1']]);
    }
}