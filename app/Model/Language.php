<?php
class Language extends AppModel {
    
    public $name = 'Language';
    public $primaryKey = 'language_id';
    public $displayField = 'language_description';

    public $validate = array(
        'language_id' => array(
            'blank' => array(
                    'rule' => array('blank'),
            ),
        ),
        'language_description' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            /* TODO: Definir expresión regular
             * 'alphaNumeric' => array(
                    'rule' => array('alphaNumeric'),
            ),*/
            'maxLength' => array(
                    'rule' => array('maxLength', 100),
            ),
            'isUnique' => array(
                    'rule' => array('isUnique'),
            ),

        ),
        'language_order' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'naturalNumber' => array(
                'naturalNumber' => array('naturalNumber'),
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