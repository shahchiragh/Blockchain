<?php 
require_once('rpc_call.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blockchian SCM</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js" ></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
     

  </head>
  <div class="header">
    <div class="row">
      <div class="col-lg-6">
         <img class ="logo" src="img/Komodo.png" height="90px;">
      </div>
      <div class="col-lg-6">
        <h1 class="logo-title">Supply Chain Management System</h1>
      </div>
    </div>
  </div>
  <body>
  <div class="container marketing">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel-grid">
             <!--  <img class="img-circle" src="img/transparent-arrow.png" alt="getnewimage" width="140" height="140"> -->
              <h2 class="blue">Vendors</h2>
              <p>On receving ACKNOWLEDGEMENT from IOT devices at material gates release funds to repective vendors address's based on Smart Contracts created.</p>
              <p class="p-title">Current vendors in queue and awaiting Check-In at Materials Gate for Inventory Audits.</p>
              <ul>
                <li>Bridgestone -- Tyres <p><a class="btn btn-default" role="button" onclick='sendToAddress(1,"Bridgestone")'>Send BTS »</a></p></li>
                <li>NGK Spark Plug Co. -- Spark Plugs <p><a class="btn btn-default" role="button" onclick='sendToAddress(2,"NGK Spark Plug Co")'>Send BTS »</a></p></li>
                <li>Bose Corp -- Speakers <p><a class="btn btn-default" role="button" onclick='sendToAddress(3,"Bose Corp")'>Send BTS » </a></p></li>
                <li>GreenKraft Inc -- Fuel Systems & Engines <p><a class="btn btn-default" role="button" onclick='sendToAddress(4,"GreenKraft Inc")'>Send BTS »</a></p></li>
                <li>Vystar Corp -- Toppers <p><a class="btn btn-default" role="button" onclick='sendToAddress(5,"Vystar Corp")'>Send BTS »</a></p></li>
                <li>Anonymous vendor -- xyz Material <p> Client Address:<input id="anonymousId" value=""> Amount:<input id="anonymousAmount" step="any" value=""></p><p><a class="btn btn-default" role="button" onclick='sendToAddress(6,"Client Address")'>Send BTS »</a></p></li>
              </ul>
              <p>Load More >></p>
            </div>
        </div>
        <div class="col-lg-4">
             <div class="panel-grid">
              <!-- <img class="img-circle" src="img/transparent-arrow.png" alt="getnewimage" width="140" height="140"> -->
              <h2 class="green">Messages</h2>
              <textarea id="tx_result" rows="20" cols="30"></textarea>
              <p><a class="btn btn-default" href="publications.php" role="button">View details »</a></p>
            </div>
        </div>
        <div class="col-lg-4">
             <div class="panel-grid">
              <p>Asset Node Address: <input name="nodeAddress" id="nodeAddress" value="" placeholder="127.0.0.1:9732"> <a class="btn btn-default" role="button" onclick='enterNode()'>Add node »</a></p>
              <h2 class="orange">Current Balance</h2>
              <p>Balance that is maintained by the organization on its BLOCKCHAIN Wallet Address.</p>
              <p><a class="btn btn-default" role="button" onclick='showAddressBalance()'>Get Balance » </a><a class="btn btn-default" role="button" onclick='showWalletInfo()'>Get Wallet Info »</a></p>
              <h3><b>Balance:</b><span id="my_balance" style="color:green;">0.0000000</span></h3>
              <h3><b>Chain Information:</b></h3>
              <div id="chain_info" style="color:blue;">0.0000000</div>
            </div>
        </div>

    </div>
</div>

  </body>
  <script>
  //Few Addresses used here hard-coded for demonstration purpose. 
  //These Addresses can be dynamically be associated or linked with entity from standalone point of view.
      var nodeAddress="";
      function enterNode(){
        var pattern = new RegExp("^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?):[0-9]{1,5}$");
        var input = document.getElementById("nodeAddress").value; 
        var result = pattern.test(input);
        //alert("Result:"+result);
        if(result){
          //alert("Address in right format: "+input);
          nodeAddress=input;
          alert("Will try to connect to Node Address: "+nodeAddress);
        }
        else{
          alert("Node Address not in expected format. Enter in 255.255.255.255:7650 format");
        }

      }

      function showWalletInfo() {
        if(nodeAddress!=""){
          $.ajax({
                url: 'rpc_call.php',
                type: 'post',
                data: { "get_wallet_info": "getinfo", "nodeAddress":nodeAddress},
                success: function(response){ 
                  //alert(response); 
                  document.getElementById("chain_info").innerHTML = response;
                 }

          });
        }
        else{
          alert("Please enter valid Asset Node Address to see Wallet Info.. ");
        }
      }

      function showAddressBalance() {
        //var my_address ="RQLTfbszrrbskCDULdHmjBFJ62oeBCkXSS";
        if(nodeAddress!=""){
        $.ajax({
              url: 'rpc_call.php',
              type: 'post',
              data: { "get_wallet_bal": "\"RQLTfbszrrbskCDULdHmjBFJ62oeBCkXSS\"", "nodeAddress":nodeAddress},
              success: function(response){ 
                //alert(response); 
                document.getElementById("my_balance").innerHTML = response;
               }

        });
        }
        else{
          alert("Please enter valid Asset Node Address to see address Balance.. ");
        }
      }
      function sendToAddress(id,clientName){
        if(nodeAddress!=""){
          //smart contract logic..
          if (id!=0){
            var client ="";
            if(id == 1 ){
               client= "\"RA61b5ppBDxGvxieTw5KUHoVPv7m7EePT1\",0.001";
            }
            else if(id == 2 ){
                client= "\"RGESCpL9saEoRR5shRgSsXeHSvJDj9CLbh\",0.002";
            }
            else if(id == 3){
               client= "\"RFGB7DrZ8cYn9ABDnFUwuGWKrg7RJtpdWx\",0.003";;
            }
            else if(id == 4 ){
                client= "\"RKzKSPdSojAWcbLzU4w5M28aqz1r5fpfeg\",0.004";
            }
            else if(id == 5 ){
                client= "\"RKzKSPdSojAWcbLzU4w5M28aqz1r5fpfeg\",0.001";
            }
            else if(id == 6 ){
                var amount = document.getElementById("anonymousAmount").value;
                var clientAddress = document.getElementById("anonymousId").value;
                clientName = clientAddress;
                client= "\""+clientAddress+"\","+amount+"";
            }
        }
        $.ajax({
              url: 'rpc_call.php',
              type: 'post',
              data: { "send_address_bal": client, "nodeAddress":nodeAddress},
              success: function(response){ 
                //alert(response); 
                document.getElementById("tx_result").innerHTML += "Transaction with Tx Id: "+response+" for client "+clientName+" is completed."+"\n";
               }

        });
        }
        else{
          alert("Please enter valid Asset Node Address to send amount.. ");
        }
      }
</script>
  </html>
