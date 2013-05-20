
<div class="row">

<div class="span12">
	<a class="btn btn-success" href="/app/nuevogrupo">Nuevo Grupo</a>
</div>


	<div class="span12">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Grupo</th>
					<th>Tipo</th>
					<th>Acciones</th>
					
				</tr>	
			</thead>
			
			</tbody>
				<?php foreach($mis_grupos as $row): ?>
				<tr>
					<td><a href="<?php echo base_url(); ?>grupo/<?php echo $row->nombre; ?>"><?php echo $row->nombre; ?></td>
					<td>
						<?php if($row->tipo == 0){ ?>
							<span class="icon-book" title="Publico"></span>
						<?php }elseif($row->tipo == 1){ ?>
							<span class="icon-lock" title="Privado"></span>
						<?php } ?>
						
					</td>
					<td>
						<a class="btn" href="/app/publicar?grupo=<?php echo $row->id; ?>">Publicar</a>
					</td>
				</tr>
				 <?php endforeach; ?>
			</tbody>
		
		</table>
	</div>
</div>
