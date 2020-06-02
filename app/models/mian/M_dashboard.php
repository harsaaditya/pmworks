<?php
class M_dashboard extends CI_Model
{

  function get_stat()
  {
    $this->db->select('date');
    $this->db->select('SUM(hits) AS total_hit');
    $this->db->select('COUNT(ip) AS total_ip');
    $this->db->group_by("date");
    $this->db->order_by("date", "asc");
    $this->db->limit(30);
    $result = $this->db->get('statistics');
    return $result;
  }
}
