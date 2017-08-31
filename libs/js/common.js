
var MD5 = function(s){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,d,F,H,x;F=(G&2147483648);H=(k&2147483648);I=(G&1073741824);d=(k&1073741824);x=(G&1073741823)+(k&1073741823);if(I&d){return(x^2147483648^F^H)}if(I|d){if(x&1073741824){return(x^3221225472^F^H)}else{return(x^1073741824^F^H)}}else{return(x^F^H)}}function r(d,F,k){return(d&F)|((~d)&k)}function q(d,F,k){return(d&k)|(F&(~k))}function p(d,F,k){return(d^F^k)}function n(d,F,k){return(F^(d|(~k)))}function u(G,F,aa,Z,k,H,I){G=K(G,K(K(r(F,aa,Z),k),I));return K(L(G,H),F)}function f(G,F,aa,Z,k,H,I){G=K(G,K(K(q(F,aa,Z),k),I));return K(L(G,H),F)}function D(G,F,aa,Z,k,H,I){G=K(G,K(K(p(F,aa,Z),k),I));return K(L(G,H),F)}function t(G,F,aa,Z,k,H,I){G=K(G,K(K(n(F,aa,Z),k),I));return K(L(G,H),F)}function e(G){var Z;var F=G.length;var x=F+8;var k=(x-(x%64))/64;var I=(k+1)*16;var aa=Array(I-1);var d=0;var H=0;while(H<F){Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=(aa[Z]| (G.charCodeAt(H)<<d));H++}Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=aa[Z]|(128<<d);aa[I-2]=F<<3;aa[I-1]=F>>>29;return aa}function B(x){var k="",F="",G,d;for(d=0;d<=3;d++){G=(x>>>(d*8))&255;F="0"+G.toString(16);k=k+F.substr(F.length-2,2)}return k}function J(k){k=k.replace(/rn/g,"n");var d="";for(var F=0;F<k.length;F++){var x=k.charCodeAt(F);if(x<128){d+=String.fromCharCode(x)}else{if((x>127)&&(x<2048)){d+=String.fromCharCode((x>>6)|192);d+=String.fromCharCode((x&63)|128)}else{d+=String.fromCharCode((x>>12)|224);d+=String.fromCharCode(((x>>6)&63)|128);d+=String.fromCharCode((x&63)|128)}}}return d}var C=Array();var P,h,E,v,g,Y,X,W,V;var S=7,Q=12,N=17,M=22;var A=5,z=9,y=14,w=20;var o=4,m=11,l=16,j=23;var U=6,T=10,R=15,O=21;s=J(s);C=e(s);Y=1732584193;X=4023233417;W=2562383102;V=271733878;for(P=0;P<C.length;P+=16){h=Y;E=X;v=W;g=V;Y=u(Y,X,W,V,C[P+0],S,3614090360);V=u(V,Y,X,W,C[P+1],Q,3905402710);W=u(W,V,Y,X,C[P+2],N,606105819);X=u(X,W,V,Y,C[P+3],M,3250441966);Y=u(Y,X,W,V,C[P+4],S,4118548399);V=u(V,Y,X,W,C[P+5],Q,1200080426);W=u(W,V,Y,X,C[P+6],N,2821735955);X=u(X,W,V,Y,C[P+7],M,4249261313);Y=u(Y,X,W,V,C[P+8],S,1770035416);V=u(V,Y,X,W,C[P+9],Q,2336552879);W=u(W,V,Y,X,C[P+10],N,4294925233);X=u(X,W,V,Y,C[P+11],M,2304563134);Y=u(Y,X,W,V,C[P+12],S,1804603682);V=u(V,Y,X,W,C[P+13],Q,4254626195);W=u(W,V,Y,X,C[P+14],N,2792965006);X=u(X,W,V,Y,C[P+15],M,1236535329);Y=f(Y,X,W,V,C[P+1],A,4129170786);V=f(V,Y,X,W,C[P+6],z,3225465664);W=f(W,V,Y,X,C[P+11],y,643717713);X=f(X,W,V,Y,C[P+0],w,3921069994);Y=f(Y,X,W,V,C[P+5],A,3593408605);V=f(V,Y,X,W,C[P+10],z,38016083);W=f(W,V,Y,X,C[P+15],y,3634488961);X=f(X,W,V,Y,C[P+4],w,3889429448);Y=f(Y,X,W,V,C[P+9],A,568446438);V=f(V,Y,X,W,C[P+14],z,3275163606);W=f(W,V,Y,X,C[P+3],y,4107603335);X=f(X,W,V,Y,C[P+8],w,1163531501);Y=f(Y,X,W,V,C[P+13],A,2850285829);V=f(V,Y,X,W,C[P+2],z,4243563512);W=f(W,V,Y,X,C[P+7],y,1735328473);X=f(X,W,V,Y,C[P+12],w,2368359562);Y=D(Y,X,W,V,C[P+5],o,4294588738);V=D(V,Y,X,W,C[P+8],m,2272392833);W=D(W,V,Y,X,C[P+11],l,1839030562);X=D(X,W,V,Y,C[P+14],j,4259657740);Y=D(Y,X,W,V,C[P+1],o,2763975236);V=D(V,Y,X,W,C[P+4],m,1272893353);W=D(W,V,Y,X,C[P+7],l,4139469664);X=D(X,W,V,Y,C[P+10],j,3200236656);Y=D(Y,X,W,V,C[P+13],o,681279174);V=D(V,Y,X,W,C[P+0],m,3936430074);W=D(W,V,Y,X,C[P+3],l,3572445317);X=D(X,W,V,Y,C[P+6],j,76029189);Y=D(Y,X,W,V,C[P+9],o,3654602809);V=D(V,Y,X,W,C[P+12],m,3873151461);W=D(W,V,Y,X,C[P+15],l,530742520);X=D(X,W,V,Y,C[P+2],j,3299628645);Y=t(Y,X,W,V,C[P+0],U,4096336452);V=t(V,Y,X,W,C[P+7],T,1126891415);W=t(W,V,Y,X,C[P+14],R,2878612391);X=t(X,W,V,Y,C[P+5],O,4237533241);Y=t(Y,X,W,V,C[P+12],U,1700485571);V=t(V,Y,X,W,C[P+3],T,2399980690);W=t(W,V,Y,X,C[P+10],R,4293915773);X=t(X,W,V,Y,C[P+1],O,2240044497);Y=t(Y,X,W,V,C[P+8],U,1873313359);V=t(V,Y,X,W,C[P+15],T,4264355552);W=t(W,V,Y,X,C[P+6],R,2734768916);X=t(X,W,V,Y,C[P+13],O,1309151649);Y=t(Y,X,W,V,C[P+4],U,4149444226);V=t(V,Y,X,W,C[P+11],T,3174756917);W=t(W,V,Y,X,C[P+2],R,718787259);X=t(X,W,V,Y,C[P+9],O,3951481745);Y=K(Y,h);X=K(X,E);W=K(W,v);V=K(V,g)}var i=B(Y)+B(X)+B(W)+B(V);return i.toLowerCase()};

