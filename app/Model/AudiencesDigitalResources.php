<?php

class AudiencesDigitalResources extends AppModel{
    
    public $name = 'AudiencesDigitalResources';
    public $primaryKey = 'audience_digital_resource_id';
    
    public $validate = array(
        'audience_digital_resource_id' => array(
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
        'audience_id' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'naturalNumber' => array(
                    'rule' => array('naturalNumber'),
            ),
        ),
    );
    
    public $belongsTo = array(
            'Audience' => array(
                    'className' => 'Audience',
                    'foreignKey' => 'audience_id',
            ),
            'DigitalResource' => array(
                    'className' => 'DigitalResource',
                    'foreignKey' => 'digital_resource_id',
            ),
    );
}
?>
