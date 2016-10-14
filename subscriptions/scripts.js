$(function() {
    $("#sameBilling").click( function() {
        var billing = $("#billing");
        var sameBilling = $("#sameBilling");
        if (sameBilling.is(":checked"))
            billing.slideUp();
        else
            billing.slideDown();
    });
});

$(document).ready(function() {
    $("#emailPopup").popover({
        title : "Why is your email needed?",
        content: "We use your email only to contact you about your Exonian subscription.",
        trigger: "hover"
    });
});

$(document).ready(function() {
    var billing = $("#billing");
    var sameBilling = $("#sameBilling");
    if (sameBilling.is(":checked"))
        billing.hide();
    else
        billing.show();
    $("#SHIP_STATE_US").hide();
    $("#SHIP_STATE_CA").hide();
    $("#SHIP_STATE_--").hide();
    var SHIP_COUNTRY = $("#SHIP_COUNTRY");
    if (SHIP_COUNTRY.val() === "US" || SHIP_COUNTRY.val() === "CA")
        $("#SHIP_STATE_" + SHIP_COUNTRY.val()).show();
    else
        $("#SHIP_STATE_--").show();
    $("#BILL_STATE_US").hide();
    $("#BILL_STATE_CA").hide();
    $("#BILL_STATE_--").hide();
    var BILL_COUNTRY = $("#BILL_COUNTRY");
    if (BILL_COUNTRY.val() === "US" || BILL_COUNTRY.val() === "CA")
        $("#BILL_STATE_" + BILL_COUNTRY.val()).show();
    else
        $("#BILL_STATE_--").show()
    var TITLE_OTHER = $("#TITLE_OTHER");
    TITLE_OTHER.hide();
    if ($("#TITLE").val() === "-")
        TITLE_OTHER.show()
});

$(function() {
    $("#mainForm").submit(function() {
        return checkFields();
    });
});

$(function() {
    $("#SHIP_COUNTRY").change( function() {
		$("#SHIP_STATE_US").hide();
		$("#SHIP_STATE_CA").hide();
		$("#SHIP_STATE_--").hide();
        var SHIP_COUNTRY = $("#SHIP_COUNTRY");
		if (SHIP_COUNTRY.val() === "US" || SHIP_COUNTRY.val() === "CA")
			$("#SHIP_STATE_" + SHIP_COUNTRY.val()).show();
		else
			$("#SHIP_STATE_--").show();
    }
    );
});

$(function() {
    $("#BILL_COUNTRY").change( function() {
        $("#BILL_STATE_US").hide();
        $("#BILL_STATE_CA").hide();
        $("#BILL_STATE_--").hide();
        var BILL_COUNTRY = $("#BILL_COUNTRY");
        if (BILL_COUNTRY.val() === "US" || BILL_COUNTRY.val() === "CA")
            $("#BILL_STATE_" + BILL_COUNTRY.val()).show();
        else
            $("#BILL_STATE_--").show()
    }
    );
});

$(function() {
    $("#TITLE").change( function() {
        var TITLE_OTHER = $("#TITLE_OTHER");
		TITLE_OTHER.hide();
		if ($("#TITLE").val() === "-")
			TITLE_OTHER.show()
        }
    );
});


function checkFields() {
    var unfilled = false;
    var reqFields = ["FIRST_NAME", "LAST_NAME", "EMAIL_ADDRESS", "SHIP_COUNTRY", "SHIP_NAME", "SHIP_STREET1", "SHIP_CITY", "SHIP_POSTAL_CODE"];
    if (!$("#sameBilling").is(":checked")) {
        reqFields = reqFields.concat(["BILL_COUNTRY", "BILL_NAME", "BILL_STREET1", "BILL_CITY", "BILL_POSTAL_CODE"]);
        var BILL_COUNTRY = $("#BILL_COUNTRY");
        if (BILL_COUNTRY.val() === "US" || BILL_COUNTRY.val() === "CA")
            reqFields.push("BILL_STATE_" + BILL_COUNTRY.val());
        else
            reqFields.push("BILL_STATE_--");
    }
    if ($("#TITLE").val() === "-")
        reqFields.push("TITLE_OTHER");
    else
        reqFields.push("TITLE");
    var SHIP_COUNTRY = $("#SHIP_COUNTRY");
    if (SHIP_COUNTRY.val() === "US" || SHIP_COUNTRY.val() === "CA")
        reqFields.push("SHIP_STATE_" + SHIP_COUNTRY.val());
    else
        reqFields.push("SHIP_STATE_--");
    $.each(reqFields, function(index, fieldName) {
        var FIELD_SELECT = $("#" + fieldName);
        if (FIELD_SELECT.val() === "") {
            unfilled = true;
            FIELD_SELECT.parent().parent().addClass("error");
        }
        else {
            FIELD_SELECT.parent().parent().removeClass("error");
        }
    });
    if (unfilled === true) {
        $("#missing").slideDown();
	$("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    }
    else {
        $("#missing").slideUp();
        return true;
    }
}
