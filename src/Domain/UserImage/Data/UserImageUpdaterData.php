<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/18/20
 * Time: 6:15 AM
 */

namespace App\Domain\UserImage\Data;


use Selective\ArrayReader\ArrayReader;

final class UserImageUpdaterData
{
    /**
     * @var string|null
     */
    public $logo;

    /**
     * @var string|null
     */
    public $banner;

    /**
     * UserImageCreatorData constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->logo = $data->findString('logo');
        $this->banner = $data->findString('banner');
    }

}