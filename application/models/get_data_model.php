<?php

/*
 * This is the model to get all type of data from database.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class get_data_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_valid_admin_user($email_or_mobile) {
            $this->db->select('*');
            $this->db->from('admin_details ad');
            $this->db->where(array('ad.admin_name' => $email_or_mobile,'ad.is_activated' => 1));
            $query = $this->db->get();
            return $query->row_array();
    }

    function get_valid_user($email_or_mobile) {
        if (filter_var($email_or_mobile, FILTER_VALIDATE_EMAIL)) {
            $this->db->select('u.username,u.user_id,u.email,u.mobile,u.fullname,u.nickname,u.flag,a.flag activation_flag');
            $this->db->from('users u');
            $this->db->join('activation_log a', 'a.user_id=u.user_id', 'left');
            $this->db->where(array('u.email' => $email_or_mobile));
            $query = $this->db->get();
            return $query->row_array();
        }
        else {
            $this->db->select('u.username,u.user_id,u.email,u.mobile,u.fullname,u.nickname,u.flag,a.flag activation_flag');
            $this->db->from('users u');
            $this->db->join('activation_log a', 'a.user_id=u.user_id', 'left');
            $this->db->where(array('u.mobile' => $email_or_mobile));
            $this->db->where("u.mobile !=", 0 );
            $query = $this->db->get();
            return $query->row_array();            
        }
    }
    function get_apartment_details($apartment_id = 0,$flag = 0, $limit = 20) {
        if(!$apartment_id){
            $this->db->select('*');
            $this->db->from('users ap');
            $this->db->limit($limit,0);
            $this->db->where(array('ap.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($apartment_id) {
            $this->db->select('*');
            $this->db->from('users ap');
            $this->db->where(array('ap.flag' => $flag, 'ap.a_id' => $apartment_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_event_details($event_id = 0,$flag = 0, $limit = 20) {
        if(!$event_id){
            $this->db->select('*');
            $this->db->from('events_meta em');
            $this->db->limit($limit,0);
            $this->db->where(array('em.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($event_id) {
            $this->db->select('*');
            $this->db->from('events_meta em');
            $this->db->where(array('em.flag' => $flag, 'em.event_id' => $event_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_park_details($park_id = 0,$flag = 0, $limit = 20) {
        if(!$park_id){
            $this->db->select('*');
            $this->db->from('business_park bp');
            $this->db->limit($limit,0);
            $this->db->where(array('bp.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($park_id) {
            $this->db->select('*');
            $this->db->from('business_park bp');
            $this->db->where(array('bp.flag' => $flag, 'bp.park_id' => $park_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_mall_details($mall_id = 0,$flag = 0, $limit = 20) {
        if(!$mall_id){
            $this->db->select('*');
            $this->db->from('malls_meta mm');
            $this->db->limit($limit,0);
            $this->db->where(array('mm.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($mall_id) {
            $this->db->select('*');
            $this->db->from('malls_meta mm');
            $this->db->where(array('mm.flag' => $flag, 'mm.mall_id' => $mall_id));
            $query = $this->db->get();
            return $query->row();
        }
    }
    function get_hoardings_details($h_id = 0,$flag = 0, $limit = 20) {
        if(!$h_id){
            $this->db->select('*');
            $this->db->from('hoardings h');
            $this->db->limit($limit,0);
            $this->db->where(array('h.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($h_id) {
            $this->db->select('*');
            $this->db->from('hoardings h');
            $this->db->where(array('h.flag' => $flag, 'h.h_id' => $h_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

    function get_radio_details($radio_id = 0,$flag = 0, $limit = 20) {
        if(!$radio_id){
            $this->db->select('*');
            $this->db->from('radio r');
            $this->db->limit($limit,0);
            $this->db->where(array('r.flag' => $flag));
            $query = $this->db->get();
            return $query->result();
        }
        elseif ($radio_id) {
            $this->db->select('*');
            $this->db->from('radio r');
            $this->db->where(array('r.flag' => $flag, 'r.radio_station_id' => $radio_id));
            $query = $this->db->get();
            return $query->row();
        }
    }

}