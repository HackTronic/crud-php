<?php 
// echo $_POST['txtNombre'];  este es para mostrar el dato nombre por metodo post aqui mismo
$txtId= (isset($_POST['txtId']))?$_POST['txtId']:"No hay ID";
$txtNombre= (isset($_POST['txtNombre']))?$_POST['txtNombre']:"No hay Nombre";
$txtApellidoP= (isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"No hay Apellido Paterno";
$txtApellidoM= (isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"No hay Apellido Materno";
$txtCorreo= (isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"No hay Correo";
$txtFoto= (isset($_POST['txtFoto']))?$_POST['txtFoto']:"No hay Foto";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

include("../conexion/conexion.php");
    
switch ($accion) {
    case 'btnAgregar':
        echo "Presionaste el boton btnAgregar";
        $sentencia = $pdo->prepare("INSERT INTO empleados(Nombre, ApellidoP, ApellidoM, Correo, Foto)VALUES (:Nombre, :ApellidoP, :ApellidoM, :Correo, :Foto)");
        $sentencia->bindParam(':Nombre',$txtNombre);
        $sentencia->bindParam(':ApellidoP',$txtApellidoP);
        $sentencia->bindParam(':ApellidoM',$txtApellidoM);
        $sentencia->bindParam(':Correo',$txtCorreo);
        $sentencia->bindParam(':Foto',$txtFoto);
        $sentencia->execute();
        
        break;
    
    case 'btnModificar':
        echo "Presionaste el boton btnModificar";
        $sentencia = $pdo->prepare("UPDATE empleados SET Nombre=:Nombre, ApellidoP=:ApellidoP, ApellidoM=:ApellidoM, Correo=:Correo, Foto=:Foto WHERE Id=:Id");
        $sentencia->bindParam(':Nombre',$txtNombre);
        $sentencia->bindParam(':ApellidoP',$txtApellidoP);
        $sentencia->bindParam(':ApellidoM',$txtApellidoM);
        $sentencia->bindParam(':Correo',$txtCorreo);
        $sentencia->bindParam(':Foto',$txtFoto);
        $sentencia->bindParam(':Id',$txtId);
        $sentencia->execute();
        
        break;
    
    case 'btnEliminar':
        echo "Presionaste el boton btnEliminar";
        $sentencia = $pdo->prepare("DELETE FROM empleados WHERE Id=:Id");
        $sentencia->bindParam(':Id',$txtId);
        $sentencia->execute();
        break;
    
    case 'btnCancelar':
        echo "Presionaste el boton btnCancelar";
        break;
    
    default:
        # code...
        break;
}

$sentencia = $pdo->prepare("SELECT * FROM `empleados` WHERE 1");
$sentencia->execute();
$listaEmpleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="content">
        <form action="#" method="POST" enctype="multipart/form-data">
                
                <!-- (label{lbl$:}+input[name="txt$" placeholder="" id="txt$" require]+br) 
            esto se multiplica por el numero de label e imputs que se desee y 
            automaticamente se crea-->

            <label for="">Id:</label>
            <input type="text" name="txtId" placeholder="" value="<?php echo $txtId;?>" id="txtId" require="">
            <br>
            <label for="">Nombre(s):</label>
            <input type="text" name="txtNombre" placeholder="" value="<?php echo $txtNombre;?>" id="txtNombre" require="">
            <br>
            <label for="">Apellido Paterno:</label>
            <input type="text" name="txtApellidoP" placeholder="" value="<?php echo $txtApellidoP;?>" id="txtApellidoP" require="">
            <br>
            <label for="">Apellido Materno:</label>
            <input type="text" name="txtApellidoM" placeholder="" value="<?php echo $txtApellidoM;?>" id="txtApellidoM" require="">
            <br>
            <label for="">Correo:</label>
            <input type="text" name="txtCorreo" placeholder="" value="<?php echo $txtCorreo;?>" id="txtCorreo" require="">
            <br>
            <label for="">Foto:</label>
            <input type="text" name="txtFoto" placeholder="" value="<?php echo $txtFoto;?>" id="txtFoto" require="">
            <br>
            <!-- (button[value="btn$" type="submit" name="accion"]) 
            esto se multiplica por el numero de botones que se desee y 
            automaticamente se crea-->
            <button value="btnAgregar" type="submit" name="accion">Agregar</button>
            <button value="btnModificar" type="submit" name="accion">Modificar</button>
            <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
            <button value="btnCancelar" type="submit" name="accion">Cancelar</button>
        </form>
        <div class="row">
            <!-- table>thead>tr>(th)*4   esto es para generar una tabla con 4 columnas-->
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre completo</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php foreach($listaEmpleados as $empleados){?>
                    <!-- tr>(td)*4    esto es para generar 4 datos de la tabla-->
                    <tr>
                        <td><?php echo $empleados['Foto'];?></td>
                        <td><?php echo $empleados['Nombre'];?> <?php echo $empleados['ApellidoP'];?> <?php echo $empleados['ApellidoM'];?></td>
                        <td><?php echo $empleados['Correo'];?></td>
                        <td>
                            
                        <form action="" method="post">
                            <!-- (input:hidden)*6   esto es para generar 6 input de tipo hidden-->
                            <input type="hidden" name="txtId" value="<?php echo $empleados['Id'];?>">
                            <input type="hidden" name="txtNombre" value="<?php echo $empleados['Nombre'];?>">
                            <input type="hidden" name="txtApellidoP" value="<?php echo $empleados['ApellidoP'];?>">
                            <input type="hidden" name="txtApellidoM" value="<?php echo $empleados['ApellidoM'];?>">
                            <input type="hidden" name="txtCorreo" value="<?php echo $empleados['Correo'];?>">
                            <input type="hidden" name="txtFoto" value="<?php echo $empleados['Foto'];?>">
                            <input type="submit" value="Seleccionar" name="accion">
                            <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
                        </form>
                        
                        </td>
                    </tr>
                <?php }?>
            </table>

        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>