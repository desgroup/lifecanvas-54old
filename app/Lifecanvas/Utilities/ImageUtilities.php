<?php
/**
 * Created by Red Square Studios.
 * User: kgwhatley
 * Date: 2017-03-12
 * Time: 8:30 PM
 */

namespace App\Lifecanvas\Utilities;


use Illuminate\Http\Request;
use Intervention\Image\Image;
use SplFileInfo;

class ImageUtilities
{

    /**
     * @param Request $request
     * @return array
     */
    public function processImage(Request $request)
    {

        $file = $request->file('image');

        $user_id = Auth::user()->id;
        $info = new SplFileInfo($file->getClientOriginalName());
        $extension = strtolower($info->getExtension());
        $filename = uniqid($user_id, true);
        $filename = str_replace(".", "-", $filename) . "." . $extension;
        $filePath = public_path() . '/usr/' . $user_id;
        if (!is_dir($filePath)) {
            mkdir($filePath . '/org', 0777, true);
        }
        if (!is_dir($filePath)) {
            mkdir($filePath . '/medium', 0777, true);
        }
        if (!is_dir($filePath)) {
            mkdir($filePath . '/small', 0777, true);
        }
        if (!is_dir($filePath)) {
            mkdir($filePath . '/thumb', 0777, true);
        }
        $file->move($filePath . '/org/', $filename);

        $img = Image->make($filePath . '/org/' . $filename);
        $img_medium = Image->make($filePath . '/org/' . $filename);
        $img_small = Image->make($filePath . '/org/' . $filename);
        $img_thumbnail = Image->make($filePath . '/org/' . $filename);
        $img_medium->resize(1500, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($filePath . '/medium/' . $filename, 90);
        $img_small->resize(240, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($filePath . '/small/' . $filename, 90);
        $img_thumbnail->resize(125, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($filePath . '/thumb/' . $filename, 70);

        $exif = $img->exif();

        $lat = null;
        $lng = null;

        if (array_key_exists('GPSLongitude', $exif)) {
            $lat = $this->getGps($exif['GPSLatitude'], $exif['GPSLatitudeRef']);
            $lng = $this->getGps($exif['GPSLongitude'], $exif['GPSLongitudeRef']);
        }

        $image_data = array(
            'file_name' => $filename,
            'extension' => $extension,
            'size_kb' => $exif['FileSize'] / 1000,
            'height_px' => $exif['COMPUTED']['Height'],
            'width_px' => $exif['COMPUTED']['Width'],
            'asset_date' => $exif['DateTime'],
            'timezone_id' => Null,
            'lat' => $lat,
            'lng' => $lng,
            'user_id' => $user_id
        );

        $image = Image::create($image_data);

        if ($request->use_image_time == "on" && !is_null($img->exif('DateTime'))) {

            $byte_date = array("datetime" => $img->exif('DateTime'), "accuracy" => "1111110");
            $data = array("id" => $image->id, "byte_date" => $byte_date);

        } else {

            $data = array("id" => $image->id, "byte_date" => null);

        }

        return ($data);

    }

    /**
     * @param $exifCoord
     * @param $hemi
     * @return int
     */
    private function getGps($exifCoord, $hemi)
    {

        $degrees = count($exifCoord) > 0 ? $this->gps2Num($exifCoord[0]) : 0;
        $minutes = count($exifCoord) > 1 ? $this->gps2Num($exifCoord[1]) : 0;
        $seconds = count($exifCoord) > 2 ? $this->gps2Num($exifCoord[2]) : 0;

        $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

        return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

    }

    /**
     * @param $coordPart
     * @return float|int
     */
    private function gps2Num($coordPart)
    {

        $parts = explode('/', $coordPart);

        if (count($parts) <= 0) {
            return 0;
        }

        if (count($parts) == 1) {
            return $parts[0];
        }

        return floatval($parts[0]) / floatval($parts[1]);
    }

}