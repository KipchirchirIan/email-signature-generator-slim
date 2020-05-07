<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 5:30 PM
 */

namespace App\Domain\User\Data;

use Selective\ArrayReader\ArrayReader;

 final class UserCreatorData
{
     /**
      * @var int|null
      */
    public $id;

     /**
      * @var string|null
      */
    public $email;

     /**
      * @var string|null
      */
    public $name;

     /**
      * @var string|null
      */
    public $company;

     /**
      * @var string|null
      */
    public $position;

     /**
      * @var string|null
      */
    public $department;

     /**
      * @var string|null
      */
    public $phone;

     /**
      * @var string|null
      */
    public $mobile;

     /**
      * @var string|null
      */
    public $website;

     /**
      * @var string|null
      */
    public $skype;

     /**
      * @var string|null
      */
    public $address;

    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->id = $data->findInt('user_id');
        $this->email = $data->findString('email');
        $this->name = $data->findString('name');
        $this->company = $data->findString('company');
        $this->position = $data->findString('position');
        $this->department = $data->findString('department');
        $this->mobile = $data->findString('mobile');
        $this->phone = $data->findString('phone');
        $this->address = $data->findString('address');
        $this->skype = $data->getString('skype', null);
        $this->website = $data->findString('website');
    }

 }