function initShare(){
	(function(t,e){"use strict";var a=function(t){this.elem=t};a.init=function(){var t=e.querySelectorAll(".sharer"),r,i=t.length;for(r=0;r<i;r++){t[r].addEventListener("click",a.add)}};a.add=function(t){var e=t.currentTarget||t.srcElement;var r=new a(e);r.share()};a.prototype={constructor:a,getValue:function(t){var e=this.elem.getAttribute("data-"+t);return e===undefined||e===null?false:e},share:function(){var t=this.getValue("sharer").toLowerCase(),e={facebook:{shareUrl:"https://www.facebook.com/sharer/sharer.php",params:{u:this.getValue("url")}},googleplus:{shareUrl:"https://plus.google.com/share",params:{url:this.getValue("url")}},linkedin:{shareUrl:"https://www.linkedin.com/shareArticle",params:{url:this.getValue("url"),mini:true}},twitter:{shareUrl:"https://twitter.com/intent/tweet/",params:{text:this.getValue("title"),url:this.getValue("url"),hashtags:this.getValue("hashtags"),via:this.getValue("via")}},email:{shareUrl:"mailto:"+this.getValue("to"),params:{subject:this.getValue("subject"),body:this.getValue("title")+"\n"+this.getValue("url")},isLink:true},whatsapp:{shareUrl:"whatsapp://send",params:{text:this.getValue("title")+" "+this.getValue("url")},isLink:true},telegram:{shareUrl:"tg://msg_url",params:{text:this.getValue("title")+" "+this.getValue("url")},isLink:true},viber:{shareUrl:"viber://forward",params:{text:this.getValue("title")+" "+this.getValue("url")},isLink:true},line:{shareUrl:"http://line.me/R/msg/text/?"+encodeURIComponent(this.getValue("title")+" "+this.getValue("url")),isLink:true},pinterest:{shareUrl:"https://www.pinterest.com/pin/create/button/",params:{url:this.getValue("url"),media:this.getValue("image"),description:this.getValue("description")}},tumblr:{shareUrl:"http://tumblr.com/widgets/share/tool",params:{canonicalUrl:this.getValue("url"),content:this.getValue("url"),posttype:"link",title:this.getValue("title"),caption:this.getValue("caption"),tags:this.getValue("tags")}},hackernews:{shareUrl:"https://news.ycombinator.com/submitlink",params:{u:this.getValue("url"),t:this.getValue("title")}},reddit:{shareUrl:"https://www.reddit.com/submit",params:{url:this.getValue("url")}},vk:{shareUrl:"http://vk.com/share.php",params:{url:this.getValue("url"),title:this.getValue("title"),description:this.getValue("caption"),image:this.getValue("image")}},xing:{shareUrl:"https://www.xing.com/app/user",params:{op:"share",url:this.getValue("url"),title:this.getValue("title")}},buffer:{shareUrl:"https://buffer.com/add",params:{url:this.getValue("url"),title:this.getValue("title"),via:this.getValue("via"),picture:this.getValue("picture")}},instapaper:{shareUrl:"http://www.instapaper.com/edit",params:{url:this.getValue("url"),title:this.getValue("title"),description:this.getValue("description")}},pocket:{shareUrl:"https://getpocket.com/save",params:{url:this.getValue("url")}},digg:{shareUrl:"http://www.digg.com/submit",params:{url:this.getValue("url")}},stumbleupon:{shareUrl:"http://www.stumbleupon.com/submit",params:{url:this.getValue("url"),title:this.getValue("title")}},flipboard:{shareUrl:"https://share.flipboard.com/bookmarklet/popout",params:{v:2,title:this.getValue("title"),url:this.getValue("url"),t:Date.now()}},weibo:{shareUrl:"http://service.weibo.com/share/share.php",params:{url:this.getValue("url"),title:this.getValue("title"),pic:this.getValue("image"),appkey:this.getValue("appkey"),ralateUid:this.getValue("ralateuid"),language:"zh_cn"}},renren:{shareUrl:"http://share.renren.com/share/buttonshare",params:{link:this.getValue("url")}},myspace:{shareUrl:"https://myspace.com/post",params:{u:this.getValue("url"),t:this.getValue("title"),c:this.getValue("description")}},blogger:{shareUrl:"https://www.blogger.com/blog-this.g",params:{u:this.getValue("url"),n:this.getValue("title"),t:this.getValue("description")}},baidu:{shareUrl:"http://cang.baidu.com/do/add",params:{it:this.getValue("title"),iu:this.getValue("url")}},douban:{shareUrl:"https://www.douban.com/share/service",params:{name:this.getValue("title"),href:this.getValue("url"),image:this.getValue("image")}},okru:{shareUrl:"https://connect.ok.ru/dk",params:{"st.cmd":"WidgetSharePreview","st.shareUrl":this.getValue("url"),title:this.getValue("title")}},mailru:{shareUrl:"http://connect.mail.ru/share",params:{share_url:this.getValue("url"),linkname:this.getValue("title"),linknote:this.getValue("description"),type:"page"}}},a=e[t];if(a){a.width=this.getValue("width");a.height=this.getValue("height")}return a!==undefined?this.urlSharer(a):false},urlSharer:function(e){var a=e.params||{},r=Object.keys(a),i,s=r.length>0?"?":"";for(i=0;i<r.length;i++){if(s!=="?"){s+="&"}if(a[r[i]]){s+=r[i]+"="+encodeURIComponent(a[r[i]])}}e.shareUrl+=s;if(!e.isLink){var l=e.width||600,h=e.height||480,u=t.innerWidth/2-l/2+t.screenX,n=t.innerHeight/2-h/2+t.screenY,g="scrollbars=no, width="+l+", height="+h+", top="+n+", left="+u,o=t.open(e.shareUrl,"",g);if(t.focus){o.focus()}}else{t.location.href=e.shareUrl}}};if(e.readyState==="complete"||e.readyState!=="loading"){a.init()}else{e.addEventListener("DOMContentLoaded",a.init)}t.addEventListener("page:load",a.init);t.Sharer=a})(window,document);
}

//initialize events  here
function initEvents(){

	/*New js code end*/
	/*changes from 19.07 start*/
/*
	$('.userprofile-image:not(.my-profile-image)>img').on('click', function(){
		var url = $(this).attr('src');
		$('#maine-photo-popup').find('.maine-popup-image>img').attr('src', url);
		$('#maine-photo-popup').addClass('flex-wrapper');
		fixBody();
	});*/
	$('.my-profile-image').on('click', function(){
		var url = $('.my-profile-image-change').attr('src');
		$('#profile-photo-popup').find('.image-profile-current>img').attr('src', url);
		$('#profile-photo-popup').addClass('flex-wrapper');

		fixBody();
	});
	$( ".my-profile-image-change" ).hover(
		function() {
			$(this).next().toggleClass('nonactive');
			$('.tal label').css('display', 'block');
			$('.btn-main-change').attr('id', 'button_resize');
		}
		);
	$( ".my-profile-image" ).hover(
		function() {
			$(this).toggleClass('nonactive');
			$('.tal label').css('display', 'block');
			$('.btn-main-change').attr('id', 'button_resize');
		}
		);

	$('.my-profile-image-owner').on('click', function(){
		var url = $('#owner_image').attr('src');
		$('#profile-photo-popup').find('.image-profile-current>img').attr('src', url);
		$('#profile-photo-popup').addClass('flex-wrapper');

		fixBody();
	});

	$('.my-profile-image-family').on('click', function(){
		var url = $('#edit_famiy_image').attr('src');
		$('#profile-photo-popup').find('.image-profile-current>img').attr('src', url);
		$('#profile-photo-popup').addClass('flex-wrapper');

		fixBody();
	});

	$('.my-profile-image-add-dog').on('click', function(){
		var url = $('#add_image').attr('src');
		$('#profile-photo-popup').find('.image-profile-current>img').attr('src', url);
		$('#profile-photo-popup').addClass('flex-wrapper');

		fixBody();
	});



	var drop = false;

	$('.notifi-event-drop').on('click', function(e){
		e.preventDefault();

		if (drop == false) {
			drop = true;
			get_all_event();
			var timer1 = setTimeout(function(){
				var data =  new FormData();
				data.append("rem_event_active", 'true');

				$.ajax({
					url: "/application/Request/setpost.php",
					type: "POST",
					data: data,
					processData: false,
					contentType: false,
					success: function (data) {
    					//console.log(data);
    					$('.notification-count-event').remove();
    					$('.list-notifi-event').removeClass('event-active');
    				}
    			});
			}, 3000);
		} else{
			drop = false;
			clearTimeout(timer1);
		}
		$(this).next().toggleClass('hidden');
	});
	function get_all_event(){
		var data =  new FormData();
		data.append("get_all_event", 'true');

		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
    			//console.log(data);
    			$('.event-drop').empty();
    			$('.event-drop').append(data);      
    		}
    	});
	}

	var url = window.location; 
	var element = $('.nav-middle li a').filter(function() {
		return url.indexOf($(this).href) || url.href.indexOf($(this).href) == 0; 
		console.log(url.indexOf($(this).href));
	}).addClass('menu-activ');

	setIdleFamily();
	var rectImgArray;

		$('.post-images-container').each(function(){
			if ($(this).hasClass('multiple-images')){
				if ($(this).hasClass('four-images') || $(this).hasClass('two-images')){
					$(this).find('img').addClass('rectangularImg');
				} else if ($(this).hasClass('three-images')){
					$(this).find('img:not(:first)').addClass('rectangularImg');
				}
				rectImgArray = $(this).find('.rectangularImg');
					rectImgArray.each(function(){
						$(this).height($(this).width());
					});
			}
		});

}

$('.sidebar').on('change', function(){
	setIdleFamily();
});

$(window).resize(function(){
	$('.rectangularImg').height($('.rectangularImg').width());
})

function auto_grow(element) {
	element.style.height = "5px";
	element.style.height = (element.scrollHeight)+"px";
}

function pool_event(){
	var data =  new FormData();
	data.append("get_event", 'true');

	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			//console.log(data);
			if (data > 0) {
				$('.notification-count-event').remove();
				$('.notification-event').prepend('<span class="notification-count notification-count-event">'+data+'</span>');
				get_all_event();
			} else {
				$('.notification-count-event').remove();
			}

		}
	});
}

function setIdleFamily() {
	if (!$('.family').length){
		$('.sidebar.tile').addClass('idle');
	}
	else{
		$('.sidebar.tile').removeClass('idle');
	}
}



$(document).on("mouseenter",'.comment', function() {
	var parid = $(this).attr('id');
	$('.remove_comment_' + parid).toggleClass('hidden');
	console.log(parid); 
}).on('mouseleave','.comment', function() {
	var parid = $(this).attr('id');
	$('.remove_comment_' + parid).toggleClass('hidden');
	console.log(parid);
});

$(document).ready(function() {

	initShare();
	initEvents();
	pool_event();

	setInterval(pool_event,8000);


	/*-----hide popup-----*/
	$(document).on('click','#exit', function() {
		$("#popup1").hide();
		document.getElementById("popUpwindow").remove();
	});
	/*-----end hide-----*/
	var rem_following = document.body.querySelectorAll('#remove_following');
	for (var i = 0; i < rem_following.length; i++) {
		$(rem_following[i]).mouseover(function () {
			$(this).text("Unfollow");
			$(this).removeClass('following-message');
			$(this).addClass('unfollow-cta');
		});
		$(rem_following[i]).mouseleave(function () {
			$(this).text("Following");
			$(this).removeClass('unfollow-cta');
			$(this).addClass('following-message');
		});
	}

	/*-----discover pagination-------*/
	var discover_start = 0;
	var discover_limit = 10;

	$(document).on('click','#discover_view', function() {
		var max = $(this).attr('data-count');


		discover_start = discover_start + 10;
		discover_limit = discover_limit + 10;
		if (max < 20) {
			discover_limit = max;
			$(this).css('display','none');
		}
		if (discover_limit > max) {
			discovert = discover_limit - max;
			discover_limit = discover_limit - discovert;
			$(this).css('display','none');
		}
		if (discover_limit == max) {
			$(this).css('display','none');
		}

		var breed = $_GET['breed'];
		var location = $_GET['location'];
		var saf = $_GET['agefrom'];
		var sa = $_GET['ageto'];
		var data =  new FormData();
		data.append("discover_pagin", "true");
		data.append("discover_start", discover_start);
		data.append("discover_limit", discover_limit);
		data.append("breed", breed);
		data.append("location", location);
		data.append("serch_agefrom", saf);
		data.append("serch_ageto", sa);

		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data);

				$('.discover').append(data);
			}

		});

	});
