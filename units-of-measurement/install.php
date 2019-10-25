<?php
$query = $this->db->query("SELECT 1 from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = '". DB_PREFIX."product' and COLUMN_NAME = 'unit_id'");

if (!$query->num_rows) {
	$this->db->query("ALTER TABLE `". DB_PREFIX. "product` ADD  `unit_id` INT( 11 ) NOT NULL AFTER  `date_available`");
}
?>