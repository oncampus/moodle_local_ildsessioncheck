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
 * Web service local plugin template external functions and service definitions.
 *
 * @package     local_ildsessioncheck
 * @copyright   2018 Eugen Ebel, ILD, Technische Hochschule Lübeck, <eugen.ebel@th-luebeck.de>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

defined('MOODLE_INTERNAL') || die;

// We defined the web service functions to install.
$functions = array(
    'local_ildsessioncheck_check_session' => array(
        'classname' => 'local_ildsessioncheck_external',
        'methodname' => 'check_session',
        'classpath' => 'local/ildsessioncheck/externallib.php',
        'description' => 'Check session, specialy for SCORM',
        'type' => 'read',
        'ajax' => true,
        'loginrequired' => false
    ),
);
// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
    'ildsessioncheck_check_session' => array(
        'functions' => array('local_ildsessioncheck_check_session'),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);