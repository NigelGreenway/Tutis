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
 * Inactive Pass exception
 *
 * @author  Nigel Greenway <github@futurepixels.co.uk>
 */
final class InactivePassException extends Exception
{
    /** Class constructor */
    public function __construct()
    {
        parent::__construct('Inactive Pass');
    }
}
