$(document).ready(function() {
    $('title').html("D.A.T.E - Home");
    loadDllData();
    $("#scannerFormQrSubmit").hide();
    $("#onTheSpotFormSubmit").hide();

    $("#scannerFormQr2").submit(function(e){
        e.preventDefault();
        var card_id = $("#scannerInputQr2").val();
        checkCard(card_id);
    });

    $("#checkFacilityBtn").click(function() {
        checkAvailableFacility();
    });

    $(document).on("keypress", "#scannerFormQr", function(event) {
        return event.keyCode != 13;
    });

    $(document).on("keypress", "#onTheSpotForm", function(event) {
        return event.keyCode != 13;
    });

});

function checkCard(card_id){
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'Kehadiran/checkVerification',
        dataType : 'json',
        data : {
            'card_id'       : card_id
        },
        success : function(data){
            if(data[0].checkVerification == 0) {
                $("#scannerInputQr").val(card_id);
                getParticipantByCardID(card_id);
            } else if(data[0].checkVerification == 1) {
                var r = confirm("Kartu "+card_id+" sudah diverfikasi, apakah ingin perbarui verifikasi?");
                if (r == true) {
                    $("#scannerInputQr").val(card_id);
                    getParticipantByCardID(card_id);
                } else {
                    $("#scannerInputQr2").val("");
                    $("#scannerInputQr").val("");
                }
            } else if(data[0].checkVerification == 2) {
                var r = confirm("Kartu "+card_id+" sudah diwakilkan oleh "+data[0].title_name +" "+data[0].participant_name+" apakah ingin perbarui verifikasi?");
                if (r == true) {
                    $("#scannerInputQr").val(card_id);
                    getParticipantByCardID(card_id);
                } else {
                    $("#scannerInputQr2").val("");
                    $("#scannerInputQr").val("");
                }
            }
        }
    });
}

function loadDllData(){
    $.ajax({
        type : 'GET',
        url : BASE_URL + 'Peserta/getModalDdl',
        dataType : 'json',
        success : function(data){
            $("#titleDdl").empty();
            $("#groupDdl").empty();
            for (var i = 0 ; i < data.title.length ; i++) {
                $("#titleDdl").append('<option value="'+data.title[i].title_id+'">'+data.title[i].title_name+'</option>');
            }
            for (var i = 0; i < data.group.length ; i++) {
                $("#groupDdl").append('<option value="'+data.group[i].group_id+'">'+data.group[i].group_name+'</option>');
            }

            $("#saveButton").click(function(){
                alert("saved");
            });
        }
    });
}

function getParticipantByCardID(card_id){
    $("#participantID").val("");
    $("#participantName1").val("");
    $("#participantContact1").val("");
    $("#groupName").val("");
    $("#participantFollower1").val("");

    $("#menu2").removeClass("active");
    $("#menu1").addClass("active");
    $("#menu1").addClass("in");
    $("#tab-menu2").removeClass("active");
    $("#tab-menu1").addClass("active");

	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Home/getParticipantByCardID',
		dataType : 'json',
		data : {
			'card_id' : card_id
		},
		success : function(data){
            if(data.length > 0) {
                $("#participantID").val(data[0].participant_id);
    			$("#participantName1").val(data[0].title_name + " " + data[0].participant_name);
                $("#participantContact1").val(data[0].phone_num);
                $("#groupName").val(data[0].group_name);
                $("#participantFollower1").val(data[0].follower);

                getParticipantFacility(data[0].group_id, data[0].participant_id);
                getParticipantRepresentation(data[0].participant_id);

            } else {
                alert('Kartu '+card_id+' tidak terdaftar');
                $("#scannerInputQr2").val("");
                $("#scannerInputQr").val("");
            }
		}
	});
}

function getParticipantFacility(group_id, participant_id) {
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'Home/getParticipantFacility',
        dataType : 'json',
        data : {
            'group_id' : group_id,
            'participant_id' : participant_id
        },
        success : function(data){
            var checkbox = '';
            $('#listFacilityContent').html("");
            for(var i = 0 ; i < data.length ; i++) {
                if(data[i].available == 1) {
                    checkbox = '<input type="checkbox" name="selectFacility[]" class="selectFacility" value="'+ data[i].facility_id +'">';
                } else {
                    checkbox = '<input type="checkbox" name="selectFacility[]" class="selectFacility" value="'+ data[i].facility_id +'" checked>';
                }
                $('#listFacilityContent').append('<tr value="'+ data[i].facility_id +'"><td>'+ data[i].canvas_name +'</td><td>'+ data[i].group_name +'</td><td>'+ data[i].table_name +'</td><td>'+ data[i].chair_name +'</td><td>'+checkbox+'</td></tr>');
            }
            // $("#listFacilityTable").scrollTableBody();
            VerificationValidation();
        }
    });

    // $(document).on('click', '#listFacilityTable tr', function(){
    //     var checkbox = $(this).find('input[type=checkbox][name=selectFacility]');
    //     if(checkbox.is(':checked')){
    //         checkbox.removeProp('checked', 'false');
    //     } else {
    //         checkbox.prop('checked', 'true');
    //     }
    // });

    $(document).on('change', '.selectFacility', function(){
        VerificationValidation();
    });

    $(document).on('keyup', '#participantFollower1', function(){
        VerificationValidation();
    });
}

