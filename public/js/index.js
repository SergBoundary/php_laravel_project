$(document).ready(function() {
    function funcInterface (words) {
        $.each( words['nav-login'], function( key, value ) {
//            console.log( key + ": " + value );
            $('#' + key).text(value);
        });
        $.each( words['nav-menu'], function( key, value ) {
//            console.log( key + ": " + value );
            $('#' + key).text(value);
        });
        $.each( words['form-button'], function( key, value ) {
//            console.log( key + ": " + value );
            $('#' + key).attr('alt', value);
            $('#' + key).attr('title', value);
        });
        $.each( words['user-access-level'], function( key, value ) {
//            console.log( key + ": " + value );
            $('#' + key).attr('value', value);
        });
        var modul = $("#interface-modul").attr('modul');
        $.each( words[modul], function( key, value ) {
            console.log( key + ": " + value );
            $('#' + key).text(value);
        });
        $('title').text(words['title']);
        $('#nav-title').text(words['title']);
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function funcAjaxInterface (lang) {
        $('#lang-title').text(lang);
        var modul = $("#interface-modul").attr('modul');
        $.ajax({
            url: "/ajax-interface",
            type: "POST",
            data: ({language: lang, modul: modul}),
            dataType: "json",
            success: funcInterface
        });
    }
    // Передать значения в куки
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        console.log("Language set: " + cvalue);
    }
    // Получить значения из куки
    function getCookie(cname) {
        var name = cname + "=";
        var carray = document.cookie.split(';');
        for(var i = 0; i < carray.length; i++) {
            var c = carray[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    // Проверить куки
    function checkCookie() {
        var lang = getCookie("coordinator");
        if (lang != "") {
            funcAjaxInterface (lang);
            console.log("Language check (cookie yes): " + lang);
        } else {
            lang = "PL";
            if (lang != "" && lang != null) {
                setCookie("coordinator", lang, 365);
                funcAjaxInterface (lang);
                console.log("Language check (cookie no): " + lang);
            }
        }
    }
    $('.lang').click(function() {
        var lang = $(this).attr('id');
        funcAjaxInterface(lang);
        setCookie("coordinator", lang, 365);
    });
    checkCookie();
});
