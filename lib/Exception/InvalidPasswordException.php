<?php
/**
 * Part of the Tutis library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tutis\Exception;

use Exception;

/**
 * Invalid password exception
 *
 * @package Tutis\Exception
 * @author  Nigel Greenway <nigel_greenway@me.com>
 */
final class InvalidPasswordException extends Exception
{
    public function __construct()
    {
        return parent::__construct('An invalid password as been given');
    }
}