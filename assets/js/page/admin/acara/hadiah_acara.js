var prize_id;
var totalWinner;
var participantName;
var actionType;

$(document).ready(function() {
	getPrize();

	$("#btnInsert").unbind('click').click(function(){ 
		loadInsertUpdateModal("Tambah Hadiah");
	});

	$("#btnSavePrize").unbind('click').click(function(){
		uploadPrize(prize_id);
	});

	$("input:radio[name=settingWinner]").unbind('click').click(function() {
		if($(this).val() == "0")
		{
			$("input[name='participant']").val('');
			$("input[name='participant']").attr('disabled',false);
			$('.groups').prop('disabled', true);
		}
		else
		{
			$("input[name='participant']").val('');
			$("input[name='participant']").attr('disabled', true);
			$('.groups').prop('disabled', false);
			$('.groups').prop('checked', false);
		}
	});

	$("#btnSaveParticipantsOrGroups").unbind('click').click(function() {
		var check = '';
		var titles = '';

		if($("#rbGroups").prop('checked') == true)
		{
			if ($('.groups:checked').length == 0)
			{
				showMessage("Pilih salah satu group!");
				return;
			}

			$('.groups:checked').each(function(){
				check += $(this).val() + ',';
			});

			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Hadiah_acara/deleteParticipantsPrizeSetting',
				dataType : 'json',
				data : {
					'prize_id'	: prize_id
				},
				success : function(data){

				}
			});

			if(actionType == 'Update'){
				$.ajax({
					type : 'POST',
					url : BASE_URL + 'acara/Hadiah_acara/deleteGroups',
					async : false,
					dataType : 'json',
					data : {
						'prize_id'			: prize_id,
						'groups'			: check
					},
					success : function(data){

					}
				});
			}

			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Hadiah_acara/saveGroups',
				dataType : 'json',
				async : false,
				data : {
					'prize_id'			: prize_id,
					'groups'			: check
				},
				success : function(data){
					getPrize();
				}
			});
		}
		else if($('#rbParticipants').prop('checked') == true)
		{
			for(var i = 0; i < totalWinner; i++)
			{
				if($('#txtParticipant'+i+'').val().trim() == '')
				{
					if(i == 0)
					{
						showMessage("Participant " + (i+1) + " harus diisi!");
					}
					else
					{
						showMessage("Participant " + (i+1) + " harus diisi!");
					}
					return;
				}
			}

			for(var i = 0; i < totalWinner; i++)
			{
				if($.inArray($('#txtParticipant'+i+'').val().trim(), participantName) == -1)
				{
					showMessage("Participant " + $('#txtParticipant'+i+'').val() + " tidak ada!")
					return;
				}
			}

			for(var i = 0; i < totalWinner; i++)
			{
				titles += $('#txtParticipant'+i+'').val().split(' ', 2)[0] + ',';
				check += $('#txtParticipant'+i+'').val().split(' ', 2)[1] + ',';
			}

			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Hadiah_acara/deleteGroupsPrizeSetting',
				dataType : 'json',
				data : {
					'prize_id'			: prize_id
				},
				success : function(data){

				}
			});

			if(actionType == 'Update'){
				$.ajax({
					type : 'POST',
					url : BASE_URL + 'acara/Hadiah_acara/deleteParticipants',
					async : false,
					dataType : 'json',
					data : {
						'prize_id'			: prize_id,
						'participants'		: check,
						'titles'			: titles
					},
					success : function(data){

					}
				});
			}

			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Hadiah_acara/saveParticipants',
				async : false,
				dataType : 'json',
				data : {
					'prize_id'			: prize_id,
					'participants'		: check,
					'titles'			: titles
				},
				success : function(data){
					getPrize();
				}
			});
		}
	});
});

function showMessage(text = '')
{
	$("#messageTitle").text(text);
	$("#messageModal").modal("show");
}

