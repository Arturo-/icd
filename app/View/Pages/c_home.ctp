<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>

<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>

<?php
if (isset($filePresent)):
	App::uses('ConnectionManager', 'Model');
	try {
		$connected = ConnectionManager::getDataSource('default');
	} catch (Exception $connectionError) {
		$connected = false;
		$errorMsg = $connectionError->getMessage();
		if (method_exists($connectionError, 'getAttributes')):
			$attributes = $connectionError->getAttributes();
			if (isset($errorMsg['message'])):
				$errorMsg .= '<br />' . $attributes['message'];
			endif;
		endif;
	}
?>

<?php endif; ?>

<!-- Mostramos el cuadro de inicio de sesión -->
<?php echo $this->element('/Inicio/inicio_sesion'); ?>

<h1>Intercambio de contenidos digitales</h1>

<div class="introduccion">
	<p> Este sitio está diseñado y orientado a la propuesta y recolección de recursos
		digitales que en cooperación con las instituciones de la Secretaría de Educación 
		Pública y la Universidad Nacional Autónoma de México se podrán utilizar para los 
		fines académicos pertinentes.
	</p><br/>
	
	<center>
		<?php 	echo $this->Html->link(
				    'Registra nuevo contenido',
				    array('controller' => 'digital_resources', 'action' => 'add'),
				    array('onClick'=>"checarSesionActiva()")
				);
		?>
		<br><br>
		<?php 
			//if( estaEnSesion() && estaSesionEsAdministrador() ){
				echo $this->Html->link(
				    'Ver recursos propuestos',
				    array('controller' => 'digital_resources', 'action' => 'ver_registros')
				);
			//}
		?>
	</center>
</div>

<br/>

