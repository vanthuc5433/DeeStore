<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author chien
 */
class Product {

    //put your code here
    function Product() {
        
    }

    function feFetchTop20Product() {
        try {
            $connect = new Connect();
            $result = mysqli_query($connect->ConnectDb(), "SELECT * FROM products LIMIT 20");
            $connect->CloseDB();
            return $result;
        } catch (Exception $e) {
            echo "feFetchTop20Product" + $e;
        }
    }

    function feFetchProductByCategoriesId($cateId) {
        try {
            $connect = new Connect();
            $result = mysqli_query($connect->ConnectDb(), "SELECT * FROM products WHERE CategoriesID = $cateId");
            $connect->CloseDB();
            return $result;
        } catch (Exception $e) {
            echo "feFetchProductByCategoriesId" + $e;
        }
    }

    function feFetchProductByParentId($cateId) {
        try {
            $connect = new Connect();
            $result = mysqli_query($connect->ConnectDb(), "SELECT * FROM categories WHERE CategoriesParentID = $cateId");
            $str = "";
            $count = 0;

            while ($row = mysqli_fetch_array($result)) {
                if ($count == 0) {
                    $str = $str . "WHERE CategoriesID = " . $row["CategoriesID"];
                } else {
                    $str = $str . " OR CategoriesID = " . $row["CategoriesID"];
                }
                $count++;
            }
            if ($str != "") {
                $result = mysqli_query($connect->ConnectDb(), "SELECT * FROM Products $str");
            }

            $connect->CloseDB();
            return $result;
        } catch (Exception $e) {
            echo "feFetchProductByParentId" + $e;
        }
    }

}

?>
