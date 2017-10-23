<?php
/**
 * Created by PhpStorm.
 * User: Mafi
 * Date: 10/21/2017
 * Time: 2:49 PM
 */

class Account extends CI_Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $account_type_id;

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('account_types_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.account_type_id = account_types_tbl.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function insertAccount()
    {
        $this->first_name    = $this->input->post('firstName');
        $this->last_name  = $this->input->post('lastName');
        $this->email     = $this->input->post('email');
        $this->account_type_id     = $this->input->post('accountTypeId');

        $this->db->insert('accounts_tbl', $this);
    }
    public function updateAccountStatus($place, $active){
        $this->db->update('accounts_tbl', array('place'=>$place, 'active'=>$active), array('id'=>$this->input->post('accountId')));
    }
    public function DeactivateAccount($id){
        $this->db->update('accounts_tbl', array('place'=>'deactivated'), array('id'=>$id));
    }
}