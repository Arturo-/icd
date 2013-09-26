<?php

class DigitalResourceViewDataComponent extends Component{
    
    public function __construct() {

        $this->Language            = ClassRegistry::init('Language');
        $this->EducationalLevel    = ClassRegistry::init('EducationalLevel');
        $this->Audience            = ClassRegistry::init('Audience');

    }

    
    public function loadAddData(){

        $listLanguage           = $this->Language->find('list');
        $listEducationalLevel   = $this->EducationalLevel->find('list');
        $listAudience           = $this->Audience->find('list');
//        $listMajor            = $this->Major->find('all',  array(
//                                        'order' => array(
//                                            'Major.major_description' => 'ASC'),
//                                         'recursive' => -1
//                                 ));
        
        return array($listLanguage, $listEducationalLevel, $listAudience);

    }
}
?>
