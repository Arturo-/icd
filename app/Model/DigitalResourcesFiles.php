<?php

class DigitalResourcesFiles extends AppModel{
    public $name = 'DigitalResourcesFiles';
    public $primaryKey = 'digital_resource_file_id';
    
    public $validate = array(
         'digital_resource_file_id' => array(
            'blank' => array(
                    'rule' => array('blank'),
            ),
        ),
        'digital_resource_id' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'naturalNumber' => array(
                    'rule' => array('naturalNumber'),
            ),
        ),
        'digital_resource_file_name' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            
//            'alphaNumeric' => array(
//                'rule' => array('alphaNumeric'),
//            ),
            'maxLength' => array(
                'rule' => array('maxLength', 50),
            ),
        ),
    );
    
    public $belongsTo = array(
        'DigitalResource' => array(
                    'className' => 'DigitalResource',
                    'foreignKey' => 'digital_resource_id',
        ),
    );
    
}

?>
