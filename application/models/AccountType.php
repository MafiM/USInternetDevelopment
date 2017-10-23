<?php
/**
 * Created by PhpStorm.
 * User: Mafi
 * Date: 10/21/2017
 * Time: 2:49 PM
 */

class AccountType extends CI_Model
{
    public $account_type;
    public $description;
    public $cost;

    public function getAll()
    {
        $query = $this->db->get('account_types_tbl');
        return $query->result();
    }
}