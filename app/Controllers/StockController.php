<?php
require_once "app/Models/Stock.php";

class StockController {
    public function index() {
        $stockModel = new Stock();
        $stocks = $stockModel->getAllStocks();
        require "app/Views/stocks/index.php";
    }

    public function create() {
        require "app/Views/stocks/create.php";
    }

    public function store($request) {
        $stockModel = new Stock();
        $stockModel->createStock($request);
        header("Location: /?controller=Stock&method=index");
    }

    public function edit($id) {
        $stockModel = new Stock();
        $stock = $stockModel->findStockById($id);
        require "app/Views/stocks/edit.php";
    }

    public function update($request) {
        $stockModel = new Stock();
        $stockModel->updateStock($request);
        header("Location: /?controller=Stock&method=index");
    }

    public function delete($id) {
        $stockModel = new Stock();
        $stockModel->deleteStock($id);
        header("Location: /?controller=Stock&method=index");
    }
}
