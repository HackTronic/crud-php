<?php
require("empleado.php");
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
            

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Empleados</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <!-- (label{lbl$:}+input[name="txt$" placeholder="" id="txt$" require]+br) 
            esto se multiplica por el numero de label e imputs que se desee y 
            automaticamente se crea-->

            
            <input type="hidden" name="txtId" placeholder="" value="<?php echo $txtId;?>" id="txtId" required>
            <div class="row">
            <div class="form-group col-md-4">
                <label for="">Nombre(s):</label>
                <input type="text" class="form-control" name="txtNombre" placeholder=""  id="txtNombre" required>
                
            </div>
            
            <div class="form-group col-md-4">
                <label for="">Apellido Paterno:</label>
                <input type="text" class="form-control" name="txtApellidoP" placeholder=""  id="txtApellidoP" required>
            
            </div>
            
            <div class="form-group col-md-4">
                <label for="">Apellido Materno:</label>
                <input type="text" class="form-control" name="txtApellidoM" placeholder=""  id="txtApellidoM" required>
            
            </div>
            
            </div>
            <br>
            <div class="form-group col-md-12">
                <label for="">Correo:</label>
                <input type="email" class="form-control" name="txtCorreo" placeholder=""  id="txtCorreo" required>
                <br>
            </div>
            
            <div class="form-group col-md-12">
                <label for="">Foto:</label>
                <input type="file" class="form-control" accept="image/*" name="txtFoto" placeholder=""  id="txtFoto">
                <br>
            </div>
            
                        </div>
                    </div>
                        <div class="modal-footer">
                            <!-- (button[value="btn$" type="submit" name="accion"]) 
            esto se multiplica por el numero de botones que se desee y 
            automaticamente se crea-->
                            <button value="btnAgregar" <?php echo $accionAgregar;?> class="btn btn-success" type="submit" name="accion">Agregar</button>
                            <button value="btnModificar" <?php echo $accionModificar;?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
                            <button value="btnEliminar" <?php echo $accionEliminar;?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                            <button value="btnCancelar" <?php echo $accionCancelar;?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
               
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar
            </button>
                
            
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
                        <td><img class="img-thumbnail" width="100px" src="../imagenes/<?php echo $empleados['Foto'];?>" alt=""> </td> 
                        <td><?php echo $empleados['Nombre'];?> <?php echo $empleados['ApellidoP'];?> <?php echo $empleados['ApellidoM'];?></td>
                        <td><?php echo $empleados['Correo'];?></td>
                        <td>
                            
                        <form action="" method="post" >
                            <!-- (input:hidden)*6   esto es para generar 6 input de tipo hidden-->
                            <input type="hidden" name="txtId" value="<?php echo $empleados['Id'];?>">
                            <input type="hidden" name="txtNombre" value="<?php echo $empleados['Nombre'];?>">
                            <input type="hidden" name="txtApellidoP" value="<?php echo $empleados['ApellidoP'];?>">
                            <input type="hidden" name="txtApellidoM" value="<?php echo $empleados['ApellidoM'];?>">
                            <input type="hidden" name="txtCorreo" value="<?php echo $empleados['Correo'];?>">
                            <input type="hidden" name="txtFoto" value="<?php echo $empleados['Foto'];?>">

                            <input type="submit" value="Seleccionar" name="accion" >
                            <button value="btnEliminar" onclick="return Confirmar('Deseas eliminar el registro');" type="submit" name="accion">Eliminar</button>
                        </form>
                        
                        </td>
                    </tr>
                <?php }?>
            </table>

        </div>

        <?php if($mostrarModal){?>
            <script>
                $('#exampleModal').modal('show');
            </script>
        <?php }?>
        
    </div>
<script>
    function Confirmar(mensaje) {
        return (confirm(mensaje))?true:false;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>