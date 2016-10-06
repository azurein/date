$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function checkCard(card_id){
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'Kehadiran/checkCard',
        dataType : 'json',
        data : {
            'card_id'       : card_id
        },
        success : function(data){
            if(data[0].checkCard == 1)
                checkVerification(card_id);
            else
                alert("Kartu tidak terdaftar.");
        }
    });
}

function checkVerification(card_id){
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'Kehadiran/checkVerification',
        dataType : 'json',
        data : {
            'card_id'       : card_id
        },
        success : function(data){
            if(data[0].checkVerification == 0)
                saveVerificationLog(card_id);
            else
                var r = confirm("Kartu sudah diverfikasi, apakah ingin perbarui verifikasi?");

            if (r == true)
                replaceVerificationLog(card_id);
        }
    });
}

function replaceVerificationLog(card_id){
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'KehadiranSync/deactiveVerificationCard',
        dataType : 'json',
        data : {
            'card_id' : card_id
        },
        success : function(data){
            saveVerificationLog(card_id);
        }
    });
}

function saveVerificationLog(card_id){
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'KehadiranSync/saveVerificationLog',
        dataType : 'json',
        data : {
            'card_id'       : card_id
        },
        success : function(data){
            var href = "";
            var curr_page = "";
            href = window.location.href;
            curr_page = href.substr(href.lastIndexOf('/') + 1);

            if(curr_page == "kehadiran") {
                $.getScript( "/date/assets/js/page/admin/kehadiran.js" )
                .done(function( script, textStatus ) {
                    getVerificationLog();
                })
                .fail(function( jqxhr, settings, exception ) {
                    alert("Failed to load script");
                });
            }
            else if(curr_page == "peserta") {
                $.getScript( "/date/assets/js/page/admin/peserta.js" )
                .done(function( script, textStatus ) {
                    getParticipant();
                })
                .fail(function( jqxhr, settings, exception ) {
                    alert("Failed to load script");
                });
            }
        }
    });
}