function loadInsertUpdateModal(text = "", prizeData = '') 
{
	$("#insertUpdateTitle").text(text);
	$("#insertUpdateModal").modal("show");

	$("#prizeName").val('');
	$("#prizeDescription").val('');
	$("#prizePriority").val('');
	$("#totalWinner").val('');
	$('#prizeFile').attr('data-input', '');
	$('#prizeFile').val('');

	actionType = 'Insert';
	prize_id = '';

	if(text == 'Ubah Hadiah')
	{
		actionType = 'Update';

		prize_id = prizeData.prize_id;
		$("#prizeName").val(prizeData.prize_name);
		$("#prizeDescription").val(prizeData.prize_descr);
		$("#prizePriority").val(prizeData.prize_priority);
		$("#totalWinner").val(prizeData.total_winner);
		$('#prizeFile').attr('data-input', prizeData.prize_img);
	}
}

function getPrize()
{
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Hadiah_acara/getPrize',
		dataType : 'json',
		success : function(data){
			populateTablePrize(data);
		}
	});
}

function getPrizeByID(prize_id) 
{
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Hadiah_acara/getPrizeByID',
		dataType : 'json',
		data : {
			'prize_id' : prize_id
		},
		success : function(data){
			loadInsertUpdateModal('Ubah Hadiah', data[0]);
		}
	})
}

function getWinnerByID(prize_id)
{
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Hadiah_acara/getWinnerByID',
		dataType : 'json',
		data : {
			'prize_id' : prize_id
		},
		success : function(data){
			populateTableWinner(data);
		}
	});
}

function uploadPrize(prize_id)
{
	var formData = new FormData($("#formPrize")[0]);
	
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Hadiah_acara/uploadPrize',
		dataType : 'json',
		data : formData,
		cache : false,
		contentType : false,
		processData : false,
		success : function(data){

		},
		error : function(data){
			savePrize(data['responseText'], prize_id);
		}
	});
}

function savePrize(data, prize_id)
{
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Hadiah_acara/savePrize',
		dataType : 'json',
		data : {
			'prize_id'			: prize_id,
			'prize_name'		: $("#prizeName").val(),
			'prize_descr'		: $("#prizeDescription").val(),
			'prize_img'			: data,
			'prize_priority'	: $("#prizePriority").val(),
			'total_winner'		: $("#totalWinner").val()
		},
		success : function(data){
			getPrize();
		}
	});
}

function deletePrize(prize_id = '', text = '') 
{
	$("#deleteTitle").text(text);
	$("#deleteModal").modal("show");

	$("#btnDeletePrize").click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Hadiah_acara/deletePrizeByID',
			dataType : 'json',
			data : {
				'prize_id' : prize_id
			},
			success : function(data){
				getPrize();
			}
		});
	});
}

