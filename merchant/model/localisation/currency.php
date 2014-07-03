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
 * Description of currency
 *
 * @author ahmet
 */
class ModelLocalisationCurrency extends Model {

    public function getCurrency($currency_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "currency WHERE currency_id = '" . (int) $currency_id . "'");

        return $query->row;
    }

    public function getCurrencyByCode($currency) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "currency WHERE code = '" . $this->db->escape($currency) . "'");

        return $query->row;
    }

    public function getCurrencies($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "currency";

            $sort_data = array(
                'title',
                'code',
                'value',
                'date_modified'
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

                $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $currency_data = $this->cache->get('currency');

            if (!$currency_data) {
                $currency_data = array();

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency ORDER BY title ASC");

                foreach ($query->rows as $result) {
                    $currency_data[$result['code']] = array(
                        'currency_id' => $result['currency_id'],
                        'title' => $result['title'],
                        'code' => $result['code'],
                        'symbol_left' => $result['symbol_left'],
                        'symbol_right' => $result['symbol_right'],
                        'decimal_place' => $result['decimal_place'],
                        'value' => $result['value'],
                        'status' => $result['status'],
                        'date_modified' => $result['date_modified']
                    );
                }

                $this->cache->set('currency', $currency_data);
            }

            return $currency_data;
        }
    }

    public function updateCurrencies($force = false) {
        if (extension_loaded('curl')) {
            $data = array();

            if ($force) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "'");
            } else {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "' AND date_modified < '" . $this->db->escape(date('Y-m-d H:i:s', strtotime('-1 day'))) . "'");
            }

            foreach ($query->rows as $result) {
                $data[] = $this->config->get('config_currency') . $result['code'] . '=X';
            }

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data) . '&f=sl1&e=.csv');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);

            $content = curl_exec($curl);

            curl_close($curl);

            $lines = explode("\n", trim($content));

            foreach ($lines as $line) {
                $currency = utf8_substr($line, 4, 3);
                $value = utf8_substr($line, 11, 6);

                if ((float) $value) {
                    $this->db->query("UPDATE " . DB_PREFIX . "currency SET value = '" . (float) $value . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($currency) . "'");
                }
            }

            $this->db->query("UPDATE " . DB_PREFIX . "currency SET value = '1.00000', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($this->config->get('config_currency')) . "'");

            $this->cache->delete('currency');
        }
    }

    public function getTotalCurrencies() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "currency");

        return $query->row['total'];
    }

}