/*background-color: rgba(48, 55, 63, .05);*/
	$(document).on('click', '#filter-accounts', function(){
		var txt = $('.input-search-by-keyword').val();
		if (txt.trim().length != 0) {
			$(this).toggleClass('filter-category');
			$('#filter-photos').removeClass('filter-category');
			$('.users_wall_posts').toggleClass('hidden');
			if ($('.list-element').hasClass('hidden')) {
				$('.list-element').removeClass('hidden');
			}
		}
	});

	$(document).on('click', '#filter-photos', function(){
		var txt = $('.input-search-by-keyword').val();
		if (txt.trim().length != 0) {
			$(this).toggleClass('filter-category');
			$('#filter-accounts').removeClass('filter-category');
			$('.list-element').toggleClass('hidden');
			if ($('.users_wall_posts').hasClass('hidden')) {
				$('.users_wall_posts').removeClass('hidden');

			}
		}
	});

	/*pagination*/

	var follow_start = 0;
	var follow_limit = 10;


	$(document).on('click','#whotofollow_view', function() {
		var followmax = $(this).attr('data-count');
		follow_start = follow_start + 10;
		follow_limit = follow_start + 10;
		if (followmax < 20) {
			follow_limit = followmax;
			$(this).css('display','none');
		}
		if (follow_limit > followmax) {
			discovert = follow_limit - followmax;
			follow_limit = follow_limit - discovert;
			$(this).css('display','none');
		}

		if (follow_limit == followmax) {
			$(this).css('display','none');
		}

		var data =  new FormData();
		data.append("whotofollow", "true");
		data.append("follow_start", follow_start);
		data.append("follow_limit", follow_limit);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data);
				$('.followers').empty();
				$('.followers').append(data);
			}

		});

	});

	

});


/*----button show pop-up in edit post-----*/
var plus_photo;

function fileSelectHandler(thiss) {

    // get selected file
    var oFile = $(thiss)[0].files[0];
    img = oFile;
    // hide all errors
    /*$('.error').hide();*/
    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
    	/*$('.error').html('Please select a valid image file (jpg and png are allowed)').show();*/
    	return;
    }

    // check for file size
/*    if (oFile.size > 250 * 1024) {
        $('.error').html('You have selected too big file, please select a one smaller image file').show();
        return;
    }*/

    // preview element
    var oImage = document.getElementById('maine_photo_image');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
    oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;

        oImage.onload = function () { // onload event handler
        	var mw = oImage.width;  
        	var mh = oImage.height;  
        	var rw = oImage.naturalWidth; 
        	var rh = oImage.naturalHeight; 
        	//alert(rw + ', ' + rh);
        	maxS = 1024/(rw/mw);
        	minS = 500 /(rw/mw);
        	if (rw < 500 ) {
        		alert("Choose a larger photo size!");
        		return;
/*        		var maxS = rw;
var minS = 500;*/
}
$('#maine_photo_image').imgAreaSelect({
	onSelectChange: function(img, selection){

	},
	handles: true,
	aspectRatio: '1:1',
	maxWidth: maxS, 
	maxHeight: maxS, 
	minWidth:minS,
	minHeight:minS,
	onSelectEnd: function (img, selection) {
        			//console.log('minmewW: ' + maxS + '; height: ' + minS + '; x1: '+ selection.x1 + '; y1: ' + selection.y1);
        			x1 = selection.x1;
        			y1 = selection.y1;
        			w = selection.width;
        			h = selection.height;

        		}

        	});

};
};

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);

}

/*-----button resize photo-----*/
$(document).on('click','#button_resize', function() {
	var myimage = document.getElementById("maine_photo_image"); 
	var mw = myimage.width;  
	var mh = myimage.height;  
	if (typeof myimage.naturalWidth == "undefined") { 
  // IE 6/7/8 
  var i = new Image(); 
  i.src = myimage.src; 
  var rw = i.width; 
  var rh = i.height; 
} 
else { 
  // HTML5 browsers 
  var rw = myimage.naturalWidth; 
  var rh = myimage.naturalHeight; 
}
//alert(w + ', h: ' + h + ', rw: ' + (rw/mw) + ', rh: ' + rh);
if ($('#add-single-dog-popup').hasClass('flex-wrapper') || $('#edit-single-dog-popup').hasClass('flex-wrapper') ||  $('#edit-family-popup').hasClass('flex-wrapper') || $('#edit-owner-popup').hasClass('flex-wrapper')) {
	var setup = 'setting_photo';
} else {
	var setup = 'main_photo';
}


var input = document.getElementById("maine_userfile");


file = input.files[0];
if (file != undefined) {
	formData = new FormData();
	if (!!file.type.match(/image.*/)) {
		formData.append(setup, 'true');
		formData.append("img", file);
		formData.append('x1', x1 * (rw/mw));
		formData.append('y1', y1 * (rh/mh));
		formData.append('h', h * (rh/mh));
		formData.append('w', w * (rw/mw));
			/*formData.append('pid', dataArray.length);
			*/
			$.ajax({
				url: "upload",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					
					
					if ($('#add-single-dog-popup').hasClass('flex-wrapper')){
						console.log(data);
						$('#add_image').attr('src', data);
						$('.imgareaselect-outer').css('display', 'none');
						$('.imgareaselect-selection').parent().css('display', 'none');
						$('#profile-photo-popup').removeClass('flex-wrapper');

					}else if ($('#edit-single-dog-popup').hasClass('flex-wrapper')) {
						console.log(data);
						$('.profile-edit-image-container #image').attr('src', data);
						$('.imgareaselect-outer').css('display', 'none');
						$('.imgareaselect-selection').parent().css('display', 'none');
						$('#profile-photo-popup').removeClass('flex-wrapper');

					}else if ($('#edit-family-popup').hasClass('flex-wrapper')) {

						$('#edit_famiy_image').attr('src', data);
						$('.imgareaselect-outer').css('display', 'none');
						$('.imgareaselect-selection').parent().css('display', 'none');
						$('#profile-photo-popup').removeClass('flex-wrapper');

					}else if ($('#edit-owner-popup').hasClass('flex-wrapper')) {

						$('#owner_image').attr('src', data);
						$('.imgareaselect-outer').css('display', 'none');
						$('.imgareaselect-selection').parent().css('display', 'none');
						$('#profile-photo-popup').removeClass('flex-wrapper');

					} else {
						$('.my-profile-image img').attr('src', data);
						$(".account-info .por #account-image").attr('src', data);
						$('.popups-wrapper').removeClass('flex-wrapper');
						$('body').css('overflow-y','auto');
						$('.imgareaselect-outer').css('display', 'none');
						$('.imgareaselect-selection').parent().css('display', 'none');
						location.reload();
						console.log(data);
					}

				}
			});
		} else {
			alert('Not a valid image!');
		}
	}

});

$(document).on('click', '#button_resize_setting', function(){
	var myimage = document.getElementById("maine_photo_image"); 
	var mw = myimage.width;  
	var mh = myimage.height;  
	if (typeof myimage.naturalWidth == "undefined") { 
  // IE 6/7/8 
  var i = new Image(); 
  i.src = myimage.src; 
  var rw = i.width; 
  var rh = i.height; 
} 
else { 
  // HTML5 browsers 
  var rw = myimage.naturalWidth; 
  var rh = myimage.naturalHeight; 
}
//alert(w + ', h: ' + h + ', rw: ' + (rw/mw) + ', rh: ' + rh);

var input = document.getElementById("add_userfile");
file = input.files[0];
if (file != undefined) {
	formData = new FormData();
	if (!!file.type.match(/image.*/)) {
		formData.append("setting_photo", 'true');
		formData.append("img", file);
		formData.append('x1', x1 * (rw/mw));
		formData.append('y1', y1 * (rh/mh));
		formData.append('h', h * (rh/mh));
		formData.append('w', w * (rw/mw));
			/*formData.append('pid', dataArray.length);
			*/
			$.ajax({
				url: "upload",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					console.log(data);
					$('#add_image').attr('src', data);
					$('.imgareaselect-outer').css('display', 'none');
					$('.imgareaselect-selection').parent().css('display', 'none');
					$('#profile-photo-popup').removeClass('flex-wrapper');
				}
			});
		} else {
			alert('Not a valid image!');
		}
	}
});


