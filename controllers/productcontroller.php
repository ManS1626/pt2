<?php
 
class ProductController extends Controller {
    private $model;
 
    public function __construct() {
        $this->model = $this->model("productmodel");
    }
 
    public function index() {
        $records = $this->model->readAll();
        $this->view("products", ["products" => $records]);
    }

    public function save() {
        $data = $_POST;
        $this->model->create($data);
    
        $this->index();
    }

    public function edit($id) {
        $aproduct = $this->model->readById($id);
    
        if (!$aproduct) {
            exit;
        }
    
        $this->view("products", [
            "aproduct" => $aproduct,
            "products" => $this->model->readAll()
        ]);
    }
    
}
 
?>