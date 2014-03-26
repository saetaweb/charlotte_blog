			<h2>BUSCAR</h2>

            <div align="center" class="buscador">
			<input type="text" id="elsearch">
			<a title="Buscar" onClick="enviarkeyword()">
			<img src="public/images/lupa.png" width="24" height="24" border="0">
			</a>
			</div>

            <hr /><br />

			<h2>CATEGORIAS DISPONIBLES</h2>
            
            <ul>
            <?php 
			for($i = 0; $i < sizeof($las_categorias); $i++)
			{
			?>
            
            	<li>
                	<a href="<?php echo Configuracion::ruta();?>?controlador=ver_noticias&categoria=<?php echo $las_categorias[$i]["categoria_id"];?>">
					<?php echo $las_categorias[$i]["nombre"];?>
                    </a>
                </li>
                
            <?php 
			}
			?>
            </ul>
            
            <hr />
            
            <h2>SELECCIONA TU CATEGORIA</h2>
            <select id="selector" onchange="enviarcategoria()">
            	<option value="0">Seleccione...</option>
            <?php 
			for($i = 0; $i < sizeof($las_categorias); $i++)
			{
			?>
                
                
            <?php
			
			if(isset($_GET['categoria']))
			{
				if($_GET['categoria'] == $las_categorias[$i]["categoria_id"])
				{
				?>
						<option value="<?php echo $las_categorias[$i]["categoria_id"];?>" title="<?php echo $las_categorias[$i]["nombre"];?>" selected="selected"><?php echo $las_categorias[$i]["nombre"];?></option>
						
		   		<?php
				}
				else
				{
				?>
						<option value="<?php echo $las_categorias[$i]["categoria_id"];?>" title="<?php echo $las_categorias[$i]["nombre"];?>"><?php echo $las_categorias[$i]["nombre"];?></option>
						
		   		<?php
				}
			
			}
			else
			{
			?>
				<option value="<?php echo $las_categorias[$i]["categoria_id"];?>" title="<?php echo $las_categorias[$i]["nombre"];?>"><?php echo $las_categorias[$i]["nombre"];?></option>
                
            <?php
			}
			
			
			?>    
                
                
            <?php 
			}
			?>            
            </select>
