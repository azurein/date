//variable global
var currentCanvasSlide = 1;
var currentCanvasID;
var currentCanvasName;
var currentAction;
var currentFacilityID;
var currentFacilityName;
var currentFacilityGroup;
var currentFacilityParent;
var currentFacilityFrom;
var currentParticipant;
//---------------

$(document).ready(function(){
	$('#btnAddFacility').click(function(){
		$("#addEditModal").modal("show");
		currentAction = 'add';
		getFacilityType();
		$('#ddlAddEditFacilityGroup').attr('disabled',false);
		$('#ddlAddEditFacilityFrom').attr('disabled',false);
		$('#txtAddEditFacilityName').val('');
	});

	$('#btnUploadCanvasImage').click(function(){
		$("#uploadCanvasImageModal").modal("show");
	});

	$("#btnSaveCanvasImage").click(function(){
		if($('#ufUploadCanvasImage').val() == ""){
			validationModal('tidak dapat mengunggah gambar karena gambar belum dimasukan');
		}else if(currentCanvasID == -1){
			validationModal('tidak dapat mengunggah gambar karena denah masih kosong');
		}else{
			uploadCanvasImage(currentCanvasID);
		}
	});

	$('#btnSaveParticipantFacility').click(function(){
		saveParticipantFacility();
		loadAutoCompleteParticipant();
	});

	$('#btnNextCanvas').click(function(){
		$('#FullCanvas').hide("slide", { direction: "left"},500);
		currentCanvasSlide++;
		$('#btnPrevCanvas').attr('disabled',false);
		getDetailCanvas();
		loadFacilityFrom();
		loadAutoCompleteParticipant();
		$('#FullCanvas').show("slide", {direction: "right"},500);
	});

	$('#btnPrevCanvas').click(function(){
		if(currentCanvasSlide>1){
			$('#FullCanvas').hide("slide", { direction: "right"},500);
			currentCanvasSlide--;
			getDetailCanvas();
			loadFacilityFrom();
			loadAutoCompleteParticipant();
			$('#FullCanvas').show("slide", {direction: "left"},500);
		}
		if(currentCanvasSlide == 1){
			$('#btnPrevCanvas').attr('disabled',true);
		}
	});

	$('#btnAddEditFaciliy').click(function(){
		AddEditFacility(currentAction);
	});

	$("#btnDeleteCanvasVerification").click(function(){
		$('#deleteSketchName').text(currentCanvasName);
		$("#deleteCanvasModal").modal("show");
	});

	$('#btnDeleteSketch').click(function(){
		deleteCanvas();
	});

	$('#btnDeleteFacility').click(function(){
		deleteFacility();
		loadAutoCompleteParticipant();
	});

	$('#ddlStatusParticipant').change(function(){
		if($('#ddlStatusParticipant').val() == 0){
			$('#txtParticipant').val('');
			$('#txtParticipant').attr('disabled',true);
		}else{
			if($('#txtParticipant').val() == ''){
				$('#txtParticipant').val(currentParticipant);
			}else{
				currentParticipant = $('#txtParticipant').val();
			}
			$('#txtParticipant').attr('disabled',false);
		}
	});

	getDetailCanvas();
	getFacilityGroup();
	loadFacilityFrom();
	loadAutoCompleteParticipant();
	$('#txtCanvasName').attr('onkeydown',"insertNewCanvasName(event)");
	$('#btnPrevCanvas').attr('disabled',true);
});

function insertNewCanvasName(e){
	//if get enter key
	if(e.keyCode == 13){
		$('#txtCanvasName').focusout();
		if($('#txtCanvasName').val().trim() == ""){
			validationModal('isi kan nama dengan benar');
		}else{			
			if(currentCanvasID == -1){
				insertNewCanvas();
			}else{
				updateCanvasName();
			}	
			getDetailCanvas();			
		}
	}
}

