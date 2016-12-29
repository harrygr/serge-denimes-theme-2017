jQuery(document).ready(function(){
  initMenWomen();
});

jQuery(window).resize(function(){
  initMenWomen();
});

function initMenWomen(){
	if(jQuery('.unisex-main-div').length>0){
		jQuery('.unisex-main-div').each(function(){
			var left=jQuery(this).css('left');
			//console.log(left);
			var left2=parseInt(left.substr(0,left.length-2));
			//console.log(left2);
			var w1=jQuery(this).parents('.unisex:first').outerWidth(true);
			//console.log(w1);
			var w2=jQuery(this).parents('.unisex:first').find('img:first').width();
			var h1=jQuery(this).parents('.unisex:first').find('img:first').height();
			//console.log(w2);
			var w3=(w1-w2)/2;
			//console.log(w3);
			var w4=left2-w3;
			//console.log(w4);
			var h2=h1-2*w4;
			jQuery(this).css('top',w4);
			jQuery(this).css('height',h2);
		});
	}
}