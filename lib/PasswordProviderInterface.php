<?php

namespace Tutis;

/**
 * Interface for a password provider
 * 
 * @package Tutis
 * @author  Nigel Greenway <nigel_greenway@me.com>
 */
interface PasswordProviderInterface
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
     * Verifies if the password
     *
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public static function verify($password, $hash);

    /**
     * Get the hashed password
     * 
     * @return string
     */
    public function getHash();
}