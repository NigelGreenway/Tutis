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
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
final class InvalidPasswordException extends Exception
{
    /** Class Constructor */
    public function __construct()
    {
        parent::__construct('An invalid password as been given');
    }
}
