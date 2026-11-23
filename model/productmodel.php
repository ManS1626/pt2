<?php
 
class ProductModel {
    private $db;
 
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // READ all records
    public function readAll() {
        $sql = "SELECT * FROM tbl_products_a218412 ORDER BY fld_product_num ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}
 
?>