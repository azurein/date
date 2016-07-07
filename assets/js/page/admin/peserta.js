var string = [];
var map = {};

$( document ).ready(function() {
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

	$("#search").bind('input propertychange',function(){
		getParticipant($(this).val());
	});

	$('#participantDelegate').typeahead({
		source: string
	});


	$("#exportButton").click(function(){
		exportExcel();
	});

	$("#importInput").click(function(){
		$(this).val(null);
	}).change(function(){
		importExcel($(this));
	});
});

function importExcel(input){
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

function exportExcel(){
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
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/getParticipant',
		dataType : 'json',
		data : {
			'key' : key
		},
		success : function(data){
			populateTable(data);
		}
	})
}

function loadAddEditModal(param , participantData=''){
	$("#addEditTitle").text(param);

	$("#participantName").val('');
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
		}
	});
}

function saveParticipant(id){
	var delegateID = map[$("#participantDelegate").val()];

	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Peserta/saveParticipant',
		dataType : 'json',
		data : {
			'id'		: id,
			'title'		: $("#titleDdl").val(),
			'name'		: $("#participantName").val(),
			'group' 	: $("#groupDdl").val(),
			'follower'	: $("#participantFollower").val(),
			'delegate'	: delegateID
		},
		success : function(data){
			getParticipant();
		}
	})
}

function populateTable(data){
	$('#contentTable').empty();
	if(data.length > 0)
	{
		for(var i = 0 ; i < data.length ; i++)
		{
			$('#contentTable').append('<tr value="'+data[i].participant_id+'"><td><span class="card" style="cursor:hand;">'+ data[i].card_id +'</span></td><td class="name">'+ data[i].title_name + data[i].participant_name +'</td><td id="hah" value="'+data[i].group_id+'">'+ data[i].group_name +'</td><td>'+ data[i].follower +'</td><td>'+ data[i].status_kehadiran +'</td><td> <i class="editButton glyphicon glyphicon-pencil"></i><i class="deleteButton glyphicon glyphicon-trash"></i></td></tr>');
		}
		$(".card").click(function(){
			resetCardID($(this).text(),$(this).parent().siblings(".name").text());
		});
		$(".deleteButton").click(function(){
			deleteParticipant($(this).parent().parent().attr("value"),$(this).parent().siblings(".name").text());
		});

		$(".editButton").click(function(){
			getParticipantByID($(this).parent().parent().attr("value"));
		});
	}
	else
	{
		$('#contentTable').append('<tr><td colspan="6" align="center">Tidak ada data</td></tr>');
	}
}

function resetCardID(cardID,name){
	$("#resetName").text('Anda yakin reset Kode Kartu Peserta '+ name +' ?');
	$("#resetCardModal").modal("show");
	$("#resetButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'Peserta/resetCardID',
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
			url : BASE_URL + 'Peserta/deleteParticipantByID',
			dataType : 'json',
			data : {
				'id' : id
			},
			success : function(data){
				getParticipant();
			}
		})
	})
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