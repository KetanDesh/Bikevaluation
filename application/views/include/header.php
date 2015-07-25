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
            $("#popup").css('display','block');
        });
        $("#popup1").click(function(){
            $("#dealerInfo").css('display','none');
            $("#addBike").css('display','block');
        });
        $("#makeDrp").change(function(){
            $.ajax({url:"<?php echo base_url()?>index.php/Pricematrix/getModel",data:{id:$(this).val()},type:"GET",
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
        
        
        


