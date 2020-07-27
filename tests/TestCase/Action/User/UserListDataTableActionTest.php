<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/24/20
 * Time: 9:27 AM
 */

namespace App\Test\TestCase\Action\User;


use App\Domain\User\Repository\UserListDataTableRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class UserListDataTableActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * @dataProvider provideUserListDataTableAction
     *
     * @param array $users List of users
     * @param array $expected Expected results
     */
    public function testAction(array $users, array $expected)
    {
        $this->mock(UserListDataTableRepository::class)
            ->method('getTableData')->willReturn($users);

        $request = $this->createRequest('GET', 'v1/users');

        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame(200, $response->getStatusCode());
    }

    public function provideUserListDataTableAction()
    {
        $user = [
            [
                'user_id' => 1,
                'name' => 'Jane Doe',
                'company' => 'Jane Doe LLC',
                'position' => 'Sales Representative',
                'department' => 'Sales & Marketing',
                'phone' => '0711000111',
                'mobile' => '0711000111',
                'website' => 'www.janedoeonline.com',
                'skype' => 'janedoe',
                'email' => 'janedoe@janedoeonline.com',
                'password' => '1234',
                'address' => 'Palm Beach Ave.',
                'created_at' => '2020-04-29 11:18:08',
                'updated_at' => '2020-04-29 11:18:08'
            ],
            [
                'user_id' => 2,
                'name' => 'John Doe',
                'company' => 'John Doe LLC',
                'position' => 'Sales Manager',
                'department' => 'Sales & Marketing',
                'phone' => '0711000111',
                'mobile' => '0711000111',
                'website' => 'www.johndoeonline.com',
                'skype' => 'johndoe',
                'email' => 'johndoe@johndoeonline.com',
                'password' => '1234',
                'address' => 'Em Street',
                'created_at' => '2020-04-29 11:18:08',
                'updated_at' => '2020-04-29 11:18:08'
            ]
        ];

        return [
            'users' => [
                $user,
                [
                    [
                        'user_id' => 1,
                        'name' => 'Jane Doe',
                        'company' => 'Jane Doe LLC',
                        'position' => 'Sales Representative',
                        'department' => 'Sales & Marketing',
                        'phone' => '0711000111',
                        'mobile' => '0711000111',
                        'website' => 'www.janedoeonline.com',
                        'skype' => 'janedoe',
                        'email' => 'janedoe@janedoeonline.com',
                        'password' => '1234',
                        'address' => 'Palm Beach Ave.',
                        'created_at' => '2020-04-29 11:18:08',
                        'updated_at' => '2020-04-29 11:18:08'
                    ],
                    [
                        'user_id' => 2,
                        'name' => 'John Doe',
                        'company' => 'John Doe LLC',
                        'position' => 'Sales Manager',
                        'department' => 'Sales & Marketing',
                        'phone' => '0711000111',
                        'mobile' => '0711000111',
                        'website' => 'www.johndoeonline.com',
                        'skype' => 'johndoe',
                        'email' => 'johndoe@johndoeonline.com',
                        'password' => '1234',
                        'address' => 'Em Street',
                        'created_at' => '2020-04-29 11:18:08',
                        'updated_at' => '2020-04-29 11:18:08'
                    ]
                ]
            ]
        ];
    }
}