<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('max_input_time', 3000);
ini_set('max_execution_time', 3000);
ini_set('memory_limit', '640M');

$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);     
echo "<br /><br />";
echo $externalIp = $m[1];                                                          
echo "<br /><br />";

function direccionMACServidor(){
  exec('netstat -ie', $result);
  echo "<br /><br />";
  print_r($result);
  echo "<br /><br />";
   if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
      if($key > 0) {
        $tmp = str_replace(" ", "", substr($line, 0, 10));
        if($tmp <> "") {
          
          $macpos = strpos($line, "HWaddr");
          if($macpos !== false) {
            $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
          }else{
            $macpos = strpos($line, "ether");
            if($macpos !== false) {
              $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+6, 17)));
            }
          }
          
        }
      }
    }
    return $iface[0]['mac'];
  } else {
    return "notfound";                     
  }
}
echo direccionMACServidor();
echo "<br /><br />";
 
 
$mac = system('arp -an');
echo $mac;
echo "<br /><br />";



$mac = system("ifconfig -a ");
echo $mac;
echo "<br /><br />";