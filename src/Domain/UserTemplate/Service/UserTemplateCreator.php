<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 6/10/20
 * Time: 8:28 PM
 */

namespace App\Domain\UserTemplate\Service;


use App\Domain\User\Repository\UserViewerRepository;
use App\Domain\User\Service\UserViewer;
use App\Domain\UserTemplate\Repository\UserTemplateCreatorRepository;
use App\Factory\LoggerFactory;
use Exception;
use http\Exception\InvalidArgumentException;
use DomainException;
use PDO;
use Psr\Log\LoggerInterface;

final class UserTemplateCreator
{
    private $repository;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * UserTemplateCreator constructor.
     *
     * @param UserTemplateCreatorRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(UserTemplateCreatorRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler('usertemplate_creator.log')
            ->createInstance('usertemplate_creator');
    }

    public function createUserTemplate(int $userId, int $templateId)
    {
        try {
            if ($userId < 1 || !is_int($userId)) {
                throw new InvalidArgumentException("User ID must be an integer and not less than 1");
            }

            if ($templateId < 1 || !is_int($templateId)) {
                throw new InvalidArgumentException("Template ID must be an integer and not less than 1");
            }

            // Todo: Should probably check if user exists
//        $user  = new UserViewer(new UserViewerRepository(new PDO()));
//        $userExists = $user->getUserViewData($userId);
//        if (!$this->repository->findUserById($userId)) {
//            throw new DomainException(sprintf('User does not exist: %d', $userId));
//        }

            // Todo: Should probably check if template exists
//        if (!$this->repository->getTemplateById($templateId)) {
//            throw new DomainException(sprintf('Template does not exist: %d', $templateId));
//        }

            // Todo: Check if user already has this template in their saved lists
            if ($this->repository->findUserTemplateByTemplateId($userId, $templateId)) {
                throw new DomainException(sprintf('User already has this template in their saved list'));
            }

            $userTemplateId = $this->repository->insertUserTemplate($userId, $templateId);
            $this->logger->info(
                sprintf('Added a template of id %s to user with id %s list of saved templates: %s',
                $templateId, $userId, $userTemplateId
                )
            );

            return $userTemplateId;
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}