function validationModal(textMessage){
	$("#validationAlertModal").modal("show");
	$('#validationAlertName').text(textMessage);
}

function getDetailCanvas(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getDetailCanvas',
		async : false,
		dataType : 'json',
		data : {
			'canvas_slideid': currentCanvasSlide
		},
		success : function(data){
			if(data.length > 0){
				if(data[0].canvas_img != null){
					$('#imgBackgroundCanvas').attr('src','../../assets/img/denah/'+data[0].canvas_img);
				}else{
					$('#imgBackgroundCanvas').attr('src','../../assets/img/denah/default.jpg');
				}
				$('#txtCanvasName').val(data[0].canvas_name);
				currentCanvasID = data[0].canvas_id;
				currentCanvasName = data[0].canvas_name;
				$('#btnAddFacility').attr('disabled',false);
				$('#btnUploadCanvasImage').attr('disabled',false);
				$('#btnDeleteCanvasVerification').attr('disabled',false);
			}else{
				$('#imgBackgroundCanvas').attr('src','../../assets/img/denah/default.jpg');
				$('#txtCanvasName').val('');
				currentCanvasID = -1;
				currentCanvasName = '';
				$('#btnAddFacility').attr('disabled',true);
				$('#btnUploadCanvasImage').attr('disabled',true);
				$('#btnDeleteCanvasVerification').attr('disabled',true);
			}
			
		}
	});
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getFacilityDetail',
		async : false,
		dataType : 'json',
		data : {
			'canvas_id': currentCanvasID,
			'canvas_slideid': currentCanvasSlide
		},
		success : function(data){
			$('#accordionFacility').empty();
			var color;
			var status; //for ddlStatusParticipant
			var accordionParent = new Array();
			var accordionChild = new Array();
			var listParent = [];
			for(var i=0;i<data.length;i++){
				//coloring child
				if(data[i].is_parent == 0){
					if(data[i].checkin_at != null){ //checkin
						color = "text-danger";
						data[i].color = status = 2;
					}else if(data[i].reserve_at != null){ //booking
						color = "text-warning";
						data[i].color = status = 1;
					}else{ //available
						color = "text-success";
						data[i].color = status = 0;
					}
				}

				if(data[i].is_parent == 1){
					$('#accordionFacility').append('<div id="accordionFacilityParent'+data[i].facility_id+'" class="panel panel-default"><div class="panel-heading facility-detail" role="tab" facility="'+data[i].facility_id+'" name="'+data[i].facility_name+'" group="'+data[i].group_id+'" parent="'+data[i].is_parent+'" from="'+data[i].facility_parent_id+'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordionFacility" aria-expanded="false" href="#accordionFacility .item-'+data[i].facility_id+'">'+data[i].facility_name+' - '+data[i].group_name+'</a><span class="collapse-action"><i class="glyphicon glyphicon-plus addButton"></i><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></h4></div><div class="panel-collapse collapse item-'+data[i].facility_id+'" role="tabpanel"></div></div>');
					accordionParent['FacilityParent'+data[i].facility_id] = 0;
					accordionParent['ReservedFacility'+data[i].facility_id] = 0;
					listParent.push(data[i].facility_id);
				}else if(data[i].facility_parent_id != 0){
					$('#accordionFacilityParent'+data[i].facility_parent_id+' .item-'+data[i].facility_parent_id).append('<div class="panel-body facility-detail" facility="'+data[i].facility_id+'" name="'+data[i].facility_name+'" group="'+data[i].group_id+'" parent="'+data[i].is_parent+'" from="'+data[i].facility_parent_id+'"><span><a class="'+color+' participantFacilityButton" status="'+status+'">'+data[i].facility_name+' - '+(data[i].participant_name?(data[i].title_name? data[i].title_name+' ':'')+data[i].participant_name:'Available')+'</a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>');	
					accordionParent['FacilityParent'+data[i].facility_parent_id]++;
					if(data[i].checkin_at!= null || data[i].reserve_at != null){
						accordionParent['ReservedFacility'+data[i].facility_parent_id]++;
					}
				}else{
					$('#accordionFacility').append('<div class="panel-body facility-detail" style="border-top:1px solid black;" facility="'+data[i].facility_id+'" name="'+data[i].facility_name+'" group="'+data[i].group_id+'" parent="'+data[i].is_parent+'" from="'+data[i].facility_parent_id+'"><span><a class="'+color+' participantFacilityButton" status="'+status+'">'+data[i].facility_name+' - '+(data[i].participant_name?(data[i].title_name? data[i].title_name+' ':'')+data[i].participant_name:'Available')+'</a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>');
				}
			}

			//coloring parent
			for(var i=0;i<listParent.length;i++){
				if(accordionParent['FacilityParent'+listParent[i]] == accordionParent['ReservedFacility'+listParent[i]]){ //full
					$('#accordionFacilityParent'+listParent[i]+' h4').addClass('text-danger');
					color = 2;
				}else if(accordionParent['ReservedFacility'+listParent[i]] == 0){
					$('#accordionFacilityParent'+listParent[i]+' h4').addClass('text-success');
					color = 0;
				}else{
					$('#accordionFacilityParent'+listParent[i]+' h4').addClass('text-warning');
					color = 1;
				}
				for(var z=0;z<data.length;z++){
					if(data[z].facility_id == listParent[i]){
						data[z].color = color;
					}
				}
			}

			canvasApp(data);

			//redeclare after remove 
			$(".addButton").click(function(){
				$("#addEditModal").modal("show");
				currentAction = 'add';
				currentFacilityID = $(this).closest('div .facility-detail').attr('facility');
				currentFacilityName = $(this).closest('div .facility-detail').attr('name');
				currentFacilityGroup = $(this).closest('div .facility-detail').attr('group');
				currentFacilityParent = $(this).closest('div .facility-detail').attr('parent');
				currentFacilityFrom =  $(this).closest('div .facility-detail').attr('from');
				getFacilityType(0); // add always is_parent 0
				$('#txtAddEditFacilityName').val('');
				$('#ddlAddEditFacilityFrom').val(currentFacilityID);
				$('#ddlAddEditFacilityGroup').val(currentFacilityGroup);
				$('#ddlAddEditFacilityGroup').attr('disabled',true);
				$('#ddlAddEditFacilityFrom').attr('disabled',true);
			});

			$(".editButton").click(function(){
				$("#addEditModal").modal("show");
				currentAction = 'edit';
				currentFacilityID = $(this).closest('div .facility-detail').attr('facility');
				currentFacilityName = $(this).closest('div .facility-detail').attr('name');
				currentFacilityGroup = $(this).closest('div .facility-detail').attr('group');
				currentFacilityParent = $(this).closest('div .facility-detail').attr('parent');
				currentFacilityFrom =  $(this).closest('div .facility-detail').attr('from');
				getFacilityType(currentFacilityParent);
				$('#txtAddEditFacilityName').val(currentFacilityName);
				$('#ddlAddEditFacilityGroup').val(currentFacilityGroup);
				if(currentFacilityParent == 1 || currentFacilityFrom == 0){//if parent can edit group
					$('#ddlAddEditFacilityGroup').attr('disabled',false);
				}else{
					$('#ddlAddEditFacilityGroup').attr('disabled',true);
				}
				$('#ddlAddEditFacilityFrom').val(currentFacilityFrom);
				$('#ddlAddEditFacilityFrom').attr('disabled',false);
			});

			$(".deleteFacilityButton").click(function(){
				$("#deleteFacilityModal").modal("show");
				currentFacilityID = $(this).closest('div .facility-detail').attr('facility');
			});		

			$(".participantFacilityButton").click(function(){
				$("#participantFacilityModal").modal("show");
				currentFacilityID = $(this).closest('div .facility-detail').attr('facility');
				currentFacilityName = $(this).closest('div .facility-detail').attr('name');
				currentFacilityGroup = $(this).closest('div .facility-detail').attr('group');
				currentFacilityParent = $(this).closest('div .facility-detail').attr('parent');
				currentFacilityFrom =  $(this).closest('div .facility-detail').attr('from');
				currentParticipant = $(this).text().split(' - ',2)[1]; //mengambil namanya saja
				$('#ddlStatusParticipant').val($(this).attr('status'));
				if(currentParticipant == 'Available'){
					currentParticipant = '';
					$('#txtParticipant').val('');
					$('#txtParticipant').attr('disabled',true);
				}else{
					$('#txtParticipant').val(currentParticipant);
					$('#txtParticipant').attr('disabled',false);
				}
			});
		}
	});
}

