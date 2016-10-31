$(document).ready(function() {
	$('title').html("D.A.T.E - Pengaturan Acara");
	$('#StartDate').datetimepicker();
	$('#EndDate').datetimepicker();
	getEvent();
	$("#addButton").click(function(){
		loadAddEditModal("Tambah Acara");
	});

	var souvenirValue = 0;
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

	var hasActive = 0;

	var actions = '';
	if(PRIVILEGE == 1) { activator = '<i class="editButton glyphicon glyphicon-pencil"></i><i class="deleteButton glyphicon glyphicon-trash"></i>'; }
	if(PRIVILEGE == 1) { actions = '<i class="glyphicon glyphicon-gift souvenirButton"></i> <i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteButton"></i>'; }

	for(var i = 0 ; i < data.length ; i++)
	{
		var activeflag = "";
		if(data[i].is_active == 1) {
			activeflag = '<i class="fa fa-check"></i>';
			hasActive = 1;
		} else {
			activeflag = '<i class="fa fa-remove"></i>';
		}

		$('#contentTable').append('<tr value="'+ data[i].event_id +'"><td class="name"><a href="#" id="name'+i+'">'+ data[i].event_name +'</a></td><td>'+ data[i].event_type_name +'</td><td>'+ data[i].address +', '+ data[i].city +'</td><td>'+ data[i].duration +'</td><td>'+ data[i].total_invitation +'</td><td>'+ activeflag +'</td><td>'+ actions +'</td></tr>');

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
	if(hasActive == 0) {
		$('#warningModal').modal('show');
	}

	$(".fa-check").click(function(e){
		if (PRIVILEGE == 1) {
			var text = "Anda yakin menyelesaikan Acara "+ $(this).parent().siblings(".name").text() +"?";
			var id = $(this).parent().parent().attr("value");
			changeEventStatus(text, 0, id)
		}
	});

	$(".fa-remove").click(function(){
		if (PRIVILEGE == 1) {
			var text = "Anda yakin mengaktifkan Acara "+ $(this).parent().siblings(".name").text();
			var id = $(this).parent().parent().attr("value");
			changeEventStatus(text, 1, id)
		}
	});

	$(".souvenirButton").click(function(){
		getSouvenir($(this).parent().parent().attr("value"));
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

function getSouvenir(id=''){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Pengaturan_acara/getSouvenir',
		dataType : 'json',
		data: {id},
		success : function(data){
			populateTableSouvenir(id, data);
		}
	});
}

function populateTableSouvenir(id='', data=''){
	$("#souvenirModal").modal("show");
	$('#contentSouvenir').empty();
	souvenirValue = 0;
	var flagLoop = 0;

	for(var i = 0 ; i < data.length ; i++)
	{
		$('#contentSouvenir').append(
			'<tr value="'+ data[i].souvenir_id +'">' +
			'<td><input name="souvenir_name_'+i+'" class="form-control input-sm" type="text" value="'+data[i].souvenir_name+'"></td>' +
			'<td><input name="souvenir_qty_'+i+'" class="form-control input-sm" type="text" value="'+data[i].souvenir_qty+'"></td>' +
			'<td class="actionSouvenir"><i class="glyphicon glyphicon-trash deleteSouvenir"></i></td>' +
			'</tr>'
		);
		souvenirValue = i;
		flagLoop = 1;
	}
	if(flagLoop == 1) {
		souvenirValue++;
	}

	$('#contentSouvenir').append(
		'<tr>' +
		'<td><input name="souvenir_name_'+souvenirValue+'" class="form-control input-sm" type="text"></td>' +
		'<td><input name="souvenir_qty_'+souvenirValue+'" class="form-control input-sm" type="text"></td>' +
		'<td class="actionSouvenir"><i class="glyphicon glyphicon-plus addSouvenir"></i></td>' +
		'</tr>'
	);

	$(document).off('click', '.addSouvenir');
	$(document).on('click', '.addSouvenir', function(){
		souvenirValue++;
		$('.actionSouvenir').html('<i class="glyphicon glyphicon-trash deleteSouvenir"></i>');
		$('#contentSouvenir').append(
			'<tr>' +
			'<td><input name="souvenir_name_'+souvenirValue+'" class="form-control input-sm" type="text"></td>' +
			'<td><input name="souvenir_qty_'+souvenirValue+'" class="form-control input-sm" type="text"></td>' +
			'<td class="actionSouvenir"><i class="glyphicon glyphicon-plus addSouvenir"></i></td>' +
			'</tr>'
		);
	});

	$(document).off('click', '.deleteSouvenir');
	$(document).on('click', '.deleteSouvenir', function(){
		$(this).parent().parent().remove();
	});

	$(document).off('click', '#saveSouvenirButton');
	$(document).on('click', '#saveSouvenirButton', function(){
		if($('.addSouvenir').parent().siblings().children().val() == "") {
			$(".addSouvenir").parent().parent().remove();
		}
		if($('.actionSouvenir').length > 0) {
			var formSerialize = $('#souvenirForm').serializeArray();
			var event_id = {
			      name: "id",
			      value: id
			};
			var length = {
			      name: "length",
			      value: $('#contentSouvenir tr').length
			};
			formSerialize.push(event_id);
			formSerialize.push(length);

			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Pengaturan_acara/saveSouvenir',
				dataType : 'json',
				data : formSerialize,
				success : function(data){
					$("#souvenirModal").modal("hide");
				}
			});
		} else {
			$("#souvenirModal").modal("hide");
		}
	});
}

function changeEventStatus(text='', status=0, id=0) {
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
								href = window.location.href;
					            curr_page = href.substr(href.lastIndexOf('/') + 1);

					            if(curr_page == "peserta") {
									redirect = href.replace(/\/[^\/]*$/, '/peserta');
									window.location = redirect;
								} else if(curr_page == "kehadiran") {
									redirect = href.replace(/\/[^\/]*$/, '/kehadiran');
									window.location = redirect;
					            } else {
									getEvent();
									$("#activateModal").modal("hide");
					            }
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