$(document).on('click', '#button_resize_fam', function(){
	var myimage = document.getElementById("maine_photo_image"); 
	var mw = myimage.width;  
	var mh = myimage.height;  
	if (typeof myimage.naturalWidth == "undefined") { 
  // IE 6/7/8 
  var i = new Image(); 
  i.src = myimage.src; 
  var rw = i.width; 
  var rh = i.height; 
} 
else { 
  // HTML5 browsers 
  var rw = myimage.naturalWidth; 
  var rh = myimage.naturalHeight; 
}
//alert(w + ', h: ' + h + ', rw: ' + (rw/mw) + ', rh: ' + rh);

var input = document.getElementById("family_userfile");
file = input.files[0];
if (file != undefined) {
	formData = new FormData();
	if (!!file.type.match(/image.*/)) {
		formData.append("setting_photo", 'true');
		formData.append("img", file);
		formData.append('x1', x1 * (rw/mw));
		formData.append('y1', y1 * (rh/mh));
		formData.append('h', h * (rh/mh));
		formData.append('w', w * (rw/mw));
			/*formData.append('pid', dataArray.length);
			*/
			$.ajax({
				url: "upload",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					console.log(data);
					$('#family_add_image').attr('src', data);
					$('.imgareaselect-outer').css('display', 'none');
					$('.imgareaselect-selection').parent().css('display', 'none');
					$('#profile-photo-popup').removeClass('flex-wrapper');
				}
			});
		} else {
			alert('Not a valid image!');
		}
	}
});

$(document).on('click', '#button_resize_pet', function(){
	var myimage = document.getElementById("maine_photo_image"); 
	var mw = myimage.width;  
	var mh = myimage.height;  
	if (typeof myimage.naturalWidth == "undefined") { 
  // IE 6/7/8 
  var i = new Image(); 
  i.src = myimage.src; 
  var rw = i.width; 
  var rh = i.height; 
} 
else { 
  // HTML5 browsers 
  var rw = myimage.naturalWidth; 
  var rh = myimage.naturalHeight; 
}
//alert(w + ', h: ' + h + ', rw: ' + (rw/mw) + ', rh: ' + rh);

var input = document.getElementById("pet_userfile");
file = input.files[0];
if (file != undefined) {
	formData = new FormData();
	if (!!file.type.match(/image.*/)) {
		formData.append("setting_photo", 'true');
		formData.append("img", file);
		formData.append('x1', x1 * (rw/mw));
		formData.append('y1', y1 * (rh/mh));
		formData.append('h', h * (rh/mh));
		formData.append('w', w * (rw/mw));
			/*formData.append('pid', dataArray.length);
			*/
			$.ajax({
				url: "upload",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					console.log(data);
					$('#pet_add_image').attr('src', data);
					$('.imgareaselect-outer').css('display', 'none');
					$('.imgareaselect-selection').parent().css('display', 'none');
					$('#profile-photo-popup').removeClass('flex-wrapper');
				}
			});
		} else {
			alert('Not a valid image!');
		}
	}
});
/*-----end button-----*/
/*------edit post-------*/
/*var srcimg = [];
$(document).on('click','#edit_post', function() {
	srcimg = [];
	var parid = this.parentNode.id;

	$(this).css('display','none');
	$('.posts_content_' + parid).css('display','none');
	var txt = $('.post_message_'+parid).text();
	var untime = $( '.post_time_'+parid ).text();
	var imgsrc = document.body.querySelectorAll('.posts_attach_photo_'+parid);

	$('#post_'+parid).append('<div class="block_edit_post_'+parid+'" id="'+parid+'"> \
		<textarea cols="20" rows="1" id="edit_post_text_'+parid+'">'+txt+'</textarea><br> \
		<button class="edit_post_btn">send</button> \
		<button class="rem_post_edit">back</button> \
		<ul class="edit_post_photo_list" id="edit_post_photo_list_'+parid+'"> \
		</ul> \
		</div>');
/*for (i=10;i>0;i--) {
document.write(i);
}

for (var x = 0; x < imgsrc.length; x++) {
	/*alert(imgsrc[x].getAttribute("src"));
	srcimg[x] = imgsrc[x].getAttribute('src');

	$('#edit_post_photo_list_'+parid).append('<li id="'+[x]+'"><img class="posts_attach_photo posts_attach_photo_'+[x]+'" src="'+ srcimg[x] +'">\
		<img class="remove_attach_photo" id="remove_attach_photo" src="/img/include/remove.png"></li>');
}
if ((imgsrc.length + 1) <= 4) {
	$('#edit_post_photo_list_'+parid).append('<li class="add_edit_post_photo"><button class="plus_photo">add</button></li>');
}

});*/

/*--------добавить фото при редактировании поста-----------------*/
$(document).on('click','.add_edit_photo', function() {
	if ((srcimg.length + 1) >= 4) {
		$('.add_edit_post_photo').remove();
	}
	var x = srcimg.length;//((document.getElementById(plus_photo).getElementsByTagName("li").length) - 1);
	var input = document.getElementById("image_file");
	file = input.files[0];
	if (file != undefined) {
		formData = new FormData();
		if (!!file.type.match(/image.*/)) {
			formData.append("img", file);
			formData.append('x1', x1);
			formData.append('y1', y1);
			formData.append('h', h);
			formData.append('w', w);
			formData.append('pid', srcimg.length);
			
			$.ajax({
				url: "upload",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					////console.log(data);
					$('#'+plus_photo).prepend('<li id="'+[x]+'"><img class="posts_attach_photo posts_attach_photo_'+[x]+'" src="'+ data +'">\
						<img class="remove_attach_photo" id="remove_attach_photo" src="/img/include/remove.png"></li>');
					$("#popup1").hide();
					document.getElementById("popUpwindow").remove();
					srcimg.push(data);

					////console.log(dataArray.length);
				}
			});
		} else {
			alert('Not a valid image!');
		}
	}
	
});

/* ----------удалить фото при редактировании поста-------------*/
$(document).on('click','#remove_attach_photo', function() {
	//alert(srcimg);
	var parid = this.parentNode.id;
	var listItem = this.parentNode.parentNode.id;
	var listid = $('#'+listItem+' > li').index($('#'+parid));
	//srcimg.reverse()
	srcimg.splice(listid, 1);
	//alert(srcimg);
	this.parentNode.remove();

	if ((srcimg.length + 1) <= 4) {
		$('#edit_post_photo_list_'+parid).append('<li class="add_edit_post_photo"><button class="plus_photo">add</button></li>');
	}
});

function rem_post(parid){
	$('.block_edit_post_' + parid).remove();
	$('.edit_post_'+parid).css('display','inline-block');
	$('.posts_content_'+parid).css('display','block');
	
}

/*-------------окончить редактирование--------------------*/
$(document).on('click','.rem_post_edit', function() {
	var parid = this.parentNode.id;
	rem_post(parid);
	srcimg = [];
});

/*------------сохранить редактированый пост---------------*/
$(document).on('click','.edit_post_btn', function() {
	//alert(srcimg);
	var parid = this.parentNode.id;
	var date = new Date();
	var txt = $('#edit_post_text_'+parid).val();
	var untime = $( '.post_time_'+parid ).text();

	var data =  new FormData();
	data.append("edit_post", "true");
	data.append("edit_post_message", txt);
	data.append("edit_post_attachment", srcimg);
	data.append("edit_post_count_attach", srcimg.length);
	data.append("edit_post_id", parid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			rem_post(parid);
			$('.post_message_'+parid).text(txt);
			$('#posts_attach_'+parid).empty();
			for (var x = 0; x < srcimg.length; x++) {
				$('#posts_attach_'+parid).append('<li><img class="posts_attach_photo_'+parid+'" src="'+ srcimg[x] +'"></li>');
			}
			$( '.post_time_'+parid ).text(date.getFullYear()+'-'+ date.getMonth()+'-'+ date.getDate()+' '+date.getHours()+':'+ date.getMinutes()+':'+  date.getSeconds());
			srcimg = [];
		}
	});
	
});




/*-------end edit-------*/

var select, value, text;


$(document).on('click','.follow-dogs', function() {
	value = $(this).attr('id');

	var parid = this.parentNode.id;
	//post_data = {postid:parid, uid:value};account_image_popup_280
	var scrim = $('#follow-dog-image_' + value).attr('src');
	document.getElementById("account-image_" + parid).src = scrim; 
	document.getElementById("newcomment-avatar_" + parid).src = scrim;
	/*document.getElementById("account_image_popup_" + parid).src = scrim;
	document.getElementById("newcomment_avatar_popup_" + parid).src = scrim;*/
	document.getElementById('post_likes_' + parid).setAttribute('data-user', value);
	chek_post_likes(value, parid);
});

function chek_post_likes(value, idpost){
	var data =  new FormData();
	data.append("chek_user_likes_id", value);
	data.append("chek_post_likes_id", idpost);

	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			/*$('#post_likes_' +idpost).empty();
			$('#post_likes_' +idpost).append(data);*/
			
			if (data == 1) {
				$('.post_likes_' +idpost).removeClass('link-gray');
				$('.post_likes_' +idpost).addClass('link-green');
				$('.post_likes_' +idpost).removeClass('highpawes-grey');
				$('.post_likes_' +idpost).addClass('highpawes');
				$('.post_likes_popup_' +idpost).removeClass('link-gray');
				$('.post_likes_popup_' +idpost).addClass('link-green');
				$('.post_likes_popup_' +idpost).removeClass('highpawes-grey');
				$('.post_likes_popup_' +idpost).addClass('highpawes')
				set_like = true;
			} else {
				$('.post_likes_' +idpost).removeClass('link-green');
				$('.post_likes_' +idpost).removeClass('highpawes');
				$('.post_likes_' +idpost).addClass('link-gray');
				$('.post_likes_' +idpost).addClass('highpawes-grey');
				$('.post_likes_popup_' +idpost).removeClass('link-green');
				$('.post_likes_popup_' +idpost).addClass('link-gray');
				$('.post_likes_popup_' +idpost).removeClass('highpawes');
				$('.post_likes_popup_' +idpost).addClass('highpawes-grey');
				set_like = false;
			}

		}
	});
}

