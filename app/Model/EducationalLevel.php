<?php
class EducationalLevel extends AppModel {
    
    public $name = 'EducationalLevel';
    public $primaryKey = 'educational_level_id';
    public $displayField = 'educational_level_description';

    public $validate = array(
        'educational_level_id' => array(
            'blank' => array(
                    'rule' => array('blank'),
            ),
        ),
        'educational_level_description' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            /*TODO: Definir expresión regular
            'alphaNumeric' => array(
                    'rule' => array('alphaNumeric'),
            ),*/
            'maxLength' => array(
                    'rule' => array('maxLength', 100),
            ),
            'isUnique' => array(
                    'rule' => array('isUnique'),
            ),
        ),
        'educational_level_order' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'naturalNumber' => array(
                'naturalNumber' => array('naturalNumber'),
            ),
        ),
    );

    public $hasMany = array(
        'DigitalResourcesEducationalLevels' => array(
            'className' => 'DigitalResourcesEducationalLevels',
            'foreignKey' => 'educational_level_id'
        ),
    );
}