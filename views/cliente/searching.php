<div class="container-fluid">
    <form class="well">
        <p class="lead text-center">Su última búsqueda  fue <strong>“Busqueda”</strong></p>
        <div class="row">
            <input class="form-control" type="hidden" name="search_client_destroy" required="">
            <div class="col-xs-12">
                <a href="<?=base_url?>cliente/search" class="btn btn-danger btn-raised btn-sm">
                    <i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda
                </a>
            </div>
        </div>
    </form>
</div>