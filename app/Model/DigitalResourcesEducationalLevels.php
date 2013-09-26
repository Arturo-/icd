<?php

class DigitalResourcesEducationalLevels extends AppModel{
    
    public $name = 'DigitalResourcesEducationalLevels';
    public $primaryKey = 'digital_resource_educational_level_id';
    
    public $validate = array(
        'digital_resource_educational_level_id' => array(
            'blank' => array(
                    'rule' => array('blank'),
            ),
        ),
        'educational_level_id' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'naturalNumber' => array(
                    'rule' => array('naturalNumber'),
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
    );
    
     public $belongsTo = array(
            'EducationalLevel' => array(
                    'className' => 'EducationalLevel',
                    'foreignKey' => 'educational_level_id',
            ),
            'DigitalResource' => array(
                    'className' => 'DigitalResource',
                    'foreignKey' => 'digital_resource_id',
            ),
    );
     
}
?>
