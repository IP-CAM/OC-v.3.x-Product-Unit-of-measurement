<?php

class ModelCatalogUnit extends Model
{
    public function addUnit($data)
    {

        $this->db->query("INSERT INTO " . DB_PREFIX . "unit SET code = '" . (int)($data['code']) . "', title = '" . $this->db->escape($data['title']) . "', symbol_rus = '" . $this->db->escape($data['symbol_rus']) . "', symbol_ukr = '" . $this->db->escape($data['symbol_ukr']) . "', symbol_intl = '" . $this->db->escape($data['symbol_intl']) . "', symbol_letter_intl = '" . $this->db->escape($data['symbol_letter_intl']) . "'");

        $unit_id = $this->db->getLastId();

        $this->cache->delete('unit');

        return $unit_id;
    }

    public function editUnit($unit_id, $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "unit SET code = '" . (int)$data['code'] . "', title = '" . $this->db->escape($data['title']) . "', symbol_rus = '" . $this->db->escape($data['symbol_rus']) . "', symbol_ukr = '" . $this->db->escape($data['symbol_ukr']) . "', symbol_intl = '" . $this->db->escape($data['symbol_intl']) . "', symbol_letter_intl = '" . $this->db->escape($data['symbol_letter_intl']) . "' WHERE unit_id = '" . (int)$unit_id . "'");

        $this->cache->delete('unit');
    }

    public function deleteUnit($unit_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "unit WHERE unit_id = '" . (int)$unit_id . "'");

        $this->cache->delete('unit');
    }

    public function getUnits($data = array())
    {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "unit";
            $sort_data = array(
                'unit_id',
                'code',
                'title',
                'sort_symbol_rus',
                'sort_symbol_ukr',
                'sort_symbol_intl'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY title";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $unit_data = $this->cache->get('unit');

            if (!$unit_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "unit ORDER BY title ASC");

                $unit_data = $query->rows;

                $this->cache->set('unit', $unit_data);
            }

            return $unit_data;
        }
    }

    public function getUnit($unit_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "unit WHERE unit_id = '" . (int)$unit_id . "'");

        return $query->row;
    }

    public function getTotalUnits()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "unit");

        return $query->row['total'];
    }
}