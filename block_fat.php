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
 * FAT block code
 *
 * @package    block_fat
 * @copyright  Tim Martinez <martinez.tim@me.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_fat extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_fat');
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

         $this->content = '';
        
        return $this->content;
    }

    // my moodle can only have SITEID and it's redundant here, so take it away
    public function applicable_formats() {
        return array('all' => false,
                     'site' => false,
                     'site-index' => false,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => false, 
                     'mod-quiz' => false);
    }

    function has_config() {return true;}
    
    public function get_required_javascript() {
        global $DB;
        
        parent::get_required_javascript();
        
        if (!empty($this->config->banner)) {
            if ($rec = $DB->get_record('block_fat_banners', array('id' => $this->config->banner))) {
                $this->page->requires->js_call_amd('block_fat/main', 'init', array($rec->url));
            }
        }
        
        
    }
}
