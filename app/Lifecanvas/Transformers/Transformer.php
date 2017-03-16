<?php

/**
 * Created by Red Square Studios.
 * User: kgwhatley
 * Date: 2017-03-12
 * Time: 11:02 PM
 */

namespace App\Lifecanvas\Transformers;

abstract class Transformer {

    public function transformCollection(array $item)
    {
        return array_map([$this, 'transform'], $item);
    }

    public abstract function transform($item);

}