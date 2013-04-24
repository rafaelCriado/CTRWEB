<?php
	/* Classe Abstrata BD */
	abstract class bd {
		protected $_bd = "mysql";  // mysql, mysqli, postgresql, oracle
		protected $_bdtype = 0;  // 0=MySQL, 1=PostgreSQL, 2 = mysqli, 3 = oracle
		protected $_connection = NULL;
		protected $_affected_rows = 0;
		protected $_servidor = "localhost";
		protected $_bdname = NULL;
		protected $_usuario = "root";
		protected $_senha = "";
		protected $_porta = NULL;
		protected $_extras = NULL;
		protected $_last_error = -1;
		
		/* Funções abstratas */
		abstract protected function setAffectedRows();
		/* Fim das funções abstratas */
				
		/* Contrutor */
		function __construct($_bdtype="mysql",$_srv="",$_port="",$_bd="",$_usr="",$_pwd="",$_extras="") {
			$_bdtype = strtolower($_bdtype);
			if($_bdtype!="mysql"&&$_bdtype!="postgresql"&&$_bdtype!="mysqli"&&$_bdtype!="oracle") {
				return FALSE;
			}
			$this->_bd = $_bdtype;	
			
			switch($_bdtype) {
				case 'mysql':		$this->_bdtype = 0;
									break;
				case 'postgresql':	$this->_bdtype = 1;
									break;
				case 'mysqli':		$this->_bdtype = 2;
				
				case 'oracle':		$this->_bdtype = 3;

			}				 
			if($_srv!="") {
				// banco, usuario devem ser informados tb...
				if($_bd!=""&&$_usr!="") {
					$_r = $this->conecta($_srv,$_port,$_bd,$_usr,$_pwd,$_extras);
					if($_r===FALSE) {
						return FALSE;
					}
				}
			} 
		}
		
		/* Funções privativas */
		/* Funções protegidas */		

		/* Funções Públicas */		
		public function conecta($_srv="",$_port="",$_bd="",$_usr="",$_pwd="",$_extras="") {
			if($this->_connection!==NULL) {
				return FALSE;
			}
			if($_srv!="") {
				// banco, usuario devem ser informados tb...
				if($_bd!=""&&$_usr!="") {
					$this->setServidor($_srv);
					$this->setPorta($_port);
					$this->setbd($_bd);
					$this->setusuario($_usr);
					$this->setsenha($_pwd);
					$this->setExtras($_extras);
				}
			}
			if($this->_bdtype===NULL||$this->_servidor==NULL||($this->_bdname==NULL && $this->_bdtype!=3)) { 
				return FALSE;
			} else {									
				switch($this->_bdtype) {
					case 0: // mysql
							if(is_int($this->_porta)) {
								$_s = "{$this->_servidor}:{$this->_porta}";
							} else {
								$_s = $this->_servidor;
							}
							if($this->_extras!=NULL) {
								$this->_connection = @mysql_connect($_s,$this->_usuario,$this->_senha,TRUE,$this->_extras);
							} else {
								$this->_connection = @mysql_connect($_s,$this->_usuario,$this->_senha);
							}
							if($this->_connection!==FALSE) {
								// seleciona o BD
								$_r = mysql_select_db($this->_bdname,$this->_connection);
								if($_r===FALSE) {
									$this->_last_error = mysql_error($this->_connection);
									return FALSE;
								}
							} else {
								$this->_connection = NULL;
								return FALSE;
							}
							break;
					case 1:	// postgresql 
							$_strcon = "host={$this->_servidor} ";
							$_strcon.= "dbname={$this->_bdname} ";
							$_strcon.= "user={$this->_usuario} ";
							if($this->_senha!=NULL&&$this->_senha!="") {
								$_strcon.= "password={$this->_senha} ";
							}
							if(is_int($this->_porta)) {
								$_strcon.= "port={$this->_porta} ";
							}
							if($this->_extras!=NULL) {
								$_strcon.= "options={$this->_extras} ";
							}	   				  
							$this->_connection = pg_connect($_strcon);
							if($this->_connection===FALSE) {
								$this->_connection = NULL;
								return FALSE;
							}
							break;
					case 2:	// mysqli
							$this->_connection = new mysqli($this->_servidor,$this->_usuario,$this->_senha,$this->_bdname,$this->_porta);
							if($this->_connection===FALSE) {
								$this->_connection = NULL;
								$this->_last_error = mysqli_connect_error();
								return FALSE;
							}
							break;
					
					case 3: //oracle
						$this->_connection = oci_connect($this->_usuario, $this->_senha, $this->_porta);
						if ($this->_connection === FALSE) {
							$erro_connection = NULL; 
							$this->_last_error = oci_error();
							exit;
						}
				}
			}
		}
			
		public function setServidor($_srv) {
			$this->_servidor = $_srv;
		}
		
		public function setPorta($_port) {
			$this->_porta = $_port;
		}
		
		public function setbd($_bd) {
			$this->_bdname = $_bd;
		}
		
		public function setUsuario($_usr) {
			$this->_usuario = $_usr;
		}
		
		public function setSenha($_pwd) {
			$this->_senha = $_pwd;
		}
		
		public function setExtras($_extras) {
			$this->_extras = $_extras;
		}
		
		public function printBD() {
			return Array(	"tipo_banco"=>$this->_bd,
							"servidor"=>$this->_servidor,
							"porta"=>$this->_porta,
							"banco"=>$this->_bdname,
							"usuario"=>$this->_usuario,
							"extras"=>$this->_extras
						);
		}
		
		public function getConnection() {
			return $this->_connection;
		}
		
		public function getAffectedRows() {
			return $this->_affected_rows;
		}
		
		public function getLastError() {
			return $this->_last_error;
		}
		
		public function close() {
			if($this->_connection===NULL) {
				return FALSE;
			}
			switch($this->_bdtype) {
				case 0: mysql_close($this->_connection);
						break;
				case 1:	pg_close($this->_connection);
						break;
				case 2:	$this->_connection->close();
						break;
				case 3:	oci_close($this->_connection);
			}
		}
		/* Fim das funções públicas */
	}
	/* Fim da Classe BD */
	


	/* Classe Consulta */	
	class consulta extends bd {
		protected $_res = NULL;
		protected $_sql = "";
		protected $_dados = Array();
		protected $_tipo_res = 0; // 0 - array, 1 - objeto
		protected $_num_rows = -1;
		private $_atual = -1;
		
		// Construtor da classe
		function __construct($_bdtype="mysql",$_srv="",$_port="",$_bd="",$_usr="",$_pwd="",$_extras="", $_sql="") {
			parent::__construct($_bdtype,$_srv,$_port,$_bd,$_usr,$_pwd,$_extras);
			if($_sql!="") {
				$this->executa($_sql);
			}
		}
							   
		/* Funções privativas */
		private function moveponteiro($_ponteiro) {
			switch($this->_bdtype) {
				case 0:	$_r = mysql_data_seek($this->_res,$_ponteiro);
						break;
				case 1:	$_r = pg_result_seek($this->_res,$_ponteiro);
						break;
				case 2:	$_r = $this->_res->data_seek($_ponteiro);
						break;
				case 3:	$_r = oci_result($this->_res,$_ponteiro);
						break;
			}
			if($_r!==FALSE) {
				$this->_atual = $_ponteiro;
			} else {
				return FALSE;
			}
		}
		/* Fim das funções privativas */

		/* Funções protegidas */
		protected function setAffectedRows() {
			switch($this->_bdtype) {
				case 0: $this->_affected_rows = mysql_affected_rows($this->_connection);
						break;
				case 1: $this->_affected_rows = pg_affected_rows($this->_res);
						break;
				case 2:	$this->_affected_rows = $this->_connection->affected_rows;
						break;
				case 3:	$this->_affected_rows = oci_num_rows($this->_res);
						break;
			}
		}
		
		protected function setNumRows() {
			if($this->_res==NULL) {
				
				return FALSE;
			}
			switch($this->_bdtype) {
				case 0:	$this->_num_rows = mysql_num_rows($this->_res);
						break;
				case 1:	$this->_num_rows = pg_num_rows($this->_res);
						break;
				case 2:	$this->_num_rows = $this->_res->num_rows; 
						break;
				case 3:	$this->_num_rows = oci_num_rows($this->_res); 
						break;
			}			
		}
		
		protected function preenche() {
			if($this->_res==NULL||$this->_num_rows<=0) {
				return FALSE;
			}	
			switch($this->_bdtype) {
				case 0:	if($this->_tipo_res==0) {
							$this->_dados = mysql_fetch_assoc($this->_res);
						} else {
							$this->_dados = mysql_fetch_object($this->_res);
						}
						break;
				case 1:	if($this->_tipo_res==0) {
							$this->_dados = pg_fetch_assoc($this->_res);
						} else {
							$this->_dados = pg_fetch_object($this->_res);
						}
						break;
				case 2:	if($this->_tipo_res==0) {
							$this->_dados = $this->_res->fetch_assoc();
						} else {
							$this->_dados = $this->_res->fetch_object();
						}
						break;
				case 3:	if($this->_tipo_res==0) {
							$this->_dados = oci_fetch_assoc($this->_res);
						} else {
							$this->_dados = oci_fetch_object($this->_res);
						}
						break;
			}
			
			if($this->_dados!==FALSE) {
				$this->_atual++;
				if($this->_atual>$this->_num_rows-1) {
					$this->_atual = $this->_num_rows-1;
				}
			}
		}
		/* Fim das funções protegidas */
		
		/* Funções Publicas */
		public function setTipo($_tipo) {
			if($_tipo==0||$_tipo==1) {
				$this->_tipo_res = $_tipo;
			} else { 
				return FALSE;
			}				 
		}
		
		public function setSQL($_sql) {
			$this->_sql = $_sql;
		}
		
		public function getSQL() {
			return $this->_sql;
		} 
		
		public function getAtual() {
			return $this->_atual;
		}
		
		public function executa($_sql="",$_tipo_res=NULL) {
			if($this->_connection === NULL) {
				return FALSE;
			}
			
			if($_sql!="") {
				$this->setSQL($_sql);
			}
			
			if($this->_sql==""||$this->_sql==NULL) {
				return FALSE;
			}
			
			switch($this->_bdtype) {
				case 0: $this->_res = @mysql_query($this->_sql,$this->_connection);
						break;
				case 1:	$this->_res = @pg_query($this->_connection,$this->_sql);
						break;
				case 2:	$this->_res = @$this->_connection->query($this->_sql);
						break;
				case 3:	$xe = @oci_parse($this->_connection, $this->_sql);
						$this->_res = @oci_execute($xe);
						break;
			}
			if($this->_res!==FALSE) {
				if($_tipo_res!==NULL) {
					$this->setTipo($_tipo_res);
				}																
				$_tipo = strtolower(substr($this->_sql,0,strpos($this->_sql," ")));	 
				if($_tipo=="select"||$_tipo=="describe"||$_tipo=="show"||$_tipo=="explain") {
					
					$this->setNumRows();
					
					$this->primeiro();
					
				} else {   
				
					$this->setAffectedRows();
				}
			} else {
				return FALSE;
			}
		}
		
		
		public function getNumRows() {
			return $this->_num_rows;
		}
		
		public function primeiro() {
			if($this->_res==NULL||$this->_num_rows<=0) {
				return FALSE;
			}
			if($this->moveponteiro(0)===FALSE) {
				return FALSE;
			}
		}
		
		public function ultimo() {
			if($this->_res==NULL||$this->_num_rows<=0) {
				return FALSE;
			}
			if($this->moveponteiro($this->_num_rows-1)===FALSE) {
				return FALSE;
			}
		}
		
		public function proximo() {
			if($this->_res==NULL||$this->_atual>=$this->_num_rows) {
				return FALSE;
			}
			if($this->moveponteiro($this->_atual+1)===FALSE) {
				return FALSE;
			}
		}
		
		public function anterior() {
			if($this->_res==NULL||$this->_atual<=0) {
				return FALSE;
			}
			if($this->moveponteiro($this->_atual-1)===FALSE) {
				return FALSE;
			}
		}
		
		public function navega($_reg) {
			if($this->_res==NULL||$this->_reg<0||$this->_reg>=$this->_num_rows) {
				return FALSE;
			}
			if($this->moveponteiro($_reg)===FALSE) {
				return FALSE;
			}
		}
		
		public function getDados() {
			if($this->preenche()===FALSE) { 
				return FALSE;
			}
			if(is_array($this->_dados)||is_object($this->_dados)) {
				return $this->_dados;
			} else {
				return FALSE;
			}
		}
		/* Fim das funções publicas */
	}
	/* Fim da classe Consulta */
?>