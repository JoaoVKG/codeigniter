<?php

class Area_Model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function getAreas() {
    $query = $this->db->get('area');
    return $query->result_array();
  }

  public function getAreaByCodigo($codigo) {
    $this->db->where("CODIGO_AREA_CONHECIMENTO", $codigo);
    $query = $this->db->get("area")->row_array();
    return $query;
  }

}