/*----------set like----------*/
var set_like = false;
$(document).on('click','.post_likes', function() {

	var select = $(this).attr('data-user');
	var idpost = this.parentNode.id;
	var user_owner = $('.wall_posts_'+idpost).attr('data-user-post');
	if (value == null) {
		value = select;
	}

	if (set_like == false) {
		set_like = true;
		//console.log('true');
		var data =  new FormData();
		data.append("user_likes_id", value);
		data.append("post_likes_id", idpost);
		data.append("post_user_owner", user_owner);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				$('.post_likes_' +idpost).empty();
				$('.post_likes_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">High Pawes!</span>');
				$('.post_likes_' +idpost).removeClass('link-gray');
				$('.post_likes_' +idpost).addClass('link-green');
				$('.post_likes_' +idpost).removeClass('highpawes-grey');
				$('.post_likes_' +idpost).addClass('highpawes');
				$('.post_likes_popup_' +idpost).empty();
				$('.post_likes_popup_' +idpost).append(data);
				$('.post_likes_popup_' +idpost).removeClass('link-gray');
				$('.post_likes_popup_' +idpost).addClass('link-green');
				$('.post_likes_popup_' +idpost).removeClass('highpawes-grey');
				$('.post_likes_popup_' +idpost).addClass('highpawes')
			}
		});
	} else {
		set_like = false;
		//console.log('false');
		remove_like(value, idpost);
	}
	value = null;
});

function remove_like(value, idpost){
	var data =  new FormData();
	data.append("rem_user_likes_id", value);
	data.append("rem_post_likes_id", idpost);
	
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			$('.post_likes_' +idpost).empty();
			$('.post_likes_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">High Pawes!</span>');
			$('.post_likes_' +idpost).removeClass('link-green');
			$('.post_likes_' +idpost).addClass('link-gray');
			$('.post_likes_' +idpost).removeClass('highpawes');
			$('.post_likes_' +idpost).addClass('highpawes-grey');
			$('.post_likes_popup_' +idpost).empty();
			$('.post_likes_popup_' +idpost).append(data);
			$('.post_likes_popup_' +idpost).removeClass('link-green');
			$('.post_likes_popup_' +idpost).addClass('link-gray');
			$('.post_likes_popup_' +idpost).removeClass('highpawes');
			$('.post_likes_popup_' +idpost).addClass('highpawes-grey');
		}
	});
}

/*----------end----------*/

/*-----add following-----*/

function check_following(){
	var data =  new FormData();
	data.append("check_follow", "true");
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			$('.count_follow_me').remove();
			$('.count_followers_me').remove();
			$('.userprofile-counters').append(data);
		}
	});
}


$(document).on('click','#add_following', function() {
	var one = 0;
	if ($(this).hasClass('follow_sidebar')){
		one = 0;
	} else {
		one = 1;
		
	}

	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("follow", "true");
	data.append("parentNode_id", parid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			$('.state-unfollow_'+parid + ' #remove_following').css('display', 'block');
			$('.state-follow_'+parid + ' #remove_following').css('display', 'block');
			if (one == 1) {
				check_following();
			}
			
		}
	});

	$(this).css('display', 'none');
	//alert(this.parentNode.id);
	//$(this).text("Follow");
});


/*----who to follow add------*/
var timer1;
$(document).on('click','#add_following_tofollow', function() {
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("follow", "true");
	data.append("parentNode_id", parid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			$('.add_remove_followers_'+parid + ' #removing_following_tofollow').css('display', 'block');
			check_following();
			timer1 = setTimeout(function(){
				$('.followers_' + parid).remove();
			}, 3000);
		}
	});

	$(this).css('display', 'none');
});
/*----who to follow add------*/


/*-----end add following-----*/



/*-----remove following-----*/

/*----who to follow rem----*/
$(document).on('click','#removing_following_tofollow', function() {
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("remove_follow", "true");
	data.append("parentNode_id", parid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			//console.log(data);
			$('.add_remove_followers_'+parid + ' #add_following_tofollow').css('display', 'block');
			check_following();
			//$('.state-unfollow_'+parid).append('<button class="link button button-cta-green contest-button follow-cta add_follow" id="add_following_page">Follow</button>');
		}
	});
	$(this).css('display', 'none');
	clearTimeout(timer1);
});

/*----who to follow rem----*/

$(document).on('click','#remove_following', function() {
	var one = 0;
	if ($(this).hasClass('follow_sidebar')){
		one = 0;
	} else {
		one = 1;
		
	}
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("remove_follow", "true");
	data.append("parentNode_id", parid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			//console.log(data);
			$('.state-unfollow_'+parid + ' #add_following').css('display', 'block');
			$('.state-follow_'+parid + ' #add_following').css('display', 'block');
			if (one == 1) {
				check_following();
			}
		}
	});
	$(this).css('display', 'none');
	
});


/*-----end rem following-----*/

/*-----remove comment-----*/
var remove_comm= {};
$(document).on('click','#remove_comment', function() {
	var parid = this.parentNode.id;
	var idpost = this.parentNode.parentNode.parentNode.id;
	var data =  new FormData();
	data.append("remove_comment", "true");
	data.append("remove_comment_id", parid);
	var data_comment =  new FormData();
	data_comment.append("count_comment", "true");
	data_comment.append("count_post_id", idpost);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			remove_comm[parid] = data;
			//$(".comment_" + parid).remove();
			console.log(data);
			$(".comment_" + parid).children().css('display', 'none');
			$(".comment_" + parid).append('<a href="#" class="link-blue no-margin undo_remove_comment undo_'+parid +'">Undo removing</a>');
		}
	});
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data_comment,
		processData: false,
		contentType: false,
		success: function (data) {
			$('.post_comment_' +idpost).empty();
			$('.post_comment_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">Comment</span>');
			$('.post_comment_popup_' +idpost).empty();
			$('.post_comment_popup_' +idpost).append(data);

		}
	});
	$(this).addClass('hidden');
	
});

$(document).on('click','.undo_remove_comment', function() {
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("undo_removing_comment", "true");
	data.append("undo_remove_comment_id", remove_comm[parid]);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			delete remove_comm[parid];
			$(".comment_" + parid).children().css('display', 'block');

		}

	});

	$('.undo_' + parid).remove();
});
/*-----end comment-----*/

/*-----edit comment-----*/
var edit_comment;
$(document).on('click','#edit_comment', function() {
	var parid = this.parentNode.id;
	edit_comment = this.parentNode.id;

	$(this).css('display','none');
	$('#comment_text_' + parid).css('display','none');
	var txt = $('#comment_text_'+parid).text();
	var untime = $( '.utime_'+parid ).text();
	//$('.comment_block_'+parid).append('<div class="block_edit_'+parid+'" id="'+parid+'"><textarea cols="20" rows="1" id="edit_comment_text_'+parid+'">'+txt+'</textarea><br><button class="edit_comment_btn">send</button><button class="rem_text_edit">back</button></div>');

});
function rem_comment(parid){
	$('.block_edit_' + parid).remove();
	$('.edit_comment_'+parid).css('display','inline-block');
	$('#comment_text_' + parid).css('display','inline-block');
}
$(document).on('click','.rem_text_edit', function() {
	var parid = this.parentNode.id;
	rem_comment(parid);
	
});
$(document).on('click','.edit_comment_btn', function() {
	var parid = this.parentNode.id;
	var txt = $('#edit_comment_text_' + parid).val();
	//alert(txt);
	var data =  new FormData();
	data.append("edit_comment_txt", txt);
	data.append("edit_comment_id", parid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			var date = new Date();
			$('#comment_text_'+parid).text(data);
			$( '.utime_'+parid ).text(date.getFullYear()+'-'+ date.getMonth()+'-'+ date.getDate()+' '+date.getHours()+':'+ date.getMinutes()+':'+  date.getSeconds());
			rem_comment(parid);
		}
	});
	
});
/*-----end comment-----*/

/*--------add comment-------------*/

$(document).on('click','#add_comment_wall', function() {

	var idpost = this.parentNode.id;
	//var select = $(this).attr('data-user');
	var uid = $('#post_likes_' + idpost).attr('data-user');

	var blah = $('#text_add_comment_' + idpost).val();
	
	var user_owner = $('.wall_posts_'+idpost).attr('data-user-post');
	
	var myList = $('.comment_list_'+idpost+' li').length;
	//console.log(myList); 
	var follow_max = $('.comment_view_' + idpost).attr('data-count');
	if (blah.trim().length != 0) {
		if (myList == 10) {
			comment_view(this, 10, follow_max, idpost);
		}


		var data =  new FormData();
		data.append("user_comment_id", uid);
		data.append("post_comment_id", idpost);
		data.append("comment_text", blah);
		data.append("coment_user_owner", user_owner);
		var data_comment =  new FormData();
		data_comment.append("count_comment", "true");
		data_comment.append("count_post_id", idpost);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
						//$('.comment_list' +idpost).empty();
						$('.comment_list_' +idpost).append(data);
					}
				});
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data_comment,
			processData: false,
			contentType: false,
			success: function (data) {
				$('.post_comment_' +idpost).empty();
				$('.post_comment_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">Comment</span>');
				$('.post_comment_popup_' +idpost).empty();
				$('.post_comment_popup_' +idpost).append(data);
			}
		});
		document.getElementById('text_add_comment_' + idpost).value="";
		document.getElementById('text_add_comment_' + idpost).placeholder = "Leave a comment for your friend"; 

		//value = null;
	}
});

