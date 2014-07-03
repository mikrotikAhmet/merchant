<?php

/*
 * Copyright (C) 2014 ahmet
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * Description of zone
 *
 * @author ahmet
 */
class ModelLocalisationZone extends Model {

    public function getZone($zone_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int) $zone_id . "'");

        return $query->row;
    }

    public function getZones($data = array()) {
        $sql = "SELECT *, z.name, c.name AS country FROM " . DB_PREFIX . "zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id)";

        $sort_data = array(
            'c.name',
            'z.name',
            'z.code'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY c.name";
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

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getZonesByCountryId($country_id) {
        $zone_data = $this->cache->get('zone.' . (int) $country_id);

        if (!$zone_data) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int) $country_id . "' AND status = '1' ORDER BY name");

            $zone_data = $query->rows;

            $this->cache->set('zone.' . (int) $country_id, $zone_data);
        }

        return $zone_data;
    }

    public function getTotalZones() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "zone");

        return $query->row['total'];
    }

    public function getTotalZonesByCountryId($country_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int) $country_id . "'");

        return $query->row['total'];
    }

}
