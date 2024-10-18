<?php

class CategoryView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showCategorys($categorys) {
        require 'templates/view.categorys.phtml';
    }

    public function showProductsByCategory($products, $nameCategory){
        require 'templates/view.products.categorys.phtml';
    }
    public function showError($error) {
        require 'templates/error.phtml';
    }

}
