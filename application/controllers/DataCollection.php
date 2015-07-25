<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DataCollection extends CI_Controller {
    function index(){
        $this->load->model("data_collection_model");
        $data['title']="Dealer Pricings";
       // $this->load->view('include/header',$data);
        $this->load->view('Dealer',$data);
        
    }
    function insertdata(){
        $this->load->model("data_collection_model");
        $dealerName = $this->input->get('dealerName',true);
        $description = $this->input->get('description',true);
        $pincode = $this->input->get('pincode',true);
        $location = $this->input->get('location',true);
        $data['location'] =$location;
        $this->load->view('Dealer',$data);
        $this->data_collection_model->dealer_post($dealerName,$description,$pincode,$Location);
    }
}
?>
