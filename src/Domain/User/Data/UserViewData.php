<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/6/20
 * Time: 1:42 AM
 */

namespace App\Domain\User\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Class UserViewData
 * @package App\Domain\User\Data
 */
class UserViewData
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
//    public $company;

    /**
     * @var string|null
     */
//    public $position;

    /**
     * @var string|null
     */
//    public $department;

    /**
     * @var string|null
     */
//    public $phone;

    /**
     * @var string|null
     */
//    public $mobile;

    /**
     * @var string|null
     */
//    public $website;

    /**
     * @var string|null
     */
//    public $skype;

    /**
     * @var string|null
     */
//    public $address;

    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->id = $data->findInt('user_id');
        $this->email = $data->findString('email');
        $this->name = $data->findString('name');
    }
}