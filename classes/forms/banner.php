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
 * Form definitions for Banners
 *
 * @package   block_fat
 * @copyright Tim Martinez <martinez.time@me.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_fat\forms;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * Form definitions for Banners
 *
 * @author Tim Martinez <martinez.time@me.com>
 */
class banner extends \moodleform {
    /**
     * Form definition method
     */
    public function definition() {
        $mform = $this->_form;
        
        $attributes = array('size' => '254');
        
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);
        
        $mform->addElement('text', 'name', get_string('bannername', 'block_fat'),$attributes);
        $mform->setType('name', PARAM_TEXT);
        
        $mform->addElement('text', 'url', get_string('url', 'block_fat'), $attributes);
        $mform->setType('url', PARAM_URL);
        
        $this->add_action_buttons();
    }
}
