<?php

class ApiView{

    function response($data, $code = 200){ // si no viene con codigo de error se le pone el 200 

        //devolver json
        header("Content-type: application/json");
        header("HTTP/1.1 " . $code . " " . $this->_requestStatus($code));
        echo json_encode($data);
        
    }
    
    function _requestStatus($code){
        $status = array(
            200 => "OK",
            404 => "Not Found",
            500 => "Internal Server Error"
        );
        return (isset($status[$code]))? $status[$code] : $status[500];
    }


}
