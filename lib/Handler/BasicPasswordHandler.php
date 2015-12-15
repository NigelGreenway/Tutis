<?php
/**
 * Part of the Tutis library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tutis\Handler;

use Tutis\Exception\InvalidPasswordException;
use Tutis\PasswordHandlerInterface;

/**
 * A basic password handler
 *
 * @package Tutis
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
class BasicPasswordHandler implements PasswordHandlerInterface
{
    /** @var string */
    private $hash;

    /**
     * Class constructor
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
    public static function verify($password, $hash, array $options = [])
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
