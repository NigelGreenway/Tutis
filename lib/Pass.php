<?php
/**
 * Part of the Tutis library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tutis;

use Tutis\Exception\InactivePassException;
use Tutis\Provider\BasicPasswordProvider;

/**
 * The user Pass for authentication usage
 *
 * @package Tutis
 * @author  Nigel Greenway <nigel_greenway@me.com>
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
     * @param PasswordProviderInterface $passwordProvider
     * @param int                       $activeState
     */
    private function __construct(
        $username,
        PasswordProviderInterface $passwordProvider,
        $activeState = self::ACTIVE
    ) {
        $this->username    = $username;
        $this->password    = $passwordProvider->getHash();
        $this->activeState = $activeState;
    }

    /** {@inheritDoc} */
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

    /** {@inheritDoc} */
    public static function authenticate(
              $username,
              $password,
              $hash,
              $passwordProviderFQCN,
              $activeStatus,
        array $options = []
    ) {
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

    /** {@inheritDoc} */
    public function deactivate()
    {
        $this->activeState = self::INACTIVE;
    }

    /** {@inheritDoc} */
    public function isActive()
    {
        return $this->activeState === self::ACTIVE;
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
}
