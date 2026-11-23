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

    // CREATE a new record
    public function create($data) {
        $sql = "INSERT INTO tbl_products_a218412
                (fld_product_num, fld_product_name, fld_product_price,
                fld_product_brand, fld_product_condition, fld_product_year,
                fld_product_quantity, fld_product_image)
                VALUES
                (:product_num, :product_name, :product_price,
                :product_brand, :product_condition, :product_year,
                :product_quantity, :product_image)";
    
        $stmt = $this->db->prepare($sql);
    
        $product_num       = $data['product_num'];
        $product_name      = $data['product_name'];
        $product_price     = $data['product_price'];
        $product_brand     = $data['product_brand'];
        $product_condition = $data['product_condition'];
        $product_year      = $data['product_year'];
        $product_quantity  = $data['product_quantity'];
        $product_image     = $data['product_image'] ?? '';
    
        $stmt->bindValue(':product_num',       $product_num,       PDO::PARAM_STR);
        $stmt->bindValue(':product_name',      $product_name,      PDO::PARAM_STR);
        $stmt->bindValue(':product_price',     $product_price);
        $stmt->bindValue(':product_brand',     $product_brand,     PDO::PARAM_STR);
        $stmt->bindValue(':product_condition', $product_condition, PDO::PARAM_STR);
        $stmt->bindValue(':product_year',      $product_year,      PDO::PARAM_INT);
        $stmt->bindValue(':product_quantity',  $product_quantity,  PDO::PARAM_INT);
        $stmt->bindValue(':product_image',     $product_image,     PDO::PARAM_STR);
    
        $result = $stmt->execute();
    
        return $result;
    }

}
 
?>