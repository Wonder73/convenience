/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
        $("#tt").mouseover(function(){
        $("#ttt").css("color","rgb(255, 80, 0)");
        $("#hh img").css("opacity","0.9");        
        $("#hh").css("border-color","rgb(255, 80, 0)");
    });
    
    $("#tt").mouseout(function(){
        $("#ttt").css("color","rgb(51, 51, 51)");
        $("#hh img").css("opacity","1");
        $("#hh").css("border-color","#13d0a1");
    });
});