$(document).on('keyup', '.text_add_comment', function(event){
	var blah = $(this).val();
	
	if(event.keyCode == 13 && !event.shiftKey && this.value.trim().length != 0){
		var idpost = this.parentNode.parentNode.id;
		var uid = $('#post_likes_' + idpost).attr('data-user');
		var user_owner = $('.wall_posts_'+idpost).attr('data-user-post');
		var myList = $('.comment_list_'+idpost+' li').length;
		var follow_max = $('.comment_view_' + idpost).attr('data-count');

		if (myList == 10) {
			comment_view(this, 10, follow_max, idpost);
		}
		var data =  new FormData();
		data.append("user_comment_id", uid);
		data.append("post_comment_id", idpost);
		data.append("comment_text", blah);
		data.append("coment_user_owner", user_owner);
		var data_comment =  new FormData();
		data_comment.append("count_comment", "true");
		data_comment.append("count_post_id", idpost);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
						//$('.comment_list' +idpost).empty();
						$('.comment_list_' +idpost).append(data);
					}
				});
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data_comment,
			processData: false,
			contentType: false,
			success: function (data) {
				$('.post_comment_' +idpost).empty();
				$('.post_comment_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">Comment</span>');
				$('.post_comment_popup_' +idpost).empty();
				$('.post_comment_popup_' +idpost).append(data);
			}
		});
		document.getElementById('text_add_comment_' + idpost).value="";
		document.getElementById('text_add_comment_' + idpost).placeholder = "Leave a comment for your friend"; 
	}
});

$(document).on('click','#add_comment_popup', function() {
	var idpost = this.parentNode.id;
	var blah = $('#text_add_comment_popup_' + idpost).val();
	var uid = $('#post_likes_' + idpost).attr('data-user');
	var user_owner = $('.wall_posts_'+idpost).attr('data-user-post');
	var myList = $('.comment_list_popup .comment_list_'+idpost+' li').length;
	var follow_max = $('.comment_view_popup_' + idpost).attr('data-count');
	if (blah.trim().length != 0) {
		if (myList == 5) {
			comment_view(this, 5, follow_max, idpost);
		}
		
		var data =  new FormData();
		data.append("user_comment_id", uid);
		data.append("post_comment_id", idpost);
		data.append("comment_text", blah);
		data.append("coment_user_owner", user_owner);
		var data_comment =  new FormData();
		data_comment.append("count_comment", "true");
		data_comment.append("count_post_id", idpost);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
						//$('.comment_list' +idpost).empty();
						$('.comment_list_' +idpost).append(data);
					}
				});
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data_comment,
			processData: false,
			contentType: false,
			success: function (data) {
				$('.post_comment_' +idpost).empty();
				$('.post_comment_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">Comment</span>');
				$('.post_comment_popup_' +idpost).empty();
				$('.post_comment_popup_' +idpost).append(data);
			}
		});
		document.getElementById('text_add_comment_popup_' + idpost).value="";
		document.getElementById('text_add_comment_popup_' + idpost).placeholder = "Leave a comment for your friend"; 

	}
});

$(document).on('keyup', '.text_add_comment_popup', function(event){
	var blah = $(this).val();
	
	if(event.keyCode == 13 && !event.shiftKey && this.value.trim().length != 0){
		var idpost = this.parentNode.parentNode.id;
		
		var uid = $('#post_likes_' + idpost).attr('data-user');
		var user_owner = $('.wall_posts_'+idpost).attr('data-user-post');
		var myList = $('.comment_list_popup .comment_list_'+idpost+' li').length;
		var follow_max = $('.comment_view_popup_' + idpost).attr('data-count');
		if (myList == 5) {
			comment_view(this, 5, follow_max, idpost);
		}
		
		var data =  new FormData();
		data.append("user_comment_id", uid);
		data.append("post_comment_id", idpost);
		data.append("comment_text", blah);
		data.append("coment_user_owner", user_owner);
		var data_comment =  new FormData();
		data_comment.append("count_comment", "true");
		data_comment.append("count_post_id", idpost);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
						//$('.comment_list' +idpost).empty();
						$('.comment_list_' +idpost).append(data);
					}
				});
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data_comment,
			processData: false,
			contentType: false,
			success: function (data) {
				$('.post_comment_' +idpost).empty();
				$('.post_comment_' +idpost).append(data + ' <span class="hidden-sm hidden-xs">Comment</span>');
				$('.post_comment_popup_' +idpost).empty();
				$('.post_comment_popup_' +idpost).append(data);
			}
		});
		this.value="";
		this.placeholder = "Leave a comment for your friend"; 
	}
});


/*----end press-----*/

/*-----send email-----*/
$(document).on('click','#send_email_btn', function() {

	var send_e = document.getElementById("send_email").value;
	//alert(send_e);
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("send_email_true", "true");
	data.append("send_email_adress", send_e);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			//console.log(data);
			document.getElementById("send_email").value = " ";
		}

	});
	
});
/*-----end email-----*/

/*-----follow-dogs-----*/
$(document).on('click','.follow-dog', function() {

	var send_e = $(this).attr('id');//.getAttribute('src');

	var scrim = $('#follow-dog-image_' + send_e).attr('src');
	document.getElementById("account-image").src = scrim; 
	//$('.newpost-active-part #account-image')
	/*document.getElementById("newpost-avatar").src = scrim; */
	

});

/*-----end follow-dogs-----*/

/*-----save setting-----*/
$(document).on('click','#save_setting', function() {
	var email = document.getElementById("settings-email").value;
	var currpass = document.getElementById("settings-currpass").value;
	var newpass = document.getElementById("settings-newpass").value;
	var newrepass = document.getElementById("settings-newrepass").value;
	var settings_fb = document.getElementById("settings-fb").value;
	var settings_tw = document.getElementById("settings-tw").value;
	var settings_inst = document.getElementById("settings-inst").value;
	var settings_tumblr = document.getElementById("settings-tumblr").value;
	var settings_goo = document.getElementById("settings-goo").value;
	if (currpass == '') {
		currpass = '';
	} else {
		currpass = MD5(currpass);
	}
	if (newpass == '') {
		newpass = '';
	} else {
		newpass = MD5(newpass);
	}
	if (newrepass == '') {
		newrepass = '';
	} else {
		newrepass = MD5(newrepass);
	}
	this.disabled = true;
	
	var data =  new FormData();
	data.append("save_setting_user", "true");
	data.append("email", email);
	data.append("currpass", currpass);
	data.append("newpass", newpass);
	data.append("newrepass", newrepass);
	data.append("settings_fb", settings_fb);
	data.append("settings_tw", settings_tw);
	data.append("settings_inst", settings_inst);
	data.append("settings_tumblr", settings_tumblr);
	data.append("settings_goo", settings_goo);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		beforeSend: function(){
			$('.popup .heading-h3').append('<img src="img/preloader.gif" class="task-img" alt="done photo">');
		},
		complete: function(){
			//$('#image').hide();
		},
		success: function (data) {
			$('.task-img').remove();
			var tile = '<p class="datatile" style="color:#20aa93;">'+data+'</p> ';
			$('.msg_settings').prepend(tile);
			document.getElementById('settings-currpass').value = "";
			document.getElementById("settings-newpass").value = "";
			document.getElementById("settings-newrepass").value = "";
			document.getElementById('settings-currpass').placeholder = "Enter your current password"; 
			document.getElementById("settings-newpass").placeholder = "Enter your new password";
			document.getElementById("settings-newrepass").placeholder = "Enter your new password once again";
			myFunction();

			
		}

	});

	
});

function myFunction() {
	setTimeout(function(){ $('.datatile').remove(); }, 8000);
}
/*-----end setting-----*/
$(document).on('click','#save_setting_guest', function() {
	//var $input = $("#owner_userfile");
	var oldimg = document.getElementById("owner_image").src;
	var texty = oldimg.replace('http://petsoverload.yaskravo.net/img/avatar/','/');
	var sett_location = document.getElementById("signup-location").value;
	var sett_username = document.getElementById("owner-settings-username").value;
	this.disabled = true;
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("sett_username", sett_username);
	data.append("sett_location", sett_location);
	//data.append('img', $input.prop('files')[0]);
	data.append('oldimg', texty);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		beforeSend: function(){
			$('.popup .heading-h3').append('<img src="img/preloader.gif" class="task-img" alt="done photo">');
		},
		complete: function(){
			
		},
		success: function (data) {
			$('.task-img').remove();
			if (data) {
				
				$('.owner-edit-profile-image img').attr('src', oldimg);
				$('.owner-edit-profile-info .follow-dog-name-centered').text(sett_username);
				$('.owner-edit-profile-info .follow-dog-location').text(sett_location);
				$('.popups-wrapper').removeClass('flex-wrapper');
				$('body').css('overflow-y','auto');
				
			} else {
				
			}
			
		}

	});
	
});

