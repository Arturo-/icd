<?php

class DigitalResource extends AppModel{
    
    public $name = 'DigitalResource';
    public $primaryKey = 'digital_resource_id';
    
    public $validate = array(
        'digital_resource_id' => array(
            'blank' => array(
                    'rule' => array('blank'),
            ),
        ),
        'user_id' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'naturalNumber' => array(
                    'rule' => array('naturalNumber'),
            ),
        ),
        'language_id' => array(
            'naturalNumber' => array(
                    'rule' => array('naturalNumber'),
                    'allowEmpty' => true
            ),
        ),
        'digital_resource_type' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 1),
            ),
            
        ),
        'digital_resource_title' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
//            'alphaNumeric' => array(
//                'rule' => array('alphaNumeric'),
//            ),
            'maxLength' => array(
                'rule' => array('maxLength', 500),
            ),
        ),
        'digital_resource_topic' => array(
            
//            'alphaNumeric' => array(
//                'rule' => array('alphaNumeric'),
//            ),
            'maxLength' => array(
                'rule' => array('maxLength', 300),
            ),
        ),
        'digital_resource_description' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            
//            'alphaNumeric' => array(
//                'rule' => array('alphaNumeric'),
//            ),
            'maxLength' => array(
                'rule' => array('maxLength', 800),
            ),
        ),
        'digital_resource_subjects_description' => array(
            
//            'alphaNumeric' => array(
//                'rule' => array('alphaNumeric'),
//            ),
            'maxLength' => array(
                'rule' => array('maxLength', 500),
            ),
        ),
        'digital_resource_url' => array(
            'url' => array(
                'rule' => array('url'),
                'allowEmpty' => true
            ),
        ),
        'digital_resource_record_date' => array(
//           'blank' => array(
//                    'rule' => array('blank'),
//            ),
        ),
        
    );
    
    public $hasMany = array(
        'DigitalResourcesEducationalLevels' => array(
            'className' => 'DigitalResourcesEducationalLevels',
            'foreignKey' => 'digital_resource_id',
            'dependent' => false,
        ),
        'AudiencesDigitalResources' => array(
            'className' => 'AudiencesDigitalResources',
            'foreignKey' => 'digital_resource_id',
            'dependent' => false,
        ),
        'DigitalResourcesFiles' => array(
            'className' => 'DigitalResourcesFiles',
            'foreignKey' => 'digital_resource_id',
            'dependent' => false,
        ),
    );
    
    public $hasOne =  array(
        'Language' => array(
            'className' => 'Language',
            'foreignKey' => 'language_id',
            'dependent' => false,
        ),
    );
    
    public $belongsTo = array(
        'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'user_id',
        ),
    );
}


?>
