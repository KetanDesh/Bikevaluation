<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Data_collection_model extends CI_Model{
    function dealer_post($dealerName,$description,$pincode,$Location){
        echo "Dealer".$dealerName;
        $data = array('dealer'=>$dealerName,'description'=>$description,'pincode'=>$pincode,'location'=>$location);
        $this->db->insert('DealerDetails',$data);
    }
}
?>
