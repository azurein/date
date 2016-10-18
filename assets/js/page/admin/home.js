$(document).ready(function() {

    loadDllData();

    $("#scannerFormQr2").submit(function(e){
        e.preventDefault();
        var id = $("#scannerInputQr2").val();
        $("#scannerInputQr").val(id);
        $("#scannerInputQr2").val("");
        getParticipantByCardID(id);
        $("#menu2").removeClass("active");
        $("#menu1").addClass("active");
        $("#menu1").addClass("in");
        $("#tab-menu2").removeClass("active");
        $("#tab-menu1").addClass("active");
    });

    $("#checkFacilityBtn").click(function() {
        $.ajax({
            type : 'GET',
            url : BASE_URL + 'Home/checkAvailableFacility',
            dataType : 'json',
            data : {
                'group_id' : $("#groupDdl").val(),
                'follower' : $("#participantFollower2").val()
            },
            success : function(data){
                $('#listFacilityContent').html("");
                for(var i = 0 ; i < data.length ; i++) {
                    $('#listFacilityContent').append('<tr value="'+ data[i].facility_id +'"><td>'+ data[i].table_name +'</td><td>'+ data[i].chair_name +'</td><td><input type="checkbox" name="selectFacility"></td></tr>');
                }
            }
        });
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
                saveParticipant(id);
            });
        }
    });
}

function getParticipantByCardID(id){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Home/getParticipantByCardID',
		dataType : 'json',
		data : {
			'id' : id
		},
		success : function(data){
            if(data.length > 0) {
    			$("#participantName1").val(data[0].title_name + " " + data[0].participant_name);
                $("#participantContact1").val(data[0].phone_num);
                $("#groupName").val(data[0].group_name);
                $("#participantFollower1").val(data[0].follower);
            } else {
                alert('invalid');
            }
		}
	})
}
