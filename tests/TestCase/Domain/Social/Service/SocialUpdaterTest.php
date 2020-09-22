<?php

namespace App\Test\TestCase\Domain\Social\Service;

use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialUpdaterRepository;
use App\Domain\Social\Service\SocialUpdater;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SocialUpdaterTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test
     *
     * @return void
     */
    public function testEditSocial(): void
    {
        // Mock the required repository
        $this->mock(SocialUpdaterRepository::class)
            ->method('updateSocialById')
            ->willReturn(true);

        $service = $this->container->get(SocialUpdater::class);

        $socialData = new SocialCreatorData(
            [
                'social_name' => 'Facebook',
                'social_link' => 'https://www.facebook.com',
                'profile_link' => 'https://www.facebook.com/',
                'social_description' => 'FB',
            ]
        );

        $actual = $service->editSocial($socialData, 1);

        $this->assertTrue($actual);
    }
}
