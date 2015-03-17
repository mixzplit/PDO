<?php
//CLASE PARA CONEXION
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
            }
            if ($param1!='') {
              $query.= $param1;
            }
            if($param2!=''){
              $query.= " AND ".$param2;
            }
            if($param3!=''){
              $query.= " AND ". $param3;
            }
            if($param4!=''){
              $query.= " AND ". $param4;
            }
            if($param5!=''){
              $query.= " AND ". $param5;
            }
            echo $query;  
            $result = PDO::prepare($query);
            $result->execute();
            return $result->fetchColumn();
        } catch (PDOException $e) {
           echo "Error" . $e->getMessage();     
        }      
    }

 } 


?>