function insertNewCanvas(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/insertCanvas',
		dataType : 'json',
		async : false,
		data : {
			'canvas_name' 	: $('#txtCanvasName').val(),
			'canvas_slideid': currentCanvasSlide,
			'canvas_img' 	: 'default.jpg',
			'canvas_width'	: 1000,
			'canvas_height' : 600
		},
		success : function(data){
			currentCanvasID = data;
			validationModal('Berhasil membuat Denah');
		}
	});
}

function updateCanvasName(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/updateCanvasName',
		dataType : 'json',
		async : false,
		data : {
			'canvas_name' 	: $('#txtCanvasName').val(),
			'canvas_id': currentCanvasID
		},
		success : function(data){
			validationModal('Berhasil merubah nama Denah');
		}
	});
}

function deleteCanvas(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/deleteCanvas',
		dataType : 'json',
		data : {
			'canvas_id': currentCanvasID
		},
		success : function(data){
			$('#txtCanvasName').val('');
			validationModal('Berhasil menghapus Denah');
			getDetailCanvas();
		}
	});
}

function getFacilityType(is_parent = null){
	$('#ddlAddEditFacilityType').empty();
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getFacilityType',
		data : {
			'is_parent': is_parent
		},
		async : false,
		dataType : 'json',
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#ddlAddEditFacilityType').append('<option value="'+data[i].facility_type_id+'" parent="'+data[i].is_parent+'">'+data[i].facility_type_name+'</option>');				
			}

			if($('#ddlAddEditFacilityType :selected').attr('parent') == 1){ //parent
				$('#ddlAddEditFacilityFrom').closest('div').hide();
				$('#ddlAddEditFacilityFrom').val(0);
			}else{
				$('#ddlAddEditFacilityFrom').closest('div').show();
			}

			$('#ddlAddEditFacilityType').change(function(){
				if($('#ddlAddEditFacilityType :selected').attr('parent') == 1){ //parent
					$('#ddlAddEditFacilityFrom').closest('div').hide();
					$('#ddlAddEditFacilityFrom').val(0);
				}else{
					$('#ddlAddEditFacilityFrom').closest('div').show();
				}
			});
		}
	});
}

