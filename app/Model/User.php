<?php

class User extends AppModel {
    
    public $name = 'User';
    public $primaryKey = 'user_id';
    public $displayField = 'user_email_address';

    public $validate = array(
        'user_id' => array(
            'blank' => array(
                    'rule' => array('blank'),
            ),
        ),
        'user_name' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            /* TODO: Definir expresión regular
             * 'alphaNumeric' => array(
                    'rule' => array('alphaNumeric'),
            ),*/
            'maxLength' => array(
                    'rule' => array('maxLength', 30),
            ),
        ),
        'user_first_surname' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            /* TODO: Definir expresión regular
             * 'alphaNumeric' => array(
                    'rule' => array('alphaNumeric'),
            ),*/
            'maxLength' => array(
                    'rule' => array('maxLength', 30),
            ),
        ),
        'user_first_surname' => array(
            /* TODO: Definir expresión regular
             * 'alphaNumeric' => array(
                    'rule' => array('alphaNumeric'),
            ),*/
            'maxLength' => array(
                    'rule' => array('maxLength', 30),
            ),
        ),
        'user_email_address' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            'email' => 'email',
            'isUnique' => array(
                    'rule' => array('isUnique'),
            ),
        ),
        'user_password' => array(
            'notEmpty' => array(
                    'rule' => array('notEmpty'),
            ),
            /* TODO: Definir expresión regular
             * 'alphaNumeric' => array(
                    'rule' => array('alphaNumeric'),
            ),*/
            'maxLength' => array(
                    'rule' => array('maxLength', 64),
            ),
        ),
        'user_phone_number' => array(
            'alphanumerico'   => array(
                    'rule'       => array('custom', '/^[\d\-\+\(\)\s]+$/'),
                    'required'   => false,
                    'allowEmpty' => true,
                    'message'    => "El teléfono permite ingresar únicamente números, espacios y los siguinetes caracteres [ - , +, () ]. Por favor ingréselo nuevamente."
                    ),
            'between' => array(
                    'rule'    => array('between', 0, 20),
                    'message' => "El teléfono requiere ingresar una cadena entre 2 y 20 caracteres. Por favor ingréselo nuevamente."
                    )
        ),
        'user_agency' => array(
            'alphanumerico'   => array(
                    'rule'       => array('custom', '/^[a-zñáéíóúäëïöüâêîôûàèìòùãõçÑÁÉÍÓÚÄËÏÖÜÂÊÎÔÛÀÈÌÒÙÃÕÇ\s]+$/i'),
                    'required'   => false,
                    'allowEmpty' => true,
                    'message'    => "La dependencia permite ingresar únicamente letras y espacios. Por favor ingrésela nuevamente."
                    ),
            'between'     => array(
                    'rule'    => array('between', 2, 100),
                    'message' => "La dependencia requiere ingresar una cadena entre 2 y 100 caracteres. Por favor ingrésela nuevamente."
                    )
        ),
        'user_agency_role' => array(
            'alphanumerico'   => array(
                    'rule'       => array('custom', '/^[a-zñáéíóúäëïöüâêîôûàèìòùãõçÑÁÉÍÓÚÄËÏÖÜÂÊÎÔÛÀÈÌÒÙÃÕÇ\d\s]+$/i'),
                    'required'   => false,
                    'allowEmpty' => true,
                    'message'    => "El rol en la institución permite ingresar únicamente letras, números y espacios. Por favor ingréselo nuevamente."
                    ),
            'between'     => array(
                    'rule'    => array('between', 2, 75),
                    'message' => "El rol en la institición requiere ingresar una cadena entre 2 y 75 caracteres. Por favor ingréselo nuevamente."
                    )
        ),
        'user_knowledge_area' => array(
            'alfanumerico'   => array(
                    'rule'       => array('custom', '/^[a-zñáéíóúäëïöüâêîôûàèìòùãõçÑÁÉÍÓÚÄËÏÖÜÂÊÎÔÛÀÈÌÒÙÃÕÇ\d\s]+$/i'),
                    'required'   => false,
                    'allowEmpty' => true,
                    'message'    => "El área permite ingresar únicamente letras, números y espacios. Por favor ingrésela nuevamente."
                    ),
            'between'     => array(
                    'rule'    => array('between', 2, 100),
                    'message' => "El área requiere ingresar una cadena entre 2 y 100 caracteres. Por favor ingrésela nuevamente."
                    )
        ),
    );
}


?>
