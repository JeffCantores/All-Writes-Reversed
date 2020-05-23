<?php
	class Product{
		private $productID;
		private $productImgUrl;
	  private $productName;
	  private $productPrice;
	  private $productColor;
	  private $productCategory;

	  public function __construct() {
	  	$this->productID = "";
			$this->productImgUrl = "";
	    $this->productName = "";
	    $this->productPrice = 0;
	    $this->productColor = "";
	    $this->productCategory = "";
	  }
	  public function __get($fieldName) {
	    return $this->$fieldName;
	  }
	  public function setProduct($id, $name, $img_url, $price, $color, $category) {
	    $this->productID = $id;
	    $this->productName = $name;
			$this->productImgUrl = $img_url;
	    $this->productPrice = $price;
	    $this->productColor = $color;
	    $this->productCategory = $category;
	  }
	}
?>
