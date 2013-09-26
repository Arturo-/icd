<?php

class Audience extends AppModel {
    
    public $name = 'Audience';
    public $primaryKey = 'audience_id';
    public $displayField = 'audience_description';

    public $validate = array(
            'audience_id' => array(
                'blank' => array(
                        'rule' => array('blank'),
                ),
            ),
            'audience_description' => array(
                'notEmpty' => array(
                        'rule' => array('notEmpty'),
                ),
                /*TODO: Cambiar por expresión regular
                 * 'alphaNumeric' => array(
                        'rule' => array('alphaNumeric'),
                ),
                */
                'maxLength' => array(
                        'rule' => array('maxLength', 100),
                ),
                'isUnique' => array(
                        'rule' => array('isUnique'),
                ),
            ),
            'audience_order' => array(
                'notEmpty' => array(
                        'rule' => array('notEmpty'),
                ),
                'naturalNumber' => array(
                    'naturalNumber' => array('naturalNumber'),
                ),
            ),
    );

    public $hasMany = array(
            'AudiencesDigitalResources' => array(
                    'className' => 'AudiencesDigitalResources',
                    'foreignKey' => 'audience_id'
            )
    );
}
?>
