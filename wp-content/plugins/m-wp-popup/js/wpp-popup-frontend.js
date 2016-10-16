//Return value boolean and take the rules option value

function wpp_check_rules( rules, popup_id ) {

	if ( rules.use_cookies ) {

		var cookie_name = 'wpp_popup_' + popup_id + '_closed';

		var subscriber_cookie_name = 'wpp_popup_' + popup_id + '_subscribed';
		
		if ( wpp_getCookie( cookie_name ) == 'yes' )
			return false;

		if (  wpp_getCookie( subscriber_cookie_name ) == 'yes' )
			return false;

	}

	if ( rules.hide_on_mobile_devices && ( DetectMobileLong() ||DetectTierTablet() ) )
		return false;

	return true;
}

function wpp_do_exit_popup( wpp_popup_function ) {

	jQuery('a').each(function(index,elem) {
	    
	    if ( jQuery(this).hasClass('wpp_external_link') ) {

	    } else {
	   
	    	jQuery(this).addClass('wpp_internal_link');
	   
	    }

	});

	jQuery("a.wpp_internal_link").click(function(){ window.onbeforeunload = null; }) ;

	jQuery("form").submit(function(){ window.onbeforeunload = null;  });

	window.onbeforeunload = function(e) {

		var e = e || window.event;

		if (e) {
			e.returnValue = wpp.exit_alert_text;
		}
		  
		setTimeout( function(){

			wpp_popup_function()

			css_background = jQuery('#cboxClose').css('background');
			  
			jQuery('#cboxClose').css('background', css_background );

		}, 500 );


		window.onbeforeunload = null;

		return wpp.exit_alert_text;

	}


}

function wpp_do_exit_intent_popup( wpp_popup_function ) {

	jQuery(document).mouseleave(function(e){
		if ( window.doing_wpp_exit_intent_popup )return false;
		if (e.pageY - jQuery(window).scrollTop() <= 1) {
			window.doing_wpp_exit_intent_popup = true;
			setTimeout( function(){
				wpp_popup_function();
			},  50 );
		}

	});
}

function wpp_do_comment_autofill( popup_uniq_id, cookie_hash ) {

	var popup = jQuery( '.' + popup_uniq_id );

	var name = popup.find('input[name=name]')

	var email = popup.find('input[name=email]')

	var comment_author = wpp_getCookie( 'comment_author_' + cookie_hash );

	var comment_email = wpp_getCookie( 'comment_author_email_' + cookie_hash );

	name.val( comment_author );

	email.val( comment_email );

}

function wpp_do_when_post_rule( wpp_popup_function, when ) {

	if ( window.wpp_when_rule_done )
		return false;

	var when = typeof when !== 'undefined' ? when : 'end';

	var element_pos = jQuery('#wpp_popup_post_end_element').offset();

	var element_pos = element_pos.top;

	var cur_pos = jQuery(document).scrollTop() + 900;

	if ( cur_pos >= element_pos  ) {

		wpp_popup_function();

		window.wpp_when_rule_done = true;

		return true;

	}

}

function wpp_check_when_post_rule( wpp_popup_function, when ) {

	window.wpp_when_rule_done = false;

	jQuery(document).scroll(function() {

		wpp_do_when_post_rule( wpp_popup_function, when );

	});

}

function wpp_place_popup_close_cookie( popup_id, expiration, which_cookie ) {

	var id = popup_id;

	var which_cookie = typeof which_cookie !== 'undefined' ? which_cookie : 'close';

	if ( expiration <= 0 || expiration === undefined )
		expiration = 1;

	wpp_setCookie( 'wpp_popup_' + id + '_closed', 'yes', expiration, '/' );

	if ( which_cookie === 'subscribed' )
		wpp_setCookie( 'wpp_popup_' + id + '_subscribed', 'yes', 350, '/' );

}

function wpp_handle_form_submit( popup_id, popup_uniq_id, submit_url, expiration ) {

	//Prevent Double clicking error
	if ( window.__wpp_doing )
		return false;

	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	var form = jQuery('.' + popup_uniq_id +' form');

	var email = form.find('input[name=email]').val();

	if ( ! re.test( email ) )
		return alert('Please enter a valid email address');

	window.__wpp_doing = true;

	form.find('input[type=submit]').attr('disabled', true);

	jQuery.post( 
		submit_url, 
		form.serialize(),
		function( data ){

			form.find('input[type=submit]').attr('disabled', false);

			window.__wpp_doing = false;
			
			if ( data.status === 'error' ) {

				alert(data.message);

			}

			if ( data.status === 'success' ) {

				wpp_place_popup_close_cookie( popup_id, expiration, 'subscribed' );

				data.message = "<div id='wpp_success_message' style='color: black'>" +  data.message + "</div>" + '<button title="Close (Esc)" type="button" class="mfp-close">×</button>';
				
				if ( data.redirect_to == '' )
					jQuery( '.' + popup_uniq_id ).html( data.message );
				else
					window.location.href = data.redirect_to;

			}
			
		}, "json");

}

function wpp_getCookie( name ) {	

	var start = document.cookie.indexOf( name + "=" );

	var len = start + name.length + 1;

	if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {

		return null;

	}

	if ( start == -1 ) return null;

	var end = document.cookie.indexOf( ';', len );

	if ( end == -1 ) end = document.cookie.length;

	return unescape( document.cookie.substring( len, end ) );

}



