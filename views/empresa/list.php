		<!-- panel lista de empresas -->
		<div class="container-fluid">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EMPRESAS</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover text-center">
							<thead>
								<tr>
									<th class="text-center">CODIGO DE REGISTRO</th>
									<th class="text-center">NOMBRE</th>
									<th class="text-center">TELEFONO</th>
									<th class="text-center">EMAIL</th>
									<th class="text-center">DIRECCION</th>
									<th class="text-center">SIMBOLO MONEDA</th>
									<th class="text-center">YEAR</th>
									<th class="text-center">DIRECTOR</th>
									<th class="text-center">EDITAR</th>
									<th class="text-center">ELIMINAR</th>
									
								</tr>
							</thead>
							<tbody>
								<?php if($empresas->num_rows>0) :?>
								<?php while($empresa = $empresas->fetch_object()):?>
	
								<tr>
									<td><?=$empresa->codigo?></td>
									<td><?=$empresa->nombre?></td>
									<td><?=$empresa->telefono?></td>
									<td><?=$empresa->email?></td>
									<td><?=$empresa->direccion?></td>
									<td><?=$empresa->simbolo_moneda?></td>
									<td><?=$empresa->anio?></td>
									<td><?=$empresa->director?></td>		
									<td>
										<a href="<?=base_url?>empresa/select&id=<?=$empresa->id?>" class="btn btn-success btn-raised btn-xs">
											<i class="zmdi zmdi-refresh"></i>
										</a>
									</td>
									<td>
										<form>
											<button type="submit" class="btn btn-danger btn-raised btn-xs">
												<i class="zmdi zmdi-delete"></i>
											</button>
										</form>
									</td>
								</tr>
								<?php endwhile; ?>
								<?php else : ?>
									<td colspan="10">No hay ningun registro</td> 
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