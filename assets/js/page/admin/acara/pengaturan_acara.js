$(document).ready(function() {

	getEvent();
	$("#addButton").click(function(){
		loadAddEditModal("Tambah Acara");
	});

});

function getEvent(key=''){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Pengaturan_acara/getEvent',
		dataType : 'json',
		success : function(data){
			populateTableEvent(data);
		}
	});
}

function populateTableEvent(data){
	$(".modal").modal("hide");
	$('#eventDataTable').DataTable().destroy();
	$('#contentTable').empty();

	moment.locale("id");

	for(var i = 0 ; i < data.length ; i++)
	{
		var activeflag = "";
		if(data[i].is_active == 1) {
			activeflag = '<i class="fa fa-check"></i>';
		} else {
			activeflag = '<i class="fa fa-remove"></i>';
		}

		$('#contentTable').append('<tr value="'+ data[i].event_id +'"><td class="name"><a href="#" id="name'+i+'">'+ data[i].event_name +'</a></td><td>'+ data[i].event_type_name +'</td><td>'+ data[i].address +', '+ data[i].city +'</td><td>'+ data[i].duration +'</td><td>'+ data[i].total_invitation +'</td><td>'+ activeflag +'</td><td><i class="glyphicon glyphicon-gift souvenirButton"></i> <i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteButton"></i></td></tr>');
		
		var startdt = moment(data[i].start_at).format("dddd, DD MMMM YYYY");
		var enddt = moment(data[i].end_at).format("dddd, DD MMMM YYYY");
		var starttm = moment(data[i].start_at).format("HH:mm");
		var endtm = moment(data[i].end_at).format("HH:mm");
		var finaldt = "";
		if(startdt == enddt) {
			finaldt = 'Hari '+ startdt +'<br>Pukul '+ starttm +' s/d '+ endtm;
		} else {
			finaldt = 'Hari '+ startdt+' Pukul '+ starttm +' s/d <br> Hari '+ enddt +' Pukul '+ endtm;
		}

		$("#name"+i).tooltip({
			html: true,
			container: 'body',
			delay: 500,
			placement: 'left',
			title: '<p align="left">Jadwal:<br>'+ finaldt +'<br><br>Deskripsi:<br>'+ data[i].event_descr +'</p>'
		}); 
	}

	$(".fa-check").click(function(e){
		var text = "Anda yakin menyelesaikan Acara "+ $(this).parent().siblings(".name").text() +"?";
		var id = $(this).parent().parent().attr("value");
		changeEventStatus(text, 0, id)
	});

	$(".fa-remove").click(function(){
		var text = "Anda yakin mengaktifkan Acara "+ $(this).parent().siblings(".name").text();
		var id = $(this).parent().parent().attr("value");
		changeEventStatus(text, 1, id)
	});

	$(".souvenirButton").click(function(){
		loadSouvenirForm($(this).parent().parent().attr("value"));
	});

	$(".editButton").click(function(){
		getEventByID($(this).parent().parent().attr("value"));
	});
	
	$(".deleteButton").click(function(){
		deleteEvent($(this).parent().parent().attr("value"), "Anda yakin menghapus acara "+ $(this).parent().siblings(".name").text() +"?");
	});
	
	$('#eventDataTable').DataTable({
		"order"		: [[ 4, "desc" ]]
	});
}

function changeEventStatus(text="", status=0, id=0) {
	if(status==1) {
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Pengaturan_acara/checkAvailableEvent',
			dataType : 'json',
			success : function(data){
				if(data[0].status_active == 0) {
					$("#activateModal p").text(text);
					$("#activateModal").modal("show");
					$("#changeStatusButton").unbind('click').click(function(){
						$.ajax({
							type : 'POST',
							url : BASE_URL + 'acara/Pengaturan_acara/changeEventStatus',
							dataType : 'json',
							data : {
								'status' 	: status,
								'id'		: id
							},
							success : function(data){
								getEvent();
								$("#activateModal").modal("hide");
							}
						});
					});
				} else {
					$("#forbidModal").modal("show");
				}			
			}
		});
	} else {
		$("#activateModal p").text(text);
		$("#activateModal").modal("show");
		$("#changeStatusButton").unbind('click').click(function(){
			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Pengaturan_acara/changeEventStatus',
				dataType : 'json',
				data : {
					'status' 	: status,
					'id'		: id
				},
				success : function(data){
					getEvent();
					$("#activateModal").modal("hide");
				}
			});
		});
	}
}

function loadAddEditModal(text="Tambah/Ubah Acara", eventData='') {
	$("#addEditTitle").text(text);
	$("#addEditModal").modal("show");

	$("#EventText").val('');
	$("#StartDate").val('');
	$("#EndDate").val('');
	$("#AddressText").val('');
	$("#ParticipantText").val('');

	$.ajax({
		type : 'GET',
		url : BASE_URL + 'acara/Pengaturan_acara/getModalDdl',
		dataType : 'json',
		success : function(data){
			$("#EventTypeDdl").empty();
			$("#CityDdl").empty();
			for (var i = 0 ; i < data.event_type.length ; i++) {
				$("#EventTypeDdl").append('<option value="'+data.event_type[i].event_type_id+'">'+data.event_type[i].event_type_name+'</option>');	
			}
			for (var i = 0; i < data.city.length ; i++) {
				$("#CityDdl").append('<option value="'+data.city[i].city+'">'+data.city[i].city+'</option>');
			}

			var id = '';
			if(text == 'Ubah Acara')
			{
				id = eventData.event_id;
				$("#EventText").val(eventData.event_name);
				$("#EventTypeDdl").val(eventData.event_type_id);
				$("#StartDate").val(eventData.start_at);
				$("#EndDate").val(eventData.end_at);
				$("#AddressText").val(eventData.address);
				$("#CityDdl").val(eventData.city);
				$("#ParticipantText").val(eventData.total_invitation);
			}

			$("#saveButton").unbind('click');
			$("#saveButton").click(function(){
				saveEvent(id);
			});
		}
	});
}

function saveEvent(id){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Pengaturan_acara/saveEvent',
		dataType : 'json',
		data : {
			'id'				: id,
			'event_name'		: $("#EventText").val(),
			'event_type_id'		: $("#EventTypeDdl").val(),
			'start_at'			: $("#StartDate").val(),
			'end_at'			: $("#EndDate").val(),
			'address'			: $("#AddressText").val(),
			'city'				: $("#CityDdl").val(),
			'total_invitation'	: $("#ParticipantText").val()
		},
		success : function(data){
			getEvent();
		}
	});
}

function loadSouvenirForm() {
	$("#souvenirModal").modal("show");
}

function deleteEvent(id='', text='') {
	$("#deleteName").text(text);
	$("#deleteModal").modal("show");

	$("#deleteEventButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Pengaturan_acara/deleteEventByID',
			dataType : 'json',
			data : {
				'id' : id
			},
			success : function(data){
				getEvent();
			}
		});
	});
}

function getEventByID(id) {
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Pengaturan_acara/getEventByID',
		dataType : 'json',
		data : {
			'id' : id
		},
		success : function(data){
			loadAddEditModal('Ubah Acara',data[0]);
		}
	})
}