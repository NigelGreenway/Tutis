<?php

namespace Tutis\Provider;

use Tutis\Exception\InvalidPasswordException;
use Tutis\PasswordProviderInterface;

/**
 * A basic password provider
 *
 * @package Tutis
 * @author  Nigel Greenway <nigel_greenway@me.com>
 */
class BasicPasswordProvider implements PasswordProviderInterface
{
    /** @var string */
    private $hash;

    /**
     * Object constructor
     *
     * @param string $hash The hashed password
     */
    private function __construct($hash)
    {
        $this->hash = $hash;
    }

    /** {@inheritDoc} */
    public static function hash($password, array $options = [])
    {
        $hash = password_hash($password, PASSWORD_DEFAULT, $options);

        return new self($hash);
    }

    /** {@inheritDoc} */
    public static function verify($password, $hash)
    {
        if (password_verify($password, $hash) === false) {
            throw new InvalidPasswordException;
        }

        return true;
    }

    /** {@inheritDoc} */
    public function getHash()
    {
        return $this->hash;
    }
}
