<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/19/20
 * Time: 3:20 AM
 */

namespace App\Domain\Social\Data;


use Selective\ArrayReader\ArrayReader;

final class SocialCreatorData
{
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
     * SocialCreatorData constructor.
     *
     * @param array $array
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->social_name = $data->findString('social_name');
        $this->social_link = $data->findString('social_link');
        $this->profile_link = $data->findString('profile_link');
        $this->social_description = $data->findString('social_description');
    }
}