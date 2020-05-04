<!-- Content page -->
<!--Mensaje de alerta o registro-->
<?php if(isset($_SESSION["register"]) && $_SESSION["register"] == 'complete'):?>
    <div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>
    <strong>Exitosa!</strong> <?= $_SESSION["mensaje"] ?>  </div>
<?php elseif(isset($_SESSION["register"]) && $_SESSION["register"] == 'failed'): ?>
    <div class='alert alert-warning alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>
    <strong>Error!</strong> Registro fallido! </div>
<?php endif; ?>

<!-- Panel listado de clientes -->
<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CLIENTES</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">NOMBRES</th>
                            <th class="text-center">APELLIDOS</th>
                            <th class="text-center">TELÉFONO</th>
                            <th class="text-center">ANULAR</th>
                            <th class="text-center">EDITAR</th>
                            <th class="text-center">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($usuarios->num_rows > 0):?>
                        <?php while($cliente = $usuarios->fetch_object()):?>
                        <tr>
                            <td><?=$cliente->id?></td>
                            <td><?=$cliente->numeroDocumento?></td>
                            <td><?=$cliente->nombre?></td>
                            <td><?=$cliente->apellidos?></td>
                            <td><?=$cliente->telefono?></td>
                            <td>
                                <a href="<?=base_url?>cliente/cancel&id=<?=$cliente->id?>" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?=base_url?>cliente/select&id=<?=$cliente->id?>" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?=base_url?>cliente/remove&id=<?=$cliente->id?>" class="btn btn-danger btn-raised btn-xs">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" > No hay ningun registro </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <nav class="text-center">
                <ul class="pagination pagination-sm">
                    <li class="disabled"><a href="javascript:void(0)">«</a></li>
                    <li class="active"><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)">4</a></li>
                    <li><a href="javascript:void(0)">5</a></li>
                    <li><a href="javascript:void(0)">»</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>