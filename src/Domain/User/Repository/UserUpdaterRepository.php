<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 4/30/20
 * Time: 2:07 PM
 */

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreatorData;
use PDO;

/**
 * Class UserUpdaterRepository
 * @package App\Domain\User\Repository
 */
class UserUpdaterRepository
{
    /**
     * @var PDO The connection
     */
    private $connection;

    /**
     * UserUpdaterRepository constructor.
     *
     * @param PDO $connection The connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param UserCreatorData $user User data to update
     * @param int $uid Id of user to update
     *
     * @return bool The result
     */
    public function updateUser(UserCreatorData $user, int $uid): bool
    {
        $row = [
            'name' => $user->name,
            'company' => $user->company,
            'position' => $user->position,
            'department' => $user->department,
            'phone' => $user->phone,
            'mobile' => $user->mobile,
            'website' => $user->website,
            'skype' => $user->skype,
            'address' => $user->address,
            'userId' => $uid
        ];

        $sql = "UPDATE tbl_users SET name = :name, 
                                company = :company, 
                                position = :position, 
                                department = :department, 
                                phone = :phone, 
                                mobile = :mobile, 
                                website = :website, 
                                skype = :skype, 
                                address = :address 
                                WHERE user_id = :userId";

        return $this->connection->prepare($sql)->execute($row);
    }
}