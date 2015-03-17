<?php
//CLASE PARA CONEXION EN PRUEBA
 class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = 'localhost';
   private $nombre_de_base = 'omnix_app';
   private $usuario = 'root';
   private $contrasena = ''; 
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   }

   public function ContarReg($tabla,$param1='',$param2='',$param3='',$param4='',$param5='')
    {
      global $conexionPDO;  
        try {
            $query = "SELECT count(*) FROM ".$tabla;
            if($param1!='' || $param2!='' || $param3!='' || $param4!='' || $param5!=''){
              $query.=" WHERE ";
              #echo $query;
            }
            if ($param1!='') {
              $query.= $param1;
            }
            if($param2!=''){
              $query.= " AND ".$param2;
            }
            if($param3!=''){
              $query.= " AND ". $param3;
              #echo $query;
            }
            if($param4!=''){
              $query.= " AND ". $param4;
              #echo $query;
            }
            if($param5!=''){
              $query.= " AND ". $param5;
              #echo $query;
            }
            echo $query;  
            $result = PDO::prepare($query);
            $result->execute();
            return $result->fetchColumn();




          /*if($param1){
            $query = "SELECT count(*) FROM " .$tabla. " WHERE ".$param1;
            echo $query;
            $result = PDO::prepare($query);
            $result->execute();
            return $result->fetchColumn();
          }elseif($param1 && $param2){
            $query = "SELECT count(*) FROM " .$tabla. " WHERE ".$param1 ." AND ". $param2;
            echo $query;
            $result = PDO::prepare($query);
            $result->execute();
            return $result->fetchColumn();
          }elseif($param1 && $param2 && $param3){
            $query = "SELECT count(*) FROM " .$tabla. " WHERE ". $param1." AND ".$param2. " AND ".$param3;
            echo $query;
            $result = PDO::prepare($query);
            $result->execute();
            return $result->fetchColumn();
          }elseif($param1 && $param2 && $param3 && $param4){
            $query = "SELECT count(*) FROM " .$tabla. " WHERE :param1 AND :param2 AND :param3 AND :param4 ";
            $result = PDO::prepare($query);
            $result->execute(array(':param1'=>$param1,':param2'=>$param2,':param3'=>$param3,':param4'=>$param4));
            return $result->fetchColumn();
          }elseif($param1 && $param2 && $param3 && $param4 && $param5){
            $query = "SELECT count(*) FROM " .$tabla. " WHERE :param1 AND :param2 AND :param3 AND :param4 AND :param5 ";
            $result = PDO::prepare($query);
            $result->execute(array(':param1'=>$param1,':param2'=>$param2,':param3'=>$param3,':param4'=>$param4,':param5'=>$param5));
            return $result->fetchColumn();
          }else{
            $query = "SELECT count(*) FROM ".$tabla;
            $result = PDO::prepare($query);
            $result->execute();
            return $result->fetchColumn();
          }*/

        } catch (PDOException $e) {
           echo "Error" . $e->getMessage();     
        }      

    }

 } 


?>