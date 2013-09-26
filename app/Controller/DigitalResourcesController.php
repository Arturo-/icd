<?php
/**
 *  Calse que define al Contralador DigitalResourceController
 *  @version: 0.1
 *
 */
class DigitalResourcesController extends AppController{

    public $name = 'DigitalResources';
    public $components = array('DigitalResourceViewData', 'RequestHandler');
    public $uses = array('Audience', 'Language', 'EducationalLevel', 'DigitalResource', 
                         'User', 'AudiencesDigitalResources', 'DigitalResourcesEducationalLevels',
                         'DigitalResourcesFiles');

    /**
     * Método que permite registrar un nuevo recurso digital
     */
    public function add(){
        
        //Enviamos la información de los formularios a la vista
        $this->set(array('listLanguage', 'listEducationalLevel', 'listAudience'), $this->DigitalResourceViewData->loadAddData());
        
        if ($this->request->is('post')) {
        /*
            echo '<pre>';
                print_r($_FILES); 
            echo '</pre>';
            exit;
        */     
            //debug($this->request->data);
            //debug($this->request);
            //exit;
            try {
                //Iniciamos la transacción
                $this->User->begin();
                
               
                if(isset($this->request->data['digital_resource_type'])){
                    
                    /************* Es un Url *********/ 
                    if($this->request->data['digital_resource_type'] == 'U'){

                        $this->saveModels($this->request->data);
                        
                     /************* Son Archivos *********/   
                    }elseif($this->request->data['digital_resource_type'] == 'F'){

                        $digital_resource_id = $this->saveModels($this->request->data);
                        $this->saveFiles($this->request, $digital_resource_id);

                    }else{
                        throw new Exception('ERR_DIGITAL_RESOURCE_TYPE');
                    }
                    //exit;
                    
                    //Hacemos commit en la BD para que se guarden los cambios si 
                    //no hubo error (finalizamos la transacción)
                    //$this->User->commit();
                    
                   
                    $this->Session->setFlash('Propuesta registrada correctamente!', 'default', array('class'=>'success'));
                    //$this->redirect(array('action' => 'index'));
                    
                }else{
                   throw new Exception('ERR_EMPTY_DIGITAL_RESOURCE_TYPE');
                }
                
            }catch (Exception $exc) {
                $this->User->rollback();
                //echo $exc->getTraceAsString();
                //echo $exc->getMessage();
                //$this->redirect(array('action' => 'msgError', $exc->getMessage()));
                
                //$this->Session->setFlash($exc->getMessage(), 'default', array('class' => 'alert-box error'));                
                //$this->Session->setFlash($this->msgError($exc->getMessage()), 'default', array('class' => 'alert-box error'));
                $this->Session->setFlash($this->msgError($exc->getMessage()));
            }
        }
    }
    
    
    /**
     * Método que guarda en los modelos DigitalResource, AudiencesDigitalResources, DigitalResourcesEducationalLevels
     */
    public function saveModels($vModels){
        
        //debug($vModels);
        //exit;
        
        $data = array(
            'user_id' => $vModels['DigitalResource']['user_id'],
            'language_id' => $vModels['DigitalResource']['language_id'],
            'digital_resource_type' => $vModels['digital_resource_type'],
            'digital_resource_title' => $vModels['DigitalResource']['digital_resource_title'],
            'digital_resource_topic' => ($vModels['DigitalResource']['digital_resource_topic'] != '') ? $this->request->data['DigitalResource']['digital_resource_topic'] : NULL,
            'digital_resource_description' => $vModels['DigitalResource']['digital_resource_description'],
            'digital_resource_subjects_description' => ($vModels['DigitalResource']['digital_resource_subjects_description'] != '') ? $this->request->data['DigitalResource']['digital_resource_subjects_description'] : NULL,
            'digital_resource_url' => ($vModels['DigitalResource']['digital_resource_url'] != '')? $this->request->data['DigitalResource']['digital_resource_url'] : NULL,
            //'digital_resource_record_date' => '2013-09-18 13:21:32.196-05',
        );

        $this->DigitalResource->create();

        if(!$this->DigitalResource->save($data)) {
            //debug($this->DigitalResource->getDataSource()->getLog(false, false));
            throw new Exception('ERR_SAVE_DIGITAL_RESOURCE');
        }

        $digital_resource_id = $this->DigitalResource->id;
        
        if($vModels['EducationalLevel']['educational_level_id'] != ''){
                            
            foreach ($vModels['EducationalLevel']['educational_level_id'] as $value) {

                $data = array(
                    'educational_level_id' => $value,
                    'digital_resource_id' => $digital_resource_id
                );

                $this->DigitalResourcesEducationalLevels->create();

                if (!$this->DigitalResourcesEducationalLevels->save($data)) {
                    throw new Exception('ERR_SAVE_AUDIENCES_DIGITAL_RESOURCES');
                }
            }

        }

        if($vModels['Audience']['audience_id'] != ''){
            
            foreach ($vModels['Audience']['audience_id'] as $value) {

                $data = array(
                    'digital_resource_id' => $digital_resource_id,
                    'audience_id' => $value
                );

                $this->AudiencesDigitalResources->create();

                if (!$this->AudiencesDigitalResources->save($data)) {
                    throw new Exception('ERR_SAVE_DIGITAL_RESOURCE_EDUCATIONAL_LAVELS');
                }
            }
        }
        
        return $digital_resource_id;
        
    }
    
