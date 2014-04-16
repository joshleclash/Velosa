<?php
include_once '../config/config.php';
include_once '../config/validateSession.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class proyectoController{
    private $components=null;
    private $conect=null;
    public function __construct() {
        $this->components= new Components();
        $this->conect= $this->components->getConnect();
        $this->model= new proyectoModel();
    }
    public function saveProyecto($parametros){
                $response = $this->model->createProyecto($parametros);
                if($response['codeError']==0)
                    {
                        return '<span id="error-response">'.$response['msg'].'</span>';
                    }
                else{
                        return '<span id="ok-response">'.$response['msg'].'</span>';
                    }
    }
    public function loadProyectos($idUser=null){
        $modelUser = new userModel();
        $sql="select * from proyecto where idCreate=".$_SESSION["_User"]->idUsuario;
        $rs = $this->components->__executeQuery($sql, $this->conect);
        $table="<table border='0' CELLSPACING='0' CELLSPACING='0'>";
        $table.="<tr>";
        $table.="<th>Csc</th>";
        $table.="<th>Nombre Proyecto</th>";
        $table.="<th>Codigo Interno</th>";
        $table.="<th>Nombre Auditor</th>";
        $table.="<th>Correo Auditor</th>";
        $table.="<th>Usuario Admin</th>";
        $table.="<th>Agregar Usuario</th>";
        $table.="</tr>";
        $i=0;
        while($row=  mysql_fetch_array($rs)):
           $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
           $table.='<th>'.$i.'</th>';
           $table.='<td>'.$row["nombreProyecto"].'</td>';
           $table.='<td>'.$row["codigoProyecto"].'</td>';
           $table.='<td>'.$row["nombreAuditor"].'</td>';
           $table.='<td>'.$row["mail"].'</td>';
           $table.='<td>'.$_SESSION["_User"]->nombreUsuario.' '.$_SESSION["_User"]->apellidoUsuario.'</td>'; 
           $table.='<td>';
                $rsUser = $modelUser->showUser();
                $option = '<select name="idProyecto" id="proyecto'.$row['idProyecto'].'"'.
							'onChange='."submitObjectData('proyecto$row[idProyecto]','response-update$i',{'idUsuario':$(this).val(),'idProyecto':$row[idProyecto]});".' action="'.PATCH.'/controller/proyectoController.php?option=1">';
                            
                $option .= "<option>--</option>";
                while($rowUser = mysql_fetch_array($rsUser)):
                        $option .= "<option value='".$rowUser["idUsuario"]."'>".$rowUser["nombreUsuario"]."-".$rowUser["apellidoUsuario"]."</option>";
                endwhile;
                $option .= "</select>";
           $table.=$option;
           $table.='</td>';
           $table.='</tr>';
           $table.="<tr><td id='response-update$i' colspan='6'></td><tr>";
           $i++;
        endwhile;
        $table.="<table>";
        return $table;
    }
	public function saveProyectoByUser(){
		echo $this->model->saveUsuarioProyecto($_REQUEST['idUsuario'],$_REQUEST['idProyecto']);
	
	}
	public function listUserByProject(){
		$sql="SELECT U.* FROM `usuario_proyecto`  UP
                        inner join proyecto P
							on(UP.idProyecto=P.idProyecto)
						inner join usuario U
                            on(UP.idUsuario=U.idUsuario)						
						WHERE UP.idProyecto=".$_REQUEST["idProyecto"]." 
							group by UP.idUsuario";
		$rs = $this->components->__executeQuery($sql, $this->conect);
        $table="<table border='0' CELLSPACING='0' CELLSPACING='0'>";
        $table.="<tr>";
        $table.="<th>Csc</th>";
        $table.="<th>Nombres</th>";
        $table.="<th>Apellidos</th>";
        $table.="<th>Email</th>";
        $table.="<th>Celular</th>";
		$table.="<th>Identificacion</th>";
        $table.="</tr>";
		while($row=  mysql_fetch_array($rs)):
           $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
           $table.='<th>'.$i.'</th>';
           $table.='<td>'.$row["nombreUsuario"].'</td>';
           $table.='<td>'.$row["apellidoUsuario"].'</td>';
           $table.='<td>'.$row["mail"].'</td>';
		   $table.='<td>'.$row["celular"].'</td>';
           $table.='<td>'.$row["identificacion"].'</td>';
           $table.='</tr>';
		   $i++;
		endwhile;
		$table.="<table>";
		return $table;
	}
}
if(isset($_REQUEST["option"]))
    {
    $proyectoController = new proyectoController();     
            switch($_REQUEST["option"])
            {
            case 0://Save Proyecto.
                 echo  $proyectoController->saveProyecto($_REQUEST);
                break;
            case 1:
                    echo $proyectoController->saveProyectoByUser();
                break;
			case 2:
                    echo $proyectoController->listUserByProject();
                break;	
            default :
                //echo Dialog::Message("Error", "Existio algun error valide su informacion", true, 0, "Aceptar", true);
                //echo '<script>setTimeout(function(){window.location="index.php";},2000);</script>';
            break;
            }
    }
    

?>
