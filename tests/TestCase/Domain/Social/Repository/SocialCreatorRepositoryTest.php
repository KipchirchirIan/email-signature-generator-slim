<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 9/10/20
 * Time: 10:49 AM
 */

namespace App\Test\TestCase\Domain\Social\Repository;

use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialCreatorRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialCreatorRepositoryTest extends TestCase
{
    use DatabaseTestTrait;

    /**
     * @var array
     */
    public $fixtures = [
        SocialFixture::class,
    ];

    /**
     * Create instance
     *
     * @return SocialCreatorRepository The instance
     */
    protected function createInstance(): SocialCreatorRepository
    {
        return $this->container->get(SocialCreatorRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInsertSocial(): void
    {
        $repository = $this->createInstance();

        $social = new SocialCreatorData(
            [
                'social_name' => 'Twitter',
                'social_link' => 'https://www.twitter.com',
                'profile_link' => 'https://www.twitter.com',
                'social_description' => 'Twitter is know for the 140-character limit',
            ]
        );

        $actual = $repository->insertSocial($social);

        self::assertSame(3, $actual);
    }
}
