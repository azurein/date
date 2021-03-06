var string = [];
var map = {};

$(document).ready(function() {
    $('title').html("D.A.T.E - Peserta");
	getParticipant();

	$.ajax({
		type : 'GET',
		url : BASE_URL + 'Peserta/getForm',
		success : function(data){
			$("#t").append(data+'<input type="file" name="userfile" size="20" /><br /><br /><input type="submit" value="upload" /></form>');
		}
	});

	$("#addButton").click(function(){
		loadAddEditModal('Tambah Peserta');
	});

	$(".fa-refresh").click(function(){
		getParticipant();
	});

	$('#participantDelegate').typeahead({
		source: string
	});

	$("#exportButton").click(function(){
		exportExcelParticipant();
	});

	$("#importInput").click(function(){
		$(this).val(null);
	}).change(function(){
		importExcelParticipant($(this));
	});
});

function importExcelParticipant(input){
	var data = new FormData()
	data.append('uploadXls',input[0].files[0]);
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/upload',
		contentType : false,
		processData : false,
		cache : false,
		data : data,
		dataType : 'json',
		success: function(data){
			if(data.status == 0){
				$("#message").empty().append(data.error);
				$("#messageModal").modal("show");
			}
			else if(data.status == 1){
				$("#message").empty().text("Data berhasil di import");
				$("#messageModal").modal("show");
				getParticipant();
			}
		}
	});
}

function exportExcelParticipant(){
	var url = BASE_URL+'Peserta/export';
	$.ajax({
		type : 'GET',
		url : url,
		success:function(data){
			window.open(url,'_blank');
		}
	});
}

function getAvailDelegate(id=''){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/getAvailDelegateParticipant',
		dataType : 'json',
		data : {
			participantID : id
		},
		success : function(data){
			string.length = 0;
			map = {};
			for(var i = 0 ; i < data.length ; i++){
				string.push(data[i].title_name + data[i].participant_name + ' - ' + data[i].card_id);
				map[string[i]] = data[i].participant_id;
			}
		}
	});
}

function getParticipant(key=''){
	$(".fa-refresh").addClass('fa-spin');
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/getParticipant',
		dataType : 'json',
		data : {
			'key' : key
		},
		success : function(data){
			populateTableParticipant(data);
			$(".fa-refresh").removeClass('fa-spin');
		}
	});
}

function getParticipantSummary(key=''){
		var TotalVerified = 0;
		var TotalParticipant = 0;
		var TotalUnverified = 0;

		$.ajax({
		type : 'POST',
		url : BASE_URL + 'Kehadiran/getTotalVerified',
		dataType : 'json',
		data : {
			'key' : key
		},
		success : function(data){
			if(data.length > 0)
			{
				TotalVerified = data[0].TotalVerified;
				$('#totalVerified').html(TotalVerified);
                
                $.ajax({
                    type : 'POST',
                    url : BASE_URL + 'Peserta/getTotalParticipant',
                    dataType : 'json',
                    data : {
                        'key' : key
                    },
                    success : function(data){
                        if(data.length > 0)
                        {
                            TotalParticipant = data[0].TotalParticipant;
                            TotalUnverified = TotalParticipant - TotalVerified;
                            $('#totalUnverified').html(TotalUnverified);
                        }
                    }
                });
			}
		}
	});
}

function loadAddEditModal(param , participantData=''){
	$("#addEditTitle").text(param);

	$("#participantName").val('');
	$("#participantContact").val('');
	$("#participantFollower").val('');
	$("#participantDelegate").val('');

	getAvailDelegate(participantData != '' ? participantData.participant_id : '');

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

			var id = '';
			if(param == 'Ubah Peserta')
			{
				var delegateName = '';
				for(var name in map){
					if(map[name] === participantData.delegate_to){
						delegateName = name;
						break;
					}
				}
				$("#titleDdl").val(participantData.title_id);
				$("#participantName").val(participantData.participant_name);
				$("#participantContact").val(participantData.phone_num);
				$("#groupDdl").val(participantData.group_id);
				$("#participantFollower").val(participantData.follower);
				$("#participantDelegate").val(delegateName);
				id = participantData.participant_id;
			}

			$("#saveButton").unbind('click');
			$("#saveButton").click(function(){
				saveParticipant(id);
			});
			$("#addEditModal").modal("show");

            if (PRIVILEGE != 1) {
                $('.modal-body input').prop('readonly','true');
                $('.modal-body option:not(:selected)').prop('disabled', 'true');
                $('.modal-body #participantDelegate').removeAttr('readonly');
            }
		}
	});
}

function saveParticipant(id){
	var delegateID = map[$("#participantDelegate").val()];

	$.ajax({
		type : 'POST',
		url : BASE_URL + 'PesertaSync/saveParticipant',
		dataType : 'json',
		data : {
			'id'		: id,
			'title'		: $("#titleDdl").val(),
			'name'		: $("#participantName").val(),
			'phone_num'	: $("#participantContact").val(),
			'group' 	: $("#groupDdl").val(),
			'follower'	: $("#participantFollower").val(),
			'delegate'	: delegateID
		},
		success : function(data){
			getParticipant();
		}
	});
}

