<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>The Exonian &mdash; Interstitial page</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style>
	@import url(http://fonts.googleapis.com/css?family=Trocchi|PT+Serif:400,700,400italic,700italic);
	body {
		padding: 60px;
		margin: 0;
		border-top: 5px solid #8C1D1D;
		font-family: "PT Serif",Georgia,Times,serif;
	}
	h1 {
		font-family: "Trocchi",Arial,Helvetica,sans-serif;
		font-weight: normal;
		font-size: 28px;
		color: #893434;
	}
	p {
		max-width: 740px;
		font-size: 18px;
		line-height: 34px;
	}
	a {
		color: #893434;
	}
	#passwordfield {
		padding: 15px 12px;
		font-size: 20px;
		width: 500px;
		border: 1px solid #CCC;
	}

	#passwordfield:focus {
		outline: none;
		box-shadow: 0 0 5px #A3D8E0;
	}
</style>
<script type="text/javascript">//<![CDATA[
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-19218628-1']);
_gaq.push(['_trackPageview']);
(function () {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
//]]>
</script>
<script type="text/javascript">
$(function() {
	$("#passwordfield").focus();

	var peaIPNamespace = "209.23.204.";
	var IPAddress = $("#ipaddress").html();

	if (IPAddress.indexOf(peaIPNamespace) == 0) {
		$("#passwordfield").val("BigRed");
		runCheck(true);
	}

	$("#autofillpassword").click(function(event) {
		$("#passwordfield").val("BigRed");
		runCheck(false);
	});

	$("#passwordfield").keyup(function(event) {
		runCheck(false);
	});

	function runCheck(onCampus) {
		password = $('#passwordfield').val();

		if (password.toLowerCase() == "bigred")
		{
			$("#passwordfield").attr("disabled","disabled");
			$("body").css("background-color","#BAE4B4");

			var onCampusStatement = (onCampus) ? "You're on campus, so we're automatically logging you in&hellip;" : "Logging you in now&hellip;";
			var onCampusTime = (onCampus) ? 1500 : 750;

			$("p").first().html(onCampusStatement).css("color","green");
			setTimeout(function() {
				window.location.href = "http://theexonian.com/new/";
			},onCampusTime);
		}
	}

});
</script>

<meta property="fb:admins" content="1562263125" />

</head>

<body>
<noscript>
<a href="http://theexonian.com/new" style="font-size:50px">Click here.</a>
</noscript>

<div style="display:none" id="ipaddress"><?php echo $_SERVER['REMOTE_ADDR']; ?></div>
<img src="http://theexonian.com/new/wp-content/uploads/2013/04/header-logo-full21.png">
<h1>This will only take a moment&hellip;</h1>
<p>Due to Phillips Exeter Academy publication requirements, you need to use a password to view <i>The Exonian</i>'s website. We are, however, allowed to share the password with you &mdash;<br />it is currently "<a href="#" id="autofillpassword">BigRed</a>".</p>
<p>Enter the password below:<br />
<form>
<input type="text" placeholder="Password?" name="passwordfield" id="passwordfield">
</p>

</body>
</html>