<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo "$title"; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link href="<?php echo base_url()?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>/css/style.css" rel="stylesheet">
        <script src="<?php echo base_url()?>js/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>js/main.js"></script>
<!--    <script src="<?php echo base_url()?>js/paggination.js"></script>-->
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
.bikeInfo{overflow: scroll;}
.dumbikeinfo{padding-top:10px;}
</style>
<script>
    $(document).ready(function(){
        $("#popup").click(function(){
            $("#dealerInfo").css('display','block');
            $("#addBike").css('display','none');
        });
        $("#popup1").click(function(){
            $("#dealerInfo").css('display','none');
            $("#addBike").css('display','block');
        });
        $("#makeDrp").change(function(){
            $.ajax({url:"http://localhost/bikevaluation/index.php/Pricematrix/getModel",data:{id:$(this).val()},type:"GET",
                success:function(data){
                    $("#modelDrp").html(data);
                }
            });
        });
        $("#modelDrp").change(function(){
            var make = $( "#makeDrp option:selected" ).text();
            $.ajax({url:"http://localhost/bikevaluation/index.php/Pricematrix/getVariant",data:{id:make,model:$(this).val()},type:"GET",
                success:function(data){
                    $("#variantDrp").html(data);
                }
            });
        });
        $("#variantDrp").change(function(){
            var make = $( "#makeDrp option:selected" ).text();
            var model = $( "#modelDrp option:selected" ).text();
            $("#dumbikeinfo").css("display","none");
            
            $.ajax({url:"http://localhost/bikevaluation/index.php/Pricematrix/getInfo",data:{id:make,model:model,variant:$(this).val()},type:"GET",
                success:function(data){
                    $("#bikeInfo").html(data);
                }
            });
        });
        $("body").on("click",'#bikeId',function(){
            console.log("inside bike");
            $.ajax({url:"http://localhost/bikevaluation/index.php/Pricematrix/getLocationByBikeid",data:{bikeid:$(this).val()},type:"GET",
                success:function(data){
                    $("#locationDrp").html(data);
                }
            });
        });
        $("#locationDrp").change(function(){
            var make = $( "#makeDrp option:selected" ).text();
            var model = $( "#modelDrp option:selected" ).text();
            var variant = $( "#variantDrp option:selected" ).text();
            var bikeId = $('input:radio[name=bikeId]:checked').val();
            $.ajax({url:"http://localhost/bikevaluation/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:$(this).val(),web:'yes'},type:"GET",
                success:function(data){
                    $("#result").html(data);
                }
            });
        });
        
        $("#yearDrp").change(function(){
            var make = $( "#makeDrp option:selected" ).text();
            var model = $( "#modelDrp option:selected" ).text();
            var variant = $( "#variantDrp option:selected" ).text();
            var bikeId = $('input:radio[name=bikeId]:checked').val();
            var locId = $( "#locationDrp option:selected" ).val();
            $.ajax({url:"http://localhost/bikevaluation/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:locId,year:$(this).val(),web:'yes'},type:"GET",
                success:function(data){
                    $("#result").html(data);
                }
            });
        });
        $("#monthDrp").change(function(){
            var make = $( "#makeDrp option:selected" ).text();
            var model = $( "#modelDrp option:selected" ).text();
            var variant = $( "#variantDrp option:selected" ).text();
            var bikeId = $('input:radio[name=bikeId]:checked').val();
            var locId = $( "#locationDrp option:selected" ).val();
            var year = $( "#yearDrp option:selected" ).val();
            $.ajax({url:"http://localhost/bikevaluation/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:locId,year:year,month:$(this).val(),web:'yes'},type:"GET",
                success:function(data){
                    $("#result").html(data);
                }
            });
        });
        $("#submit").click(function(){
            console.log("in");
            var make = $( "#makeDrp option:selected" ).text();
            var model = $( "#modelDrp option:selected" ).text();
            var variant = $( "#variantDrp option:selected" ).text();
            var bikeId = $('input:radio[name=bikeId]:checked').val();
            var locId = $( "#locationDrp option:selected" ).val();
            var year = $( "#yearDrp option:selected" ).val();
            var month = $( "#monthDrp option:selected" ).val();
            var distance = $("#distance").val();
            var on_rd_price =$("#on_rd_price").val();
            console.log("Distance="+distance);
            $.ajax({url:"http://localhost/bikevaluation/index.php/BikeValuation/api",data:{make:make,model:model,variant:variant,bikeId:bikeId,locId:locId,year:year,month:month,distance:distance,on_rd_price:on_rd_price,web:'yes'},type:"GET",
                success:function(data){
                    $("#result").html(data);
                }
            });
        });
        $("#insertDealer").click(function(){
            console.log("in");
            
            var dealerName = $("#dealerName").val();
            var description = $("#description").val();
            var pincode = $("#pincode").val();
            var location = $("#location").val();
            
            var on_rd_price =$("#on_rd_price").val();
            $.ajax({url:"http://localhost/bikevaluation/index.php/DataCollection/insertdata",data:{dealerName:dealerName,description:description,pincode:pincode,location:location},type:"GET",
                success:function(data){
                    $("#result").html("<h3>Insert Succes</h3>");
                }
            });
        });
    });
