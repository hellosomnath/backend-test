<?php
/**
 * 
 */
class Api_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	// get order using given order id
	public function getOrder($orderId)
	{
		$this->db->select('orderNumber as order_id, orderDate as order_date, status');
		$this->db->where('orderNumber', $orderId);
		$res = $this->db->get('orders')->row();
		if (!empty($res)) {
			// if order exist fetch some details of the order
			$res->order_details = $this->getOrderDetails($orderId);
		}
		
		return $res;
	}

	// get selective order details for an existing order
	public function getOrderDetails($orderId)
	{
		$this->db->select('P.productName as product, P.productLine as product_line, OD.priceEach as unit_price, OD.quantityOrdered as qty, (OD.priceEach * OD.quantityOrdered) as line_total');
		$this->db->from('orderdetails as OD');
		$this->db->join('products as P', 'OD.productCode = P.productCode');
		return $this->db->get()->result();
	}
}
?>