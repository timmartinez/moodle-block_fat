<?php

class block_fat_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $DB;
        
        $bannerlist = $DB->get_records_select_menu('block_fat_banners', null, null, 'name', 'id, name');
        
        $mform->addElement('select', 'config_banner', get_string('bannername', 'block_fat'), $bannerlist);
    }
}
