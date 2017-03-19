<?php
/**
 * Created by Red Square Studio.
 * User: kgwhatley
 * Date: 2017-03-18
 * Time: 9:32 PM
 */

namespace App\Lifecanvas\Transformers;


class LineTransformer extends Transformer
{
    public function transform($data)
    {
        return array(
            'id' => $data['id'],
            'name' => $data['name']
        );
    }
}