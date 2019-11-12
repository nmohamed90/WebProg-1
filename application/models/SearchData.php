<?php

class SearchData extends CI_Model {
    function getStates(){
        $query = $this->db->query("select distinct state, statefull from fakenames order by statefull");
        return $query->result();
    }
    
    function getUsers($state, $gender) {
        $query = $this->db->query("select * from fakenames where state = '" . $state . "' and gender = '" . $gender . "' order by surname, givenname");
        return $query->result();
    }
    
    function getUsersLastName($id){
        $query = $this->db->query("select surname from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersFirstName($id){
        $query = $this->db->query("select givenname from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersAddress($id){
        $query = $this->db->query("select streetaddress from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersCity($id) {
        $query = $this->db->query("select city from fakenames where number = '" .$id ."'");
        return $query->result();
    }
        
    function getUsersState($id) {
        $query = $this->db->query("select state from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersZip($id) {
        $query = $this->db->query("select zipcode from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersPhone($id) {
        $query = $this->db->query("select telephonenumber from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersGender($id) {
         $query = $this->db->query("select gender from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersAge($id) {
        $query = $this->db->query("select age from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersOccupation($id) {
        $query = $this->db->query("select occupation from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersCompany($id) {
        $query = $this->db->query("select company from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersEmail($id) {
        $query = $this->db->query("select emailaddress from fakenames where number = '" .$id ."'");
        return $query->result();
    }
    
    function getUsersBirthdate($id) {
        $query = $this->db->query("select birthday from fakenames where number = '" .$id ."'");
        return $query->result();
    }
          
    function updateUsersRecord($id) {
        $query = $this->db->query("UPDATE fakenames set surname ='" .$_POST['update_lastname']."', givenname='". $_POST['update_firstname']. 
              "', streetaddress='".$_POST['update_address']."', city='".$_POST['update_city']."', state='".$_POST['update_state'].
              "', zipcode ='". $_POST['update_zip']."', telephonenumber='".$_POST['update_phone']."', gender='".
              $_POST['update_gender']."', age='".$_POST['update_age']."', occupation='".$_POST['update_occupation']."', company='".
              $_POST['update_company']."', emailaddress='".$_POST['update_emailaddress']."', birthday='".$_POST['update_birthdate']."'".
              " WHERE number = '" . $id ."'");
    }
    
    function getDetails($id){
        $query = $this->db->query("select * from fakenames where number = '" . $id . "'");
        return $query->result();
    }
    
}

?>