function populateTablePrize(data)
{
	$('#insertUpdateModal').modal("hide");
	$('#deleteModal').modal("hide");
	$('#settingModal').modal("hide");
	$('#prizeDataTable').DataTable().destroy();
	$('#contentTable').empty();

	for(var i = 0 ; i < data.length ; i++)
	{
		var imageHTML = '<td>-</td>';

		if(data[i].prize_img!="")
			var imageHTML = '<td><i class="fa fa-image showImage" imagePath="'+data[i].prize_img+'"></i></td>';

		$('#contentTable').append('<tr value="'+data[i].prize_id+'" totalwinner="'+data[i].total_winner+'"><td class="name"><a href="#" id="name'+i+'">'+data[i].prize_name+'</a></td>'+imageHTML+'<td>'+data[i].prize_priority+'</td><td>'+data[i].total_winner+'</td><td><i class="fa fa-trophy showWinner"></i></td><td><i class="glyphicon glyphicon-cog settingButton"></i> <i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteButton"></i></td></tr>');

		$("#name"+i).tooltip({
			html: true,
			container: 'body',
			delay: 500,
			placement: 'left',
			title: '<p align="left">Deskripsi:<br>'+ data[i].prize_descr +'</p>'
		}); 
	}
	
	$(".showImage").click(function(e){ 
		var text = $(this).parent().siblings(".name").text();
		var imagePath = $(this).attr("imagePath");
		loadImage(text, imagePath);
	});

	$(".showWinner").click(function(e){ 
		showWinner();
	});

	$(".settingButton").click(function(){ 
		$("#settingModal").modal("show");

		$('.templateParticipant').empty();

		prize_id = $(this).parent().parent().attr("value");
		totalWinner = $(this).parent().parent().attr("totalwinner");

		// AUTOCOMPLETE PARTICIPANTS
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Hadiah_acara/getParticipants',
			dataType : 'json',
			success : function(data){
				participantName = [];

				for (var i = 0; i < data.length; i++)
				{
					participantName.push(data[i].ParticipantName);
				}

				for(var i = 0; i < totalWinner; i++)
				{
					$("#txtParticipant"+i).autocomplete({
						source: participantName
					});
				}
			}
		});

		// GET PARTICIPANTS TEXTBOX
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Hadiah_acara/getParticipantsPrizeSetting',
			dataType : 'json',
			data : {
				'prize_id' : prize_id
			},
			success : function(data){
				for(var i = 0; i < data.length ; i++)
				{
					$("#txtParticipant"+i).val(data[i].ParticipantName);
					actionType = 'Update';
				}
			}
		});

		// GET GROUPS CHECKBOX
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Hadiah_acara/getGroupsPrizeSetting',
			dataType : 'json',
			data : {
				'prize_id' : prize_id
			},
			success : function(data){
				for(var i = 0; i < data.length ; i++)
				{
					$('.groups[value="'+data[i].group_id+'"]').prop('checked', true);
					actionType = 'Update';
				}
			}
		});

		for(var i = 0; i < totalWinner; i++)
		{
			$('.templateParticipant').append('<div class="ui-widget"><input style="margin-bottom: 5px;" class="form-control" name="participant" type="text" id="txtParticipant' + i + '"></div>');
		}

		$("#rbParticipants").prop('checked', true);
		$("input[name='participant']").val('');
		$("input[name='participant']").attr('disabled',false);
		$('.groups').prop('checked', false);
		$('.groups').prop('disabled', true);
	});

	$(".editButton").unbind('click').click(function(){
		getPrizeByID($(this).parent().parent().attr("value"));
	});
	
	$(".deleteButton").unbind('click').click(function(){
		deletePrize($(this).parent().parent().attr("value"), "Anda yakin menghapus hadiah "+ $(this).parent().siblings(".name").text() +"?");
	});
	
	$('#prizeDataTable').DataTable({
		"order"		: [[ 3, "desc" ]],
		"columnDefs": [{
			"targets": [1, 4, 5],
			"orderable": false
		} ]
	});
}

function populateTableWinner(data)
{
	// $('#winnerDataTable').DataTable().destroy();
	// $('#contentWinner').empty();

	// for(var i = 0 ; i < data.length ; i++)
	// {
	// 	$('#contentWinner').append('<tr><td>' + data[i].card_id + '</td><td>' + data[i].participant_name + '</td><td>' 
	// 		+ data[i].group_name + '</td></tr>');
	// }
	
	// $('#winnerDataTable').DataTable({
	// 	"order"		: [[ 0, "asc" ]],
	// });
}

function loadImage(text, imagePath)
{
	$("#imageModal").modal("show");
	$('#imageText').text('Gambar Hadiah ' + text);
	$('#imageModal img').attr('src', '../../assets/img/hadiah/' + imagePath);
}

function showWinner(text, prize_id)
{
	$("#winnerModal").modal("show");
	$('#winnerText').text('Pemenang Hadiah ' + text);

	getWinnerByID(prize_id);
}