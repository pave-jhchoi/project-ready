var reg_user_id_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.user_id.php",
        data: {
            "reg_user_id": encodeURIComponent($("#reg_user_id").val())
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}


// 추천인 검사
var reg_user_recommend_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.user_recommend.php",
        data: {
            "reg_user_recommend": encodeURIComponent($("#reg_user_recommend").val())
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}


var reg_user_nick_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.user_nick.php",
        data: {
            "reg_user_nick": ($("#reg_user_nick").val()),
            "reg_user_id": encodeURIComponent($("#reg_user_id").val())
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}


var reg_user_email_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.user_email.php",
        data: {
            "reg_user_email": $("#reg_user_email").val(),
            "reg_user_id": encodeURIComponent($("#reg_user_id").val())
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}


var reg_user_hp_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.user_hp.php",
        data: {
            "reg_user_hp": $("#reg_user_hp").val(),
            "reg_user_id": encodeURIComponent($("#reg_user_id").val())
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}