function getFacilityGroup(){
	$('#ddlAddEditFacilityGroup').empty();
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getFacilityGroup',
		dataType : 'json',
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#ddlAddEditFacilityGroup').append('<option value="'+data[i].group_id+'">'+data[i].group_name+'</option>');				
			}
		}
	});
}

function loadFacilityFrom(){
	$('#ddlAddEditFacilityFrom').empty();
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/loadFacilityFrom',
		dataType : 'json',
		async : false,
		data : {
			'canvas_id': currentCanvasID,
			'canvas_slideid' : currentCanvasSlide
		},
		success : function(data){
			if(data.length > 0){
				$('#ddlAddEditFacilityFrom').append('<option value="0">Tidak menggunakan fasilitas lain</option>');
				for(var i=0;i<data.length;i++){
					$('#ddlAddEditFacilityFrom').append('<option value="'+data[i].facility_id+'">'+data[i].facility_name+'</option>');				
				}
			}else{
				$('#ddlAddEditFacilityFrom').append('<option value="0">Tidak menggunakan fasilitas lain</option>');
			}
		}
	});
}

function AddEditFacility(type){
	if(type == 'add'){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Denah_acara/addFacility',
			dataType : 'json',
			async : false,
			data : {
				'facility_type_id': $('#ddlAddEditFacilityType').val(),
				'facility_parent_id': $('#ddlAddEditFacilityFrom').val(),
				'canvas_id': currentCanvasID,
				'canvas_slideid': currentCanvasSlide,
				'group_id':	$('#ddlAddEditFacilityGroup').val(),
				'facility_name': $('#txtAddEditFacilityName').val()
			},
			success : function(data){
				validationModal('Berhasil menambahkan fasilitas');
				$('#txtAddEditFacilityName').val('');
			}
		});
	}else if(type == 'edit'){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'acara/Denah_acara/editFacility',
			dataType : 'json',
			async : false,
			data : {
				'facility_id': currentFacilityID,
				'facility_name': $('#txtAddEditFacilityName').val(),
				'facility_type_id': $('#ddlAddEditFacilityType').val(),
				'facility_parent_id': $('#ddlAddEditFacilityFrom').val(),
				'group_id':	$('#ddlAddEditFacilityGroup').val()
			},
			success : function(data){
				validationModal('Berhasil mengubah fasilitas');
				$('#txtAddEditFacilityName').val('');
			}
		});
	}

	loadFacilityFrom();
	getDetailCanvas();
}