function wpp_setCookie( name, value, expires, path, domain, secure ) {

	var today = new Date();

	today.setTime( today.getTime() );

	if ( expires ) {

		expires = expires * 1000 * 60 * 60 * 24;

	}

	var expires_date = new Date( today.getTime() + (expires) );

	document.cookie = name+'='+escape( value ) +

		( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()

		( ( path ) ? ';path=' + path : '' ) + 

		( ( domain ) ? ';domain=' + domain : '' ) +

		( ( secure ) ? ';secure' : '' );

}



function wpp_deleteCookie( name, path, domain ) {

	if ( getCookie( name ) ) document.cookie = name + '=' +

			( ( path ) ? ';path=' + path : '') +

			( ( domain ) ? ';domain=' + domain : '' ) +

			';expires=Thu, 01-Jan-1970 00:00:01 GMT';

}

/*! Magnific Popup - v1.1.0 - 2016-02-20
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2016 Dmitry Semenov; */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):window.jQuery||window.Zepto)}(function(a){var b,c,d,e,f,g,h="Close",i="BeforeClose",j="AfterClose",k="BeforeAppend",l="MarkupParse",m="Open",n="Change",o="mfp",p="."+o,q="mfp-ready",r="mfp-removing",s="mfp-prevent-close",t=function(){},u=!!window.jQuery,v=a(window),w=function(a,c){b.ev.on(o+a+p,c)},x=function(b,c,d,e){var f=document.createElement("div");return f.className="mfp-"+b,d&&(f.innerHTML=d),e?c&&c.appendChild(f):(f=a(f),c&&f.appendTo(c)),f},y=function(c,d){b.ev.triggerHandler(o+c,d),b.st.callbacks&&(c=c.charAt(0).toLowerCase()+c.slice(1),b.st.callbacks[c]&&b.st.callbacks[c].apply(b,a.isArray(d)?d:[d]))},z=function(c){return c===g&&b.currTemplate.closeBtn||(b.currTemplate.closeBtn=a(b.st.closeMarkup.replace("%title%",b.st.tClose)),g=c),b.currTemplate.closeBtn},A=function(){a.magnificPopup.instance||(b=new t,b.init(),a.magnificPopup.instance=b)},B=function(){var a=document.createElement("p").style,b=["ms","O","Moz","Webkit"];if(void 0!==a.transition)return!0;for(;b.length;)if(b.pop()+"Transition"in a)return!0;return!1};t.prototype={constructor:t,init:function(){var c=navigator.appVersion;b.isLowIE=b.isIE8=document.all&&!document.addEventListener,b.isAndroid=/android/gi.test(c),b.isIOS=/iphone|ipad|ipod/gi.test(c),b.supportsTransition=B(),b.probablyMobile=b.isAndroid||b.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),d=a(document),b.popupsCache={}},open:function(c){var e;if(c.isObj===!1){b.items=c.items.toArray(),b.index=0;var g,h=c.items;for(e=0;e<h.length;e++)if(g=h[e],g.parsed&&(g=g.el[0]),g===c.el[0]){b.index=e;break}}else b.items=a.isArray(c.items)?c.items:[c.items],b.index=c.index||0;if(b.isOpen)return void b.updateItemHTML();b.types=[],f="",c.mainEl&&c.mainEl.length?b.ev=c.mainEl.eq(0):b.ev=d,c.key?(b.popupsCache[c.key]||(b.popupsCache[c.key]={}),b.currTemplate=b.popupsCache[c.key]):b.currTemplate={},b.st=a.extend(!0,{},a.magnificPopup.defaults,c),b.fixedContentPos="auto"===b.st.fixedContentPos?!b.probablyMobile:b.st.fixedContentPos,b.st.modal&&(b.st.closeOnContentClick=!1,b.st.closeOnBgClick=!1,b.st.showCloseBtn=!1,b.st.enableEscapeKey=!1),b.bgOverlay||(b.bgOverlay=x("bg").on("click"+p,function(){b.close()}),b.wrap=x("wrap").attr("tabindex",-1).on("click"+p,function(a){b._checkIfClose(a.target)&&b.close()}),b.container=x("container",b.wrap)),b.contentContainer=x("content"),b.st.preloader&&(b.preloader=x("preloader",b.container,b.st.tLoading));var i=a.magnificPopup.modules;for(e=0;e<i.length;e++){var j=i[e];j=j.charAt(0).toUpperCase()+j.slice(1),b["init"+j].call(b)}y("BeforeOpen"),b.st.showCloseBtn&&(b.st.closeBtnInside?(w(l,function(a,b,c,d){c.close_replaceWith=z(d.type)}),f+=" mfp-close-btn-in"):b.wrap.append(z())),b.st.alignTop&&(f+=" mfp-align-top"),b.fixedContentPos?b.wrap.css({overflow:b.st.overflowY,overflowX:"hidden",overflowY:b.st.overflowY}):b.wrap.css({top:v.scrollTop(),position:"absolute"}),(b.st.fixedBgPos===!1||"auto"===b.st.fixedBgPos&&!b.fixedContentPos)&&b.bgOverlay.css({height:d.height(),position:"absolute"}),b.st.enableEscapeKey&&d.on("keyup"+p,function(a){27===a.keyCode&&b.close()}),v.on("resize"+p,function(){b.updateSize()}),b.st.closeOnContentClick||(f+=" mfp-auto-cursor"),f&&b.wrap.addClass(f);var k=b.wH=v.height(),n={};if(b.fixedContentPos&&b._hasScrollBar(k)){var o=b._getScrollbarSize();o&&(n.marginRight=o)}b.fixedContentPos&&(b.isIE7?a("body, html").css("overflow","hidden"):n.overflow="hidden");var r=b.st.mainClass;return b.isIE7&&(r+=" mfp-ie7"),r&&b._addClassToMFP(r),b.updateItemHTML(),y("BuildControls"),a("html").css(n),b.bgOverlay.add(b.wrap).prependTo(b.st.prependTo||a(document.body)),b._lastFocusedEl=document.activeElement,setTimeout(function(){b.content?(b._addClassToMFP(q),b._setFocus()):b.bgOverlay.addClass(q),d.on("focusin"+p,b._onFocusIn)},16),b.isOpen=!0,b.updateSize(k),y(m),c},close:function(){b.isOpen&&(y(i),b.isOpen=!1,b.st.removalDelay&&!b.isLowIE&&b.supportsTransition?(b._addClassToMFP(r),setTimeout(function(){b._close()},b.st.removalDelay)):b._close())},_close:function(){y(h);var c=r+" "+q+" ";if(b.bgOverlay.detach(),b.wrap.detach(),b.container.empty(),b.st.mainClass&&(c+=b.st.mainClass+" "),b._removeClassFromMFP(c),b.fixedContentPos){var e={marginRight:""};b.isIE7?a("body, html").css("overflow",""):e.overflow="",a("html").css(e)}d.off("keyup"+p+" focusin"+p),b.ev.off(p),b.wrap.attr("class","mfp-wrap").removeAttr("style"),b.bgOverlay.attr("class","mfp-bg"),b.container.attr("class","mfp-container"),!b.st.showCloseBtn||b.st.closeBtnInside&&b.currTemplate[b.currItem.type]!==!0||b.currTemplate.closeBtn&&b.currTemplate.closeBtn.detach(),b.st.autoFocusLast&&b._lastFocusedEl&&a(b._lastFocusedEl).focus(),b.currItem=null,b.content=null,b.currTemplate=null,b.prevHeight=0,y(j)},updateSize:function(a){if(b.isIOS){var c=document.documentElement.clientWidth/window.innerWidth,d=window.innerHeight*c;b.wrap.css("height",d),b.wH=d}else b.wH=a||v.height();b.fixedContentPos||b.wrap.css("height",b.wH),y("Resize")},updateItemHTML:function(){var c=b.items[b.index];b.contentContainer.detach(),b.content&&b.content.detach(),c.parsed||(c=b.parseEl(b.index));var d=c.type;if(y("BeforeChange",[b.currItem?b.currItem.type:"",d]),b.currItem=c,!b.currTemplate[d]){var f=b.st[d]?b.st[d].markup:!1;y("FirstMarkupParse",f),f?b.currTemplate[d]=a(f):b.currTemplate[d]=!0}e&&e!==c.type&&b.container.removeClass("mfp-"+e+"-holder");var g=b["get"+d.charAt(0).toUpperCase()+d.slice(1)](c,b.currTemplate[d]);b.appendContent(g,d),c.preloaded=!0,y(n,c),e=c.type,b.container.prepend(b.contentContainer),y("AfterChange")},appendContent:function(a,c){b.content=a,a?b.st.showCloseBtn&&b.st.closeBtnInside&&b.currTemplate[c]===!0?b.content.find(".mfp-close").length||b.content.append(z()):b.content=a:b.content="",y(k),b.container.addClass("mfp-"+c+"-holder"),b.contentContainer.append(b.content)},parseEl:function(c){var d,e=b.items[c];if(e.tagName?e={el:a(e)}:(d=e.type,e={data:e,src:e.src}),e.el){for(var f=b.types,g=0;g<f.length;g++)if(e.el.hasClass("mfp-"+f[g])){d=f[g];break}e.src=e.el.attr("data-mfp-src"),e.src||(e.src=e.el.attr("href"))}return e.type=d||b.st.type||"inline",e.index=c,e.parsed=!0,b.items[c]=e,y("ElementParse",e),b.items[c]},addGroup:function(a,c){var d=function(d){d.mfpEl=this,b._openClick(d,a,c)};c||(c={});var e="click.magnificPopup";c.mainEl=a,c.items?(c.isObj=!0,a.off(e).on(e,d)):(c.isObj=!1,c.delegate?a.off(e).on(e,c.delegate,d):(c.items=a,a.off(e).on(e,d)))},_openClick:function(c,d,e){var f=void 0!==e.midClick?e.midClick:a.magnificPopup.defaults.midClick;if(f||!(2===c.which||c.ctrlKey||c.metaKey||c.altKey||c.shiftKey)){var g=void 0!==e.disableOn?e.disableOn:a.magnificPopup.defaults.disableOn;if(g)if(a.isFunction(g)){if(!g.call(b))return!0}else if(v.width()<g)return!0;c.type&&(c.preventDefault(),b.isOpen&&c.stopPropagation()),e.el=a(c.mfpEl),e.delegate&&(e.items=d.find(e.delegate)),b.open(e)}},updateStatus:function(a,d){if(b.preloader){c!==a&&b.container.removeClass("mfp-s-"+c),d||"loading"!==a||(d=b.st.tLoading);var e={status:a,text:d};y("UpdateStatus",e),a=e.status,d=e.text,b.preloader.html(d),b.preloader.find("a").on("click",function(a){a.stopImmediatePropagation()}),b.container.addClass("mfp-s-"+a),c=a}},_checkIfClose:function(c){if(!a(c).hasClass(s)){var d=b.st.closeOnContentClick,e=b.st.closeOnBgClick;if(d&&e)return!0;if(!b.content||a(c).hasClass("mfp-close")||b.preloader&&c===b.preloader[0])return!0;if(c===b.content[0]||a.contains(b.content[0],c)){if(d)return!0}else if(e&&a.contains(document,c))return!0;return!1}},_addClassToMFP:function(a){b.bgOverlay.addClass(a),b.wrap.addClass(a)},_removeClassFromMFP:function(a){this.bgOverlay.removeClass(a),b.wrap.removeClass(a)},_hasScrollBar:function(a){return(b.isIE7?d.height():document.body.scrollHeight)>(a||v.height())},_setFocus:function(){(b.st.focus?b.content.find(b.st.focus).eq(0):b.wrap).focus()},_onFocusIn:function(c){return c.target===b.wrap[0]||a.contains(b.wrap[0],c.target)?void 0:(b._setFocus(),!1)},_parseMarkup:function(b,c,d){var e;d.data&&(c=a.extend(d.data,c)),y(l,[b,c,d]),a.each(c,function(c,d){if(void 0===d||d===!1)return!0;if(e=c.split("_"),e.length>1){var f=b.find(p+"-"+e[0]);if(f.length>0){var g=e[1];"replaceWith"===g?f[0]!==d[0]&&f.replaceWith(d):"img"===g?f.is("img")?f.attr("src",d):f.replaceWith(a("<img>").attr("src",d).attr("class",f.attr("class"))):f.attr(e[1],d)}}else b.find(p+"-"+c).html(d)})},_getScrollbarSize:function(){if(void 0===b.scrollbarSize){var a=document.createElement("div");a.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(a),b.scrollbarSize=a.offsetWidth-a.clientWidth,document.body.removeChild(a)}return b.scrollbarSize}},a.magnificPopup={instance:null,proto:t.prototype,modules:[],open:function(b,c){return A(),b=b?a.extend(!0,{},b):{},b.isObj=!0,b.index=c||0,this.instance.open(b)},close:function(){return a.magnificPopup.instance&&a.magnificPopup.instance.close()},registerModule:function(b,c){c.options&&(a.magnificPopup.defaults[b]=c.options),a.extend(this.proto,c.proto),this.modules.push(b)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&#215;</button>',tClose:"Close (Esc)",tLoading:"Loading...",autoFocusLast:!0}},a.fn.magnificPopup=function(c){A();var d=a(this);if("string"==typeof c)if("open"===c){var e,f=u?d.data("magnificPopup"):d[0].magnificPopup,g=parseInt(arguments[1],10)||0;f.items?e=f.items[g]:(e=d,f.delegate&&(e=e.find(f.delegate)),e=e.eq(g)),b._openClick({mfpEl:e},d,f)}else b.isOpen&&b[c].apply(b,Array.prototype.slice.call(arguments,1));else c=a.extend(!0,{},c),u?d.data("magnificPopup",c):d[0].magnificPopup=c,b.addGroup(d,c);return d};var C,D,E,F="inline",G=function(){E&&(D.after(E.addClass(C)).detach(),E=null)};a.magnificPopup.registerModule(F,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){b.types.push(F),w(h+"."+F,function(){G()})},getInline:function(c,d){if(G(),c.src){var e=b.st.inline,f=a(c.src);if(f.length){var g=f[0].parentNode;g&&g.tagName&&(D||(C=e.hiddenClass,D=x(C),C="mfp-"+C),E=f.after(D).detach().removeClass(C)),b.updateStatus("ready")}else b.updateStatus("error",e.tNotFound),f=a("<div>");return c.inlineElement=f,f}return b.updateStatus("ready"),b._parseMarkup(d,{},c),d}}});var H,I="ajax",J=function(){H&&a(document.body).removeClass(H)},K=function(){J(),b.req&&b.req.abort()};a.magnificPopup.registerModule(I,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){b.types.push(I),H=b.st.ajax.cursor,w(h+"."+I,K),w("BeforeChange."+I,K)},getAjax:function(c){H&&a(document.body).addClass(H),b.updateStatus("loading");var d=a.extend({url:c.src,success:function(d,e,f){var g={data:d,xhr:f};y("ParseAjax",g),b.appendContent(a(g.data),I),c.finished=!0,J(),b._setFocus(),setTimeout(function(){b.wrap.addClass(q)},16),b.updateStatus("ready"),y("AjaxContentAdded")},error:function(){J(),c.finished=c.loadError=!0,b.updateStatus("error",b.st.ajax.tError.replace("%url%",c.src))}},b.st.ajax.settings);return b.req=a.ajax(d),""}}});var L,M=function(c){if(c.data&&void 0!==c.data.title)return c.data.title;var d=b.st.image.titleSrc;if(d){if(a.isFunction(d))return d.call(b,c);if(c.el)return c.el.attr(d)||""}return""};a.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var c=b.st.image,d=".image";b.types.push("image"),w(m+d,function(){"image"===b.currItem.type&&c.cursor&&a(document.body).addClass(c.cursor)}),w(h+d,function(){c.cursor&&a(document.body).removeClass(c.cursor),v.off("resize"+p)}),w("Resize"+d,b.resizeImage),b.isLowIE&&w("AfterChange",b.resizeImage)},resizeImage:function(){var a=b.currItem;if(a&&a.img&&b.st.image.verticalFit){var c=0;b.isLowIE&&(c=parseInt(a.img.css("padding-top"),10)+parseInt(a.img.css("padding-bottom"),10)),a.img.css("max-height",b.wH-c)}},_onImageHasSize:function(a){a.img&&(a.hasSize=!0,L&&clearInterval(L),a.isCheckingImgSize=!1,y("ImageHasSize",a),a.imgHidden&&(b.content&&b.content.removeClass("mfp-loading"),a.imgHidden=!1))},findImageSize:function(a){var c=0,d=a.img[0],e=function(f){L&&clearInterval(L),L=setInterval(function(){return d.naturalWidth>0?void b._onImageHasSize(a):(c>200&&clearInterval(L),c++,void(3===c?e(10):40===c?e(50):100===c&&e(500)))},f)};e(1)},getImage:function(c,d){var e=0,f=function(){c&&(c.img[0].complete?(c.img.off(".mfploader"),c===b.currItem&&(b._onImageHasSize(c),b.updateStatus("ready")),c.hasSize=!0,c.loaded=!0,y("ImageLoadComplete")):(e++,200>e?setTimeout(f,100):g()))},g=function(){c&&(c.img.off(".mfploader"),c===b.currItem&&(b._onImageHasSize(c),b.updateStatus("error",h.tError.replace("%url%",c.src))),c.hasSize=!0,c.loaded=!0,c.loadError=!0)},h=b.st.image,i=d.find(".mfp-img");if(i.length){var j=document.createElement("img");j.className="mfp-img",c.el&&c.el.find("img").length&&(j.alt=c.el.find("img").attr("alt")),c.img=a(j).on("load.mfploader",f).on("error.mfploader",g),j.src=c.src,i.is("img")&&(c.img=c.img.clone()),j=c.img[0],j.naturalWidth>0?c.hasSize=!0:j.width||(c.hasSize=!1)}return b._parseMarkup(d,{title:M(c),img_replaceWith:c.img},c),b.resizeImage(),c.hasSize?(L&&clearInterval(L),c.loadError?(d.addClass("mfp-loading"),b.updateStatus("error",h.tError.replace("%url%",c.src))):(d.removeClass("mfp-loading"),b.updateStatus("ready")),d):(b.updateStatus("loading"),c.loading=!0,c.hasSize||(c.imgHidden=!0,d.addClass("mfp-loading"),b.findImageSize(c)),d)}}});var N,O=function(){return void 0===N&&(N=void 0!==document.createElement("p").style.MozTransform),N};a.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(a){return a.is("img")?a:a.find("img")}},proto:{initZoom:function(){var a,c=b.st.zoom,d=".zoom";if(c.enabled&&b.supportsTransition){var e,f,g=c.duration,j=function(a){var b=a.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),d="all "+c.duration/1e3+"s "+c.easing,e={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},f="transition";return e["-webkit-"+f]=e["-moz-"+f]=e["-o-"+f]=e[f]=d,b.css(e),b},k=function(){b.content.css("visibility","visible")};w("BuildControls"+d,function(){if(b._allowZoom()){if(clearTimeout(e),b.content.css("visibility","hidden"),a=b._getItemToZoom(),!a)return void k();f=j(a),f.css(b._getOffset()),b.wrap.append(f),e=setTimeout(function(){f.css(b._getOffset(!0)),e=setTimeout(function(){k(),setTimeout(function(){f.remove(),a=f=null,y("ZoomAnimationEnded")},16)},g)},16)}}),w(i+d,function(){if(b._allowZoom()){if(clearTimeout(e),b.st.removalDelay=g,!a){if(a=b._getItemToZoom(),!a)return;f=j(a)}f.css(b._getOffset(!0)),b.wrap.append(f),b.content.css("visibility","hidden"),setTimeout(function(){f.css(b._getOffset())},16)}}),w(h+d,function(){b._allowZoom()&&(k(),f&&f.remove(),a=null)})}},_allowZoom:function(){return"image"===b.currItem.type},_getItemToZoom:function(){return b.currItem.hasSize?b.currItem.img:!1},_getOffset:function(c){var d;d=c?b.currItem.img:b.st.zoom.opener(b.currItem.el||b.currItem);var e=d.offset(),f=parseInt(d.css("padding-top"),10),g=parseInt(d.css("padding-bottom"),10);e.top-=a(window).scrollTop()-f;var h={width:d.width(),height:(u?d.innerHeight():d[0].offsetHeight)-g-f};return O()?h["-moz-transform"]=h.transform="translate("+e.left+"px,"+e.top+"px)":(h.left=e.left,h.top=e.top),h}}});var P="iframe",Q="//about:blank",R=function(a){if(b.currTemplate[P]){var c=b.currTemplate[P].find("iframe");c.length&&(a||(c[0].src=Q),b.isIE8&&c.css("display",a?"block":"none"))}};a.magnificPopup.registerModule(P,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){b.types.push(P),w("BeforeChange",function(a,b,c){b!==c&&(b===P?R():c===P&&R(!0))}),w(h+"."+P,function(){R()})},getIframe:function(c,d){var e=c.src,f=b.st.iframe;a.each(f.patterns,function(){return e.indexOf(this.index)>-1?(this.id&&(e="string"==typeof this.id?e.substr(e.lastIndexOf(this.id)+this.id.length,e.length):this.id.call(this,e)),e=this.src.replace("%id%",e),!1):void 0});var g={};return f.srcAction&&(g[f.srcAction]=e),b._parseMarkup(d,g,c),b.updateStatus("ready"),d}}});var S=function(a){var c=b.items.length;return a>c-1?a-c:0>a?c+a:a},T=function(a,b,c){return a.replace(/%curr%/gi,b+1).replace(/%total%/gi,c)};a.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var c=b.st.gallery,e=".mfp-gallery";return b.direction=!0,c&&c.enabled?(f+=" mfp-gallery",w(m+e,function(){c.navigateByImgClick&&b.wrap.on("click"+e,".mfp-img",function(){return b.items.length>1?(b.next(),!1):void 0}),d.on("keydown"+e,function(a){37===a.keyCode?b.prev():39===a.keyCode&&b.next()})}),w("UpdateStatus"+e,function(a,c){c.text&&(c.text=T(c.text,b.currItem.index,b.items.length))}),w(l+e,function(a,d,e,f){var g=b.items.length;e.counter=g>1?T(c.tCounter,f.index,g):""}),w("BuildControls"+e,function(){if(b.items.length>1&&c.arrows&&!b.arrowLeft){var d=c.arrowMarkup,e=b.arrowLeft=a(d.replace(/%title%/gi,c.tPrev).replace(/%dir%/gi,"left")).addClass(s),f=b.arrowRight=a(d.replace(/%title%/gi,c.tNext).replace(/%dir%/gi,"right")).addClass(s);e.click(function(){b.prev()}),f.click(function(){b.next()}),b.container.append(e.add(f))}}),w(n+e,function(){b._preloadTimeout&&clearTimeout(b._preloadTimeout),b._preloadTimeout=setTimeout(function(){b.preloadNearbyImages(),b._preloadTimeout=null},16)}),void w(h+e,function(){d.off(e),b.wrap.off("click"+e),b.arrowRight=b.arrowLeft=null})):!1},next:function(){b.direction=!0,b.index=S(b.index+1),b.updateItemHTML()},prev:function(){b.direction=!1,b.index=S(b.index-1),b.updateItemHTML()},goTo:function(a){b.direction=a>=b.index,b.index=a,b.updateItemHTML()},preloadNearbyImages:function(){var a,c=b.st.gallery.preload,d=Math.min(c[0],b.items.length),e=Math.min(c[1],b.items.length);for(a=1;a<=(b.direction?e:d);a++)b._preloadItem(b.index+a);for(a=1;a<=(b.direction?d:e);a++)b._preloadItem(b.index-a)},_preloadItem:function(c){if(c=S(c),!b.items[c].preloaded){var d=b.items[c];d.parsed||(d=b.parseEl(c)),y("LazyLoad",d),"image"===d.type&&(d.img=a('<img class="mfp-img" />').on("load.mfploader",function(){d.hasSize=!0}).on("error.mfploader",function(){d.hasSize=!0,d.loadError=!0,y("LazyLoadError",d)}).attr("src",d.src)),d.preloaded=!0}}}});var U="retina";a.magnificPopup.registerModule(U,{options:{replaceSrc:function(a){return a.src.replace(/\.\w+$/,function(a){return"@2x"+a})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var a=b.st.retina,c=a.ratio;c=isNaN(c)?c():c,c>1&&(w("ImageHasSize."+U,function(a,b){b.img.css({"max-width":b.img[0].naturalWidth/c,width:"100%"})}),w("ElementParse."+U,function(b,d){d.src=a.replaceSrc(d,c)}))}}}}),A()});

/*Mobile Detection Library
Copyright 2010-2012, Anthony Hand
*/
function DetectIphone(){if(uagent.search(deviceIphone)>-1){if(DetectIpad()||DetectIpod())return false;else return true}else return false}function DetectIpod(){if(uagent.search(deviceIpod)>-1)return true;else return false}function DetectIpad(){if(uagent.search(deviceIpad)>-1&&DetectWebkit())return true;else return false}function DetectIphoneOrIpod(){if(uagent.search(deviceIphone)>-1||uagent.search(deviceIpod)>-1)return true;else return false}function DetectIos(){if(DetectIphoneOrIpod()||DetectIpad())return true;else return false}function DetectAndroid(){if(uagent.search(deviceAndroid)>-1||DetectGoogleTV())return true;if(uagent.search(deviceHtcFlyer)>-1)return true;else return false}function DetectAndroidPhone(){if(DetectAndroid()&&uagent.search(mobile)>-1)return true;if(DetectOperaAndroidPhone())return true;if(uagent.search(deviceHtcFlyer)>-1)return true;else return false}function DetectAndroidTablet(){if(!DetectAndroid())return false;if(DetectOperaMobile())return false;if(uagent.search(deviceHtcFlyer)>-1)return false;if(uagent.search(mobile)>-1)return false;else return true}function DetectAndroidWebKit(){if(DetectAndroid()&&DetectWebkit())return true;else return false}function DetectGoogleTV(){if(uagent.search(deviceGoogleTV)>-1)return true;else return false}function DetectWebkit(){if(uagent.search(engineWebKit)>-1)return true;else return false}function DetectS60OssBrowser(){if(DetectWebkit()){if(uagent.search(deviceS60)>-1||uagent.search(deviceSymbian)>-1)return true;else return false}else return false}function DetectSymbianOS(){if(uagent.search(deviceSymbian)>-1||uagent.search(deviceS60)>-1||uagent.search(deviceS70)>-1||uagent.search(deviceS80)>-1||uagent.search(deviceS90)>-1)return true;else return false}function DetectWindowsPhone7(){if(uagent.search(deviceWinPhone7)>-1)return true;else return false}function DetectWindowsMobile(){if(DetectWindowsPhone7())return false;if(uagent.search(deviceWinMob)>-1||uagent.search(deviceIeMob)>-1||uagent.search(enginePie)>-1)return true;if(uagent.search(devicePpc)>-1&&!(uagent.search(deviceMacPpc)>-1))return true;if(uagent.search(manuHtc)>-1&&uagent.search(deviceWindows)>-1)return true;else return false}function DetectBlackBerry(){if(uagent.search(deviceBB)>-1)return true;if(uagent.search(vndRIM)>-1)return true;else return false}function DetectBlackBerryTablet(){if(uagent.search(deviceBBPlaybook)>-1)return true;else return false}function DetectBlackBerryWebKit(){if(DetectBlackBerry()&&uagent.search(engineWebKit)>-1)return true;else return false}function DetectBlackBerryTouch(){if(DetectBlackBerry()&&(uagent.search(deviceBBStorm)>-1||uagent.search(deviceBBTorch)>-1||uagent.search(deviceBBBoldTouch)>-1||uagent.search(deviceBBCurveTouch)>-1))return true;else return false}function DetectBlackBerryHigh(){if(DetectBlackBerryWebKit())return false;if(DetectBlackBerry()){if(DetectBlackBerryTouch()||uagent.search(deviceBBBold)>-1||uagent.search(deviceBBTour)>-1||uagent.search(deviceBBCurve)>-1)return true;else return false}else return false}function DetectBlackBerryLow(){if(DetectBlackBerry()){if(DetectBlackBerryHigh()||DetectBlackBerryWebKit())return false;else return true}else return false}function DetectPalmOS(){if(uagent.search(devicePalm)>-1||uagent.search(engineBlazer)>-1||uagent.search(engineXiino)>-1){if(DetectPalmWebOS())return false;else return true}else return false}function DetectPalmWebOS(){if(uagent.search(deviceWebOS)>-1)return true;else return false}function DetectWebOSTablet(){if(uagent.search(deviceWebOShp)>-1&&uagent.search(deviceTablet)>-1)return true;else return false}function DetectGarminNuvifone(){if(uagent.search(deviceNuvifone)>-1)return true;else return false}function DetectSmartphone(){if(DetectIphoneOrIpod()||DetectAndroidPhone()||DetectS60OssBrowser()||DetectSymbianOS()||DetectWindowsMobile()||DetectWindowsPhone7()||DetectBlackBerry()||DetectPalmWebOS()||DetectPalmOS()||DetectGarminNuvifone())return true;return false}function DetectArchos(){if(uagent.search(deviceArchos)>-1)return true;else return false}function DetectBrewDevice(){if(uagent.search(deviceBrew)>-1)return true;else return false}function DetectDangerHiptop(){if(uagent.search(deviceDanger)>-1||uagent.search(deviceHiptop)>-1)return true;else return false}function DetectMaemoTablet(){if(uagent.search(maemo)>-1)return true;if(uagent.search(linux)>-1&&uagent.search(deviceTablet)>-1&&!DetectWebOSTablet()&&!DetectAndroid())return true;else return false}function DetectSonyMylo(){if(uagent.search(manuSony)>-1){if(uagent.search(qtembedded)>-1||uagent.search(mylocom2)>-1)return true;else return false}else return false}function DetectOperaMobile(){if(uagent.search(engineOpera)>-1){if(uagent.search(mini)>-1||uagent.search(mobi)>-1)return true;else return false}else return false}function DetectOperaAndroidPhone(){if(uagent.search(engineOpera)>-1&&uagent.search(deviceAndroid)>-1&&uagent.search(mobi)>-1)return true;else return false}function DetectOperaAndroidTablet(){if(uagent.search(engineOpera)>-1&&uagent.search(deviceAndroid)>-1&&uagent.search(deviceTablet)>-1)return true;else return false}function DetectSonyPlaystation(){if(uagent.search(devicePlaystation)>-1)return true;else return false}function DetectNintendo(){if(uagent.search(deviceNintendo)>-1||uagent.search(deviceWii)>-1||uagent.search(deviceNintendoDs)>-1)return true;else return false}function DetectXbox(){if(uagent.search(deviceXbox)>-1)return true;else return false}function DetectGameConsole(){if(DetectSonyPlaystation())return true;if(DetectNintendo())return true;if(DetectXbox())return true;else return false}function DetectKindle(){if(uagent.search(deviceKindle)>-1&&!DetectAndroid())return true;else return false}function DetectAmazonSilk(){if(uagent.search(engineSilk)>-1)return true;else return false}function DetectMobileQuick(){if(DetectTierTablet())return false;if(DetectSmartphone())return true;if(uagent.search(deviceMidp)>-1||DetectBrewDevice())return true;if(DetectOperaMobile())return true;if(uagent.search(engineNetfront)>-1)return true;if(uagent.search(engineUpBrowser)>-1)return true;if(uagent.search(engineOpenWeb)>-1)return true;if(DetectDangerHiptop())return true;if(DetectMaemoTablet())return true;if(DetectArchos())return true;if(uagent.search(devicePda)>-1&&!(uagent.search(disUpdate)>-1))return true;if(uagent.search(mobile)>-1)return true;if(DetectKindle()||DetectAmazonSilk())return true;return false}function DetectMobileLong(){if(DetectMobileQuick())return true;if(DetectGameConsole())return true;if(DetectSonyMylo())return true;if(uagent.search(manuSamsung1)>-1||uagent.search(manuSonyEricsson)>-1||uagent.search(manuericsson)>-1)return true;if(uagent.search(svcDocomo)>-1)return true;if(uagent.search(svcKddi)>-1)return true;if(uagent.search(svcVodafone)>-1)return true;return false}function DetectTierTablet(){if(DetectIpad()||DetectAndroidTablet()||DetectBlackBerryTablet()||DetectWebOSTablet())return true;else return false}function DetectTierIphone(){if(DetectIphoneOrIpod())return true;if(DetectAndroidPhone())return true;if(DetectBlackBerryWebKit()&&DetectBlackBerryTouch())return true;if(DetectWindowsPhone7())return true;if(DetectPalmWebOS())return true;if(DetectGarminNuvifone())return true;else return false}function DetectTierRichCss(){if(DetectMobileQuick()){if(DetectTierIphone()||DetectKindle())return false;if(DetectWebkit())return true;if(DetectS60OssBrowser())return true;if(DetectBlackBerryHigh())return true;if(DetectWindowsMobile())return true;if(uagent.search(engineTelecaQ)>-1)return true;else return false}else return false}function DetectTierOtherPhones(){if(DetectMobileLong()){if(DetectTierIphone()||DetectTierRichCss())return false;else return true}else return false}function InitDeviceScan(){isIphone=DetectIphoneOrIpod();isAndroidPhone=DetectAndroidPhone();isTierIphone=DetectTierIphone();isTierTablet=DetectTierTablet();isTierRichCss=DetectTierRichCss();isTierGenericMobile=DetectTierOtherPhones()}var isIphone=false;var isAndroidPhone=false;var isTierTablet=false;var isTierIphone=false;var isTierRichCss=false;var isTierGenericMobile=false;var engineWebKit="webkit";var deviceIphone="iphone";var deviceIpod="ipod";var deviceIpad="ipad";var deviceMacPpc="macintosh";var deviceAndroid="android";var deviceGoogleTV="googletv";var deviceXoom="xoom";var deviceHtcFlyer="htc_flyer";var deviceNuvifone="nuvifone";var deviceSymbian="symbian";var deviceS60="series60";var deviceS70="series70";var deviceS80="series80";var deviceS90="series90";var deviceWinPhone7="windows phone os 7";var deviceWinMob="windows ce";var deviceWindows="windows";var deviceIeMob="iemobile";var devicePpc="ppc";var enginePie="wm5 pie";var deviceBB="blackberry";var vndRIM="vnd.rim";var deviceBBStorm="blackberry95";var deviceBBBold="blackberry97";var deviceBBBoldTouch="blackberry 99";var deviceBBTour="blackberry96";var deviceBBCurve="blackberry89";var deviceBBCurveTouch="blackberry 938";var deviceBBTorch="blackberry 98";var deviceBBPlaybook="playbook";var devicePalm="palm";var deviceWebOS="webos";var deviceWebOShp="hpwos";var engineBlazer="blazer";var engineXiino="xiino";var deviceKindle="kindle";var engineSilk="silk";var vndwap="vnd.wap";var wml="wml";var deviceTablet="tablet";var deviceBrew="brew";var deviceDanger="danger";var deviceHiptop="hiptop";var devicePlaystation="playstation";var deviceNintendoDs="nitro";var deviceNintendo="nintendo";var deviceWii="wii";var deviceXbox="xbox";var deviceArchos="archos";var engineOpera="opera";var engineNetfront="netfront";var engineUpBrowser="up.browser";var engineOpenWeb="openweb";var deviceMidp="midp";var uplink="up.link";var engineTelecaQ="teleca q";var devicePda="pda";var mini="mini";var mobile="mobile";var mobi="mobi";var maemo="maemo";var linux="linux";var qtembedded="qt embedded";var mylocom2="com2";var manuSonyEricsson="sonyericsson";var manuericsson="ericsson";var manuSamsung1="sec-sgh";var manuSony="sony";var manuHtc="htc";var svcDocomo="docomo";var svcKddi="kddi";var svcVodafone="vodafone";var disUpdate="update";var uagent="";if(navigator&&navigator.userAgent)uagent=navigator.userAgent.toLowerCase();InitDeviceScan()