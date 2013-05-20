<ul class="nav nav-list">
  <li class="nav-header">Grupos</li>
  <?php foreach ($secciones as $row) : ?>
  <li><a href="<?php echo base_url(); ?>grupo/<?php echo $row->nombre; ?>"><?php echo $row->nombre; ?></a></li>
  <?php endforeach; ?>
</ul> 