function VerificationValidation() {
    var undangan = $("input[type=checkbox][class=selectFacility]:checked").length;
    var penempatan = parseInt($("#participantFollower1").val())+1;
    if(undangan == penempatan) {
        $("#scannerFormQrSubmit").show();
    } else {
        if(parseInt($("#participantFollower1").val()) == 0) {
            $("#scannerFormQrSubmit").show();
        } else {
            $("#scannerFormQrSubmit").hide();
        }
    }
}

function OnTheSpotValidation() {
    var undangan = $("input[type=checkbox][class=selectFacility2]:checked").length;
    var penempatan = parseInt($("#participantFollower2").val())+1;
    if(undangan == penempatan) {
        $("#onTheSpotFormSubmit").show();
    } else {
        $("#onTheSpotFormSubmit").hide();
    }
}

function getParticipantRepresentation(participant_id) {
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'Home/getParticipantRepresentation',
        dataType : 'json',
        data : {
            'participant_id' : participant_id
        },
        success : function(data){
            var checkbox = '';
            $("#totalSouvenir").val(1);
            $('#listRepresentationContent').html("");
            for(var i = 0 ; i < data.length ; i++) {
                if(data[i].selected == 1) {
                    checkbox = '<input type="checkbox" class="selectRepresentation" name="selectRepresentation[]" value="'+ data[i].card_id +'" checked>';
                    $("#totalSouvenir").val(parseInt($("#totalSouvenir").val())+1);
                } else {
                    checkbox = '<input type="checkbox" class="selectRepresentation" name="selectRepresentation[]" value="'+ data[i].card_id +'">';
                }
                $('#listRepresentationContent').append('<tr value="'+ data[i].participant_id +'"><td>'+ data[i].card_id +'</td><td>'+ data[i].title_name + " " + data[i].participant_name +'</td><td>'+ data[i].phone_num +'</td><td>'+checkbox+'</td></tr>');
            }
            // $(document).on('click', '#listRepresentationTable tr', function(){
            //     var checkbox = $(this).find('input[type=checkbox][name=selectRepresentation]');
            //     if(checkbox.is(':checked')){
            //         checkbox.removeProp('checked', 'false');
            //     } else {
            //         checkbox.prop('checked', 'true');
            //     }
            // });
        }
    });

    $("#listRepresentationTable").off('change').on('change', '.selectRepresentation', function(){
        if($(this).is(':checked')) {
            $("#totalSouvenir").val(parseInt($("#totalSouvenir").val())+1);
        } else {
            $("#totalSouvenir").val(parseInt($("#totalSouvenir").val())-1);
        }
    });
}

function checkAvailableFacility() {
    var group_id = $("#groupDdl").val();
    var follower = $("#participantFollower2").val();
    $('#listFacilityContent2').html("");

    $.ajax({
        type : 'GET',
        url : BASE_URL + 'Home/checkAvailableFacility',
        dataType : 'json',
        data : {
            'group_id' : group_id,
            'follower' : follower
        },
        success : function(data){
            if(follower != "" && follower >= 0 && data.length > follower++) {
                for(var i = 0 ; i < data.length ; i++) {
                    $('#listFacilityContent2').append('<tr value="'+ data[i].facility_id +'"><td>'+ data[i].canvas_name +'</td><td>'+ data[i].group_name +'</td><td>'+ data[i].table_name +'</td><td>'+ data[i].chair_name +'</td><td><input type="checkbox" class="selectFacility2" name="selectFacility2[]" value="'+ data[i].facility_id +'"></td></tr>');
                }
            } else {
                alert("Fasilitas tidak mencukupi");
            }
        }
    });

    $("#checkFacilityBtn").click(function() {
        changeParticipantFacility(group_id, follower);
    });

    // $(document).on('click', '#listFacilityTable2 tr', function(){
    //     var checkbox = $(this).find('input[type=checkbox][name=selectFacility2]');
    //     if(checkbox.is(':checked')){
    //         checkbox.removeProp('checked', 'false');
    //     } else {
    //         checkbox.prop('checked', 'true');
    //     }
    // });

    $(document).on('change', '.selectFacility2', function(){
        OnTheSpotValidation();
    });

    $(document).on('keyup', '#participantFollower2', function(){
        OnTheSpotValidation();
    });
}
