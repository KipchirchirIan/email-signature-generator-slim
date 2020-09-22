<?php

namespace App\Test\TestCase\Domain\Social\Service;

use App\Domain\Social\Data\SocialCreatorData;
use App\Domain\Social\Repository\SocialCreatorRepository;
use App\Domain\Social\Service\SocialCreator;
use App\Test\TestCase\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SocialCreatorTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test
     *
     * @return void
     */
    public function testCreateSocial(): void
    {
        // Mock the required repository
        $this->mock(SocialCreatorRepository::class)
            ->method('insertSocial')
            ->willReturn(1);

        $service = $this->container->get(SocialCreator::class);

        $socialData = new SocialCreatorData(
            [
                'social_name' => 'Twitter',
                'social_link' => 'https://www.twitter.com',
                'profile_link' => 'https://www.twitter.com',
                'social_description' => 'Twitter is know for the 140-character limit',
            ]
        );

        $actual = $service->createSocial($socialData);

        $this->assertSame(1, $actual);
    }
}
