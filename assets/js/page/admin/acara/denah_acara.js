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
	});

	$('#btnNextCanvas').click(function(){
		$('#FullCanvas').hide("slide", { direction: "left"},500);
		currentCanvasSlide++;
		$('#btnPrevCanvas').attr('disabled',false);
		getDetailCanvas();
		loadFacilityFrom();
		$('#FullCanvas').show("slide", {direction: "right"},500);
	});

	$('#btnPrevCanvas').click(function(){
		if(currentCanvasSlide>1){
			$('#FullCanvas').hide("slide", { direction: "right"},500);
			currentCanvasSlide--;
			getDetailCanvas();
			loadFacilityFrom();
			$('#FullCanvas').show("slide", {direction: "left"},500);
		}
		if(currentCanvasSlide == 1){
			$('#btnPrevCanvas').attr('disabled',true);
		}
	});

	$('#btnAddEditFaciliy').click(function(){
		AddEditFacility(currentAction);
	});

	$("#btnPrintCanvas").click(function(){
		// var canvas = document.getElementById("canvasOne");
		// var img = canvas.toDataURL("image/pdf");
		// var doc = new jsPDF('l', 'mm');
        // doc.addImage(img, 'PNG', 10, 10);
        // doc.save('Cetak Denah '+$("#txtCanvasName").val()+'.pdf');
		var pdf = new jsPDF('p', 'pt', 'letter');
		pdf.addHTML($('#canvasOne')[0], function () {
			pdf.save('Cetak Denah '+$("#txtCanvasName").val()+'.pdf');
		});
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
	});

	$('#btnDownloadExcel').click(function(){
		//window.open(BASE_URL +'acara/Denah_acara/exportCanvasTemplateExcel/'+currentCanvasID+'/'+currentCanvasName,'_parent');

		var form = document.createElement("form");
        form.action = BASE_URL + 'acara/Denah_acara/exportCanvasTemplateExcel/',
        form.method = 'POST';
        form.target = '_blank';

        var data = {};
        data['currentCanvasID'] = currentCanvasID;
        data['currentCanvasName'] = currentCanvasName;
        if (data) {
            for (var key in data) {
                var input = document.createElement("textarea");
                input.name = key;
                input.value = data[key];
                form.appendChild(input);
            }
        }

        form.style.display = 'none';
        document.body.appendChild(form);
        form.submit();
	});

	$('#btnUploadExcel').click(function(){
		$('#uploadExcelTemplate').trigger('click');
	});

	$('#uploadExcelTemplate').change(function(){
		if($(this).val() != ''){
			loadExcel();
			$('#uploadExcelTemplate').val('');
		}
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

	$('#CanvasBorder').mouseup(function() {
      resizeCanvas();
    });

	$('#ddlAddEditFacilityFrom').change(function(){
		setGroupByParent();
	});

	getDetailCanvas();
	getFacilityGroup();
	loadFacilityFrom();
	getParentSummary();
	getChildSummary();
	$('#txtCanvasName').attr('onkeydown',"insertNewCanvasName(event)");
	$('#btnPrevCanvas').attr('disabled',true);
});

function getParentSummary(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getParentSummary',
		dataType : 'json',
		data : { 'parent_status' : '1' },
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#count_parent_1').text(data[i].count_parent);
			}
		}
	});
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getParentSummary',
		dataType : 'json',
		data : { 'parent_status' : '2' },
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#count_parent_2').text(data[i].count_parent);
			}
		}
	});
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getParentSummary',
		dataType : 'json',
		data : { 'parent_status' : '3' },
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#count_parent_3').text(data[i].count_parent);
			}
		}
	});
}

function getChildSummary(){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getChildSummary',
		dataType : 'json',
		data : { 'child_status' : '1' },
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#count_child_1').text(data[i].count_child);
			}
		}
	});
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getChildSummary',
		dataType : 'json',
		data : { 'child_status' : '2' },
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#count_child_2').text(data[i].count_child);
			}
		}
	});
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getChildSummary',
		dataType : 'json',
		data : { 'child_status' : '3' },
		success : function(data){
			for(var i=0;i<data.length;i++){
				$('#count_child_3').text(data[i].count_child);
			}
		}
	});
}

