<!-- Content page -->
<!--Mensaje de alerta o registro-->
<?php if(isset($_SESSION["register"]) && $_SESSION["register"] == 'complete'):?>
    <div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>
    <strong>Exitosa!</strong> Registro guardado con exito! </div>
<?php elseif(isset($_SESSION["register"]) && $_SESSION["register"] == 'failed'): ?>
    <div class='alert alert-warning alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>
    <strong>Error!</strong> Registro fallido! </div>
<?php endif; ?>
<!-- Panel nuevo administrador -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO ADMINISTRADOR</h3>
        </div>
        <div class="panel-body">
            <form action="<?=base_url?>usuario/save" method="POST" onsubmit="return valida(this)">
                <fieldset>
                    <legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">DNI/CEDULA *</label>
                                    <input pattern="[0-9+]{1,30}" class="form-control" type="text" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'dni') ?>" name="dni-reg" required="" maxlength="30">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'dni') ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombres *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'nombre') ?>" name="nombre-reg" required="" maxlength="30">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'nombre') ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Apellidos *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'apellido') ?>" name="apellido-reg" required="" maxlength="30">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'apellido') ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input pattern="[0-9+]{1,15}" class="form-control" type="text" name="telefono-reg" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'telefono') ?>" maxlength="15">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'telefono') ?>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <textarea name="direccion-reg" class="form-control" rows="2" maxlength="100" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'direccion') ?>"></textarea>
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'direccion') ?>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend><i class="zmdi zmdi-key"></i> &nbsp; Datos de la cuenta</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre de usuario *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="usuario-reg" required="" maxlength="15" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'usuario') ?>">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'usuario') ?>                                
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Contraseña *</label>
                                    <input id="password1" class="form-control" type="password" name="password1-reg" required="" maxlength="70">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'password') ?>                                
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Repita la contraseña *</label>
                                    <input id="password2" class="form-control" type="password" name="password2-reg" required="" maxlength="70">
                                    <div id="validar_contra" style="color:#d20b0b; display:none;"><p>la contraseña debe ser la misma</p></div>
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'password_confirm') ?>                                
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">E-mail</label>
                                    <input class="form-control" type="email" name="email-reg" maxlength="50" value="<?php if(isset($_SESSION["campos"])) echo Utils::mostrarValor($_SESSION["campos"],'email') ?>">
                                    <?php if(isset($_SESSION["errores"])) echo Utils::mostrarError($_SESSION["errores"],'email') ?>                                
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Genero</label>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsGenero" id="optionsRadios1" value="Masculino" checked="">
                                            <i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
                                        </label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="optionsGenero" id="optionsRadios2" value="Femenino">
                                            <i class="zmdi zmdi-female"></i> &nbsp; Femenino
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend><i class="zmdi zmdi-star"></i> &nbsp; Nivel de privilegios</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p class="text-left">
                                    <div class="label label-success">Nivel 1</div> Control total del sistema
                                </p>
                                <p class="text-left">
                                    <div class="label label-primary">Nivel 2</div> Permiso para registro y actualización
                                </p>
                                <p class="text-left">
                                    <div class="label label-info">Nivel 3</div> Permiso para registro
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="optionsPrivilegio" id="optionsRadios1" value="1">
                                        <i class="zmdi zmdi-star"></i> &nbsp; Nivel 1
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="optionsPrivilegio" id="optionsRadios2" value="2">
                                        <i class="zmdi zmdi-star"></i> &nbsp; Nivel 2
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="optionsPrivilegio" id="optionsRadios3" value="3" checked="">
                                        <i class="zmdi zmdi-star"></i> &nbsp; Nivel 3
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 20px;">
                    <button id="submit" type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
            </form>
            <?php Utils::borrarErrores();?>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    var validar_contra = document.querySelector("#validar_contra");
    
    function valida(f){
        var pass1 = document.querySelector("#password1");
        var pass2 = document.querySelector("#password2");
        var validar_contra = document.querySelector("#validar_contra");

        var ok = true;
        var msg = "";
        
        if(pass1.value!=pass2.value){
            ok = false;
            msg = "la contraseña debe ser la misma";
        }

        if(ok==false)
            validar_contra.style.display='block';

        return ok;
    }
</script>
