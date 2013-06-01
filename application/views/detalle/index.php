<div class="row">
<div class="span12">
	<ul class="breadcrumb">
		<li><a href="/grupos">Grupos</a> <span class="divider">/</span></li>
		<li><a href="/grupo/<?php echo $secciones->nombre;  ?>"><?php echo $secciones->nombre;  ?></a> <span class="divider">/</span></li>
		<li class="active">Detalle</li>
	</ul>
</div>
	
<div class="span8">
<!--Body content-->
	<div class=""><h1><?php echo $detalle->nombre; ?></h1></div>
	<div class="">Publicado:<?php echo $detalle->fecha; ?><p><?php echo $detalle->detalle; ?></p></div>
	<div class="">
	<hr />
	
	<?php if(count($upload) > 0){ ?>
	Arhivos:
	<ul>
	<?php foreach($upload as $row){ ?>
		<?php $nombre = explode('_' , $row->ruta); ?>
		<?php unset($nombre[0]); ?>
		<?php unset($nombre[1]); ?>
		<li>
			<?php echo implode('_',$nombre); ?>
			<br>
			<a class="btn" href="/detalle/descargar?file=<?php echo $row->ruta; ?>">Descargar</a>
			<div class="g-savetodrive"
				 data-src="<?php echo base_url(); ?>public/upload/<?php echo $row->ruta; ?>"
				 data-filename="<?php echo implode('_',$nombre); ?>"
				 data-sitename="TeAvise">
			</div>
			<!-- Button to trigger modal -->
			<!--<a href="/detalle/viewdoc?grupo=<?php echo $detalle->seccione_id;  ?>&detalle=<?php echo $detalle->id; ?>&view=<?php echo $row->ruta; ?>" class="btn">Ver</a>-->
			<hr />
		</li>
	<?php } ?>
	</ul>
	<?php } ?>
	
	


    <script>
      window.___gcfg = {
        lang: 'es-ES',
      };

      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
	
	
	
	
	
	
	<!-- Comentarios -->
	<!--<a href="http://localhost/ejempophp/discucion/index.php#disqus_thread">Link</a>-->
	<div id="disqus_thread"></div>
	<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		var disqus_shortname = 'teavise'; // required: replace example with your forum shortname
		/* * * DON'T EDIT BELOW THIS LINE * * */
		(function() {
			var dsq = document.createElement('script'); 
			dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
			
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink" data-disqus-identifier="discucion_<?php echo $detalle->id; ?>" >comments powered by</a>
	
	</div>

</div>
<div class="span3">
<!--Sidebar content-->
<script type="text/javascript"><!--
google_ad_client = "ca-pub-2504943931879912";
/* primer */
google_ad_slot = "9426618348";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 

 
</div>
</div>