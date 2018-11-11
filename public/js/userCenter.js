/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function center(){
    wid = document.body.clientWidth;
    obj = document.getElementByClassName("content");
    obj.style.marginLeft=wid/2;
}
function changeColor(colorRGB)
{
    wid = document.body.clientWidth;
    obj = document.getElementByClassName("content");
    obj.style.marginLeft=wid/2;
    
    $('.content').append("<style>.content::after{display:block}</style>"); 
}