    /**
     * Método que guarda en el modelo DigitalResourcesFiles y los archivos del usuario
     */
    public function saveFiles($vModels, $digital_resource_id){
        //debug($digital_resource_id);
        //debug($vModels);
        //exit;
        
        //Nuestro pibote es el primer archivo para saber si vienen archivos
        if(isset($vModels['form']['DigitalResourcesFiles']['name'][1]) != ''){
            
            //ubicacion y nombre del directorio donde se guarda. Todo en webroot
            $directorio_global = "digitalResourcesFiles"; 
            //$directorio_user = $this->Session->read(); 
            $directorio_user = 'kique@kique.com'; 
            
            $ubicaciones = array();

            //extensiones permitidas
            $extensiones = Configure::read('_digital_resources_extensions_'); 

            //comprueba si el directorio existe y si es posible escribir    
            if (!file_exists($directorio_global) && !is_writable($directorio_global)) {
                throw new Exception('ERR_DIGITAL_RESOURCES_FILES_DIRECTORY_DOES_NOT_EXIST');
                //echo '<br/>';
                //echo "No existe la carpeta para subir archivos o no tiene los permisos suficientes.";
            }
            
            //Nos movemos dentro del directorio digitalResourcesFiles
            chdir($directorio_global);
            
            //Verifico si existe el directorio del usuario
            if (!file_exists($directorio_user) && !is_writable($directorio_user)) {
                throw new Exception('ERR_USER_DIRECTORY_DOES_NOT_EXIST');
            }
            
            //Nos movemos dentro del directorio del usuario
            chdir($directorio_user);
            
            $digital_resource = $this->DigitalResource->find('list', array(
                'fields' => array('DigitalResource.digital_resource_record_date'),
                'conditions' => array('DigitalResource.digital_resource_id' => $digital_resource_id),
                'recursive' => -1
            ));
            
            //debug($digital_resource); exit;
            foreach ($digital_resource as $value) {
                $name = str_replace(':','' ,$value); //Le quitamos los dos puntos
                $name = str_replace(' ','_' ,$name);  //Le quitamos los espacion en blanco
                $name_folder = "$digital_resource_id"."_".$name;
            }
            
            //debug($name_folder);exit;
            
            //Creo el directorio donde se va a guardar los archivos de acurdo a la fecha
            if(!mkdir($name_folder, 0777, false)){
                throw new Exception('ERR_COULD_NOT_CREATE_THE_LOG_DIRECTORY_OF_DIGITAL_RESOURCES');
                //echo 'Fallo al crear carpetas...';
            }
            
            //Nos movemos dentro que se acaba de crear para guardar los archivos
            //chdir($name_folder);
            
            //Recorremos cada archivo
            foreach ($vModels['form']['DigitalResourcesFiles']['name'] as $key => $file) {

                //Nos aseguramos que haya seleccionado los archivos
                if($file != ''){
                    //echo $value . '<br/>';
                    $trozo = explode(".",$file); //obtenemos la extensión
                    $extension = strtolower(end($trozo)); //la pasamos a minuscula
                    
                    //comprobamos que sea una extensión permitida
                    if(in_array($extension, $extensiones)){
                        //si el archivo es valido lo intentamos mover
                        
                        //ubicacion original y temporal del archivo
                        $ubicacion_original = $vModels['form']['DigitalResourcesFiles']['tmp_name'][$key]; 

                        if(!move_uploaded_file($ubicacion_original, "$name_folder/$file")){
                            throw new Exception('ERR_MOVING_FILE');
                            //echo "No se puede mover el archivo \n";
                        }
//                        else{
//                                $ubicaciones[] = $file; //podemos manipular los archivos desde el arreglo resultante.
//                        }
                        
                        //Guardamos en los registros en la tabla digital_resources_files
                        $data = array(
                            'digital_resource_id' => $digital_resource_id,
                            'digital_resource_file_name' => $file
                        );
                        
                        $this->DigitalResourcesFiles->create();
                        
                        if(!$this->DigitalResourcesFiles->save($data)){
                            rmdir($name_folder); //Borramos el directorio si hubo un error
                            throw new Exception('ERR_SAVE_DIGITAL_RESOURCE_FILES');
                        }
                        
                        
                    }else{
                        rmdir($name_folder); //Borramos el directorio si hubo un error
                        throw new Exception('ERR_INVALID_FILE_EXTENSION');
                        //echo "Extension de archivo no valida \n";
                    }
                    
                }

            }

        }else{
            throw new Exception('ERR_EMPTY_FILES');
        }

        //exit;
    }
    