</script> 
</head>
<body style="margin-top:-14px;">
<nav class="navbar navbar-inverse navbar-fixed-top hidden-xs" role="navigation">
    <ul class="nav navbar-nav">
        <li style="height: 51px; width: 205px; background: url('<?php echo base_url().'images/logo.jpg' ?>') no-repeat scroll 0 0 / 212px 64px transparent;"><a></a></li>
        <li class="active"><a href="<?php echo base_url();?>">Credr.com</a></li>

        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul> 
</nav>   
        
<div class="container-fluid"  id="container" style="margin-top:62px;">
    <div class="row">
        <div class="col-sm-2" style="background-color: black;height:560px;">
            <ul>
                <li class="active"><a  href="<?php echo base_url().'index.php/Pricematrix' ?>">Dealer Price Matrix</a></li>
                <li class="active"><a href="<?php echo base_url().'index.php/DataCollection' ?>">Dealer Pricing</a></li>
            </ul>
        </div>
        
        <div class="col-sm-10" style="padding-top:30px;">
            <div class="col-md-10">
                <button type="button" id="popup" onclick="div_show('pop')">+ Add Dealer</button>
                <button type="button" id="popup1" onclick="div_show('pop1')">+ Add bike</button>
            </div>
            <div id="dealerInfo" class="col-md-5" style="border: 1px solid gray;">
                <form method="get"> <!-- Dealer form -->
                    <b>*Dealer Name:</b><br>
                    <input id="name" type="text" name="dealerName" class="col-md-8"><br><br>
                    <b>Description:</b><br>
                    <input type="text" id="description" name="description" class="col-md-8"><br><br>
                    <b>*Pincode:</b><br>
                    <input type="text" id="pincode" name="pincode" class="col-md-8"><br><br>
                    <b>*Location:</b><br>
                    <input type="text" id="location" name="location" class="col-md-8"><br><br>
                    <a id="insertDealer" >Submit</a>
                    <br><br><br>
                    Fields marked * are required.
                </form><!-- Dealer form -->
                <div id="result"></div>
            </div>
            
            <!-- second form -->
     <div class="col-md-8" id="addBike" style="display: none;">
        <?php echo "<form action='http://54.69.166.71/api/DataCollection/dealer.php?dealer={$dealer}' method='get' id='form2'>";
        echo "<br><b>Select Dealer:</b>";
        echo "<select name='dealerID'>";
        
        $sql = "SELECT distinct DealerId, Dealer as Dealer from DealerDetails";
        $query = mysql_query($sql, $ANALYTICS);
        echo "<option value='' >-- Select Dealer --</option>";
        
        while($result = mysql_fetch_array($query))
        {
            $dealer_1 = $result['Dealer'];
            $dealerId = $result['DealerId'];
                
                if($dealerId == $dealerID){
                   echo "<option selected value='{$dealerId}'> {$dealer_1}</option>";
                }
                else
                    echo "<option value='{$dealerId}'> {$dealer_1}</option>";
            
        }
        echo " </select><br>";
    
        echo "<br><b>Select Make-Model-Variant : </b>";
        echo "<select id='make' name='make' onchange='this.form.submit()'>";
        $sql = "SELECT distinct Make as Make from Models";
        $query = mysql_query($sql, $ANALYTICS);
        echo "<option value='' >-- Select Make --</option>";
            
        while($result = mysql_fetch_array($query))
        {
            $make_l = $result['Make'];
            if (isset($make))
            {
                if($make_l == $make){
                   echo "<option selected value='{$make_l}'> {$make_l}</option>";
                   
                }
                else
                    echo "<option value='{$make_l}'> {$make_l}</option>";
            }
            else
                echo "<option value='{$make_l}'> {$make_l}</option>";
        
            }
            //echo $RegressionId;
        ?>
     </select>
     
     <select id="model" name='model' onchange='this.form.submit()'>
        <?php 
        //$qry = array("user" => $usr_email,"password" => md5($usr_password));
        $sql = "SELECT distinct Model as Model from Models where Make = '{$make}'";
        $query = mysql_query($sql, $ANALYTICS);
        echo "<option value='' >-- Select Model --</option>";
            
        while($result = mysql_fetch_array($query))
        {
            $model_l = $result['Model'];
            if (isset($model))
            {
                if($model_l == $model){
                   echo "<option selected value='{$model_l}'> {$model_l}</option>";
                   
                }
                else
                    echo "<option value='{$model_l}'> {$model_l}</option>";
            }
            else
                echo "<option value='{$model_l}'> {$model_l}</option>";
        
            }
            //echo $RegressionId;
        ?>
    </select>
     
     <select id="variant1" name='modelId' onchange='this.form.submit()'>
        <?php 
        //$qry = array("user" => $usr_email,"password" => md5($usr_password));
        /*echo "<option value='' >-- Select Variant --</option>";
            $variants = get_variants($make, $model);
            //print_r($variants);
            foreach ($variants as $key => $value){
                echo "<br><br><br>$values<br><br>";
                if ($modelId == $key){
                    echo "<option selected='selected' value='{$key}'>{$value} </option>";
                }
                else
                    echo "<option value='{$key}'>{$value} </option>";
                    
            }*/
            //echo $RegressionId;
        ?>
    </select>
     
     <table style="width:30%">
        <tr> <th>select </th><th>cc </th><th>AnalogMeter </th><th>DigitalMeter </th><th>Tachometer</th><th>DTSi</th><th>Kick Start</th> <th>Self Start</th> <th>Wheel Type</th> <th>Rear Brake</th><th>Front Brake</th><th>ABS</th><th>Digital Meter</th><th>Manufactured Year</th><th>Discontinued Year</th><th>Color</th></tr>
       
        <?php 
        //$qry = array("user" => $usr_email,"password" => md5($usr_password));
        /*if(isNotNull($make) and isNotNull($model) )
        {
            //$sql = "SELECT ModelId from Models where Make = '{$make}' and Model='{$model}' and Variant='{$variant}'";
            //echo $sql;
            //$query = mysql_query($sql, $ANALYTICS);
            //$result = mysql_fetch_array($query);
            //echo $result['ModelId'];
            $sql = "SELECT `BikeId`, `CC`, `AnalogMeter`, `DigitalMeter`, `Tachometer`, `DTSi`, `KickStart`, `SelfStart`, `WheelType`, `RearBrakeType`, `FrontBrakeType`, `Abs`, `DigitalMeter`, `MfgYear`, `DiscontinuationYear`, `Colour` FROM `Specifications` WHERE ModelId={$modelId}";
            $query = mysql_query($sql, $ANALYTICS);
            //echo $sql;
            while($result = mysql_fetch_array($query))
            {
                $bike_id = $result['BikeId'];
                $text ="";
                echo "<tr> <td>";
                if (isset($bikeId))
                {
                    if($bike_id == $bikeId)
                        echo "<input type='radio' id='bikeId' name='bikeId' value={$bike_id} onclick='this.form.submit()' checked>";
                    else 
                        echo "<input type='radio' id='bikeId' name='bikeId' onclick='this.form.submit()' value={$bike_id} >";
                }
                else
                    echo "<input type='radio' name='bikeId' id='bikeId' onclick='this.form.submit()' value={$bike_id} >";
                echo "</td> <td>{$result['CC']}</td><td>".boolToText($result['AnalogMeter'])."</td><td>".boolToText($result['DigitalMeter'])."</td><td>".boolToText($result['Tachometer'])."</td><td>".boolToText($result['DTSi'])."</td><td>".boolToText($result['KickStart'])."</td> <td>".boolToText($result['SelfStart'])."</td> <td>{$result['WheelType']}</td> <td>{$result['RearBrakeType']}</td><td>{$result['FrontBrakeType']}</td><td>".boolToText($result['Abs'])."</td><td>".boolToText($result['DigitalMeter'])."</td><td>{$result['MfgYear']}</td><td>{$result['DiscontinuationYear']}</td><td>{$result['Colour']}</td></tr>";

              }
                //echo $RegressionId;
        }*/
        ?>
     </table><br>
     <b>*Min Price:</b><br>
        <input id="minp" type="text" name="minp"><br>
        <b>*Max Price:</b><br>
        <input type="text" id="maxp" name="maxp"><br>
        <b>*Year:</b><br>
        <input type="text" id="year" name="year"><br>
        <button id="formSubmit1" type="button" onclick="check_empty1()">Submit</button><br><br><br>
        Fields marked * are required.
            </div>
        </div>
    </div>
</div>