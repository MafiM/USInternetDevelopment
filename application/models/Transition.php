<?php
/**
 * Created by PhpStorm.
 * User: Mafi
 * Date: 10/21/2017
 * Time: 4:32 PM
 */

class Transition extends CI_Model
{
    public $account_id;
    public $from;
    public $to;
    public $timestamp;
    public $message;

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('transitions_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.id = transitions_tbl.account_id', 'left');
        $this->db->order_by('transitions_tbl.timestamp', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function insertTransition($transition)
    {
        $this->db->insert('transitions_tbl', $transition);
    }
}