function populateTableParticipant(data){
	$('#participantDataTable').DataTable().destroy();
	$('#contentTable').empty();

    var actions = '';
    if (PRIVILEGE == 1) {
        actions = '<i class="deleteButton glyphicon glyphicon-trash"></i>';
    }

	for(var i = 0 ; i < data.length ; i++)
	{
		var activeflag = "";
		if(data[i].is_confirm == 1) {
			activeflag = '<i class="fa fa-check"><span style="display:none">1</span></i>';
		} else {
			activeflag = '<i class="fa fa-remove"><span style="display:none">0</span></i>';
		}

		var followerBadge = "";
		if(data[i].facility_status == 0) {
			followerBadge = '<span class="badge" style="background-color: #cc0000; cursor: pointer"><span style="display:none">1</span>'+ data[i].follower +'</span>';
		} else if(data[i].facility_status == 1) {
			followerBadge = '<span class="badge" style="background-color: #ff8533; cursor: pointer"><span style="display:none">2</span>'+ data[i].follower +'</span>';
		} else {
			followerBadge = '<span class="badge" style="background-color: #33cc00; cursor: pointer"><span style="display:none">3</span>'+ data[i].follower +'</span>';
		}

		$('#contentTable').append('<tr value="'+data[i].participant_id+'"><td><span class="card" style="cursor:hand;">'+ data[i].card_id +'</span></td><td class="name">'+ data[i].title_name + data[i].participant_name +'</td><td>'+ data[i].phone_num +'</td><td value="'+data[i].group_id+'">'+ data[i].group_name +'</td><td>'+ followerBadge +'</td><td>'+ data[i].verification_time +'</td><td>'+ activeflag +'</td><td><i class="editButton glyphicon glyphicon-pencil"></i>'+ actions +'</td></tr>');
	}

	$(".card").click(function(){
		resetCardID($(this).text(),$(this).parent().siblings(".name").text());
	});

	$(".badge").click(function(e){
		getParticipantFacility($(this).parent().siblings(".name").text(), $(this).parent().parent().attr("value"));
	});

	$(".fa-check").click(function(e){
		if (PRIVILEGE == 1) {
			var text = "Anda yakin  "+ $(this).parent().siblings(".name").text() +" tidak konfirmasi?";
			var id = $(this).parent().parent().attr("value");
			changeParticipantStatus(text, 0, id)
		}
	});

	$(".fa-remove").click(function(){
		if (PRIVILEGE == 1) {
			var text = "Anda yakin "+ $(this).parent().siblings(".name").text() +" konfirmasi?";
			var id = $(this).parent().parent().attr("value");
			changeParticipantStatus(text, 1, id)
		}
	});

	$(".deleteButton").click(function(){
		deleteParticipant($(this).parent().parent().attr("value"),$(this).parent().siblings(".name").text());
	});

	$(".editButton").click(function(){
		getParticipantByID($(this).parent().parent().attr("value"));
	});

	$('#participantDataTable').DataTable({
		"order"		: [[ 5, "desc" ]],
		"columnDefs": [
		    { "width": "17%", "targets": 0 }
		  ]
	});

	getParticipantSummary();
}

function getParticipantFacility(title='', id=''){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/getParticipantFacility',
		dataType : 'json',
		data : {
			participantID : id
		},
		success : function(data){
			$("#facilityTitle").text("Fasilitas "+title);
			$("#facilityModal").modal("show");
			$("#contentFacility").html("");
			for(var i = 0 ; i < data.length ; i++) {
				$("#contentFacility").append("<tr><td>"+ data[i].canvas_name +"</td><td>"+ data[i].group_name +"</td><td>"+ data[i].table_name +"</td><td>"+ data[i].chair_name +"</td></tr>");
			}
		}
	});
}

function resetCardID(cardID,name){
	$("#resetName").text('Anda yakin reset Kode Kartu Peserta '+ name +' ?');
	$("#resetCardModal").modal("show");
	$("#resetButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'PesertaSync/resetCardID',
			dataType : 'json',
			data : {
				'cardID' : cardID
			},
			success : function(data){
				getParticipant();
			}
		});
	});
}

function deleteParticipant(id,name){
	$("#deleteName").text('Anda yakin menghapus peserta '+ name +' ?');
	$("#deleteModal").modal("show");
	$("#deleteButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'PesertaSync/deleteParticipantByID',
			dataType : 'json',
			data : {
				'id' : id
			},
			success : function(data){
				getParticipant();
			}
		});
	});
}

function getParticipantByID(id){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/getParticipantByID',
		dataType : 'json',
		data : {
			'id' : id
		},
		success : function(data){
			loadAddEditModal('Ubah Peserta',data[0]);
		}
	})
}

function changeParticipantStatus(text='', status=0, id=0) {
	$("#activateModal p").text(text);
	$("#activateModal").modal("show");
	$("#changeStatusButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'Peserta/changeParticipantStatus',
			dataType : 'json',
			data : {
				'status' 	: status,
				'id'		: id
			},
			success : function(data){
				getParticipant();
				$("#activateModal").modal("hide");
			}
		});
	});
}
