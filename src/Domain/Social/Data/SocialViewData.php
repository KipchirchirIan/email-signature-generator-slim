<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 12:06 AM
 */

namespace App\Domain\Social\Data;


use Selective\ArrayReader\ArrayReader;

final class SocialViewData
{
    /**
     * @var int
     */
    public $socialId;

    /**
     * @var string
     */
    public $social_name;

    /**
     * @var string
     */
    public $social_link;

    /**
     * @var string
     */
    public $profile_link;

    /**
     * @var string|null
     */
    public $social_description;

    /**
     * SocialViewData constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->socialId = $data->findString('social_id');
        $this->social_name = $data->findString('social_name');
        $this->social_link = $data->findString('social_link');
        $this->profile_link = $data->findString('social_profile_link');
        $this->social_description = $data->findString('social_desc');
    }
}