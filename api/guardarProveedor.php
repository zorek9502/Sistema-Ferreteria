<?php 
	require_once 'config.php';

	//Checar que recibimos los parametros obligatorios
	if(
		!property_exists($request,'id_prov') ||
		!property_exists($request,'nombre') ||
		!property_exists($request,'r_social') ||
		!property_exists($request,'telefono') ||
		!property_exists($request,'calle') ||
		!property_exists($request,'colonia') ||
        !property_exists($request,'num_domicilio_ext') ||
		!property_exists($request,'cp') ||
		!property_exists($request,'cve_mun') ||
		!property_exists($request,'cve_ent')
	) {
		echoError("No se pudo guardar el usuario: Parametros incompletos");
	}

	//Obtener el último id
	$res1 = $con->query("SELECT IFNULL( MAX(id_proveedor), 0) as lastid FROM proveedor;");
	if($row = mysqli_fetch_assoc($res1)) {
		$lastid = $row['lastid'] + 1;
	} 

	$num_domicilio_int = "NULL";
	if(property_exists($request,'num_domicilio_int')) {
		$num_domicilio_int = "'".$request->num_domicilio_int."'";
	}

	$sql = "
		INSERT INTO 
		proveedor
		SET 
		id_prov = $lastid,
		nombre='$request->nombre',
		razon_social='$request->r_social',
		telefono='$request->telefono',
		correo='$request->correo',
		telefono='$request->telefono',
		calle='$request->calle',
		colonia='$request->colonia',
        num_domicilio_ext='$request->num_domicilio_ext',
		num_domicilio_int=$num_domicilio_int,
		cp='$request->cp',
		cve_mun='$request->cve_mun',
		cve_ent='$request->cve_ent','
        fecha_ultima_visita=NULL";

	$result = $con->query($sql);

	if($result){ 
		echoMessage("Insercion Correcta ");
	} else {
		echoError("Error al guardar el registro");
	}
?>