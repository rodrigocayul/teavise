
<div class="row">
<div class="span12">
	<ul class="breadcrumb">
		<li><a href="/">Home</a> <span class="divider">/</span></li>
		<li><a href="/<?php echo $_GET['grupo'];  ?>"><?php echo $_GET['grupo'];  ?></a> <span class="divider">/</span></li>
		<li><a href="/detalle/<?php echo $_GET['detalle']; ?>">Detalle</a><span class="divider">/</span></li>
		<?php $nombre = explode('_' , $_GET['view']); ?>
		<?php unset($nombre[0]); ?>
		<?php unset($nombre[1]); ?>
		<li class="active"><?php echo implode('_',$nombre); ?></li>
	</ul>
</div>
	
<!--Body content-->
<iframe class="span9" src="http://docs.google.com/viewer?url=http://<?php echo $_SERVER['SERVER_NAME']; ?>/public/upload/<?php echo $_GET['view']; ?>&embedded=true" width="600" height="600" style="border: none;"></iframe>
	
<div class="span3">
<!--Sidebar content-->
  
</div>
</div>

