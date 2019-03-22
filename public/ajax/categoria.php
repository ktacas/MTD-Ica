<?php
    require_once "../modelos/Categoria.php";

    $categoria=new Categoria();

    $idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

    switch($_GET["op"]){
        case 'guardaryeditar':
            if(empty($idcategoria)){
                $rspta=$categoria->insertar($nombre, $descripcion);
                echo $rspta ? "Categoria Registrada" : "Categoria no registrada";
            }else{
                $rspta=$categoria->editar($idcategoria, $nombre, $descripcion);
                echo $rspta ? "Categoria Actualiza" : "Categoria no se pudo Actualizar";
            }
        break;

        case 'desactivar':
            $rspta= $categoria-> desactivar($idcategoria);
            echo $rspta ? "Categoria Desactivada":"Categoria no Desactivada";
        break;

        case 'activar':
            $rspta= $categoria->activar($idcategoria);
            echo $rspta ? "Categoria Activada":"Categoria no Activada";
        break;

        case 'mostrar':
            $rspta= $categoria->mostrar($idcategoria);
            // Codificar el resultado utilizando json
            echo json_encode($rspta);
        break;

        case 'listar':
            $rspta= $categoria-> listar();
            // Vamos a declarar un array
            $data=Array();

            while ($reg = $rspta->fetch_object()){
                $data[]=array(
                    "0"=>($reg->condicion)?
                            '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                            ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>'
                        :
                            '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                            ' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
                    "1"=>$reg->nombre,
                    "2"=>$reg->descripcion,
                    "3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>'
                                            :
                                            '<span class="label bg-red">Desactivado</span>'
                );
            }

            $results = array(
                "sEcho"=>1, // Informacion para el datatables
                "iTotalRecords"=>count($data), // enviamos el total de registros al datatable
                "iTotalDisplayRecords"=>count($data), // enviamos el total de registros a visualizar
                "aaData"=>$data
            );
            echo json_encode($results);
        break;
    }
?>