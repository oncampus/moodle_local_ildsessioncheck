<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External Web Service Template
 *
 * @package     local_ildsessioncheck
 * @copyright   2018 Eugen Ebel, ILD, Technische Hochschule Lübeck, <eugen.ebel@th-luebeck.de>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . "/externallib.php");

class local_ildsessioncheck_external extends external_api
{
    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function check_session_parameters() {
        return new external_function_parameters(array());
    }

    /**
     * Returns status
     * @return array user data
     */
    public static function check_session() {
        self::validate_parameters(self::check_session_parameters(),
            array());

        if (isloggedin()) {
            $status = 1;
        } else {
            $status = 0;
        }

        $response = array(
            'status' => $status
        );

        return $response;
    }

    /**
     * Returns description of method result value
     * @return external_single_structure
     */
    public static function check_session_returns() {
        $keys = [
            'status' => new \external_value(PARAM_TEXT, 'Logging status', VALUE_REQUIRED)
        ];

        return new \external_single_structure($keys, 'check session status');
    }
}

