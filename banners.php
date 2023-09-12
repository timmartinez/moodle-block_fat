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
 * Manage Banner definitions
 *
 * @package   block_fat
 * @copyright    Tim Martinez <martinez.tim@me.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$table = new \html_table();
$table->id = 'block_fat_banners';
$table->head = array(
    get_string('bannername', 'block_fat'),
    get_string('url', 'block_fat'),
    get_string('edit')
    );

$records = $DB->get_records('block_fat_banners', null, 'name');

foreach($records as $record) {
    $row = new \html_table_row();
    $cells = array($record->name,$record->url);
    
    $actions = array();
    $url = new \moodle_url('/blocks/fat/banneredit.php', array('id' => $record->id, 'action' => '2'));
    $actions[] = \html_writer::link($url, $OUTPUT->pix_icon('t/delete', get_string('delete')));
    $url = new \moodle_url('/blocks/fat/banneredit.php', array('id' => $record->id));
    $actions[] = \html_writer::link($url, $OUTPUT->pix_icon('t/edit', get_string('edit')));
    $cells[] = join(' ', $actions);
    
    $row->cells = $cells;
    
    $table->data[] = $row;
}

$tablehtml = \html_writer::table($table);

$add_button = new \single_button(
        new \moodle_url('/blocks/fat/banneredit.php'), 
        get_string('add'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('managebanners', 'block_fat'));
echo $OUTPUT->render($add_button);
echo $tablehtml;
echo $OUTPUT->footer();