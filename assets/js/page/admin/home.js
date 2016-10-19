var curr_facility = 0;

$(document).ready(function() {

    loadDllData();

    $("#scannerFormQr2").submit(function(e){
        e.preventDefault();
        var card_id = $("#scannerInputQr2").val();
        $("#scannerInputQr").val(card_id);
        getParticipantByCardID(card_id);
    });

    $("#checkFacilityBtn").click(function() {
        checkAvailableFacility();
    });

});

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
    			$("#participantName1").val(data[0].title_name + " " + data[0].participant_name);
                $("#participantContact1").val(data[0].phone_num);
                $("#groupName").val(data[0].group_name);
                $("#participantFollower1").val(data[0].follower);

                getParticipantFacility(data[0].group_id, data[0].participant_id);

            } else {
                alert('Kartu '+card_id+' tidak terdaftar');
            }
		}
	});
}

function getParticipantFacility(group_id, participant_id) {
    curr_facility = 0;
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
                if(data[i].available == 0) {
                    checkbox = '<input type="checkbox" name="selectFacility" value="'+ data[i].facility_id +'" disabled checked>';
                    curr_facility++;
                } else {
                    checkbox = '<input type="checkbox" name="selectFacility" value="'+ data[i].facility_id +'" disabled>';
                }
                $('#listFacilityContent').append('<tr value="'+ data[i].facility_id +'"><td>'+ data[i].table_name +'</td><td>'+ data[i].chair_name +'</td><td>'+checkbox+'</td></tr>');
            }
        }
    });

    $("#participantFollower1").change(function(){
        var demand = $("#participantFollower1").val()
        if(demand >= 0) {
            changeParticipantFacilityTemp(demand);
        }
	});
}

function changeParticipantFacilityTemp(demand) {
    demand++;
    var count = 0;

    if(demand < curr_facility) {
        var unavailable_facility = [];
        $("input[name='selectFacility']:checked").each(function(){
            unavailable_facility.push($(this).val());
        });
        var count = curr_facility - demand;
        if(unavailable_facility.length >= count) {
            for (var i = demand; i < unavailable_facility.length; i++) {
                $("input[name='selectFacility'][value='"+unavailable_facility[i]+"']").removeProp("checked");
            }
            curr_facility = demand;
        } else {
            alert("Fasilitas tidak mencukupi");
        }
    } else if(demand > curr_facility) {
        var available_facility = [];
        $("input[name='selectFacility']:not(:checked").each(function(){
            available_facility.push($(this).val());
        });
        var count = demand - curr_facility;
        if(available_facility.length >= count) {
            for (var i = 0; i < demand - curr_facility; i++) {
                $("input[name='selectFacility'][value='"+available_facility[i]+"']").prop("checked", "true");
            }
            curr_facility = demand;
        } else {
            alert("Fasilitas tidak mencukupi");
        }
    } else {
        //nothing changes
    }
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
            if(follower != "" && data.length >= follower++) {
                for(var i = 0 ; i < data.length ; i++) {
                    $('#listFacilityContent2').append('<tr><td>'+ data[i].table_name +'</td><td>'+ data[i].chair_name +'</td><td><input type="checkbox" name="selectFacility2" value="'+ data[i].facility_id +'"></td></tr>');
                }
            } else {
                alert("Fasilitas tidak mencukupi");
            }
        }
    });

    $("#checkFacilityBtn").click(function() {
        changeParticipantFacility(group_id, follower);
    });

}

function insertParticipantFacility() {

}

function changeParticipantFacility() {

}
