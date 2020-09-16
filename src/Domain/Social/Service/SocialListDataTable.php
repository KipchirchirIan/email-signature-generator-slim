<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/20/20
 * Time: 2:54 AM
 */

namespace App\Domain\Social\Service;


use App\Domain\Social\Repository\SocialViewerRepository;

final class SocialListDataTable
{
    /**
     * @var SocialViewerRepository
     */
    private $repository;

    /**
     * SocialListDataTable constructor.
     *
     * @param SocialViewerRepository $repository The repository
     */
    public function __construct(SocialViewerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List all social media platforms
     *
     * @return array A list of social media platforms
     */
    public function listAllSocials(): array
    {
        return $this->repository->findAllSocials();
    }
}