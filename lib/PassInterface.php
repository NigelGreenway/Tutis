<?php
/**
 * Part of the Tutis library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tutis;

use Tutis\Exception\InactivePassException;

/**
 * Interface for a Pass implementation
 *
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
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
     * @param PasswordHandlerInterface  $passwordHandler
     * @param int                       $activeStatus
     *
     * @return mixed
     */
    public static function generate(
        $username,
        PasswordHandlerInterface $passwordHandler,
        $activeStatus = self::ACTIVE
    );

    /**
     * Verify the password matches the given hash and that the pass is active
     *
     * @param string  $username
     * @param string  $password
     * @param string  $hash
     * @param string  $passwordHandlerFQCN
     * @param integer $activeStatus
     * @param array   $options
     *
     * @throws InactivePassException
     *
     * @return self
     */
    public static function authenticate(
        $username,
        $password,
        $hash,
        $passwordHandlerFQCN,
        $activeStatus,
        array $options = []
    );

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
     * Return the username
     *
     * @return string
     */
    public function toUsername();

    /**
     * Get the hashed version of the password
     *
     * @return string
     */
    public function toHash();

    /**
     * Return the current
     *
     * @return int
     */
    public function currentStatus();
}
