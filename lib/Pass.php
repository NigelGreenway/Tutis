<?php
/**
 * Part of the Tutis library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tutis;

use Tutis\Exception\InactivePassException;
use Tutis\Handler\BasicPasswordHandler;

/**
 * The user Pass for authentication usage
 *
 * @package Tutis
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
final class Pass implements PassInterface
{
    /** @var string */
    private $username;
    /** @var string */
    private $password;
    /** @var integer */
    private $activeState;

    /**
     * Class constructor
     *
     * @param string                    $username
     * @param PasswordHandlerInterface  $passwordHandler
     * @param int                       $activeState
     */
    private function __construct(
        $username,
        PasswordHandlerInterface $passwordHandler,
        $activeState = self::ACTIVE
    ) {
        $this->username    = $username;
        $this->password    = $passwordHandler->getHash();
        $this->activeState = $activeState;
    }

    /** {@inheritDoc} */
    public static function generate(
        $username,
        PasswordHandlerInterface $passwordHandler,
        $activeStatus = self::ACTIVE
    ) {
        return new self(
            $username,
            $passwordHandler,
            $activeStatus
        );
    }

    /** {@inheritDoc} */
    public static function authenticate(
              $username,
              $password,
              $hash,
              $passwordHandlerFQCN,
              $activeStatus,
        array $options = []
    ) {
        $passwordHandlerFQCN::verify($password, $hash, $options);

        if ($activeStatus === self::INACTIVE) {
            throw new InactivePassException;
        }

        return new self(
            $username,
            BasicPasswordHandler::hash($password),
            $activeStatus
        );
    }

    /** {@inheritDoc} */
    public function deactivate()
    {
        $this->activeState = self::INACTIVE;
    }

    /** {@inheritDoc} */
    public function toUsername()
    {
        return $this->username;
    }

    /** {@inheritDoc} */
    public function toPassword()
    {
        return $this->password;
    }

    /** {@inheritDoc} */
    public function currentStatus()
    {
        return $this->activeState;
    }

    /** {@inheritDoc} */
    public function isActive()
    {
        return $this->activeState === self::ACTIVE;
    }
}
