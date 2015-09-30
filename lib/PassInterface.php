<?php

namespace Tutis;

use Tutis\Exception\InactivePassException;

interface PassInterface
{
    /** @const INACTIVE Mark the pass as inactive */
    const INACTIVE = 0;
    /** @const ACTIVE   Mark the pass as active */
    const ACTIVE   = 1;

    /**
     * Generate a pass
     *
     * @param string                    $username
     * @param PasswordProviderInterface $passwordProvider
     * @param int                       $activeStatus
     *
     * @return mixed
     */
    public static function generate(
                                  $username,
        PasswordProviderInterface $passwordProvider,
                                  $activeStatus = self::ACTIVE
    );

    /**
     * Verify the password matches the given hash and that the pass is active
     *
     * @param $username
     * @param $password
     * @param $hash
     * @param $passwordProviderFQCN
     * @param $activeStatus
     *
     * @throws InactivePassException
     *
     * @return self
     */
    public static function authenticate($username, $password, $hash, $passwordProviderFQCN, $activeStatus);

    /**
     * Set the active status to inactive/0
     *
     * @return void
     */
    public function deactivate();

    /**
     * Check if the current pass is active
     *
     * @return bool
     */
    public function isActive();

    /**
     * Get the hashed version of the password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Get the active status of the pass
     *
     * @return int
     */
    public function getActiveStatus();
}