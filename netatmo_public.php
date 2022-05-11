<?
sdk_header('text/xml');

$username = getArg('username', true);
$password = getArg('password', true);
$clientId = getArg('clientid', true);
$clientSecret = getArg('clientsecret', true);
// le type peut être 'temperature'
$type = getArg('type', true);
// les coordonnées sous la forme "lat_ne;lon_ne;lat_sw;lon_sw"
// e.g. "43.596602;3.941438;43.576154;3.903615"
list($lat_ne, $lon_ne, $lat_sw, $lon_sw) = explode(";", getArg('coord', true));

// restitution du résultat au format xml
function sdk_showResult($systemState, $error=null) {
  // on écrit le contenu du XML retourné
  echo "<root>";
  echo "  <netatmo_public>";
  echo "    <data>";
  echo "      <summary>"
  echo "        <temperature>10</temperature>"
  echo "      </summary>"
  echo "    </data>";
  echo "  </netatmo_public>";
  echo "</root>";
}

// on regarde si on a un refresh_token
$refreshToken = loadVariable("refresh_token");
$accessToken = null;
if (!$refreshToken) {
  // si non, on le récupère
  $resStr = httpQuery("https://api.netatmo.com/oauth2/token", "POST", "grant_type=password&client_id=".$clientId."&client_secret=".$clientSecret."&username=".rawurlencode($username)."&password=".rawurlencode($password), null, array("Content-Type: application/x-www-form-urlencoded"));
  echo $resStr."<br>";
  $res = sdk_json_decode($resStr, true);
  if (!isset($res['refresh_token'])) {
    return sdk_showResult(null, "Impossible de retrouver le refresh_token : ".$resStr);
  }
  if (!isset($res['access_token'])) {
    return sdk_showResult(null, "Impossible de retrouver le access_token : ".$resStr);
  }

  $accessToken = $res['access_token']
  $refreshToken = $res['refresh_token'];
  // on le sauvegarde pour plus tard
  saveVariable("refresh_token", $refreshToken);
} else {
  // on récupère un token
  $resStr = httpQuery("https://api.netatmo.com/oauth2/token", "POST", "grant_type=refresh_token&client_id=".$clientId."&client_secret=".$clientSecret."&refresh_token=".$refreshToken, null, array("Content-Type: application/x-www-form-urlencoded"));
  echo $resStr."<br>";
  $res = sdk_json_decode($resStr, true);
  if (!isset($res['access_token'])) {
    return sdk_showResult(null, "Impossible de retrouver le access_token : ".$resStr);
  }
  $accessToken = $res['access_token'];
}

// on interroge netatmo
$resStr = httpQuery("https://api.netatmo.com/api/getpublicdata?access_token=".$accessToken."&lat_ne=".$lat_ne."&lon_ne=".$lon_ne."&lat_sw=".$lat_sw."&lon_sw=".$lon_sw."&filter=true&required_data=temperature");
echo $resStr;
?>
