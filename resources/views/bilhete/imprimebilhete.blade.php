<h1>Bilhetes Gerados</h1>

<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
    <thead>
        <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" ></th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" ></th>
            <th style=""></th>
            <th style=""></th>
            
        </tr>
    </thead>
    <tbody>
	<?php
	for ($i = 0; $i <= count($bilhetes); $i+=4){
	  echo ' <tr>';
	  echo ' <td> ';
	  
	
	if (isset($bilhetes[$i])){
		echo '  <fieldset id="bilhete_esquerda">';
		echo '<img src="'.public_path().'/img/HAS.png" style="float: left; width:50 px;heigth: 50px">';
		echo 'Bilhete de Acesso'; 
		echo '<strong> Ilimitado</strong><br>';
		echo '<centro id="centro">';
		echo '<strong class="val"> Número: '.$bilhetes[$i]['name']."</strong> <br>";
		echo '<center>Validade: 2 Meses</center>';
		echo '</centro>';
		echo '<p id="obs">';
		echo "Obs.: Este bilhete libera acesso para 01 dispositivo(notebook,celular, entre outros)";
		echo '</p>';
		
		echo "</fieldset>";
	}
	echo '</td>';
	echo '<td>';
		
	
	if (isset($bilhetes[$i+1])){
		echo '<fieldset id="bilhete_direita">';
		echo '<img src="'.public_path().'/img/HAS.png" style="float: left; width:50px">';
		echo 'Bilhete de Acesso';
		echo '<strong> Ilimitado</strong><br>';
		echo '<centro id="centro">';
		echo '<strong class="val"> Número: '.$bilhetes[$i+1]['name']."</strong> <br>";
		echo '<center>Validade: 2 Meses</center>';
		echo '</centro>';
		echo '<p id="obs">';
		echo "Obs.: Este bilhete libera acesso para 01 dispositivo(notebook,celular, entre outros)";
		echo '</p>';
		echo "</fieldset>";
	}
echo '</td>';
	echo '<td>';
	if (isset($bilhetes[$i+2])){
		echo '	<fieldset id="bilhete_direita">';
		echo '	<img src="'.public_path().'/img/HAS.png" style="float: left; width:50px">';
		echo '	Bilhete de Acesso';
		echo '	<strong> Ilimitado</strong><br>';
		echo '<centro id="centro">';
		echo '<strong class="val"> Número: '.$bilhetes[$i+2]['name']."</strong> <br>";
		echo '<center>Validade: 2 Meses</center>';
		echo '</centro>';
		echo '<p id="obs">';
		echo "Obs.: Este bilhete libera acesso para 01 dispositivo(notebook,celular, entre outros)";
		echo '</p>';
		
		echo "</fieldset>";
	}
echo '</td>';
echo '<td>';
	
	if (isset($bilhetes[$i+3])){
		echo '	<fieldset id="bilhete_direita">';
		echo '	<img src="'.public_path().'/img/HAS.png" style="float: left; width:50px">';
		echo '	Bilhete de Acesso';
		echo '	<strong> Ilimitado</strong><br>';
		echo '<centro id="centro">';
		echo '<strong class="val"> Número: '.$bilhetes[$i+3]['name']."</strong> <br>";
		echo '<center>Validade: 2 Meses</center>';
		echo '</centro>';
		echo '<p id="obs">';
		echo "Obs.: Este bilhete libera acesso para 01 dispositivo(notebook,celular, entre outros)";
		echo '</p>';
		
		echo "</fieldset>";
	}
echo '</td>';
echo '</tr>';
	
		}
	?>

	</tbody>
	<tfoot>
	    <tr>
	        <th  ></th>
	        <th  ></th>
	        <th  ></th>
	        <th ></th>
	    </tr>
	</tfoot>
</table>
