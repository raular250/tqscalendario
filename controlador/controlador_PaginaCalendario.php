<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__.'/../model/model_paginaCalendario.php';
$connexio=connectDB();
require_once __DIR__.'/../vista/vista_cabecera.php';

function getRecordatoriosMock($user_id){
    if($user_id==1){
        $recordatorios= array(
            '2021-02-26 10:30' => [['titulo1', 'desc1'], ['titulo2', 'desc2']] ,
            '2021-05-13 08:55' => [['titulo', 'desc']],
            '2021-07-01 23:55' => [['titulo3', 'desc3'], ['titulo4', 'desc4']] ,
            '2021-02-26 11:30' => [['titulo5', 'desc5']],
        );
        ksort($recordatorios);
    }else{
        $recordatorios=array();
    }
    return $recordatorios;
}
function minusAnt($nextRec,$ant){
    //5m,1h,1d,1s
    //Restar a nextRec la anterioridad de $ant;
    if($nextRec!=false){
        $modificacion="";
        switch($ant){
            case '5m':
                $modificacion='- 5 minutes';
                break;
            case '1h':
                $modificacion='- 1 hours';
                break;
            case '1d':
                $modificacion='- 1 days';
                break;
            case '1s':
                $modificacion='- 1 weeks';
                break;
        }
        $nextRec=date('Y-m-d H:i', strtotime($nextRec.$modificacion));
    }
    return $nextRec;
}
function nextRec($ini,$fin,$freq,$ant,$date){
    if(($ini<$fin) and ($date<$fin) ){
        if(is_numeric($freq[0])){    //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,
            // var_dump($freq[strlen($freq)-1]);
            // var_dump(substr($freq,0,-1));
            switch($freq[strlen($freq)-1]){
                case 'D':
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                    }else{
                        $nextRec=$ini;
                        do{
                            $nextRec=date('Y-m-d H:i', strtotime($nextRec. '+ '.substr($freq,0,-1).' days'));
                        }while(minusAnt($nextRec,$ant)<$date);
                    }
                    $nextRec=minusAnt($nextRec,$ant);
                    if($nextRec>$fin){
                        $nextRec=false;
                    }
                    break;
                case 'M':
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                    }else{
                        $nextRec=$ini;
                        do{
                            $nextRec=date('Y-m-d H:i', strtotime($nextRec. '+ '.substr($freq,0,-1).' months'));
                        }while(minusAnt($nextRec,$ant)<$date);
                    }
                    $nextRec=minusAnt($nextRec,$ant);
                    if($nextRec>$fin){
                        $nextRec=false;
                    }
                    break;
                case 'A':
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                    }else{
                        $nextRec=$ini;
                        do{
                            $nextRec=date('Y-m-d H:i', strtotime($nextRec. '+ '.substr($freq,0,-1).' years'));
                        }while(minusAnt($nextRec,$ant)<$date);
                    }
                    $nextRec=minusAnt($nextRec,$ant);
                    if($nextRec>$fin){
                        $nextRec=false;
                    }
                    break;
            }
        }else{
            switch($freq){  //once,daily,L-V",annually
                case "once":
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                        $nextRec=minusAnt($nextRec,$ant);
                    }else{
                        $nextRec=false;
                    }
                    break;
                case "daily":
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                    }else{
                        $nextRec=$ini;
                        do{
                            $nextRec=date('Y-m-d H:i', strtotime($nextRec. '+ 1 days'));
                        }while(minusAnt($nextRec,$ant)<$date);
                    }
                    $nextRec=minusAnt($nextRec,$ant);
                    if($nextRec>$fin){
                        $nextRec=false;
                    }
                    break;
                case "L-V":
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                    }else{
                        $nextRec=$ini;
                        do{
                            $nextRec=date('Y-m-d H:i', strtotime($nextRec. '+ 1 days'));
                            $weekDay=date('w',strtotime($nextRec));
                        }while((minusAnt($nextRec,$ant)<$date) or  $weekDay<1 or $weekDay>5);
                    }
                    $nextRec=minusAnt($nextRec,$ant);
                    if($nextRec>$fin){
                        $nextRec=false;
                    }
                    break;
                case "annually":
                    if(minusAnt($ini,$ant)>$date){
                        $nextRec=$ini;
                    }else{
                        $nextRec=$ini;
                        do{
                            $nextRec=date('Y-m-d H:i', strtotime($nextRec. '+ 1 year'));
                        }while(minusAnt($nextRec,$ant)<$date);
                    }
                    $nextRec=minusAnt($nextRec,$ant);
                    if($nextRec>$fin){
                        $nextRec=false;
                    }
                    break;
            }
        }
    }
    if(!isset($nextRec)){
        $nextRec=false;
    }
    return $nextRec;
}
function getRecordatorios($user_id,$connexio){
    $recordatorios=getRecordatoriosBD($connexio,$user_id);
    $arrayRec=array();
    foreach($recordatorios as $r){
        $titulo=$r[1];
        $ini=$r[2];
        $fin=$r[3];
        $freq=$r[4];
        $ant=$r[5];
        $desc=$r[6];
        $date=date("Y-m-d H:i");
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        if($nextRec!=false){
            if(array_key_exists($nextRec,$arrayRec)){
                // var_dump($arrayRec[$nextRec]);
                // echo "</br></br>";
                // echo "</br></br>";
                array_push($arrayRec[$nextRec],[$titulo,$desc]);
                // var_dump($arrayRec[$nextRec]);
                // echo "</br></br>";
                // echo "</br></br>";
    
            }else{
                $arrayRec[$nextRec]=array(array($titulo,$desc));
            }
        }
    }
    // foreach(array_keys($arrayRec) as $k){
    //     echo "[$k]->";
    //     var_dump($arrayRec[$k]);
    //     echo "</br></br>";
    // }
    if(count($arrayRec) >=1) ksort($arrayRec);

    return $arrayRec;
}
$user_id=(isset($_SESSION['userId'])?$_SESSION['userId']:-1);
$recordatorios=getRecordatorios($user_id,$connexio);

require_once __DIR__.'/../vista/vista_PaginaCalendario.php';

?>