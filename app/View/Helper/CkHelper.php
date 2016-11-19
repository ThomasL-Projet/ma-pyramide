<?php 
class CkHelper extends Helper { 

    var $helpers = Array('Html', 'Js'); 

    function load($id) { 
        $did = ''; 
        foreach (explode('.', $id) as $v) { 
            $did .= ucfirst($v); 
        }  

        $code = "var editor = CKEDITOR.replace( '".$did."' );"; 
        return $this->Html->scriptBlock($code);  
    } 
} 
?>