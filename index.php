<!--/////////////////////////////
// Written by: Ilan Patao //
// ilan@dangerstudio.com //
//////////////////////////-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pick n Pull Quote API Example - Ilan Patao</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://autotrader-api.herokuapp.com/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://autotrader-api.herokuapp.com/css/mdb.min.css" rel="stylesheet">
    <!-- BST core CSS -->
    <link href="https://autotrader-api.herokuapp.com/js/bootstrap-table.min.css" rel="stylesheet">
</head>

<body>


    <div class="container" style="margin-top:25px;">
        <div class="flex-center flex-column">
            <h1 class="animated fadeIn mb-4">Pick-N-Pull Quote API Sample</h1>
            <p class="animated fadeIn text-muted">This is a sample call for a 2010 Acura MDX Base; the results returned for this vehicle are:</p>	
		</div>
	</div>

	<div class="container" style="margin-top:25px;">
		<div class="row">
				<div class="col-sm-6">	
					<?php
					// Make and loop through the call
					
					$curl = curl_init();
					
					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://cashforjunkcars.picknpull.com/apexremote",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "{\"action\":\"RoadsterWebQuoteCtrl\",\"method\":\"vehCondNext_st\",\"data\":[\"WL-1498692\",\"DQ-0237:false,DQ-0233:false,DQ-0231:false,DQ-0238:false,DQ-0239:false,DQ-0240:false,DQ-0234:false,DQ-0241:false,DQ-0232:false,DQ-0235:false,DQ-0236:false,\",\"2010\",\"Acura\",\"MDX Base\",\"94621\"],\"type\":\"rpc\",\"tid\":12,\"ctx\":{\"csrf\":\"VmpFPSxNakF4Tnkwd09TMHlNRlF3TWpveU16b3pOQzR4TXpOYSxybHZUYjNTX2NQY1ZHeFJNUm1Edk5ULFlUUmtNVEk1\",\"vid\":\"066E0000000NWT7\",\"ns\":\"\",\"ver\":33}}",
					  CURLOPT_HTTPHEADER => array(
						"accept: */*",
						"accept-encoding: gzip, deflate",
						"accept-language: en-US,en;q=0.8",
						"cache-control: no-cache",
						"connection: keep-alive",
						"content-type: application/json",
						"cookie: __utmt=1; _ga=GA1.2.1693712568.1505615930; _gid=GA1.2.523001162.1505615945; _gat=1; __utma=42830628.1693712568.1505615930.1505615930.1505615930.1; __utmb=42830628.8.9.1505615943592; __utmc=42830628; __utmz=42830628.1505615930.1.1.utmcsr=google^|utmccn=(organic)^|utmcmd=organic^|utmctr=(not^%^20provided)",
						"origin: http://cashforjunkcars.picknpull.com",
						"referer: http://cashforjunkcars.picknpull.com/",
						"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36",
						"x-requested-with: XMLHttpRequest",
						"x-user-agent: Visualforce-Remoting"
					  ),
					));
					
					$response = curl_exec($curl);
					$jdata = json_decode($response);
					curl_close($curl);
					
					$price = $jdata[0]->result->myQP;
					$bookprice = $jdata[0]->result->price->bookPrice;
					$buyprice = $jdata[0]->result->price->buyModelPrice;
					$partsprice = $jdata[0]->result->price->estPartSales;
					$recommendation = $jdata[0]->result->price->recommendation;
					$towfee = $jdata[0]->result->price->towCharges;
					$weight = $jdata[0]->result->price->weight;
					
					echo "Offer Price:";
					echo "<br>";
					echo $price;
					echo "<br><small><span class='text-primary'>This is the quote returned to the customer after they had filled out the form on the PNP site.</span></small><hr>";
					echo "Book Price:";
					echo "<br>$";
					echo $bookprice;
					echo "<br><small><span class='text-danger'>This is the book price value returned, the customer does not see this data.</span></small><hr>";
					echo "Parts Price:";
					echo "<br>$";
					echo $partsprice;
					echo "<br><small><span class='text-danger'>This is the parts price value returned, the customer does not see this data.</span></small><hr>";
					echo "Recommendation:";
					echo "<br>";
					echo $recommendation;
					echo "<br><small><span class='text-danger'>This is the PNP recommended action, the customer does not see this data.</span></small><hr>";
					echo "Tow Fee:";
					echo "<br>$";
					echo $towfee;
					echo "<br><small><span class='text-danger'>This is the internal tow-fee returned, the customer does not see this data.</span></small><hr>";
					echo "Weight:";
					echo "<br>";
					echo $weight;
					echo "lbs<br><small><span class='text-danger'>This is the calculated weight returned, the customer does not see this data.</span></small><hr>";
					?>
				</div>
				
				<div class="col-sm-6">
					JSON Data Returned:<br>
					<textarea rows="12" cols="12" style="height:450px;"><?PHP var_dump($jdata); ?></textarea>
					<br>&nbsp;<br>
					Note: The PNP Quote service only works with the exact Vehicle Make and Models strings as listed on the PNP cash for cars site. In other words, "Acura MDX" is not the same as "Acura MDX Base"; The exact strings can also be automatically pulled; this example however only displays the quote service polling.
					<br>&nbsp;<br>
					
				</div>
			</div>
		</div>



		
		<center>
				<p class="animated fadeIn text-muted">
				</p>
							
			<br>Written by: <a href="mailto:ilan@dangerstudio.com" style="text-decoration:none;">Ilan Patao</a> - 09/16/2017
			
		</center>
        </div>
    </div>
    <!-- JQuery -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/mdb.min.js"></script>
    <!-- BST core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/bootstrap-table.min.js"></script>
</body>
<script>
$(document).ready(function(){
});
</script>
</html>