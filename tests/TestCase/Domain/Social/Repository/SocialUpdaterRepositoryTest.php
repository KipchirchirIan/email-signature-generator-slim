<?php

namespace App\Test\TestCase\Domain\Social\Repository;

use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialUpdaterRepository;
use App\Test\Fixture\SocialFixture;
use App\Test\TestCase\DatabaseTestTrait;
use PHPUnit\Framework\TestCase;

class SocialUpdaterRepositoryTest extends TestCase
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
     * @return SocialUpdaterRepository The instance
     */
    protected function createInstance(): SocialUpdaterRepository
    {
        return $this->container->get(SocialUpdaterRepository::class);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testUpdateSocialById()
    {
        $repository = $this->createInstance();

        $social = new SocialCreatorData(
            [
                'social_name' => 'Facebook',
                'social_link' => 'https://web.facebook.com/',
                'profile_link' => 'https://web.facebook.com/',
                'social_description' => 'World\'s largest social networking site',
            ]
        );

        $actual = $repository->updateSocialById($social, 1);

//        $this->assertSame(false, $actual);
        $this->assertTrue($actual);
    }
}