/*--------edit family-------*/
$(document).on('click','#edit_family', function() {
	//var $input = $("#edit_famiy_userfile");
	var oldimg = document.getElementById("edit_famiy_image").src;
	var texty = oldimg.replace('http://petsoverload.yaskravo.net/img/avatar/','/');
	var username = document.getElementById("new_family_name").value;
	this.disabled = true;
	var data =  new FormData();
	data.append("edit_family_update", 'true');
	data.append("edit_family_username", username);
	//data.append('img', $input.prop('files')[0]);
	data.append('oldimg', texty);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		beforeSend: function(){
			$('.popup .heading-h3').append('<img src="img/preloader.gif" class="task-img" alt="done photo">');
			
		},
		complete: function(){
			
		},
		success: function (data) {
			$('.task-img').remove();
			$('.popups-wrapper').removeClass('flex-wrapper');
			$('body').css('overflow-y','auto');
			location.reload();
			$('.task-img').remove();
		}

	});
});

/*------add a pet------*/
$(document).on('click','#add-new-dog', function() {
	//var $input = $("#add_userfile");
	var oldimg = document.getElementById("add_image").src;
	var texty = oldimg.replace('http://petsoverload.yaskravo.net/img/avatar/','/');
	var username = document.getElementById("add-username").value;
	var breed = document.getElementById("add-breed").value;
	var datepi = document.getElementById("datepicker").value;
	var sex = document.getElementById("add-sex").value;
	if (username !='') {
		this.disabled = true;
		var data =  new FormData();
		data.append("ajax_add", 'true');
		data.append("ajax_add_username", username);
		data.append("ajax_add_breed", breed);
		data.append("ajax_add_datepi", datepi);
		data.append("ajax_add_sex", sex);
		//data.append('img', $input.prop('files')[0]);
		data.append('oldimg', texty);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			beforeSend: function(){
				$('.popup .heading-h3').append('<img src="img/preloader.gif" class="task-img" alt="done photo">');
			},
			complete: function(){

			},
			success: function (data) {
				$('.task-img').remove();
				$('.popups-wrapper').removeClass('flex-wrapper');
				$('body').css('overflow-y','auto');
				//location.reload();
				$('.task-img').remove();
				var url = "/id"+data;
				$(location).attr('href',url);
			}

		});
	}
});

/*-----new family-----*/
$(document).on('click','#new_family', function() {

	//var $inputpet = $("#pet_userfile");
	//var $inputfam = $("#family_userfile");
	var oldfam = document.getElementById("family_add_image").src;
	var textfam = oldfam.replace('http://petsoverload.yaskravo.net/img/avatar/','/');
	var oldpet = document.getElementById("pet_add_image").src;
	var textpet = oldpet.replace('http://petsoverload.yaskravo.net/img/avatar/','/');
	var newfamily = document.getElementById("new-family-name").value;
	var username = document.getElementById("new-username").value;
	var breed = document.getElementById("new-breed").value;
	var datepi = document.getElementById("newdatepicker").value;
	var sex = document.getElementById("new-sex").value;
	//console.log(oldfam + " -- "+oldpet);
	if (newfamily !='' && username !='') {
		this.disabled = true;
		var data =  new FormData();
		data.append("ajax_new_family", 'true');
		data.append("ajax_new_newfamily", newfamily);
		data.append("ajax_new_username", username);
		data.append("ajax_new_breed", breed);
		data.append("ajax_new_datepi", datepi);
		data.append("ajax_new_sex", sex);
		data.append("oldimgpet", textpet);
		data.append("oldimfam", textfam);
		//data.append('img', $inputpet.prop('files')[0]);
		//data.append('imgfamily', $inputfam.prop('files')[0]);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			beforeSend: function(){
				$('.popup .heading-h3').append('<img src="img/preloader.gif" class="task-img" alt="done photo">');
			},
			complete: function(){

			},
			success: function(data){
				$('.task-img').remove();
				$('.popups-wrapper').removeClass('flex-wrapper');
				$('body').css('overflow-y','auto');
				//location.reload();
				$('.task-img').remove();
				var url = "/id"+data;
				$(location).attr('href',url);
			}
		});
	}
});

var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
	function decode(s) {
		return decodeURIComponent(s.split("+").join(" "));
	}

	$_GET[decode(arguments[1])] = decode(arguments[2]);
});


var apiGeolocationSuccess = function(position) {
	/*alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
	*/
	var latlng = position.coords.latitude + ","+ position.coords.longitude;
	var url_country= "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&result_type=country&key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo";
	var url_city = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&result_type=locality&key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo";
	$.getJSON(url_city, function (data) {
		var adresscity = data.results[0].address_components[0].long_name;
		// console.log(data.results[0].address_components[0].long_name);
		//console.log(data.results[0].address_components[0].long_name);
		$.getJSON(url_country, function (data) {
			var adresscountry = data.results[0].address_components[0].long_name;
			document.getElementById('signup-location').value = adresscity + ", "+adresscountry;
		});
	});
};

var tryAPIGeolocation = function() {
	jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo", function(success) {
		apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
	})
	.fail(function(err) {
		alert("API Geolocation error! \n\n"+err);
	});
  /////https://maps.googleapis.com/maps/api/geocode/json?latlng=48.5131793,35.116195999999995&result_type=country&key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo


  /////https://maps.googleapis.com/maps/api/geocode/json?latlng=48.5131793,35.116195999999995&result_type=locality&key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo
};

var browserGeolocationSuccess = function(position) {
	var latlng = position.coords.latitude + ","+ position.coords.longitude;
	var url_country= "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&result_type=country&key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo";
	var url_city = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&result_type=locality&key=AIzaSyCW_9UZCIFyU6_bKOLB5v_7_V2JdQvr5Yo";
	$.getJSON(url_city, function (data) {
		var adresscity = data.results[0].address_components[0].long_name;
		$.getJSON(url_country, function (data) {
			var adresscountry = data.results[0].address_components[0].long_name;
			document.getElementById('signup-location').value = adresscity + ", "+adresscountry;
		});
	});

	
};

var browserGeolocationFail = function(error) {
	switch (error.code) {
		case error.TIMEOUT:
		alert("Browser geolocation error !\n\nTimeout.");
		break;
		case error.PERMISSION_DENIED:
		if(error.message.indexOf("Only secure origins are allowed") == 0) {
			tryAPIGeolocation();
		}
		break;
		case error.POSITION_UNAVAILABLE:
		alert("Browser geolocation error !\n\nPosition unavailable.");
		break;
	}
};

var getLocation_signUp = function() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			browserGeolocationSuccess,
			browserGeolocationFail,
			{maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
	}
};

var getLocation = function() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			browserGeolocationSuccess,
			browserGeolocationFail,
			{maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
	}
};

var getLocation_addpet = function() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			browserGeolocationSuccess,
			browserGeolocationFail,
			{maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
	}
};

/*function getLocation() {
	navigator.geolocation.getCurrentPosition(function(position) {

      // Get the coordinates of the current possition.
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;

      var latlng = lat.toFixed(3) + ","+ lng.toFixed(3);
      var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&sensor=false";
      $.getJSON(url, function (data) {
      	for(var i=0;i<data.results.length;i++) {
      		var adress = data.results[2].formatted_address;

      	}
      	//console.log(adress);
      	document.getElementById('settings-location').value=adress;
      	
      });

  });
}*/
$(document).on('click','#hide_this', function() {
	$('.tile_invite').css('display','none');

});

var follows_start = 0;
var follows_limit = 10;

$(document).on('click','#more_follow', function() {
	var follow_max = $(this).attr('data-count');
	follows_start = follows_start + 10;
	follows_limit = follows_limit + 10;
	//alert(follow_start +', '+follow_limit);

	if (follows_limit == follow_max) {
		$(this).css('display','none');
	}


	var data =  new FormData();
	data.append("more_follow", "true");
	data.append("follow_starts", follows_start);
	data.append("follow_limits", follows_limit);

	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			
			$('.followers').empty();
			$('.followers').append(data);
		}

	});

});

var following_start = 0;
var following_limit = 10;

$(document).on('click','#more_following', function() {
	var follow_max = $(this).attr('data-count');
	following_start = following_start + 10;
	following_limit = following_limit + 10;
	//alert(follow_start +', '+follow_limit);

	if (following_limit >= follow_max) {
		$(this).css('display','none');
	}


	var data =  new FormData();
	data.append("more_following", "true");
	data.append("following_starts", following_start);
	data.append("following_limits", following_limit);

	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			
			$('.followers').empty();
			$('.followers').append(data);
		}

	});

});



$(document).on('click','#comment_view', function() {
	var follow_max = $(this).attr('data-count');
	var postid = this.parentNode.id;
	comment_view(this, 10, follow_max, postid);
});
$(document).on('click','#comment_view_popup', function() {
	var follow_max = $(this).attr('data-count');
	var postid = this.parentNode.id;
	comment_view(this, 5, follow_max, postid);


});

function comment_view(thiss, start, comment_limit, postid){
	//var postid = thiss.parentNode.id;

	var comment_start =  start;
	
	 //alert(postid);

	var data =  new FormData();
	data.append("comment_view", "true");
	data.append("comment_start", comment_start);
	data.append("comment_limit", comment_limit);
	data.append("comment_postid", postid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {

			$('.comment_list_'+postid).append(data);
			$('.comment_view_' + postid).css('display','none');
			$('.comment_view_' + postid).next().addClass('hidden');
			$('.comment_view_popup_' + postid).css('display','none');
			$('.comment_view_popup_' + postid).next().addClass('hidden');
		}

	});
	
}
var scroll_start = 0;
var scroll_limit = 20;

