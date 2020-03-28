<?php
require 'Connect.php';

$con = new Connect();

class Item {

  public $id;
  public $item_name;
  public $jan;
  public $standard;
  public $number_contained;
  public $regular_price;
  public $expiration_date;
  public $size;

  public function __construct(){
      $this->id = $id;
      $this->item_name = $item_name;
      $this->jan = $jan;
      $this->standard = $standard;
      $this->number_contained = $number_contained;
      $this->regular_price = $regular_price;
      $this->expiration_date = $expiration_date;
      $this->size = $size;
  }

  public function getData() {
    $sql = "SELECT * FROM item ";
    
    if($sql != NULL) {
      return true;
    }
  }

}