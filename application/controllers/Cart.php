<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct() {
     parent::__construct();
		 if(isset($_SESSION['firstName'])){
 			if(!isset($_SESSION['role'])){
 				redirect('Member/ChooseRole');
 			}else{
				if($_SESSION['role']!='recipient'){
					redirect('');
				}
			}
 		}else{
 			redirect('');
 		}
     $this->load->model('cartModel');
   }

	public function index(){
		$data['title'] = "Cart";
		$this->load->view('template/header',$data);
		$this->load->view('cart',$data);
		$this->load->view('template/footer');
	}

	public function getItemListInCart_Dropdown(){
		$inCart = $this->cartModel->getCartList($_SESSION['idNum']);

		//Check if thereare items in cart
		if(is_array($inCart)){
			$itemAmount = count($inCart);
			echo $itemAmount;
			echo '<br>';
			foreach($inCart as $row){
				$itemName = $row['name'];
				$itemAmount = $row['amount'];
				echo '<br>';
				echo '<hr />';
				echo '<span alt ="'.$row['name'].'">';
				//Cut string
				if(strlen($itemName) > 30){
					echo substr($itemName,0,30) . '... ';
				}else{
					echo $itemName;
				}
				echo '  :  '. $itemAmount .' Pair(s) </span>';
			}
			echo '<hr />';
		}else{
			//No item in cart
			echo '0';
			echo '<br>';
			echo '<br>';
			echo '<h4>No shoe in cart.</h4>';
		}
	}

	public function getItemInCartAmount(){
		$inCart = $this->cartModel->getCartList($_SESSION['idNum']);
		if(is_array($inCart)){
			$itemAmount = count($inCart);
			echo $itemAmount;
		}else{
			echo "0";
		}
	}

	public function getShoeToCart(){
		$recipientID = $_SESSION['idNum'];

		$shoeId = $this->input->post('shoeId');
		$amount = $this->input->post('amount');
		$shipMethod = $this->input->post('shipMethod');
		$shipAddress = $this->input->post('shipAddress');

		//Check if not exits in cart
		$checkShoeInCart = $this->cartModel->checkShoeInCart($recipientID,$shoeId);
		if(!isset($checkShoeInCart) || $checkShoeInCart==""){
			$this->cartModel->addShoeToCart($recipientID,$shoeId,$amount,$shipMethod,$shipAddress);
			echo $shoeId . "Added";
		}else{
			$this->cartModel->editShoeInCart($recipientID,$shoeId,$amount,$shipMethod,$shipAddress);
			echo $checkShoeInCart . ": Edited";
		}
	}

}
