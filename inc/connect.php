<?PHP
	date_default_timezone_set("Asia/Bangkok");

	class database
	{
		private $host = "localhost";
		private $user = "root";
		private $password = "12345678";
		private $database = "fashion";

		public function connect()
		{
			$mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
				$mysqli->set_charset("utf8");
				if($mysqli->connect_error)
				{
					die("connect error ".$mysqli->connect_error);
				}
			return $mysqli;
		}

	    function close() {
	        mysqli_close($this->connect());
	    }

	}

function DateConvert($Date)
{
	$datecut = explode("/", $Date);
    $dateconv = $datecut[2]."-".$datecut[1]."-".$datecut[0];
    return $dateconv;
}

function DateConvertBase($Date)
{
	$datecut = explode("-", $Date);
    $dateconv = $datecut[2]."/".$datecut[1]."/".$datecut[0];
    return $dateconv;
}

function DateCutTime($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	return "$strDay/$strMonth/$strYear";
}

function DateTime($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("m",strtotime($strDate));
	$strDay= date("d",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	return "$strDay/$strMonth/$strYear $strHour:$strMinute:$strSeconds";
}

?>