function uploadCanvasImage(CanvasId)
{
	var formData = new FormData($("#formUpload")[0]);
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/uploadCanvasImage/'+CanvasId,
		dataType : 'json',
		data : formData,
		async : false,
		cache : false,
		contentType : false,
		processData : false,
		success : function(data){
			saveCanvasImage(data['responseText'], CanvasId);
		},
		error : function(data){
			saveCanvasImage(data['responseText'], CanvasId);
		}
	});
}

function saveCanvasImage(fileName, CanvasId)
{
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/saveCanvasImage',
		dataType : 'json',
		async: false,
		data : {
			'canvas_id'	: CanvasId,
			'canvas_img': fileName
		},
		success : function(data){
			$('#imgBackgroundCanvas').attr('src','../../assets/img/denah/'+fileName);
			validationModal('Sukses mengunggah gambar');
			$('#ufUploadCanvasImage').val("");
			getDetailCanvas();
		}
	});
}
function deleteFacility(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/deleteFacility',
		dataType : 'json',
		data : {
			'facility_id': currentFacilityID
		},
		success : function(data){
			validationModal('Sukses menghapus fasilitas');
			getDetailCanvas();
		}
	});
}
function loadAutoCompleteParticipant(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getAutoCompleteParticipants',
		dataType : 'json',
		async : false,
		success : function(data){
			var participantName = [];
			for (var i = 0; i < data.length; i++)
			{
				participantName.push(data[i].ParticipantName);
			}

			$("#txtParticipant").autocomplete({
				source: participantName
			});
		}
	});
}
function saveParticipantFacility(){
	var status = $('#ddlStatusParticipant').val();
	if(status == 0){ // available
		$('#txtParticipant').val('');
	}

	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/saveParticipantFacility',
		dataType : 'json',
		data : {
			'facility_id' : currentFacilityID,
			'participant' : $('#txtParticipant').val().trim(),
			'status' : status
		},
		success : function(data){
			getDetailCanvas();
			validationModal('sukses merubah peserta');
		}
	});
}
function saveCoordinateFacility(facility_id,x_axis,y_axis){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/saveCoordinateFacility',
		dataType : 'json',
		async : false,
		data : {
			'facility_id' : facility_id,
			'x_axis' : x_axis,
			'y_axis' : y_axis
		},
		success : function(data){
		
		}
	});
}
