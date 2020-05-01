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
            'email' => $user->email,
            'name' => $user->name,
            'company' => $user->company,
            'position' => $user->position,
            'department' => $user->department,
            'phone' => $user->phone,
            'mobile' => $user->mobile,
            'website' => $user->website,
            'skype' => $user->skype,
            'address' => $user->address,
            'user_id' => $uid
        ];

        $sql = "UPDATE tbl_users SET ";
        $sql .= "email=:email, ";
        $sql .= "name=:name, ";
        $sql .= "company=:company, ";
        $sql .= "position=:position, ";
        $sql .= "department=:department, ";
        $sql .= "phone=:phone, ";
        $sql .= "mobile=:mobile, ";
        $sql .= "website=:website, ";
        $sql .= "skype=:skype, ";
        $sql .= "address=:address ";
        $sql .= "WHERE user_id=:user_id;";

        return $this->connection->prepare($sql)->execute($row);
    }
}