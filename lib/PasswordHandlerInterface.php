<?php

namespace Tutis;

/**
 * Interface for a password handler
 *
 * @package Tutis
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
interface PasswordHandlerInterface
{
    /**
     * Generate the hash from the raw password
     *
     * @param string $password
     * @param array  $options
     *
     * @return self
     */
    public static function hash($password, array $options = []);

    /**
     * Verifies if the password matches
     *
     * @param string $password
     * @param string $hash
     * @param array  $options
     *
     * @throw InvalidPasswordException
     *
     * @return bool
     */
    public static function verify($password, $hash, array $options = []);

    /**
     * Get the hashed password
     *
     * @return string
     */
    public function getHash();
}
