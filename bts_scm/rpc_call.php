<?php
//curl --user user1647593239:pass7e6b0d8e6e6af354d69b0a4c4f90226aff7f48aaea912e7d5b4780ae759bcabab3 --data-binary '{"jsonrpc": "1.0", "id":"curltest", "method": "getwalletinfo", "params": [] }' -H 'content-type: text/plain;' http://127.0.0.1:9732/


if (isset($_POST['get_wallet_bal'])) {
		if(isset($_POST['nodeAddress'])){
			$nodeAddress = $_POST['nodeAddress'];
			$url = 'http://'.$nodeAddress.'/';
		}
        getReceivedByAddressInfo($_POST['get_wallet_bal'],$url);
}
elseif (isset($_POST['get_wallet_info'])) {
	if(isset($_POST['nodeAddress'])){
			$nodeAddress = $_POST['nodeAddress'];
			$url = 'http://'.$nodeAddress.'/';
		}
        getInfo($url);
}
elseif (isset($_POST['send_address_bal'])) {
	if(isset($_POST['nodeAddress'])){
			$nodeAddress = $_POST['nodeAddress'];
			$url = 'http://'.$nodeAddress.'/';
		}
        sendToAddress($_POST['send_address_bal'],$url);
}



function getInfo($url){
$data = array("jsonrpc" => "1.0", "id" => "curltest","method" => "method", "params"=> "[]");                                                                    
$data_string="{\"jsonrpc\":\"1.0\",\"id\":\"gettingwalletinfo\",\"method\":\"getwalletinfo\",\"params\":[]}";
//json_encode($data);                                                             
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, "user1647593239" . ":" . "pass7e6b0d8e6e6af354d69b0a4c4f90226aff7f48aaea912e7d5b4780ae759bcabab3");                                                     
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
//$result= json_encode($result);
$chain_info="No Wallet Information Available";
$response = json_decode($result,true);
foreach($response as $k=>$v){
	if($k == "result"){
		$chain_info = $v;
	}
}
echo "<div>";
echo "<p>Wallet_Version: ".$chain_info["walletversion"]."</p>";
echo "<p>Balance: ".$chain_info["balance"]."</p>";
echo "<p>Unconfirmed_Balance: ".$chain_info["unconfirmed_balance"]."</p>";
echo "<p>Immature_Balance: ".$chain_info["immature_balance"]."</p>";
echo "<p>TxCount: ".$chain_info["txcount"]."</p>";
echo "<p>Keypoololdest: ".$chain_info["keypoololdest"]."</p>";
echo "<p>Keypoolsize: ".$chain_info["keypoolsize"]."</p>";
echo "<p>Paytxfee: ".$chain_info["paytxfee"]."</p>";
echo "<p>Seedfp: ".$chain_info["seedfp"]."</p>";
echo "</div>";
}


function getReceivedByAddressInfo($address,$url){
//$data = array("jsonrpc" => "1.0", "id" => "curltest","method" => "method", "params"=> "[]");                                                                    
$data_string="{\"jsonrpc\":\"1.0\",\"id\":\"curltest\",\"method\":\"getreceivedbyaddress\",\"params\":[".$address."] }";
//json_encode($data);                                                             
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, "user1647593239" . ":" . "pass7e6b0d8e6e6af354d69b0a4c4f90226aff7f48aaea912e7d5b4780ae759bcabab3");                                                     
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
$response= json_decode($result,true);
$balance = "No Balance";
foreach($response as $k=>$v){
	if($k == "result"){
		$balance = $v;
	}
}
echo $balance;
}

//curl --user myrpcuser:myrpcpassword --data-binary '{"jsonrpc": "1.0", "id":"curltest", "method": "sendtoaddress", "params": ["RBtNBJjWKVKPFG4To5Yce9TWWmc2AenzfZ", 0.1, "donation", "seans outpost"] }' -H 'content-type: text/plain;' http://127.0.0.1:myrpcport/

function sendToAddress($address_amount,$url){
//$data = array("jsonrpc" => "1.0", "id" => "curltest","method" => "method", "params"=> "[]");                                                                    
$data_string="{\"jsonrpc\":\"1.0\",\"id\":\"curltest\",\"method\":\"sendtoaddress\",\"params\":[".$address_amount."] }";
//json_encode($data);                                                             
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, "user1647593239" . ":" . "pass7e6b0d8e6e6af354d69b0a4c4f90226aff7f48aaea912e7d5b4780ae759bcabab3");                                                     
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
$response= json_decode($result,true);
$transaction = "No Transaction";
foreach($response as $k=>$v){
	if($k == "result"){
		$transaction = $v;
	}
}
echo $transaction;
}

?>