<?php

class ProductView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showProducts($products, $categorys) {
        require 'templates/home.phtml';
    }
    
    public function showProduct($product, $categorys){
        require 'templates/view.products.phtml';
    }

    public function showProductsByCategory($products) {
        require 'templates/view.products.categorys.phtml';
    }

    public function mostrarError($error) {
        require 'templates/error.phtml';
    }

}