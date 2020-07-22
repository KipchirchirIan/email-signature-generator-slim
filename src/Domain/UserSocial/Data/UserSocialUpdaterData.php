<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/22/20
 * Time: 6:33 AM
 */

namespace App\Domain\UserSocial\Data;


use Selective\ArrayReader\ArrayReader;

final class UserSocialUpdaterData
{
    /**
     * @var int|null
     */
    public $socialId;

    /**
     * @var string|null
     */
    public $profileUsername;

    /**
     * UserSocialCreatorData constructor.
     *
     * @param array $array The array with data
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->socialId = $data->findInt('social_id');
        $this->profileUsername =$data->findString('profile_username');
    }
}