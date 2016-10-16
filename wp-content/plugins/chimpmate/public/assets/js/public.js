!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});
;(function( $ ){
  var csldMoving = false,
    csldOpened = false;
var privateMethods = {
    execute: function(action, callback) {
        var $menu = $("#wpmchimpas"),
		    $trig = $("#wpmchimpas-trig"),
		    $body = $("body"),
		    $html = $("html"),
		    menucWidth = $menu.data("menucWidth"),
		    speed = $menu.data("speed"),
		    side = $menu.data("side"),
		    bodyClass = "body-wpmchimpas-open",
		    bodyAnimation,
		    bodyInit,
		    scrollTop,
		    diff;
		if ('open' === action || ('toggle' === action && !$body.hasClass('body-wpmchimpas-open'))) {
		    
			$body.bind('mousewheel DOMMouseScroll', freezeCon);
			$('.wpmchimpas-cont').bind('mousewheel DOMMouseScroll', scrollCon);
		    $('.wpmchimpas-overlay').addClass('showo');
		    centresp();
		    $(window).resize(function() {
		        $(".wpmchimpas").hasClass("wpmchimpas-open") && centresp()
		    });
		    $body.addClass(bodyClass);
			$('.wpmchimpas').addClass('wpmchimpas-open');
		} else {
			$body.unbind('mousewheel DOMMouseScroll', freezeCon);
			$('.wpmchimpas-cont').unbind('mousewheel DOMMouseScroll', scrollCon);
			$('.wpmchimpas-overlay').removeClass('showo');
		    $('body > *').not('.wpmchimpas').css({
		        '-webkit-transform': '',
		        transform: ''
		    });
		    setTimeout(function() {
		        $body.removeClass(bodyClass).removeAttr('style');
		    }, speed);
		    $('.wpmchimpas').removeClass('wpmchimpas-open');
		    $trig.removeClass('wpmchimpas-trigdis');
		}
    }
};
function centresp() {
	var $menu = $("#wpmchimpas"),
	    $trig = $("#wpmchimpas-trig"),
	    $body = $("body"),
	    $html = $("html"),
	    menucWidth = $menu.data("menucWidth"),
	    speed = $menu.data("speed"),
	    side = $menu.data("side"),
	    bodytrans,
	    scrollTop,
	    diff,
	    bodyClass = "body-wpmchimpas-open";
	
    $('.wpmchimpas-bg,.wpmchimpas-overlay').css({'height': $('body').height()});
	if ($('.wpmchimpas').height() < $('.wpmchimpas-scroller').height())
	    $('.wpmchimpas-scroller').removeClass('wpmchimpas-vertcent');
	else
	    $('.wpmchimpas-scroller').addClass('wpmchimpas-vertcent');

	if ($(window).width() < 580) {
	    diff = (580 - $(window).width());
	    var perc = (menucWidth - diff) / 500;
	    $('.wpmchimpas-resp').css({
	        '-webkit-transform': 'scale(' + perc + ',' + perc + ')',
	        transform: 'scale(' + perc + ',' + perc + ')'
	    });
	} else {
	    $('.wpmchimpas-resp').removeAttr('style');
	    diff = 0;
	}
	menuWidth = menucWidth - diff;
	if (side === 'left') {
	    bodytrans = {
	        '-webkit-transform': 'translate(' + menuWidth + 'px,0)',
	        transform: 'translate(' + menuWidth + 'px,0)'
	    };
	} else {
	    bodytrans = {
	        '-webkit-transform': 'translate(' + menuWidth + 'px,0)',
	        transform: 'translate(-' + menuWidth + 'px,0)'
	    };
	}
    $('body > *').not('.wpmchimpas').css(bodytrans);
}
function scrollCon(e) {
	var scrollTo = null;
	if (e.type == 'mousewheel') {
		scrollTo = (e.originalEvent.wheelDelta * -1);
	}
	else if (e.type == 'DOMMouseScroll') {
		scrollTo = 40 * e.originalEvent.detail;
	}
	if (scrollTo) {
		e.preventDefault();
		$(this).scrollTop(scrollTo + $(this).scrollTop());
	}
}

function freezeCon(e) {
	if (e.type == 'mousewheel' || e.type == 'DOMMouseScroll') {
		e.preventDefault()
	}
}
var methods = {
    open: function(name, callback) {
        privateMethods.execute('open', name, callback);
    },
    close: function(name, callback) {
        privateMethods.execute('close', name, callback);
    },
    toggle: function(name, callback) {
        privateMethods.execute('toggle', name, callback);
    }
};

$.csld = function(method) {
    if (methods[method]) {
        return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'function' || typeof method === 'string' || !method) {
        return methods.toggle.apply(this, arguments);
    } else {
        $.error('Method ' + method + ' does not exist on jQuery.sidr');
    }
};
$.fn.csld = function(options) {
   var settings=$.extend({speed:400,side:"left",source:null,menucWidth:$(".wpmchimpas-scroller").width()},options);
    var name = 'wpmchimpas',
        $sideMenu = $('#wpmchimpas'),
        $trigMenu = $('#wpmchimpas-trig');
    $sideMenu
        .addClass('wpmchimpas')
        .addClass(settings.side)
        .data({
            speed: settings.speed,
            side: settings.side,
            menucWidth: settings.menucWidth
        });
    $trigMenu
        .addClass('wpmchimpas-trig')
        .addClass(settings.side);
    $('.wpmchimpas-bg').css({
    'background-color' : $('body').css('background-color')||'#fff',
    'background-image' : $('body').css('background-image')
    });
    if (typeof settings.source === 'function') {
        var newContent = settings.source(name);
        privateMethods.loadContent($sideMenu, newContent);
    }
    return this.each(function() {
        var $this = $(this),
            data = $this.data('wpmchimpas');
        if (!data) {
            $this.data('wpmchimpas', name);
            if ('ontouchstart' in document.documentElement) {
                $this.find('.wpmchimpas-trigi').bind('touchstart', function(e) {
                    var theEvent = e.originalEvent.touches[0];
                    this.touched = e.timeStamp;
                });
                $this.find('.wpmchimpas-trigi').bind('touchend', function(e) {
                    var delta = Math.abs(e.timeStamp - this.touched);
                    if(delta < 200) {
                        e.preventDefault();
	                    methods.toggle(name);
                    }
                });
                $this.find('.wpmchimpas-trigh').bind('touchstart', function(e) {
                    var theEvent = e.originalEvent.touches[0];
                    this.touched = e.timeStamp;
                });
                $this.find('.wpmchimpas-trigh').bind('touchend', function(e) {
                    var delta = Math.abs(e.timeStamp - this.touched);
                    if(delta < 200) {
                        e.preventDefault();
	                    $trigMenu.addClass('wpmchimpas-trigdis');
                    }
                });
            } else {
                $this.find('.wpmchimpas-trigi').click(function(e) {
                    e.preventDefault();
                    methods.toggle(name);
                });
                $this.find('.wpmchimpas-trigh').click(function(e) {
                    e.preventDefault();
                    $trigMenu.addClass('wpmchimpas-trigdis');
                });
            }
        }
    });
};
	
	$(function () {

$('[wpmcmask]').each(function(){
	$(this).mask($(this).attr('wpmcmask'),{placeholder:$(this).attr('wpmcmph')});
});
if(wpmcisset(wpmchimpa.addon) || wpmcisset(wpmchimpa.addon_scode)){
	if(wpmcisset(wpmchimpa.addon_desktop)) var desk = true;
	if(wpmcisset(wpmchimpa.addon_tablet)) var tab = true;
	if(wpmcisset(wpmchimpa.addon_mobile)) var mob = true;
}
if(wpmcisset(wpmchimpa.topbar)){
	$('.wpmchimpat-close-button').click(function(){$('.wpmchimpat').addClass('wpmchimpat-close')});
}
if(wpmcisset(wpmchimpa.flipbox)){
	var flipclosed=0;
	$('.wpmchimpaf-close-button').click(function(){
	if($('.wpmchimpaf').hasClass('wpmchimpaf-close'))
		$('.wpmchimpaf').removeClass('wpmchimpaf-close');
	else
		$('.wpmchimpaf').addClass('wpmchimpaf-close');
		flipclosed=1;
	});

	$(document).scroll(function() {
		if(flipclosed)return;
		if($(window).scrollTop() >= $(document).height()/2)
			$('.wpmchimpaf').removeClass('wpmchimpaf-close');
		else
			$('.wpmchimpaf').addClass('wpmchimpaf-close');
    });
}
var x=0;

if((wpmcisset(mob) && $(window).width()<=480) || (wpmcisset(tab) && $(window).width()>480 && $(window).width()<=768) || (wpmcisset(desk) && $(window).width()>768))
$('.wpmchimpab').show();

if(wpmcisset(wpmchimpa.litebox)){
	var docHeight = $(document).height();
    var timeoutID;
	function show_wpmca_litebox(){
		if(x!=0)return;
		if(wpmcisset(wpmchimpa.lite_behave_cookie)){
			if(document.cookie.indexOf("wpmchimpa_show") >= 0)return;
			var date, expires;
	        date = new Date();
	        date.setTime(date.getTime()+(86400000));
	        expires = "; expires="+date.toGMTString();
		    document.cookie = "wpmchimpa_show=true"+expires+"; path=/";
		}
		$('.wpmchimpa-overlay-bg').show();
		x=1;
		if(wpmcisset(wpmchimpa.lite_close_time)){
	  		wpmc_setup();  
		}
	}
	if(wpmcisset(wpmchimpa.lite_desktop)) var desk = true;
	if(wpmcisset(wpmchimpa.lite_tablet)) var tab = true;
	if(wpmcisset(wpmchimpa.lite_mobile)) var mob = true;
	if((wpmcisset(mob) && $(window).width()<=480) || (wpmcisset(tab) && $(window).width()>480 && $(window).width()<=768) || (wpmcisset(desk) && $(window).width()>768)){
		if(wpmcisset(wpmchimpa.lite_behave_time)){
			if(wpmcisset(wpmchimpa.lite_behave_time_inac)) {
		 		 setup();
			}
			else
				setTimeout(function(){show_wpmca_litebox()}, wpmchimpa.lite_behave_time*1000);
		}
		if(wpmcisset(wpmchimpa.lite_behave_scroll)){
			$(document).scroll(function() {if(x==0)if(($(window).scrollTop() / ($(document).height()-$(window).height())) * 100 > 50)show_wpmca_litebox();});
		}
	}
	$('.wpmchimpa-close-button').click(function(){
        $('.wpmchimpa-overlay-bg').hide(); 
    });
	if(wpmcisset(wpmchimpa.lite_close_bck)){    
    	$('.wpmchimpa-overlay-bg').click(function(e){
	        if($(e.target).find('#wpmchimpa-newsletterform').length != 0)
	        	$('.wpmchimpa-overlay-bg').hide();
	    });
    }

} 

if(wpmcisset(wpmchimpa.litebox) || wpmcisset(wpmchimpa.addon) || wpmcisset(wpmchimpa.topbar) || wpmcisset(wpmchimpa.flipbox) || wpmcisset(wpmchimpa.widget) || wpmcisset(wpmchimpa.slider)){
	var wpmc_subing = 0;
	$('.wpmchimpa-subs-button').click(function (e){
		e.preventDefault();
		if(wpmc_subing)return false;
		var button = this;
		var chimp = $(button).parents('.wpmchimpselector:first');
		var form = $(chimp).find('form');
		var preload = $(button).attr('wpmcpre');
		$(chimp).find('[wpmcerr="gen"]').html('');
		$(chimp).find('[wpmctype]').each(function(){
			v = (['radio','checkboxes'].indexOf($(this).attr('wpmctype')) > -1)? (($(chimp).find('[wpmcfield="'+$(this).attr('wpmcfield')+'"]:checked').length > 0)? '1':'') : this.value;
  			err = wpmcvalid($(this).attr('wpmctype'),$(this).attr('wpmcreq'),v);
  			if(err){
  				$(this).addClass('wpmcerror');
  				$this = $(this).closest('.wpmchimpa-field');
  				if(!$(chimp).find('.wpmchimpa-mainc').length){
	  				$this.addClass('wpmcerrora');
				  	setTimeout(function() {
				  		$this.removeClass('wpmcerrora');
				  	}, 500);
				}
			  	$(chimp).find('[wpmcerr="'+$(this).attr('wpmcfield')+'"]').html(err);
  			}
  			else{
  				$(this).removeClass('wpmcerror');
  				$(chimp).find('[wpmcerr="'+$(this).attr('wpmcfield')+'"]').html('');
  			}
  		});
		if($(chimp).find('.wpmcerror').length){
			if($(chimp).find('.wpmchimpa-mainc').length){
				$('.wpmchimpa-mainc').addClass('wpmcerrora');
				setTimeout(function() {
					$('.wpmchimpa-mainc').removeClass('wpmcerrora');
				}, 500);
			}
			return false;
		}
		$(chimp).addClass('signalshow');
		var SubsForm = $(form).serialize();
		wpmc_subing = 1;
		$.ajax({
			type:"POST",
			url: wpmchimpa.ajax_url,
			data: SubsForm,
			dataType: "json",
			success:function(data){
				wpmc_subing = 0;
				$(chimp).removeClass('signalshow');
				if(data == 1){
					if(wpmcsucurl()){$('.wpmchimpa-overlay-bg').hide();}
					else if(wpmchimpa.suc_sub == 'suc_msg' && wpmcisset(wpmchimpa.suc_msg)){
						$(chimp).find('form').fadeOut(function () {
							$(chimp).find('[wpmcerr="gen"]').addClass('wpmchimpa-done').html(wpmchimpa.suc_msg);
						});
					}
				}
				else if(data.status == 200){
					if(wpmcsucurl()){$('.wpmchimpa-overlay-bg').hide();}
					else if(wpmchimpa.suc_sub == 'suc_msg' && wpmcisset(wpmchimpa.suc_msg)){
						$(chimp).find('form').fadeOut(function () {
							$(chimp).find('[wpmcerr="gen"]').addClass('wpmchimpa-done').html(errmsg[2]);
						});
					}
				}
				else if(data == 0 || data.status == 401){
					$(chimp).find('[wpmcerr="gen"]').html(errmsg[4]);
				}
				else $(chimp).find('[wpmcerr="gen"]').html(errmsg[3]);
			}
		});
		return false;
	});
	$('.wpmchimpselector').each(function(){
		var form = $(this).find('form');
		$(form).find('input').keypress(function(e) {
            if(e.which == 10 || e.which == 13) {
               $(form).find('.wpmchimpa-subs-button').click();
            }
        });
	});
	$('.wpmchimpa-soc').click(function (e){
		e.preventDefault();
		var cont = $(this).closest('.wpmchimpselector');
		var form = $(cont).find('form');
		$(cont).find('.wpmchimpa-signal').fadeIn();
		if($(this).hasClass('wpmchimpa-fb')){

			FB.login(function(response) {if (response.status === 'connected') {FB.api('/me', function(response) {
			  SubsForm={name:response.first_name+' '+response.last_name,
			  		email:response.email,
			  		action:'wpmchimpa_add_email_ajax'};
			  		$(form).find('[wpmcfield="FNAME"]').val(response.first_name);
			  		$(form).find('[wpmcfield="lNAME"]').val(response.last_name);
			  		$(form).find('[wpmcfield="email"]').val(response.email);
			  		$(cont).find('.wpmchimpa-subs-button').click();
			});}else{
				if(wpmcisset(wpmchimpa.errorue)) var errmsg = wpmchimpa.errorue;
	        	else var errmsg = 'Unknown Error';
	            $(form).next(".wpmchimpa-feedback").html(errmsg);
	            $(cont).find('.wpmchimpa-signal').hide();
			}}, {scope: 'public_profile,email'});

		}
		else if($(this).hasClass('wpmchimpa-gp')){

			gapi.auth.signIn({'callback': signinCallback });
			  function signinCallback(authResult) {if (authResult['status']['signed_in']) {if (authResult['status']['method'] == 'PROMPT') {gapi.client.load('oauth2', 'v2', function () {gapi.client.oauth2.userinfo.get().execute(function (resp) {
			   SubsForm={name:resp.name,
			  		email:resp.email,
			  		action:'wpmchimpa_add_email_ajax'};
			  		$(form).find('[wpmcfield="FNAME"]').val(resp.name);
			  		$(form).find('[wpmcfield="email"]').val(resp.email);
			  		$(cont).find('.wpmchimpa-subs-button').click();
			});});}} else {
				if(wpmcisset(wpmchimpa.errorue)) var errmsg = wpmchimpa.errorue;
	        	else var errmsg = 'Unknown Error';
	            $(form).next(".wpmchimpa-feedback").html(errmsg);
	            $(cont).find('.wpmchimpa-signal').hide();
			}}
		}
		else if($(this).hasClass('wpmchimpa-ms')){

			WL.login({scope: ["wl.basic", "wl.emails"]}).then(function (response) {
	            WL.api({path: "me",method: "GET"}).then(function (response) {
	               SubsForm={name:response.name,
			  		email:response.emails.account,
			  		action:'wpmchimpa_add_email_ajax'};
			  		$(form).find('[wpmcfield="FNAME"]').val(response.name);
			  		$(form).find('[wpmcfield="email"]').val(response.emails.account);
			  		$(cont).find('.wpmchimpa-subs-button').click();
	            },function (responseFailed) {
					if(wpmcisset(wpmchimpa.errorue)) var errmsg = wpmchimpa.errorue;
		        	else var errmsg = 'Unknown Error';
		            $(form).next(".wpmchimpa-feedback").html(errmsg);
		            $(cont).find('.wpmchimpa-signal').hide();
	            });},function (responseFailed){
					if(wpmcisset(wpmchimpa.errorue)) var errmsg = wpmchimpa.errorue;
		        	else var errmsg = 'Unknown Error';
		            $(form).next(".wpmchimpa-feedback").html(errmsg);
		            $(cont).find('.wpmchimpa-signal').hide();
		    });
		}
	});
}


if (wpmcisset(wpmchimpa.slider)) {
    if (wpmcisset(wpmchimpa.slider_desktop)) var desk = true;
    if (wpmcisset(wpmchimpa.slider_tablet)) var tab = true;
    if (wpmcisset(wpmchimpa.slider_mobile)) var mob = true;
    if ((wpmcisset(mob) && $(window).width() <= 480) || (wpmcisset(tab) && $(window).width() > 480 && $(window).width() <= 768) || (wpmcisset(desk) && $(window).width() > 768)) {
        var opts = [];
        var timeoutIDs,s=0;
        if (wpmcisset(wpmchimpa.slider_orient)) opts['side'] = wpmchimpa.slider_orient;
        $('#wpmchimpas-trig').csld(opts);
        if (wpmcisset(wpmchimpa.slider_trigger_scroll)){
        	if($(window).scrollTop() >= $(document).height()/2)
				$('#wpmchimpas-trig').removeClass('scrollhide');
			else
				$('#wpmchimpas-trig').addClass('scrollhide');
	        $(document).scroll(function() {
				if($(window).scrollTop() >= $(document).height()/2)
					$('#wpmchimpas-trig').removeClass('scrollhide');
				else
					$('#wpmchimpas-trig').addClass('scrollhide');
	        });
	    }
        if (wpmcisset(wpmchimpa.slider_close_bck)) {
            $('.wpmchimpas-overlay').click(function() {
                $.csld('close', 'wpmchimpas');
            });
        }
        if (wpmcisset(wpmchimpa.slider_behave_time)) {
            if (wpmcisset(wpmchimpa.slider_behave_time_inac)) {
                setups();
            } else
                setTimeout(function() {
                    $.csld('open', 'wpmchimpas');
                }, wpmchimpa.slider_behave_time * 1000);
        }
    }
}

wpmcvalid = function(t,r,v){
	if(r == 'true' && !v)
		return errmsg[0];
	if(!v)return '';
	switch(t){
		case 'email' : if(!wpmcvalidate('e',v))
						return errmsg[1];
						break;
		case 'number' : if(!wpmcvalidate('n',v))
						return errmsg[1];
						break;
		case 'imageurl' :
		case 'url' : if(!wpmcvalidate('w',v))
						return errmsg[1];
						break;
						return errmsg[1];
						break;
	}
	return '';
};
wpmcsucurl = function(){
	if(wpmchimpa.suc_sub == 'suc_url' && wpmcisset(wpmchimpa.suc_url)){
		if(wpmcisset(wpmchimpa.suc_url_tab)){
			var win=window.open(wpmchimpa.suc_url,'_blank');
			win.focus();
		}
		else window.open(wpmchimpa.suc_url,'_self');
		return true;
	}
};
		 
function wpmc_setup() {
    document.addEventListener("mousemove", wpmcresetTimer, false);
    document.addEventListener("mousedown", wpmcresetTimer, false);
    document.addEventListener("keypress", wpmcresetTimer, false);
    document.addEventListener("DOMMouseScroll", wpmcresetTimer, false);
    document.addEventListener("mousewheel", wpmcresetTimer, false);
    document.addEventListener("touchmove", wpmcresetTimer, false);
    document.addEventListener("MSPointerMove", wpmcresetTimer, false);
    wpmcstartTimer();
}
function wpmcstartTimer() {
    wpmctimeoutID = window.setTimeout(wpmcgoInactive, wpmchimpa.lite_close_time*1000);
}
function wpmcresetTimer(e) {
    window.clearTimeout(wpmctimeoutID);wpmc_setup();		     
}
function wpmcgoInactive() {
     $('.wpmchimpa-overlay-bg').hide();
}
function setups() {
    document.addEventListener("mousemove", resetTimers, false);
    document.addEventListener("mousedown", resetTimers, false);
    document.addEventListener("keypress", resetTimers, false);
    document.addEventListener("DOMMouseScroll", resetTimers, false);
    document.addEventListener("mousewheel", resetTimers, false);
    document.addEventListener("touchmove", resetTimers, false);
    document.addEventListener("MSPointerMove", resetTimers, false);
    startTimers();
}
function startTimers() {
    timeoutIDs = window.setTimeout(goInactives, wpmchimpa.slider_behave_time * 1000);
}
function resetTimers(e) {
    window.clearTimeout(timeoutIDs);
    setups();
}
function goInactives() {
    if(s==0){$.csld('open', 'wpmchimpas');s=1;}
}
function setup() {
    document.addEventListener("mousemove", resetTimer, false);
    document.addEventListener("mousedown", resetTimer, false);
    document.addEventListener("keypress", resetTimer, false);
    document.addEventListener("DOMMouseScroll", resetTimer, false);
    document.addEventListener("mousewheel", resetTimer, false);
    document.addEventListener("touchmove", resetTimer, false);
    document.addEventListener("MSPointerMove", resetTimer, false);
    startTimer();
}
function startTimer() {
    timeoutID = window.setTimeout(goInactive, wpmchimpa.lite_behave_time*1000);
}
function resetTimer(e) {
    window.clearTimeout(timeoutID);setup();		     
}
function goInactive() {
     if(x==0)show_wpmca_litebox();
}
function wpmcvalidate(t,w){
	var a;
	switch(t){
		case 'e':a=new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i),e=a.test(w);
			break;
		case 'n':a=new RegExp(/^[0-9]*$/gm),e=a.test(w);
			break;
		case 'w':a=new RegExp(/^(ftp|http|https):\/\/[^ "]+$/g),e=a.test(w);
			break;
	}
	return e?!0:!1;
}

	});

}(jQuery));
function wpmcisset(){var r,t=arguments,n=t.length,e=0;if(0===n)throw new Error("Empty wpmcisset");for(;e!==n;){if(t[e]===r||null===t[e])return!1;e++}return!0}
var errmsg = [
	wpmchimpa.errorrf || '* Field Required',
	wpmchimpa.errorfe || '* Invalid Entry',
	wpmchimpa.erroras || 'Already subscribed to Newsletters',
	wpmchimpa.errorue || 'An unknown error occurred processing your request.  Please try again later.',
	"Please configure the plugin properly"
];