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
 * Edit a banner
 *
 * @package   block_fat
 * @copyright Tim Martinez <martinez.time@me.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$id = optional_param('id', 0, PARAM_INT);
$action = optional_param('action', '1', PARAM_INT);

require_login();

$context = \context_system::instance();
require_capability('block/fat:managebanners', $context);


if ($action == 2) {
    //Delete the record
    $DB->delete_records('block_fat_banners', array('id' => $id));
    redirect(new \moodle_url('/blocks/fat/banners.php'));
}

$mform = new \block_fat\forms\banner();

if ($mform->is_cancelled()) {
    redirect(new \moodle_url('/blocks/fat/banners.php'));
} else if ($data = $mform->get_data()) {
    if ($data->id == 0) {
        $DB->insert_record('block_fat_banners', $data);
    } else {
        $DB->update_record('block_fat_banners', $data);
    }
    redirect(new \moodle_url('/blocks/fat/banners.php'));
}

if ($id > 0) {
    $rec = $DB->get_record('block_fat_banners', array('id' => $id));
    $mform->set_data($rec);
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('editbanner', 'block_fat'));
$mform->display();
echo $OUTPUT->footer();