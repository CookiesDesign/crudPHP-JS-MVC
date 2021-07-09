<?php

    require_once("../Config/conexion.php");
    require_once("../Models/Product.php");
    
    $product = new Product();

    switch($_GET["op"]){

        case "listar":
            $datos=$product->get_product();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["name"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        case "guardaryeditar":
            $datos=$producto->get_product_x_id($_POST["id"]);
            if(empty($_POST["id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $product->insert_product($_POST["name"]);
                }
            }else{
                $product->update_product($_POST["id"],$_POST["name"]);
            }
            break;

        case "mostrar":
            $datos=$product->get_product_x_id($_POST["id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["id"] = $row["id"];
                    $output["name"] = $row["name"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $producto->delete_product($_POST["id"]);
            break;

    }
?>
