<?php
/**
 * Created by Red Square Studios.
 * User: kgwhatley
 * Date: 2017-03-15
 * Time: 8:41 PM
 */

namespace App\Lifecanvas\Transformers;


class ByteTransformer extends Transformer
{
    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'story' => $data['story'],
            'rating' => $data['rating'],
            'privacy' => $data['privacy'],
            'byte_date' => $data['byte_date'],
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'image_id' => $data['image_id'],
            'place_id' => $data['place_id'],
            'user_id' => $data['user_id']

            // TODO-KGW have left off the timezone and accuracy and need to convert the date to display time
        ];
    }
}