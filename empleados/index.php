<?php 
// echo $_POST['txtNombre'];  este es para mostrar el dato nombre por metodo post aqui mismo
$txtId= (isset($_POST['txtId']))?$_POST['txtId']:"No hay ID";
$txtId= (isset($_POST['txtNombre']))?$_POST['txtNombre']:"No hay Nombre";
$txtId= (isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"No hay Apellido Paterno";
$txtId= (isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"No hay Apellido Materno";
$txtId= (isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"No hay Correo";
$txtId= (isset($_POST['txtFoto']))?$_POST['txtFoto']:"No hay Foto";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case 'btnAgregar':
        echo "Presionaste el boton btnAgregar";
        break;
    
    case 'btnModificar':
        echo "Presionaste el boton btnModificar";
        break;
    
    case 'btnEliminar':
        echo "Presionaste el boton btnEliminar";
        break;
    
    case 'btnCancelar':
        echo "Presionaste el boton btnCancelar";
        break;
    
    default:
        # code...
        break;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <form action="#" method="POST" enctype="multipart/form-data">
                
                <!-- (label{lbl$:}+input[name="txt$" placeholder="" id="txt$" require]+br) 
            esto se multiplica por el numero de label e imputs que se desee y 
            automaticamente se crea-->

            <label for="">Id:</label>
            <input type="text" name="txtId" placeholder="" id="txtId" require="">
            <br>
            <label for="">Nombre(s):</label>
            <input type="text" name="txtNombre" placeholder="" id="txtNombre" require="">
            <br>
            <label for="">Apellido Paterno:</label>
            <input type="text" name="txtApellidoP" placeholder="" id="txtApellidoP" require="">
            <br>
            <label for="">Apellido Materno:</label>
            <input type="text" name="txtApellidoM" placeholder="" id="txtApellidoM" require="">
            <br>
            <label for="">Correo:</label>
            <input type="text" name="txtCorreo" placeholder="" id="txtCorreo" require="">
            <br>
            <label for="">Foto:</label>
            <input type="text" name="txtFoto" placeholder="" id="txtFoto" require="">
            <br>
            <!-- (button[value="btn$" type="submit" name="accion"]) 
            esto se multiplica por el numero de botones que se desee y 
            automaticamente se crea-->
            <button value="btnAgregar" type="submit" name="accion">Agregar</button>
            <button value="btnModificar" type="submit" name="accion">Modificar</button>
            <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
            <button value="btnCancelar" type="submit" name="accion">Cancelar</button>
        </form>
    </div>
</form>

</body>
</html>