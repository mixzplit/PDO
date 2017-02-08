<?php 
/**
* @package Conexion PDO
* Clase sencilla y basica para conexion a Base de Datos usando
* la libreria PDO de PHP para conexiones MySQL, PostgreSQL, Informix
* entre otros. Usamos un archivo .ini donde se agregaran los datos
* de la conexion
* @link Github: https://github.com/mixzplit
* @link Packagist: https://packagist.org/packages/mixzplit/
* @author David Acurero
* @version 0.1
*/

class Conexion extends PDO{
   private $tipo_de_base;
   private $host;
   private $server;
   private $protocol;
   private $nombre_de_base;
   private $usuario;
   private $contrasena;
   private $puerto;
   private $EnableScrollableCursors;

   private $_conexion = NULL;
   private $archivo;
   
   public function __construct() {

      $options = array(
         PDO::ATTR_PERSISTENT => true,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );


      $this->archivo = 'ini/conf.ini.php';
      if (!$ajustes = parse_ini_file($this->archivo, true)){
        throw new Exception ('No se puede abrir el archivo ' . $this->archivo . '.');
      } 
      $this->configIfx($ajustes); //Configurar Informix

      try{
         if($this->tipo_de_base == 'mysql'){
            parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena, $options);
         }
         if($this->tipo_de_base == 'informix') {
            parent::__construct($this->tipo_de_base.':host='.$this->host.';service='.$this->puerto.';database='.$this->nombre_de_base.';server='.$this->server.';protocol='.$this->protocol.';EnableScrollableCursors=1', $this->usuario, $this->contrasena, $options);
         }
         if($this->tipo_de_base == 'pgsql'){
            parent::__construct($this->tipo_de_base.':host='.$this->host.';port='.$this->puerto.';dbname='.$this->nombre_de_base.';user='.$this->usuario.';password='.$this->contrasena);
         }
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   }
   /**
   * Configuracion Informix
   * @param ajustes => archivo parseado
   */
   private function configIfx($ajustes)
   {

      $this->tipo_de_base = $ajustes["informix"]["driver"];
      $this->host = $ajustes["informix"]["host"];
      $this->puerto = $ajustes["informix"]["service"]; //Puerto de la BD
      $this->nombre_de_base = $ajustes["informix"]["database"];
      $this->server = $ajustes["informix"]["server"];
      $this->protocol = $ajustes["informix"]["protocol"];
      $this->EnableScrollableCursors = $ajustes["informix"]["EnableScrollableCursors"];
      $this->usuario = $ajustes["informix"]["username"];
      $this->contrasena = $ajustes["informix"]["password"];

   }
   /**
   * Configuracion MySQL
   * @param ajustes => archivo parseado
   */
   private function configMysql($ajustes)
   {

      $this->tipo_de_base = $ajustes["mysql"]["driver"];
      $this->host = $ajustes["mysql"]["host"];
      $this->puerto = $ajustes["mysql"]["port"]; //Puerto de la BD
      $this->nombre_de_base = $ajustes["mysql"]["database"];
      $this->usuario = $ajustes["mysql"]["username"];
      $this->contrasena = $ajustes["mysql"]["password"];

   }
   /**
   * Configuracion PostgreSQL
   * @param ajustes => archivo parseado
   */
   private function configPgsql($ajustes)
   {
      $this->tipo_de_base = $ajustes["pgsql"]["driver"];
      $this->host = $ajustes["pgsql"]["host"];
      $this->puerto = $ajustes["pgsql"]["port"]; //Puerto de la BD
      $this->nombre_de_base = $ajustes["pgsql"]["database"];
      $this->usuario = $ajustes["pgsql"]["username"];
      $this->contrasena = $ajustes["pgsql"]["password"];
   }


} //End Class

 ?>