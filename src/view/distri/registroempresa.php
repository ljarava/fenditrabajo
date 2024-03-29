<?php

namespace src\view\distri;

include_once 'view/_main.php';

/* require_once $_SERVER["DOCUMENT_ROOT"] . '/fenditrabajo/src/config.inc.php';
require_once constant('PATHSRC') . 'libraryFendi.php'; */
require_once '../../../src/config.inc.php';
require_once constant('PATHSRC') . 'libraryFendi.php';

use src\controller\empresaController;
use src\controller\codsicomController;

$emp        = new empresaController();
$codsicom   = new codsicomController();
$id_empresa = '';
$dataemp    = '';

if (isset($_SESSION['id_usuaroempresa'])) {
	$id_usuario                 = $_SESSION["id_usuaroempresa"];
	$user_codsicom              = $_SESSION["user_codsicom"];
	$id_empresa                 = $emp->getUsuarioEmpresa($id_usuario);

	/*echo "id_usuario ------> " . $id_usuario . "<br/>";
	echo "user_codsicom --->" . $user_codsicom . "<br/>";
	echo "id_empresa ------>" . $id_empresa . "<br/>";*/

	$datacodsicom           = $codsicom->codsicom_check($user_codsicom);
	foreach ($datacodsicom as $cod_sicom) {
		$codsicom_nombre    = $cod_sicom['nombre'];
	}

	$dataemp = $emp->selectIDEmpresa($id_empresa);
	foreach ($dataemp as $demp) {
		$emp_idempresa                = $demp['id_empresa'];
		$emp_razonsocial              = $demp['nomRazonSocial'];
		$emp_nit_empresa              = $demp['nit'];
		$emp_depa                     = $demp['departamento'];
		$emp_ciudad                   = $demp['ciudad'];
		$tel_empresa                  = $demp['telefono'];
		$cel_empresa                  = $demp['celular'];
		$emp_email                    = $demp['email'];
		$dir_empresa                  = $demp['direccion'];
		$emp_afiliado                 = $demp['afiliado']; 
		$emp_depeseccional            = $demp['dependencia_secional']; 
		$emp_arl                      = $demp['arl']; 
		$emp_nivel_riesgo             = $demp['nivel_riesgo']; 
		$emp_num_trabajadores_constratitas    = $demp['num_trabajadores_constratitas'];
		$emp_descripcion              = $demp['descripcion'];
	}

	$datRepLegal = $emp->selectRepLegal($id_empresa);
	foreach ($datRepLegal as $drl) {
		$emp_rep_nom            = $drl['nombre'];
		$emp_rep_tipoid         = $drl['tipoId'];
		$emp_rep_numid          = $drl['numId'];
		$emp_rep_cargo          = $drl['cargo'];
		$emp_rep_email          = $drl['email'];
		$emp_rep_tel            = $drl['telefono'];
		$emp_rep_cel            = $drl['celular'];
	}

	$datAdministador = $emp->selectAdminsitrador($id_empresa);
	foreach ($datAdministador as $dadmin) {
		$emp_admin_nom              = $dadmin['nombre'];
		$emp_admin_tipoid           = $dadmin['tipoId'];
		$emp_admin_num              = $dadmin['numId'];
		$emp_admin_email            = $dadmin['cargo'];
		$emp_admin_cargo            = $dadmin['email'];
		$emp_admin_cel              = $dadmin['celular'];
		$emp_admin_tel              = $dadmin['telefono'];
	} 

} else {
	if (isset($_POST['submit'])) {
		$res = $emp->agregarRegistroEDS();
		echo "Aqui se le dio Click en Guardar";
	}
}
?>
<link rel="stylesheet" href="<?php echo constant('CSS')?>res/style.css" />
<link rel="stylesheet" href="<?php echo constant('JS')?>richtexteditor/rte_theme_default.css" />