$(document).on('click','#view_more_post', function() {
	post_view(this);
	
	initEvents();

});

function post_view(thiss){
	var scroll_max = $(thiss).data('count');
	var scroll_uid = $('#user_wall').data('user');
	scroll_start = scroll_start + 20;
	scroll_limit = scroll_limit + 20;
	if (scroll_max < 20) {
		scroll_limit = scroll_max;
		$(thiss).css('display','none');
	}
	if (scroll_limit > scroll_max) {
		discovert = scroll_limit - scroll_max;
		scroll_limit = scroll_limit - discovert;
		$(thiss).css('display','none');
	}
	if (scroll_limit == scroll_max) {
		$(thiss).css('display','none');
	}
	//alert(scroll_uid);
	var data =  new FormData();
	data.append("more_scroll", "true");
	data.append("scroll_start", scroll_start);
	data.append("scroll_limit", scroll_limit);
	data.append("scroll_uid", scroll_uid);

	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			$('#user_wall').append(data);
			  initShare();
		}

	});
	
}

$(document).on('click','#restore_password', function() {
	var email = document.getElementById("restore-email").value;
	var data =  new FormData();
	data.append("restore_password", "true");
	data.append("restore_email", email);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			$('.block_restore').empty();
			$('.block_restore').append(data);
		}

	});

});

$(document).on('click', '.post-images-container>img, .my-profile-image-change', function(){
	var url = $(this).attr('src');
	if ($(this).hasClass('nonephoto')) {
		$('#profile-photo-popup').find('.image-profile-current>img').attr('src', url);
		$('#profile-photo-popup').addClass('flex-wrapper');
	} else {
		
	//console.log(url);
	$('#post-photo-popup').find('.post-popup-image>img').attr('src', url);
	$('#post-photo-popup').addClass('flex-wrapper');
	$('body').css('overflow-y','hidden');
	var parid = this.parentNode.parentNode.parentNode.parentNode.id;
	if (parid == '') {
		ajax_post_photo_popup_main(url);
	} else {
		ajax_post_photo_popup(parid, url);
	}
	
}
});

function ajax_post_photo_popup(uid, url){

	var data =  new FormData();

	data.append("ajax_post_photo_popup_id", uid);
	data.append("ajax_post_photo_popup_url", url);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
				//console.log(data);
				$('#post-photo-popup').append(data);

			}
		});
}

function ajax_post_photo_popup_main(url){
	var data =  new FormData();

	data.append("ajax_post_photo_popup_main_url", url);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
				//console.log(data);
				$('#post-photo-popup').append(data);

			}
		});
}

function fixBody(){
	$('body').css('overflow-y','hidden');

}
function unfixBody(){
	$('body').css('overflow-y','auto');
	$('#edit-single-dog-popup').empty();
	$('#post-photo-popup').empty();
	$('.imgareaselect-outer').css('display', 'none');
	$('.imgareaselect-selection').parent().css('display', 'none');
	picturesArray = '';
	picturesArrayCount = '';
}

$(document).on('click', '.post-share .share', function(e){
	e.preventDefault();
	$(this).next().toggleClass('hidden');
});

$(document).on('click', '.post-account-menu', function(e){
	e.preventDefault();
	$('.post-account-menu > .account-choice-dropdown').toggleClass('hidden');
	$('.post-account-menu > .account-image').toggleClass('activated');

});

$(document).on('click', '.account-info', function(){

	$('.account-info .por .account-choice-dropdown').toggleClass('hidden');
	$('.account-info .por .account-image').toggleClass('activated');

});

$(document).on('click', 'a[href="#"]', function(e){
	e.preventDefault();
});

$(document).on('click', ".post-dots", function(){
	$(this).next().toggleClass("hidden");
});

/*$(document).on('click', '.notifi-event-drop', function(e){
	e.preventDefault();
	$(this).next().toggleClass('hidden');
});*/

$(document).on('click', '.account-dropdown-arrow-popup', function(e){
	e.preventDefault();
	$(this).next().toggleClass('hidden');
});

$(document).on('click', '.account-dropdown-arrow-post', function(e){
	e.preventDefault();
	$(this).next().toggleClass('hidden');
});

$(document).on('click', '.follow-dog-option', function(e){
	$('.follow-dog-option').removeClass('current');
	$(this).addClass('current');
	$('.account-choice-dropdown').addClass('hidden');

});

$(document).on('click', function(e) {
	if (!$(e.target).closest(".post-account-menu").length) {
		$('.post-account-menu .account-choice-dropdown').addClass('hidden');
	}
	if (!$(e.target).closest(".por").length) {
		$('.por .account-choice-dropdown').addClass('hidden');
	}
	if (!$(e.target).closest(".post-dots").length) {
		$('.post-dots-choice-dropdown').addClass('hidden');
	}

	if (!$(e.target).closest(".post-share").length) {
		$('.share-list').addClass('hidden');
	}
	if (!$(e.target).closest(".notification-event").length) {
		$('.notification-event .account-choice-dropdown').addClass('hidden');
	}
	if (!$(e.target).closest("#search").length) {
		$('.search-block').css('display', 'none');
		$('#search').val(null);
	}

		/*if (!$(e.target).closest(".newpost").length) {
			$(this).find('.newpost-active-part').addClass('hidden');
		}*/

		e.stopPropagation();
	});

$(document).on('focusin', '.newpost', function(){
	$(this).addClass('active');
	$(this).find('.newpost-active-part').removeClass('hidden');
}).on('focusout', function(){
	$(this).removeClass('active');
        //$(this).find('.newpost-active-part').addClass('hidden');
    });
$(document).on('click', '.post-button', function(){
	$(this).parent().parent().parent().find('.attach').toggleClass('hidden');
})

$(document).on('click', 'button, a', function(){
	if ($(this).hasClass('popup-trigger')){
		var id = $(this).data('popup-id');
		var uid = $(this).data('popup-uid');
		$('.popups-wrapper').removeClass('flex-wrapper');
		$('#' + id).addClass('flex-wrapper');
		fixBody();
		ajax_popup(uid);

	}
	if($(this).data('action') == "close-popup"){
		$('.popups-wrapper').removeClass('flex-wrapper');
		unfixBody();
		$('#edit-single-dog-popup').empty();
		/* changes from 25.07 start*/
		$('img').removeClass('current');
		/* changes from 25.07 end*/
	}

});

function ajax_popup(uid){
	var data =  new FormData();
	data.append("ajax_popup", 'true');
	data.append("ajax_popup_uid", uid);
	$.ajax({
		url: "/application/Request/setpost.php",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
				//console.log(data);
				$('#edit-single-dog-popup').append(data);

			}
		});
}

$(document).on('click', '.popups-wrapper', function(e){
	if ($(e.target).parents(".popup").length != 1){
		$('.popups-wrapper').removeClass('flex-wrapper');
		unfixBody();
		$('img').removeClass('current');
	}
});

$(document).on('click', '.tabs li', function(){
	var tab_id = $(this).attr('data-tab');

	$('.tabs li').removeClass('current');
	$('.tab-content').removeClass('current');

	$(this).addClass('current');
	$("#"+tab_id).addClass('current');
});



/* changes from 25.07 start*/

var imageKey,
picturesArray,
picturesArrayCount;
function rollImages(imagesClass) {
	$(imagesClass).each(function(key, item) {
		if ($(this).hasClass('current')) {
			imageKey = key + 1;
			return false;
		}
	});
}

$(document).on('click', '.post-images-container.multiple-images > img',function(){

	var self = $(this);
	var url = self.attr('src');
	self.addClass('current');
	picturesArray = self.parent().find('img');
	rollImages(picturesArray);
	picturesArrayCount = picturesArray.length;
	$('#post-photo-popup').addClass('flex-wrapper img-gallery').find('.post-popup-image>img').attr('src', url);
	$('#post-photo-popup').find('.post-popup-image').removeClass('last first');
	if (picturesArrayCount == imageKey){
		$('#post-photo-popup').find('.post-popup-image').addClass('last');
	}
	else if(imageKey == 1){
		$('#post-photo-popup').find('.post-popup-image').addClass('first');
	}
	fixBody();

});

$(document).on('click', '#post-photo-popup .post-popup-image', function(e){
	if($('.img-gallery').length){
            //Determining if mouse click happened in left or right half of image
            var pWidth = $(this).innerWidth();
            var pOffset = $(this).offset();
            var x = e.pageX - pOffset.left;
            if(pWidth/2 > x){
            	if(imageKey != 1){
            		$('img').removeClass('current');
            		imageKey = imageKey - 1;
            		$(picturesArray[imageKey]).addClass('current');
            		$(this).find('img').attr('src', $(picturesArray[imageKey-1]).attr('src'));
            		$('#post-photo-popup').find('.post-popup-image').removeClass('last first');
            	}
            	else{
            		$('#post-photo-popup').find('.post-popup-image').addClass('first');

            	}
            }
            else{
            	if (picturesArrayCount > imageKey){
            		$('img').removeClass('current');
            		imageKey = imageKey + 1;
            		$(picturesArray[imageKey]).addClass('current');
            		$(this).find('img').attr('src', $(picturesArray[imageKey-1]).attr('src'));
            		$('#post-photo-popup').find('.post-popup-image').removeClass('last first');
            	}
            	else{
            		$('#post-photo-popup').find('.post-popup-image').addClass('last');
            	}
            }
        }
    });
/* changes from 25.07 end*/

