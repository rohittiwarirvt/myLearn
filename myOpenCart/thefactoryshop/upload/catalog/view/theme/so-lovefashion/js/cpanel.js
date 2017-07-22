function getParams(e) {
    var t = e,
        a = {},
        o = t.split("?");
    if (o.length > 1) {
        for (var c = o[1].split("&"), n = 0; n < c.length; n++) splitPair = c[n].split("="), a[splitPair[0]] = splitPair[1];
        return a
    }
    return !1
}

function changeColor(e) {
    "default" != e ? $("#color_scheme").after('<link id="custom_color_scheme" rel="stylesheet" type="text/css" href="catalog/view/theme/' + themes + "/css/theme-" + e + '.css">') : $("#temp_color_scheme").remove(), $(".group-schemes").find("> .item_scheme").removeClass("selected"), $(".group-schemes").find("[data-scheme='" + e + "']").addClass("selected")
}

function changeLayoutBox(e) {
    "full" == e ? $("body").addClass("no-bgbody") : $("body").removeClass("no-bgbody"), $("#wrapper").stripClass("wrapper-").addClass("wrapper-" + e), $.cookie("layoutbox", e)
}

function changePattern(e) {
    $("body").stripClass("pattern").addClass("pattern-" + e), $(".group-pattern").find("> .img-pattern").removeClass("selected"), $(".group-pattern").find("[data-pattern='" + e + "']").addClass("selected")
}

function ResetAll() {
    $.removeCookie("customColorScheme", null), $.removeCookie("layoutbox", null), $.removeCookie("bgPattern", null), window.location.reload(!0)
}

function selectElement(e, t) {
    var a = document.getElementById(t);
    a.value = e
}
$(document).ready(function() {
    var e = navigator.userAgent;
    if (event = e.match(/iPad/i) ? "touchstart" : "click", widthC = $("#sp-cpanel").width() + 40, $("#sp-cpanel_btn").bind("click", function() {
            $(this).animate({
                left: "-50px"
            }, function() {
                $("#sp-cpanel").animate({
                    left: "0px"
                }, 300)
            })
        }), $(".sp-cpanel-close").bind("click", function() {
            $("#sp-cpanel").animate({
                left: -widthC
            }, 300, function() {
                $("#sp-cpanel_btn").animate({
                    left: "0px"
                }, 850)
            })
        }), url = window.location.href, params = getParams(url), params) {
        var t = Object.keys(params);
        $.each(t, function(e, t) {
            switch (addValue = params[t], t) {
                case "scheme":
                    $.cookie("customColorScheme", addValue);
                    break;
                case "layoutbox":
                    $.cookie("layoutbox", addValue);
                    break;
                case "pattern":
                    $.cookie("bgPattern", addValue);
            }
        })
    }
    $(".group-schemes").find("> .item_scheme").each(function() {
        $(this).bind("click", function() {
            $("#custom_color_scheme").attr("id", "temp_color_scheme"), setTimeout(function() {
                $("#temp_color_scheme").remove()
            }, 500), $.cookie("customColorScheme", $(this).attr("data-scheme")), changeColor($(this).attr("data-scheme"))
        })
    }), customColor = $.cookie("customColorScheme"), customColor && changeColor(customColor), layoutbox_class = $.cookie("layoutbox"), layoutbox_class && (changeLayoutBox(layoutbox_class), selectElement(layoutbox_class, "cp-layoutbox")), $(".group-pattern").find(">.img-pattern").each(function() {
        $(this).bind("click", function() {
            $.cookie("bgPattern", $(this).attr("data-pattern")), changePattern($(this).attr("data-pattern"))
        })
    }), bgPattern = $.cookie("bgPattern"), bgPattern && "full" != layoutbox_class && changePattern(bgPattern)
}), $.fn.stripClass = function(e, t) {
    var a = new RegExp((t ? "\\S+" : "\\b") + e + "\\S*", "g");
    return this.attr("class", function(e, t) {
        return t ? t.replace(a, "").trim() : void 0
    }), this
};