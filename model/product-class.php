<?php 
	class product(){
		private $productID;
	    private $productName;
	    private $productPrice;
	    private $productColor;
	    private $productCategory;

	    public function __construct() {
	    	$this->productID = "";
	      	$this->productName = "";
	      	$this->productPrice = 0;
	      	$this->productColor = "";
	      	$this->productCategory = "";
	    }
	    public function __get($fieldName) {
	     	return $this->$fieldName;
	    }
	    public function setProduct($id, $name, $price, $color, $category) {
	        $this->productID = $id;
	        $this->productName = $name;
	        $this->productPrice = $price;
	        $this->productColor = $color;
	        $this->productCategory = $category;
	    }
	}
?>