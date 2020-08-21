<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/28/20
 * Time: 8:49 PM
 */

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreatorData;
use PDO;

class UserCreatorRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * UserCreatorRepository constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertUser(UserCreatorData $user): int
    {
        $row = [
            'email' => $user->email,
            'password' => $user->password,
            'name' => $user->name,
            'company' => $user->company,
            'position' => $user->position,
            'department' => $user->department,
            'phone' => $user->phone,
            'mobile' => $user->mobile,
            'website' => $user->website,
            'skype' => $user->skype,
            'address' => $user->address
        ];

        $sql = "INSERT INTO tbl_users 
                            SET email = :email, 
                            password = :password,
                            name = :name, 
                            company = :company, 
                            position = :position, 
                            department = :department, 
                            phone = :phone, 
                            mobile = :mobile, 
                            website = :website, 
                            skype = :skype, 
                            address = :address";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }


}