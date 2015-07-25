/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */       
    //var base_url = "http://localhost/CodeIgniter/";
    var controller = "index.php/Propertylist";
    function property_details(type){
        //$('.loading').css('display','block');
        $('.loading').html("<img src='http://localhost/CodeIgniter/images/loading.gif'>");
        $.ajax({
                'url' : 'http://localhost/CodeIgniter/index.php/Propretylist/details',
            'type' : 'POST', //the way you want to send data to your URL
            'data' : {'type' : type},
            'success' : function(data){ //probably this request will return anything, it'll be put in var "data
                var data;
                var container = $('#container'); //jquery selector (get element by id)
//                if(data){
//                    container.html(data);
//                }
                //for pop up
                if(data){
                    $('#myModal').html(data);
                    $('#myModal').css("display","block"); //for pop up
                }
            }
        });
        //location.href="http://localhost/CodeIgniter/index.php/Propretylist/details";
    }
function getModel(){
            var make =$("#make option:selected").text();
            console.log("make"+make);
            $.ajax({
            'url' : 'http://localhost/bikevaluation/index.php/bikevaluationview/getmodel',
            'type' : 'GET', //the way you want to send data to your URL
            'data' : {'make' : make},
            'dataType': "json",
            'success' : function(data){ //probably this request will return anything, it'll be put in var "data
                var data;
                console.log(data);
               if (content.status == "success") {
                    $("#modelId").find('option').remove();
                    $.each(content.message, function(key, val) {
                          $("#modelId").append(
                          '<option value="' + key + '">' + val + '</option>'
                          );
                    });
                } 
            }
        });
 }