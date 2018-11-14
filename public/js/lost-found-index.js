// JavaScript Document
function show(f){
	for(y=1;y<=2;y++){
		art = document.getElementById("show"+y);
		art.style.display="none";
		title = document.getElementById("title"+y);
		title.style.background="#ccc";
		title.style.fontWeight="400";
	}
	i=f;
	obj = document.getElementById("show"+i);
	obj.style.display="block";
	title = document.getElementById("title"+i);
	title.style.background="#3E3D3D";
	title.style.fontWeight="600";
}
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
