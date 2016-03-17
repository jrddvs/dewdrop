<?php

/**
 * Dewdrop
 *
 * @link      https://github.com/DeltaSystems/dewdrop
 * @copyright Delta Systems (http://deltasys.com)
 * @license   https://github.com/DeltaSystems/dewdrop/LICENSE
 */

namespace Dewdrop\Filter;

use Zend\Filter\AbstractFilter;

/**
 * A filter to take anything that can be parsed by GNU Date (via strtotime())
 * and convert it to an ISO-formatted timestamp that can be used for date values
 * in a DB, etc.
 */
class IsoTimestamp extends AbstractFilter
{
    /**
     * Filter the supplied input string to an ISO date.
     *
     * @param string $value
     * @return null|string
     */
    public function filter($value)
    {
        if (null === $value || '' === $value) {
            $out = null;
        } else {
            $gmtOffset = 0;

            // Reverse WordPress GMT offset when filtering date input
            if (function_exists('get_option')) {
                $gmtOffset = get_option('gmt_offset');
            }

            $out = date('Y-m-d H:i:s', strtotime($value) + ($gmtOffset * -1 * 3600));
        }

        return $out;
    }
}
