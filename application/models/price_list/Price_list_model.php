<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Price_list_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get data for parameter list
     * public
     * @return mixed
     */
    public function get_list_data()
    {
        $query = $this->db->SELECT("groups.name AS groups,
	                                parameters.name AS parameter,
	                                parameters_types.unit,
	                                parameters_types_value.price")
                          ->FROM("parameters")
                          ->JOIN("groups_parameters", "parameters.id = groups_parameters.id_parameter")
                          ->JOIN("groups", "groups.id = groups_parameters.id_group")
                          ->JOIN("parameters_types", "parameters.id_parameters_types = parameters_types.id")
                          ->JOIN("parameters_types_value", "parameters_types_value.id = parameters_types.id")
                          ->ORDER_BY("groups.name")
                          ->get();
        return $query->num_rows() == TRUE
            ? $query->result()
            : FALSE;
    }

    public function get_exchange_rates()
    {

    }
}