<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body>
<?php
	
	//List extension
    $arrExt = array(".php",".html");
    
    $lstExt = explode('|',$arrExt);
    define("LST_EXTENSION_LOOK_FOR", $lstExt);
	//Formulaire
	
	//Parcours tous les fichiers et remplis un array
	// echo "<pre>";
	// print_r($_SERVER);
	// echo "</pre>";
	
	$resultFiles = array();
	$resultFiles2 = array();
	
	$arrDir = explode("/",$_SERVER['SCRIPT_FILENAME']);
	$nomFile = end($arrDir);
	$dirToSearch = str_replace($nomFile,"",$_SERVER['SCRIPT_FILENAME']);
	
	sRecursif($dirToSearch, $arrExt, $resultFiles2);
	
	echo "Recherche trouvé dans ces fichiers : <br/>";
	echo "<pre>";
	print_r($resultFiles2);
	echo "</pre>";
	
	function sRecursif($path, $exts, &$res){
		if ($handle = opendir($path)) {
			while (false !== ($entry = readdir($handle))) {
				if($entry != '.' && $entry != '..'){
					$allPFile = $path.$entry;
					if(file_exists($allPFile)){
						if(is_dir($allPFile)){
							//If is Dir
							sRecursif($allPFile.'/', $exts, $res);
						}else{
							//If is file
							if(preg_match('/'.LST_EXTENSION_LOOK_FOR.'$/', $allPFile)){
								if(strpos(file_get_contents($allPFile),$_GET['w']) !== false) {
									$res[] = $allPFile;
								}
							}
						}
					}
				}
			}
			closedir($handle);
		}
	}
	
	function no2($nomFile){
		if ($handle = opendir($nomFile)) {
			echo "Gestionnaire du dossier : $handle\n";
			echo "Entrées :\n";
			while (false !== ($entry = readdir($handle))) {
				// $allPFile = $dirToSearch.$entry;
				echo "$entry\n";
				// if( strpos(file_get_contents($allPFile),$_GET['w']) !== false) {
					// $resultFiles[] = $dirToSearch.$entry;
				// }
			}
			closedir($handle);
		}
	/*
		echo "Nom : ".$nomFile;
		echo "</br>";
	*/
	}

?>
</body>
</html>