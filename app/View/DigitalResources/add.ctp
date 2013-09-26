<?php
/*
echo "<pre>";
    //print_r($listLanguage);
    //print_r($listEducationalLevel);
    print_r($listAudience);
echo "</pre>";
exit;
*/
echo $this->Html->script('addRowTableDigitalResourcesFiles');
echo $this->Html->script('validFormDigitalResourceAdd');

echo $this->Form->create('DigitalResource', array('enctype' => 'multipart/form-data'));
    
    echo '<div class = "indique"></div>';
    echo '<div><label >Indique el tipo de recurso a postular:</label></div>';

    echo '<input type="radio" name="digital_resource_type" value="U">Url del recurso<br>';
        echo $this->Form->input('digital_resource_url', array(
            'type' => 'text',
            'required' => false,
            'class' => 'validDigitalResourceUrl'
        ));
    echo '<input class = "prueba" type="radio" name="digital_resource_type" value="F">Archivo digital';
        /*
        echo $this->Form->input('DigitalResourcesFiles.digital_resource_file_name', array(
            'between' => '<br />',
            'type' => 'file',
            'name' => 'archivo[]'
        ));
        */
?>
    <table id="tabla">
            <!--	Cabecera de la tabla -->
            <thead>
                    <tr>
                            <th>Archivos</th>
                            <th>&nbsp;</th>
                    </tr>
            </thead>

            <!--	Cuerpo de la tabla con los campos -->
            <tbody>

                    <!-- fila base para clonar (por eso esta oculta) y agregar al final -->
                    <tr class="fila-base">
                            <td><input class="arrayDRF" type="file" name="DigitalResourcesFiles[]"></td>
                            <td class="eliminar">Eliminar</td>
                    </tr>
                    <!-- fin de código: fila base 
                   
                    <!-- Fila de ejemplo -->
                    <tr>
                            <td><input class="arrayDRF" type="file" name="DigitalResourcesFiles[]"></td>
                            <td>&nbsp;</td>
                    </tr>
                    <!--  fin de código: fila de ejemplo -->

            </tbody>
    </table>
    <!-- Botón para agregar filas -->
    <input type="button" id="agregar" value="Agregar fila" />
<?php
    echo '<hr>';
    /***********************************************************************/

    echo $this->Form->input('digital_resource_title', array(
        'label' => 'Título',
        'class' => 'validDigitalResourceTitle'
    ));
    
    echo $this->Form->input('digital_resource_topic', array(
        'type' => 'textarea',
        //'size' => 4,
        'label' => 'Tema', //false
        'required' => false
    ));
    
    echo $this->Form->input('digital_resource_description',array(
        'type' => 'textarea',
        'label' => 'Descripción',
        'class' => 'validDigitalResourceDescription'
    ));
    
    echo $this->Form->input('digital_resource_subjects_description',array(
        'type' => 'textarea',
        'label' => 'Materias o asignaturas',
        'required' => false
    ));
    
    
    echo $this->Form->input('language_id', array(
        'type' => 'select',
        'multiple' => false,
        'label' => 'Idioma',
        'required' => false,
        'empty' => 'Seleccione un idioma',
        'options' => $listLanguage,
    ));
    
    
    echo $this->Form->input('EducationalLevel.educational_level_id', array(
        'type' => 'select',
        'multiple' => 'multiple',
        'size' => 3,
        'label' => 'Nivel(es) Educativos',
        'required' => false,
        //'empty' => 'Seleccione un idioma',
        'options' => $listEducationalLevel,
    ));
    
    
    echo $this->Form->input('Audience.audience_id', array(
        'type' => 'select',
        'multiple' => 'multiple',
        'size' => 3,
        'label' => 'Público a quien va dirigido',
        'required' => false,
        //'empty' => 'Seleccione un idioma',
        'options' => $listAudience
    ));
    
    //    $options=array('0'=>'Option 0','1'=>'Option 1','2'=>'Option 2','3'=>'Option 3');
//    echo $this->Form->input("Model.field",
//        array(
//        'div' => "radio inline",
//        'separator' => '</div><div class="radio inline">',
//            'label' => false,
//        'type' => 'radio',
//        'default'=>0,
//        'legend' => false,
//        'options' => $options
//        )
//    );
    echo $this->Form->input('user_id', array(
        'type' => 'hidden',
        //'value' => $this->Session->read('User.id'),
        'value' => 123456,
    ));
    
    $options = array(
                'label' => 'Registrar',
                'div' => array(
                    'class' => 'submit',
                )
            );

echo $this->Form->end($options);


?>