    /**
     * Método que personaliza el mensaje a mostrar al usuario en caso de error y resgistra en bitacora
     */
    public function msgError($cveError){
        //Configuración de bitacora
        $hoy = date("Ymd");
        CakeLog::config('custom_log', array(
            'engine' => 'FileLog',
            'types' => array('warning', 'error'), 
            'file' => "$hoy.log",
        ));
        
        $msgErrorGenral = 'Disculpe la molestia ha ocurrido un error. Inténtelo de nuevo más tarde o reporte el error al correo en la parte inferior.';
        
        switch ($cveError) {
            case 'ERR_DIGITAL_RESOURCE_TYPE':
                $this->log('El tipo de recurso elegido por el usuario es desconocido. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_EMPTY_DIGITAL_RESOURCE_TYPE':  
                $msgError = 'Por favor, indique el tipo de recurso a postular';
                break;
            case 'ERR_SAVE_DIGITAL_RESOURCE':
                $this->log('Error al intentar guardar en la tabla digital_resource. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_SAVE_AUDIENCES_DIGITAL_RESOURCES':
                $this->log('Error al intentar guardar en la tabla audiences_digital_resources. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_SAVE_DIGITAL_RESOURCE_EDUCATIONAL_LAVELS':
                $this->log('Error al intentar guardar en la tabla digital_resource_educational_lavels. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_DIGITAL_RESOURCES_FILES_DIRECTORY_DOES_NOT_EXIST':
                $this->log('Error, el directorio digitalResourcesFiles no existe. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_USER_DIRECTORY_DOES_NOT_EXIST':
                $this->log('Error, el directorio del usuario no existe. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_COULD_NOT_CREATE_THE_LOG_DIRECTORY_OF_DIGITAL_RESOURCES':
                $this->log('Error al intentar crear el directorio para guardar los contenidos digitales. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_MOVING_FILE':
                $this->log('Error al intentar mover los contenidos digitales al directorio. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_SAVE_DIGITAL_RESOURCE_FILES':
                $this->log('Error al intentar guardar en la tabla digital_resource_files. ' . 'USER_ID: ' . $this->Session->read('User.id'));
                $msgError = $msgErrorGenral;
                break;
            case 'ERR_INVALID_FILE_EXTENSION':
                $msgError = 'Algún archivo que intenta subir tiene una extensión inválida, suba de favor solo archivos con extensiones validas.';
                break;
            case 'ERR_EMPTY_FILES':
                $msgError = 'Por favor, seleccione algún contenido digital';
                break;
            
            default:
                $msgError = $msgErrorGenral;
                break;
        }
        
        return $msgError;
    }
    
}

?>
