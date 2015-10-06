<?php

namespace Tutis;

use Tutis\Exception\InactivePassException;
use Tutis\Provider\BasicPasswordProvider;

final class Pass implements PassInterface
{
    private $username;
    private $password;
    private $activeState;

    private function __construct(
        $username,
        PasswordProviderInterface $passwordProvider,
        $activeState = self::ACTIVE
    ) {
        $this->username    = $username;
        $this->password    = $passwordProvider->getHash();
        $this->activeState = $activeState;
    }

    public static function generate(
                                  $username,
        PasswordProviderInterface $passwordProvider,
                                  $activeStatus = self::ACTIVE
    ) {
        return new self(
            $username,
            $passwordProvider,
            $activeStatus
        );
    }

    public static function authenticate($username, $password, $hash, $passwordProviderFQCN, $activeStatus)
    {
        $passwordProviderFQCN::verify($password, $hash);

        if ($activeStatus === self::INACTIVE) {
            throw new InactivePassException;
        }
        return new self(
            $username,
            BasicPasswordProvider::hash($password),
            $activeStatus
        );
    }

    public function deactivate()
    {
        $this->activeState = self::INACTIVE;
    }

    public function isActive()
    {
        return $this->activeState === self::ACTIVE;
    }

    public function toUsername()
    {
        return $this->username;
    }

    public function toPassword()
    {
        return $this->password;
    }

    public function getActiveStatus()
    {
        return $this->activeState;
    }
}
