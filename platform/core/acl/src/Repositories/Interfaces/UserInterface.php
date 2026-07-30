<?php

namespace Obii\ACL\Repositories\Interfaces;

use Obii\Support\Repositories\Interfaces\RepositoryInterface;

interface UserInterface extends RepositoryInterface
{

    /**
     * Get unique username from email
     *
     * @param $email
     * @return string
     *
     */
    public function getUniqueUsernameFromEmail($email);
}
