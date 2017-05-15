<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class save_update_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function save_user_details($user_array) {
        $query = $this->db->get_where('users', array('mobile' => $user_array['mobile']));
          if($query->num_rows >= 1){
            $user_query = $this->db->get_where('users', array('mobile' => $user_array['mobile']));
            $user_id = $user_query->row('user_id');
            return  $user_id;
        }
        else {
          $this->db->insert('users', $user_array);
          return $this->db->insert_id();
         }
    }
    /* *****************************
    ***       Save functions     ***
    */
    function save_apartment($input_array) {
    	$this->db->insert('appartments', $input_array);
      return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    function save_park($input_array) {
        $this->db->insert('business_park', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_event($input_array) {
        $this->db->insert('events_meta', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_malls($input_array) {
        $this->db->insert('malls_meta', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_radio($input_array) {
        $this->db->insert('radio', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    function save_ads_category_details($input_array) {
        $this->db->insert('ads_category', $input_array);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

    }
    /* *****************************
    ***Save functions Ends here  ***
    */

    /* *****************************
    ***       Update functions   ***
    */
    function update_apartment($input_array) {
      $this->db->where('a_id',$input_array['a_id']);
      $query = $this->db->update('appartments', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_events($input_array) {
      $this->db->where('event_id',$input_array['event_id']);
      $query = $this->db->update('events_meta', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_parks($input_array) {
      $this->db->where('park_id',$input_array['park_id']);
      $query = $this->db->update('business_park', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_mall($input_array) {
      $this->db->where('mall_id',$input_array['mall_id']);
      $query = $this->db->update('malls_meta', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_hoardings($input_array) {
      $this->db->where('h_id',$input_array['h_id']);
      $query = $this->db->update('hoardings', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }
    function update_radio($input_array) {
      $this->db->where('radio_station_id',$input_array['radio_station_id']);
      $query = $this->db->update('radio', $input_array);
      return ($query) ? true : false ;
      // or return updated_id instead of true.
    }

    /* *****************************
    ***Update functions Ends here  ***
    */
    
  }