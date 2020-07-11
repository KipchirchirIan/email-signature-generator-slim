<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/8/20
 * Time: 1:55 AM
 */

namespace App\Domain\UserImage\Data;


use Selective\ArrayReader\ArrayReader;

final class UserImageCreatorData
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string|null
     */
    public $logo;

    /**
     * @var string|null
     */
    public $banner;

    /**
     * @var int
     */
    public $userId;

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
        $this->userId = $data->findInt('userId');
        $this->id = $data->findInt('userImgId');
    }
}