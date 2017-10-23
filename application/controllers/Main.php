<?php
/*
 This is a controller for everything
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Account');
        $this->load->model('AccountType');
        $this->load->model('Transition');
    }

    public function index()
	{
		$this->main();
	}
	public function main(){
        $data['accountTypes'] = $this->AccountType->getAll();
        $data['accounts'] = $this->Account->getAll();
        $data['transitions'] = $this->Transition->getAll();

        $this->load->view('main', $data);
    }
    public  function createAccount(){
        $this->load->helper('form');
	    $formData = $this->input->post();

	    $this->Account->insertAccount();
        redirect('/main');
    }
    public function toSetup(){
        $transition = array(
            'account_id'    =>  $this->input->post('accountId'),
            'from'  =>  'confirmed',
            'to'    =>  'setup',
            'message'=> $this->input->post('message')
        );
        $this->transition($transition, 'setup', 0);
    }
    public function activate(){
        $transition = array(
            'account_id'    =>  $this->input->post('accountId'),
            'from'  =>  'setup',
            'to'    =>  'activated',
            'message'=> $this->input->post('message')
        );
        $this->transition($transition, 'activated', 1);
    }
    public function deactivate($id, $from){
        $this->Account->DeactivateAccount($id);
        $transition = array(
            'account_id'    =>  $id,
            'from'  =>  $from,
            'to'    =>  'deactivated'
        );
        $this->transition($transition, 'deactivated', 0);

    }
    private function transition($transition, $to, $active){
        $this->Account->updateAccountStatus($to, $active);
        $this->Transition->insertTransition($transition);

        redirect($this->uri->uri_string());
    }
}
