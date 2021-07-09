<?php

    class Product extends Conectar{
        
        public function get_product(){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM product WHERE status=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_product_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM product WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_product($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE product
                SET
                    status=0,
                    date_delete=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_product($name){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO product (id, name, date_create, date_update, date_delete, date_update) VALUES (NULL, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$name);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_product($id,$name){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE product
                SET
                    name=?,
                    date_update=now()
                WHERE
                    prod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$name);
            $sql->bindValue(2,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }



    }
?>