<div class="container">
	<h4>Registro de Empresa</h4>
	<br>
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs">
				<!-- Pestaña Inicio-->
				<li class="active" id="tab-eds"><a href="#eds" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-tint"></span> Información EDS</a>
				</li>
				<li class="" id="tab-representante-legal"><a href="#representante-legal" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-bookmark"></span> Información Representate legal</a>
				</li>
				<li class="" id="tab-personaContacto"><a href="#personaContacto" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-user"></span>Persona de Contacto</a>
				</li>
				<li class="" id="tab-documentos"><a href="#documentos" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-list-alt"></span> Documentos</a>
				</li>
			</ul>
			<!-- Pestañas Fin-->

			<form action="registroempresa.php" method="POST" name="form_emp" id="form_emp" autocomplete="off">
				<div class="tab-content">
					<!-- INFORMACION EDS -->
					<!--====================================================================================== -->
					<div class="tab-pane active" id="eds">
						<!-- Contenido sobre Informacion Registro de Empresa -->
						<div class="container well col-xs-12">
							<div class="row">
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Nombre de la EDS:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-object-align-bottom"></i></span></span>
											<input type="text" class="form-control" name="codsicom_nombre" id="codsicom_nombre" value="<?php echo $codsicom_nombre; ?>" disabled>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Código Sicom:</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></span>
											<input type="number" class="form-control" name="codsicom_sicom" id="codsicom_sicom" value="<?php echo $user_codsicom; ?>" disabled>
										</div>
									</div>
								</div>

								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Nombre o Razón Social de la EDS:</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-check"></span></span>
											<input type="text" class="form-control" name="emp_razonsocial" id="emp_razonsocial" value="<?php echo $emp_razonsocial; ?>" placeholder="Compañia Ejemplo S.A.S" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Cédula del propietario o Nit con DV:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
											<input type="number" class="form-control" name="emp_nit_empresa" id="emp_nit_empresa" value="<?php echo $emp_nit_empresa; ?>" placeholder="8001972684" required>
										</div>
									</div>
								</div>
							</div>

							<div class="row">

								<div class="col-xs-3">
									<div class="form-group">
										<label for="password" class="control-label">Departamento:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
											<select name="emp_depa" id="emp_depa" class="form-control" required>
												<option value="" selected disabled>Seleccionar</option>
												<?php echo "<option value='$emp_depa' selected>$emp_depa</option>"; ?>
												<option value="Bolivar">Bolivar</option>
												<option value="Atlantico">Atlantico</option>
												<option value="Magdalena">Magdalena</option>
												<option value="Tolima">Tolima</option>
												<option value="Cundinamarca">Cundinamarca</option>
												<option value="Antioquia">Antioquia</option>
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Ciudad o Municipio:</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
											<select name="emp_ciudad" id="emp_ciudad" class="form-control" required>
												<option value="" selected disabled>Seleccionar</option>
												
												<?php echo "<option value='$emp_ciudad' selected>$emp_ciudad</option>"; ?>
												<option value="Medellín">Cartagena</option>
												<option value="Medellín">Barranquilla</option>
												<option value="Medellín">Santa Marta</option>
												<option value="Medellín">Medellín</option>
												<option value="Ibagué">Ibagué</option>
												<option value="Bogotá">Bogotá</option>
												</option>
											</select>

										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Teléfono Fijo:</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
											<input type="number" class="form-control" name="emp_tel_empresa" id="emp_tel_empresa" value="<?php echo $tel_empresa; ?>" placeholder="0357276266" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Celular:</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
											<input type="number" class="form-control" name="emp_cel_empresa" id="emp_cel_empresa" value="<?php echo $cel_empresa; ?>" placeholder="3141234567" required>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Correo electrónico:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
											<input type="email" class="form-control" name="emp_email" id="emp_email" value="<?php echo $emp_email; ?>" placeholder="ejemplo@ejemplo.com" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label class="control-label">Dirección de la EDS:</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
											<input type="text" class="form-control" name="emp_dir_empresa" id="emp_dir_empresa" value="<?php echo $dir_empresa; ?>" placeholder="Cll 30 #78-128 Trans 11" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="form-group" class="control-label">Afiliado a Fendipetroleo</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-pawn"></i></span>
											<select name="emp_afiliado" id="emp_afiliado" class="form-control" value="<?php echo $emp_afiliado;?>" required>
												<option value="" selected disabled>Seleccionar</option>
													<?php echo "<option value='$emp_afiliado' selected>$emp_afiliado</option>"; ?>
    												<option value="Si">Sí</option>
    												<option value="No">No</option>
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="form-group" class="control-label">Dependencia o Seccional </label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-pawn"></i></span>
											<select name="emp_depeseccional" id="emp_depeseccional" class="form-control" required>
												
												<option value="" selected disabled>Seleccionar</option>
												<?php echo "<option value='$emp_depeseccional' selected>$emp_depeseccional</option>"; ?>
												<option value="Adiconar">Adiconar</option>
												<option value="Imzacom">Imzacom</option>
												<option value="Seccional Caribe">Seccional Caribe</option>
												<option value="Seccional Caldas">Seccional Caldas</option>
												<option value="Seccional Cesar">Seccional Cesar</option>
												<option value="Seccional Huila Y Caquetá">Seccional Huila Y Caquetá</option>
												<option value="Seccional Magdalena Medio">Seccional Magdalena Medio</option>
												<option value="Seccional Quindio">Seccional Quindio</option>
												<option value="Seccional Orinoquia">Seccional Orinoquia</option>
												<option value="Seccional Sucre">Seccional Sucre</option>
												<option value="Seccional Tolima Y Girardot">Seccional Tolima Y Girardot</option>
												<option value="Seccional Santander">Seccional Santander</option>
												<option value="Seccional Dispeguajira">Seccional Dispeguajira</option>
												<option value="Seccional Nariño">Seccional Nariño</option>
												<option value="Seccional Antioquia Y Chocó">Dependencia Antioquia Y Chocó</option>
												<option value="Seccional Bogota Y Cundinamarca">Dependencia Bogota Y Cundinamarca</option>
												<option value="Seccional Bolivar San Andres y Providencia">Bolivar, San Andres y Providencia</option>
												</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-3">
									<div class="form-group">
										<label for="correo_r">ARL</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
											<input class="form-control" type="text" name="emp_arl" id="emp_arl" placeholder="ARL EDS ASEGURADORA" value="<?php echo $emp_arl; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="numero_r">Nivel de Riesgo</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
											<input class="form-control" type="text" name="emp_riesgo" id="emp_riesgo" placeholder="Escribir el Nivel de Riesgo" value="<?php echo $emp_nivel_riesgo; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="correo_r">Numero de trabajadores y Contratistas</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
											<input class="form-control" type="number" name="emp_numtabajador" id="emp_numtabajador" placeholder="4" value="<?php echo $emp_num_trabajadores_constratitas; ?>" required>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label for="descripcion">Descripción de la Empresa</label>
										<br>
										<div class="input-group">
											<textarea name="emp_descripcion" id="emp_descripcion" cols="120" rows="5" placeholder="bereve reseña de la empresa!!"></textarea>
										</div>

										<!-- <div class="input-group">
											<div name="emp_descripcion" id="emp_descripcion"></div>

										</div> -->


									</div>
								</div>
							</div>

							<div class="form-group ">
								<a class="btn btn-primary btnNext">Siguiente</a>
							</div>
							<div class="form-group">
								<span class="help-block">Todos los campos son requeridos</span>
							</div>
						</div>
					</div>
					<!--====================================================================================== -->

					<!--======================================================================================-->
					<div class="tab-pane" id="representante-legal">
						<!-- Informacion sobre representante legal-->
						<div class="container well col-xs-12">
							<div class="form-group form-inline"></div>
							<div class="row">
								<div class="col-xs-4">
									<div class="form-group">
										<label for="nombre">Nombre Completo</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input type="text" class="form-control" name="emp_rep_nom" id="emp_rep_nom" value="<?php echo $emp_rep_nom; ?>" placeholder="Jhon Doe" required />
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="form-group" class="control-label">Tipo de Documento</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-pawn"></i></span>
											<select name="rep_tipoid" id="rep_tipoid" class="form-control" value="<?php echo $emp_rep_tipoid; ?>" required>
												<option value="" selected disabled>Seleccionar</option>
												<?php echo "<option value='$emp_rep_tipoid' selected>$emp_rep_tipoid</option>"; ?>
												<option value="Cedula">Cédula</option>
												<option value="Nit">Nit</option>
												<option value="Cedula de Extranjeria">Cédula de Extranjéria</option>
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="numeroid">Numero de Documento</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-pawn"></i></span>
											<input type="number" class="form-control" name="emp_rep_numid" id="emp_rep_numid" value="<?php echo $emp_rep_numid; ?>" placeholder="123456789" />
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-4">
									<div class="form-group">
										<label for="numero">Correo Electrónico </label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
											<input class="form-control" type="email" name="emp_rep_email" id="emp_rep_email" placeholder="ejemplo@ejemplo.com" value="<?php echo $emp_rep_email; ?>" required>
										</div>
									</div>
								</div>

								<div class="col-xs-3">
									<div class="form-group">
										<label for="razon_social">Teléfono Fijo</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
											<input class="form-control" type="number" name="emp_rep_tel" id="emp_rep_tel" placeholder="123456789" value="<?php echo $emp_rep_tel; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="giro">Celular</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
											<input class="form-control" type="number" name="emp_rep_cel" id="emp_rep_cel" placeholder="3001234567" value="<?php echo $emp_rep_cel; ?>" required>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<a class="btn btn-primary btnPrevious">Regresar</a>
								<a class="btn btn-primary btnNext">Siguiente</a>
							</div>

							<div class="form-group">
								<span class="help-block">Todos los campos son requeridos</span>
							</div>
						</div>
					</div>
					<!--======================================================================================-->

					<!--======================================================================================-->
					<div class="tab-pane" id="personaContacto">
						<!-- Informacion sobre Adminitrador -->
						<div class="container well col-xs-12">
							<div class="row">
								<div class="col-xs-4">
									<div class="form-group">
										<label for="nombre_r">Nombre Completo</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input class="form-control" type="text" name="admin_nom" id="admin_nom" placeholder="Jhon Doe" value="<?php echo $emp_admin_nom; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="form-group">
										<label for="form-group" class="control-label">Tipo de Documento</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-pawn"></i></span>
											<select name="admin_tipoid" id="admin_tipoid" class="form-control" value="<?php echo $emp_admin_tipoid; ?>" required>
												<option value="" selected disabled>Seleccionar</option>
												<option value="Cedula">Cédula</option>
												<option value="Nit">Nit</option>
												<option value="Cedula de Extranjeria">Cédula de Extrajéria</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="form-group">
										<label for="numero_r">Numero de Documento</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-pawn"></span></span>
											<input class="form-control" type="number" name="admin_num" id="admin_num" placeholder="123456789" value="<?php echo $emp_admin_num; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label for="numero_r">Cargo</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-briefcase"></span></span>
											<input class="form-control" type="text" name="admin_cargo" id="admin_cargo" placeholder="Cargo" value="<?php echo $emp_admin_cargo; ?>" required>
										</div>
									</div>
								</div>

								<!-- Código para inserción de documentos html -->
								<!-- <div class="col-xs-6">
									<input name="file-input" id="file-input" type="file" />
									<br />
									<img id="imgSalida" width="25%" height="50%" src="" />
								</div> -->
							</div>

							<div class="row">
								<div class="col-xs-4">
									<div class="form-group">
										<label for="correo_r">Correo electronico</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
											<input class="form-control" type="email" name="admin_email" id="admin_email" placeholder="ejemplo@ejemplo.com" value="<?php echo $emp_admin_email; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="form-group">
										<label for="correo_r">Celular</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
											<input class="form-control" type="number" name="admin_cel" id="admin_cel" placeholder="3005566666" value="<?php echo $emp_admin_cel; ?>" required>
										</div>
									</div>
								</div>
								<div class="col-xs-2">
									<div class="form-group">
										<label for="numero_r">Telefono Fijo</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
											<input class="form-control" type="number" name="admin_tel" id="admin_tel" placeholder="123456789" value="<?php echo $emp_admin_tel; ?>" required>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<a class="btn btn-primary btnPrevious">Regresar</a>
								<a class="btn btn-primary btnNext">Siguiente</a>
							</div>

							<div class="form-group">
								<span class="help-block">Todos los campos son requeridos</span>
							</div>

						</div>
					</div>
					<!--  Pestaña Documentos -->

					<div class="tab-pane" id="documentos">
						<div class="container well col-xs-12">
							<div class="row">
								<div>
									<div>
										<a href="">Documento Afiliado</a>
									</div>

									<div>
										<a href="">Documento no Afiliado</a>
									</div>

									<div>
										<input type="checkbox" value="agree text" name="agree">
										Politica de datos
									</div>


								</div>
								<br>
								<div class="form-group">
									<button type="reset" class="btn btn-primary btnPrevious">Regresar</button>
									<button type="reset" class="btn btn-warning">limpiar</button>
									<button type="submit" class="btn btn-info" name="submit" id="submit" value="Guardar">Guardar</button>
								</div>
								<div class="form-group">
									<span class="help-block">Todos los campos son requeridos</span>
								</div>
							</div>
						</div>

					</div>

					<!-- Fin pestaña Documentos -->
					<!--======================================================================================-->
				</div><!-- Contenido Fin -->
			</form>
		</div>
	</div>
</div>


<?php require_once 'view/_footer.php'; ?>
<script type="text/javascript" src="<?php echo constant('JS')?>richtexteditor/rte.js"></script>
<script src="./js/next.js"></script>
<script>
	var editor1 = new RichTextEditor("#emp_descripcion");

	editor1.setHTMLCode("<?php echo $emp_descripcion; ?>");

	function btngetPlainText() {
		alert(editor1.getPlainText())
	}
</script>

<script>
	RTE_DefaultConfig.url_base = 'richtexteditor'
</script>
<script type="text/javascript" src='<?php echo constant('JS')?>richtexteditor/plugins/all_plugins.js'></script>
<script src="<?php echo constant('JS')?>res/patch.js"></script>