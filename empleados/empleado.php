<?php 
// echo $_POST['txtNombre'];  este es para mostrar el dato nombre por metodo post aqui mismo
$txtId= (isset($_POST['txtId']))?$_POST['txtId']:"No hay ID";
$txtNombre= (isset($_POST['txtNombre']))?$_POST['txtNombre']:"No hay Nombre";
$txtApellidoP= (isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"No hay Apellido Paterno";
$txtApellidoM= (isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"No hay Apellido Materno";
$txtCorreo= (isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"No hay Correo";
$txtFoto= (isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"No hay Foto";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

$accionAgregar = "";
$accionModificar = $accionEliminar = $accionCancelar = "disabled";
$mostrarModal = false;

include("../conexion/conexion.php");
    
switch ($accion) {
    case 'btnAgregar':
       
        $sentencia = $pdo->prepare("INSERT INTO empleados(Nombre, ApellidoP, ApellidoM, Correo, Foto)VALUES (:Nombre, :ApellidoP, :ApellidoM, :Correo, :Foto)");
        $sentencia->bindParam(':Nombre',$txtNombre);
        $sentencia->bindParam(':ApellidoP',$txtApellidoP);
        $sentencia->bindParam(':ApellidoM',$txtApellidoM);
        $sentencia->bindParam(':Correo',$txtCorreo);

        $Fecha = new DateTime();

                $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"default.gif";

                error_reporting(error_reporting() & ~E_NOTICE);

                $tmpFoto= $_FILES["txtFoto"]["tmp_name"];

               

                if($tmpFoto!=""){

                    move_uploaded_file($tmpFoto,"../imagenes/".$nombreArchivo);

                }

        $sentencia->bindParam(':Foto',$nombreArchivo);
        $sentencia->execute();
        header('Location: index.php');
        break;
    
    case 'btnModificar':
        
        $sentencia = $pdo->prepare("UPDATE empleados SET Nombre=:Nombre, ApellidoP=:ApellidoP, ApellidoM=:ApellidoM, Correo=:Correo WHERE Id=:Id");
        $sentencia->bindParam(':Nombre',$txtNombre);
        $sentencia->bindParam(':ApellidoP',$txtApellidoP);
        $sentencia->bindParam(':ApellidoM',$txtApellidoM);
        $sentencia->bindParam(':Correo',$txtCorreo);
        //$sentencia->bindParam(':Foto',$txtFoto);
        $sentencia->bindParam(':Id',$txtId);
        $sentencia->execute();
        
        $Fecha = new DateTime();

                $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"default.gif";

                error_reporting(error_reporting() & ~E_NOTICE);

                $tmpFoto= $_FILES["txtFoto"]["tmp_name"];

               

                if($tmpFoto!=""){

                    move_uploaded_file($tmpFoto,"../imagenes/".$nombreArchivo);


                    $sentencia = $pdo->prepare("SELECT Foto FROM empleados WHERE Id=:Id");
                    $sentencia->bindParam(':Id',$txtId);
                    $sentencia->execute();
                    $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
            
            
            
                    if (isset($empleado['Foto'])) {
            
                        if (file_exists("../imagenes/".$empleado['Foto'])) {
            
                            unlink("../imagenes/".$empleado['Foto']);
            
                        }
                        $sentencia = $pdo->prepare("DELETE FROM empleados WHERE Id=:Id");
                        $sentencia->bindParam(':Id',$txtId);
                        $sentencia->execute();
                    }


                    $sentencia = $pdo->prepare("UPDATE empleados SET Foto=:Foto WHERE Id=:Id");
                    $sentencia->bindParam(':Foto',$nombreArchivo);
                    $sentencia->bindParam(':Id',$txtId);
                    $sentencia->execute();
                }

        
        break;
    
    case 'btnEliminar':
        echo "Presionaste el boton btnEliminar";
        $sentencia = $pdo->prepare("SELECT Foto FROM empleados WHERE Id=:Id");
        $sentencia->bindParam(':Id',$txtId);
        $sentencia->execute();
        $empleado=$sentencia->fetch(PDO::FETCH_LAZY);



        if (isset($empleado['Foto'])) {

            if (file_exists("../imagenes/".$empleado['Foto']) && $item['Foto']!="default.gif") {

                unlink("../imagenes/".$empleado['Foto']);

            }
            $sentencia = $pdo->prepare("DELETE FROM empleados WHERE Id=:Id");
            $sentencia->bindParam(':Id',$txtId);
            $sentencia->execute();
        }


        break;
    
    case 'btnCancelar':
        
        header('Location: index.php');
        break;
    case 'Seleccionar':
        $accionAgregar = "disabled";
        $accionModificar = $accionEliminar = $accionCancelar = "";
        $mostrarModal=true;
        break;
    default:
        # code...
        break;
}

$sentencia = $pdo->prepare("SELECT * FROM `empleados` WHERE 1");
$sentencia->execute();
$listaEmpleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>