function insertNewCanvasName(e){
	//if get enter key
	if(e.keyCode == 13){
		$('#txtCanvasName').focusout();
		if($('#txtCanvasName').val().trim() == ""){
			validationModal('isi kan nama dengan benar');
		}else{
			$.ajax({
				type : 'POST',
				url : BASE_URL + 'acara/Denah_acara/checkCanvasName',
				async : false,
				dataType : 'json',
				data : {
					'canvas_name' : $('#txtCanvasName').val(),
					'canvas_id' : currentCanvasID
				},
				success : function(data){
					if(data.length > 0){
						validationModal('nama canvas sudah terpakai');
						$('#txtCanvasName').val(currentCanvasName);
					}else{
						if(currentCanvasID == -1){
							insertNewCanvas();
						}else{
							updateCanvasName();
						}
						getDetailCanvas();
					}
				}
			});
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
				$('#CanvasBorder').css('height',data[0].canvas_height);
				$('#CanvasBorder').css('width',data[0].canvas_width);
				$('#btnAddFacility').attr('disabled',false);
				$('#btnDownloadExcel').attr('disabled',false);
				$('#btnUploadExcel').attr('disabled',false);
				$('#btnPrintCanvas').attr('disabled',false);
				$('#btnUploadCanvasImage').attr('disabled',false);
				$('#btnDeleteCanvasVerification').attr('disabled',false);
			}else{
				$('#imgBackgroundCanvas').attr('src','../../assets/img/denah/default.jpg');
				$('#txtCanvasName').val('');
				currentCanvasID = -1;
				currentCanvasName = '';
				$('#CanvasBorder').css('height',600);//default
				$('#CanvasBorder').css('width',1000);
				$('#btnAddFacility').attr('disabled',true);
				$('#btnUploadCanvasImage').attr('disabled',true);
				$('#btnDownloadExcel').attr('disabled',true);
				$('#btnUploadExcel').attr('disabled',true);
				$('#btnPrintCanvas').attr('disabled',true);
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
				data[i].name = data[i].facility_name;
				//coloring child
				if(data[i].is_parent == 0){
					data[i].totalCurrentChild = 0; //dont have child
					data[i].totalFullChild = 0;
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
					$('#accordionFacility').append('<div id="accordionFacilityParent'+data[i].facility_id+'" class="panel panel-default"><div class="panel-heading facility-detail" role="tab" facility="'+data[i].facility_id+'" name="'+data[i].facility_name+'" group="'+data[i].group_id+'" parent="'+data[i].is_parent+'" from="'+data[i].facility_parent_id+'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordionFacility" aria-expanded="false" href="#accordionFacility .item-'+data[i].facility_id+'">'+data[i].facility_name+' - '+data[i].group_name+'</a><span class="collapse-action"><i class="glyphicon glyphicon-plus addButton"></i><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i> <i class="glyphicon glyphicon-screenshot corsairCenterized"></i></span></h4></div><div class="panel-collapse collapse item-'+data[i].facility_id+'" role="tabpanel"></div></div>');
					accordionParent['FacilityParent'+data[i].facility_id] = 0;
					accordionParent['ReservedFacility'+data[i].facility_id] = 0;
					listParent.push(data[i].facility_id);
				}else if(data[i].facility_parent_id != 0){
					$('#accordionFacilityParent'+data[i].facility_parent_id+' .item-'+data[i].facility_parent_id).append('<div class="'+color+' panel-body facility-detail" facility="'+data[i].facility_id+'" name="'+data[i].facility_name+'" group="'+data[i].group_id+'" parent="'+data[i].is_parent+'" from="'+data[i].facility_parent_id+'"><span><a class="'+color+' participantFacilityButton" status="'+status+'">'+data[i].facility_name+' - '+(data[i].participant_name?(data[i].title_name? data[i].title_name+' ':'')+data[i].participant_name:'Available')+'</a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i> <i class="glyphicon glyphicon-screenshot corsairCenterized"></i></span></div>');
					accordionParent['FacilityParent'+data[i].facility_parent_id]++;
					if(data[i].checkin_at!= null || data[i].reserve_at != null){
						accordionParent['ReservedFacility'+data[i].facility_parent_id]++;
					}
				}else{
					$('#accordionFacility').append('<div class="'+color+' panel-body facility-detail accord-facility-no-parent" facility="'+data[i].facility_id+'" name="'+data[i].facility_name+'" group="'+data[i].group_id+'" parent="'+data[i].is_parent+'" from="'+data[i].facility_parent_id+'"><span><a class="'+color+' participantFacilityButton" status="'+status+'">'+data[i].facility_name+' - '+(data[i].participant_name?(data[i].title_name? data[i].title_name+' ':'')+data[i].participant_name:'Available')+'</a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i> <i class="glyphicon glyphicon-screenshot corsairCenterized"></i></span></div>');
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
						data[z].totalCurrentChild = accordionParent['ReservedFacility'+listParent[i]];
						data[z].totalFullChild = accordionParent['FacilityParent'+listParent[i]];
					}
				}
			}

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
				currentParticipant = $(this).closest('div .facility-detail').children().children('.participantFacilityButton').text().split(' - ',2)[1];

				getFacilityType(currentFacilityParent);
				$('#txtAddEditFacilityName').val(currentFacilityName);
				$('#ddlAddEditFacilityGroup').val(currentFacilityGroup);
				if(currentFacilityParent == 1 || currentFacilityFrom == 0){//if parent can edit group
					$('#ddlAddEditFacilityGroup').attr('disabled',false);
				}else{
					$('#ddlAddEditFacilityGroup').attr('disabled',true);
				}

				$('#ddlAddEditFacilityFrom').val(currentFacilityFrom);
				if(currentParticipant != 'Available'){
					$('#ddlAddEditFacilityFrom').attr('disabled', true);
				}else{
					$('#ddlAddEditFacilityFrom').attr('disabled', false);
				}
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
				loadAutoCompleteParticipant();
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

			$(".corsairCenterized").click(function(){ //for centerized
				currentFacilityID = $(this).closest('div .facility-detail').attr('facility');
				currentFacilityParent = $(this).closest('div .facility-detail').attr('parent');
				if(currentFacilityParent == 1){//parent
					var parent_x_Axis;
					var parent_y_Axis;
					for(var i=0;i<data.length;i++){
						if(data[i].facility_id == currentFacilityID || data[i].facility_parent_id == currentFacilityID){
							if(data[i].is_parent == 1){
								parent_x_Axis = data[i].x_axis;
								parent_y_Axis = data[i].y_axis;
								saveCoordinateFacility(currentFacilityID, theCanvas.width/2,theCanvas.height/2);
							}else{
								saveCoordinateFacility(data[i].facility_id, (data[i].x_axis - parent_x_Axis) + (theCanvas.width/2), data[i].y_axis- parent_y_Axis + (theCanvas.height/2));
							}
						}
					}
				}else{
					saveCoordinateFacility(currentFacilityID, theCanvas.width/2,theCanvas.height/2);
				}
				getDetailCanvas();
			});

			canvasApp(data);
			resizeCanvas();
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

			$('#ddlAddEditFacilityType').unbind('change').change(function(){
				if($('#ddlAddEditFacilityType :selected').attr('parent') == 1){ //parent
					$('#ddlAddEditFacilityFrom').closest('div').hide();
					$('#ddlAddEditFacilityFrom').val(0);
					setGroupByParent();
				}else{
					$('#ddlAddEditFacilityFrom').closest('div').show();
					$('#ddlAddEditFacilityGroup').attr('disabled',false);
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
				if(currentFacilityGroup != $('#ddlAddEditFacilityGroup').val()){//if parent change group
					$.ajax({
						type : 'POST',
						url : BASE_URL + 'acara/Denah_acara/deleteParticipantDifferentGroup',
						dataType : 'json',
						async : false,
						data : {
							'facility_parent_id': currentFacilityID
						},
						success : function(data){

						}
					});
				}
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
		data : {
			'group_id': currentFacilityGroup
		},
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
		async : false,
		dataType : 'json',
		data : {
			'facility_parent_id' : currentFacilityFrom,
			'facility_id' : currentFacilityID,
			'participant' : $('#txtParticipant').val().trim(),
			'status' : status
		},
		success : function(data){
			if(data > 0){//the number of seats required
				validationModal('kursi yang dibutuhkan kurang '+data+' kursi lagi');
			}else{
				getDetailCanvas();
				validationModal('sukses merubah peserta');
			}
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

function setGroupByParent(){
	$('#ddlAddEditFacilityGroup').attr('disabled',true);
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getFacilityGroupFromFacility',
		async : false,
		dataType : 'json',
		data : {
			'facility_id' : $('#ddlAddEditFacilityFrom').val()
		},
		success : function(data){
			if(data.length == 1){
				$('#ddlAddEditFacilityGroup').val(data[0].group_id);
				$('#ddlAddEditFacilityGroup').attr('disabled',true);
			}else{
				$('#ddlAddEditFacilityGroup').attr('disabled',false);
			}
		}
	});
}

function loadExcel(){
	var files = event.target.files;
	if (files && files[0]) {
		var reader = new FileReader();
		reader.readAsDataURL(files[0]);
	}

	var dataUpload = new FormData();
    if (typeof files != 'undefined') {
        $.each(files, function (key, value) {
            dataUpload.append(key, value);
        });
    }

    dataUpload.append('currentCanvasID',currentCanvasID);
    dataUpload.append('currentCanvasSlide',currentCanvasSlide);
    dataUpload.append('currentCanvasName',currentCanvasName);

    $.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/loadExcelCanvas/',
		data: dataUpload,
		async : false,
		processData: false,
        contentType: false,
		success : function(data){
			if(data == 'sukses'){
				getDetailCanvas();
				validationModal('Sukses memasukan data dari excel');
			}else{
				validationModal(data);
			}

		}
	});
}

function getTableDetail(facility_id){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'acara/Denah_acara/getTableDetail',
		dataType : 'json',
		async : false,
		data : {
			'facility_parent_id' : facility_id
		},
		success : function(data){
			$("#tableDetail tbody").empty();
			$("#tableName").append(" - " + data[0].group_name);
			for(var i=0;i<data.length;i++){
				$("#tableDetail tbody").append('<tr>'+
													'<td>'+data[i].facility_name+ '</td>'+
													'<td>'+data[i].title_name+' '+(data[i].participant_name=='-'?'':data[i].participant_name)+ '</td>'+
													'<td>'+data[i].verification_time+ '</td>'+
												'</tr>');
			}
		}
	});
}
