<?php include_once '../config/config.php';?>
<link href="../css/side.css" rel="stylesheet">
		
		<form enctype="multipart/form-data" class="login" method="POST" action="uploadForm.php" style="height: 200px;">	
				                
			                <table style="margin: 0, auto; border: solid #000 0px; width: 450px;" align="center">
							<tr>
								<td>
									<div style="background-color: #5F7D97; color:#fff; width: 450px; margin: 0, auto; padding: 5px; font-weight: bold;">Cargar Archivos</div>
								</td>
								
							</tr>		                    
		                    <tr>
		                        <td>Selecione archivo</td>
		                    </tr>    
		                    <tr>
		                        <td >
		                            <input type="file" name="file" id="file" style="width: 200px;"/>
		                        </td>
		                        
		                    </tr>
		                    <tr>
		                        <td>Comentarios</td>
		                    </tr>
		                    <tr>
		                        <td>
		                        	<input type="text" name="Observaciones" placeholder="Diligencie" style="height: 50px; text-align:left;">
								</td>
		                    </tr>
		                    <tr>
		                        <td>
		                            <input type="submit" value="Cargar Archivo">
		                        </td>
		                    </tr>    
		                </table>
		             </form>
		<?php 
		if(isset($_FILES["file"])){
		    if($_FILES["file"]["size"]<=8388600)
		    {
		    	if(empty($_REQUEST["fileId"]))
		    	{
		    		$components = New Components();
				    $nameFile = str_replace(" ","",$_FILES["file"]["name"]);
		                $file = addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
						if(move_upload_file($_FILES["file"]["tmp_name"],'uploads/'.$nameFile))
						{
							$sql = 'INSERT INTO archivo
		                        (idUsuario, routeFile, nameFile, smalldatetime, estate, typeFile,blobFile,description,size) 
		                        VALUES ('.$_SESSION["_User"]->idUsuario.',"'."uploads/".$nameFile.'","'.$nameFile.'","'.Components::getDate().'","activo",'.
		                        '"'.$_FILES["file"]["type"].'","'.$file.'","'.$_REQUEST["Observaciones"].'","'.$_FILES["file"]["size"].'"'.
		                        ')';
								$rs = $components->__executeQuery($sql, $components->getConnect());
								$mails = $components->getMailsByAdmin();
								$msg="<strong>Se&ntilde;or(a):</strong> Administrador,<br/><br/><br/><br/>";
								$msg.="El usuario ".$_SESSION["_User"]->nombreUsuario."-".$_SESSION["_User"]->apellidoUsuario."a cargado un archivo a el sistema<br/><br/>";
								$msg.="<strong>Nombre Archivo:</strong>".$_FILES["file"]["name"]."<br/>";
								$msg.="<strong>Tipo Archivo:</strong>".$_FILES["file"]["type"]."<br/><br/><br/><br/><br/>";
								$msg.="Señor usuario favor no responda este correo<br/>Correo generado automaticamente".Components::getDate();
								$sendMail = $components->sendRsForMail($mails, "Archivo Cargado al sistema", $msg);
								if(!$rs || !$sendMail)
								{
										 echo '<div class="error-response">Exisito algun  error intentelo nuevamente</div>';
								}
								else
								{
										 echo '<div class="ok-response" align="center"><img src="'.PATCH.'/images/icons/accept.png" style="margin-top: -10px;" align="middle">'.
														 'Archivo cargado correctamente'.
												  '</div>';
								}
						}	
		    	}else{//UPDATE FILE
		    		
		    	}
				
		                
		                
			}else{
		        echo '<div class="error-response">El archivo es demasido grande</div>';
		    }
		    
		}
		
		?>

