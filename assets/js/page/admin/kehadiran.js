$(document).ready(function() {

	getVerificationLog();

	$("#exportButton").click(function(){
		exportExcelVerification();
	});

	$(".fa-refresh").click(function(){
		getVerificationLog();
	});
});

function getVerificationLog(key=''){
	$(".fa-refresh").addClass('fa-spin');
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Kehadiran/getVerificationLog',
		dataType : 'json',
		data : {
			'key' : key
		},
		success : function(data){
			populateTableVerification(data);
			$(".fa-refresh").removeClass('fa-spin');
		}
	});
}

function getVerificationSummary(key=''){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Kehadiran/getTotalVerifiedByUser',
		dataType : 'json',
		data : {
			'key' : key
		},
		success : function(data){
			if(data.length > 0)
			{
				$('#totalVerified').html(data[0].TotalVerified);
			}
		}
	});

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
				$('#totalParticipant').html(data[0].TotalParticipant);
			}
		}
	});
}

function populateTableVerification(data){
	$('#verification-log').DataTable().destroy();
	$('#contentTable').empty();

	for(var i = 0 ; i < data.length ; i++)
	{
		$('#contentTable').append('<tr value="'+ data[i].log_id +'"><td><span class="card">'+ data[i].card_id +'</span></td><td class="name">'+ data[i].title_name + data[i].participant_name +'</td><td class="time">'+ data[i].verification_time +'</td><td> <i class="deleteButton glyphicon glyphicon-trash"></i></td></tr>');
	}

	$(".deleteButton").click(function(){
		deactiveVerificationLog($(this).parent().parent().attr("value"),$(this).parent().siblings(".name").text());
	});
	
	$('#verification-log').DataTable({
		"order"		: [[ 3, "desc" ]]
	});

	getVerificationSummary();
}

function deactiveVerificationLog(id,name){
	$("#deleteName").text('Anda yakin menghapus catatan kehadiran '+ name +' ?');
	$("#deleteModal").modal("show");
	$("#deleteButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'KehadiranSync/deactiveVerificationLog',
			dataType : 'json',
			data : {
				'id' : id
			},
			success : function(data){
				getVerificationLog();
			}
		});
	});
}

function exportExcelVerification(){
	var url = BASE_URL+'Kehadiran/export';
	$.ajax({
		type : 'GET',
		url : url,
		success:function(data){
			window.open(url,'_blank');
		}
	});
}