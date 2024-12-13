<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include 'includes/commons.inc.php';

require_once(PD_PLUGINS_DIR.'api/pw_api/security.php');

require_once(PD_PLUGINS_DIR.'api/pw_api/pw_common.php');

require_once(PD_PLUGINS_DIR.'api/pw_api/class_base.php');

$api = new api_client();

$response = $api->run($_POST + $_GET);

if ($response) {
	echo $api->dataFormat($response);
}

?>