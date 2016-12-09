/////////////////////
// using fabric js //
/////////////////////

// component state mapping
var __map = {
	0:{},
	1:{}
};

//canvas state mapping
var __canvas = {
	rotation:{
		0 : 0,
		1 : 0
	},
	id:{
		0 : 'cardFront',
		1 : 'cardBack'
	},
	status:{
		0 : 'Tampak Depan',
		1 : 'Tampak Belakang'
	},
	updated:false
};

//curr canvas
var __curr = 0;

//component stack per canvas mapping
var __idx = {
	0 : 0,
	1 : 0
};

$(document).ready(function(){
	$('title').html("D.A.T.E - Kartu Acara");
	//create canvas
	__canvas[0] = new fabric.Canvas(__canvas.id[0],{
		backgroundColor : "white",
		width 		: 800,
		height 		: 480,
		selection 	: false
	});
	__canvas[1] = new fabric.Canvas(__canvas.id[1],{
		backgroundColor : "white",
		width 		: 800,
		height 		: 480,
		selection 	: false
	});
	setInterval(function(){
    refreshCanvas(__curr);
	},16);

	$("#currStat").text(__canvas.status[__curr]+' - '+(__canvas.rotation[__curr] == 0 ? 'Mode Horizontal' : 'Mode Vertikal'));
	$('#'+__canvas.id[1]).parent().addClass('hide');

	initEvents();
	loadDesign();
});

function initInput(e,form){
	if($('option:selected',e).text().trim() == 'QR Code'){
		$('#Img-Upload',form).addClass('hide');
		$('#Text',form).addClass('hide');
		$('#FontFam',form).addClass('hide');
		$('#Color',form).addClass('hide');
	}
	else if($('option:selected',e).text().trim() == 'Gambar' && $('option:selected',e).data().source === null){
		$('#Img-Upload',form).removeClass('hide');
		$('#Text',form).addClass('hide');
		$('#FontFam',form).addClass('hide');
		$('#Color',form).addClass('hide');
	}
	else {
		$('.bfh-selectbox').val('Arial');
		$('#Img-Upload',form).addClass('hide');
		$('#Color',form).removeClass('hide');
		$('#FontFam',form).removeClass('hide');
		if($('option:selected',e).data().dynamic)
		{
			$('#Text',form).addClass('hide');
		}
		else {
			$('#Text',form).removeClass('hide');
		}
	}
}

function initEvents(){
	$('.minicolors-input').minicolors({
		opacity : true,
		theme: 'bootstrap',
		defaultValue : '#000000'
	});
	$('#compType').change(function(e){
		initInput(e.target,$('#addForm'));
	});
	$('#editCompType').change(function(e){
		initInput(e.target,$('#editForm'));
	});
	$('.addGoogle').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').hide();
		$(this).parent().parent().parent().find('.bfh-googlefonts').show();
	});
	$('.addStandard').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').show();
		$(this).parent().parent().parent().find('.bfh-googlefonts').hide();
	});
	$('.editGoogle').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').hide();
		$(this).parent().parent().parent().find('.bfh-googlefonts').show();
	});
	$('.editStandard').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').show();
		$(this).parent().parent().parent().find('.bfh-googlefonts').hide();
	});
	$("#addModal").on('show.bs.modal',function(e){
		$('.addStandard').click();
		$('#addColor').minicolors('value','#000000');
		$('#addColor').minicolors('opacity',1);
		$.ajax({
			url : BASE_URL + 'acara/Kartu_acara/getComponents',
			dataType : 'json',
			success : function(data){

				$('#compType',e.target).empty();
				for(var i = 0 ; i < data.length ; i++)
				{
					var componentName = data[i].component_name;
					if(data[i].component_id == '4') {
						componentName = 'Jumlah Peserta'
					}
					$('#compType',e.target).append('<option value="'+data[i].component_id+'" source="'+data[i].value+'">'+componentName+'</option>');
					$('#compType option:last-child').data({
						source  : data[i].value,
						dynamic : parseInt(data[i].is_dynamic)
					});
				}
				$("#compFile").val('');
				$('#compText',e.target).val('');
				$('#compName',e.target).val('');
				$('#compType',e.target).val($("#compType option:first",e.target).val());

				initInput($('#compType',e.target),$('#addForm'));
			}
		});
	});
	$("#compAdd").click(function(){
		var nama = $("#compName").val();
		var d = new Date();
		var nnama = ('0' + d.getHours()).slice(-2) + ('0' + d.getMinutes()).slice(-2) + ('0' + d.getSeconds()).slice(-2);
		nama = nama === '' ? 'comp_'+ nnama : nama;
		var id = nama.split(' ').join('-');

		var dynamic = $('#compType option:selected').data().dynamic;

		if($('#compType option:selected').text().trim() == 'Gambar'){

			var newData = new FormData();
			newData.append('newImg',$("#compFile").get(0).files[0]);

			$.ajax({
				type: 'POST',
				url : BASE_URL + 'acara/Kartu_acara/uploadImg/'+id,
				contentType : false,
				processData : false,
				cache: false,
				data : newData,
				dataType:'json',
				error: function(e){
					alert('Error Uploading Image.');
				},
				success: function(data){
					if(data.status)
						createObj({
							type 		: $('#compType').val(),
							data 		: data.val,
							nama 		: nama,
							id 			: id,
							img 		: true,
							compTypeName: $('#compType option:selected').text(),
							newObj		: true,
							dynamic		: dynamic
						});
				}
			});
		}
		else if ($('#compType option:selected').text().trim() == 'QR Code') {
			createObj({
				type 		: $('#compType').val(),
				data 		: $('option:selected',$('#compType','#addModal')).data().source,
				nama 		: nama,
				id			: id,
				img 		: true,
				compTypeName: $('#compType option:selected').text(),
				newObj		: true,
				dynamic		: dynamic
			});
		}
		else{
			var data;
			if(dynamic){
				data = $('option:selected',$('#compType','#addModal')).data().source;
			}
			else {
				data = $('#compText').val();
			}

			var fontType;
			var type;
			if($('.addStandard').hasClass('active')){
				type = 's';
				fontType = $('.addFonts').val();
			}
			else{
				type = 'g';
				fontType = $('.addGoogleFonts').val();
				WebFont.load({
		        	google: {
		        		families: [fontType]
		        	}
			  	});
			}
			createObj({
				type 		: $('#compType').val(),
				data 		: type + data,
				nama 		: nama,
				id 			: id,
				img 		: false,
				compTypeName: $('#compType option:selected').text(),
				fontFam		: fontType,
				color 		: $('#addColor').minicolors('value'),
				opacity		: $('#addColor').minicolors('opacity'),
				newObj		: true,
				dynamic		: dynamic
			});
		}
		$("#addModal").modal('hide');
	});

	$("#rotateCard").click(function(){
		rotateCard();
	});

	$("#flipCard").click(function(){
		flipCard();
	});

	$(".upper-canvas").mouseout(function(){
		__canvas[0].deactivateAll();
		__canvas[1].deactivateAll();
		// __canvas[__curr].renderAll(true);
	});

	__canvas[0].on({
		'object:modified':updateControls,
		'object:moving': updateControls,
	    'object:scaling': updateControls,
	    'object:resizing': updateControls,
	    'object:rotating': updateControls,
		'mouse:up' : afterInteract
	});

	__canvas[1].on({
		'object:modified':updateControls,
		'object:moving': updateControls,
	    'object:scaling': updateControls,
	    'object:resizing': updateControls,
	    'object:rotating': updateControls,
		'mouse:up' : afterInteract
	});

  $('#exportButton').click(function(){
    prepareMassPrint();
  });
}

function flipCard(){
	$('#'+__canvas.id[__curr]).parent().addClass('hide');

	var t = __curr;

  if(__curr == 0){
    __curr = 1;
    $('#flipCard').text('Ke Depan');
  }else{
    __curr = 0;
    $('#flipCard').text('Ke Belakang');
  }

	if(__canvas.rotation[__curr] != __canvas.rotation[t])
		rotateCard();

	$("#currStat").text(__canvas.status[__curr]+' - '+(__canvas.rotation[__curr] == 0 ? 'Mode Horizontal' : 'Mode Vertikal'));
	$('#'+__canvas.id[__curr]).parent().removeClass('hide');

	$("#editorTable").empty();

	for (var i = 0; i < Object.keys(__map[__curr]).length ; i++) {
		createControl({
			id			: __map[__curr][i].id,
			nama		: __map[__curr][i].name,
			compTypeName: __map[__curr][i].compname,
			img			: __map[__curr][i].fontType === null ? true : false,
			fontFam		: __map[__curr][i].fontType,
			idx			: i,
		});//__map[__curr][i].name,__map[__curr][i].id,i,__map[__curr][i].type,__map[__curr][i].compname,__map[__curr][i].fontType);
	}
}



// obj related function

function createObj(param,resolve){
	var promise = new Promise(function(resolve,reject){
		if(param.img) {
			createImg(param,resolve);
		}
		else {
			createText(param,resolve);
		}
	}).then(function(obj){
		var curr = param.newObj ? __curr : param.oldState.side;
		var idx = param.newObj ? __idx[curr] : param.oldState.z_index;
		__idx[curr]++;

		__canvas[curr].insertAt(obj,idx);

		__map[curr][idx] =
		{
			id 		: param.id,
			name 	: param.nama,
			type 	: param.type,
			scale 	: obj.getScaleX(),
			x 		: __canvas.rotation[__curr] == 0 ? obj.getTop() : 900 - obj.getLeft(),
			y 		: __canvas.rotation[__curr] == 0 ? obj.getLeft() : obj.getTop(),
			rotation: __canvas.rotation[__curr] == 0 ? obj.getAngle() : obj.getAngle() + 270,
			fontType: null,
			fontSize: null,
			val 	: param.data,
			dbid 	: param.newObj ? null : param.oldState.dbid,
			compname: param.compTypeName,
			color	: null,
			dynamic	: param.dynamic
		};

		if(!param.img){
			fabric.util.clearFabricFontCache(param.font_type);
			__map[curr][idx].fontType = obj.getFontFamily();
			__map[curr][idx].fontSize = obj.getFontSize();
			__map[curr][idx].color = obj.getFill();
			__map[curr][idx].opacity = obj.getOpacity();
		}

		if(curr == __curr)
			createControl({
				nama		: param.nama,
				id			: param.id,
				idx  		: idx,
				compTypeName: param.compTypeName,
				img	 		: param.img
			});

		if(param.newObj != undefined && param.newObj)
		{
			registerObj(idx,curr);
		}

		if(resolve != undefined)
			resolve(parseInt(param.idx)+1);
	});
}

function createImg(param,resolve){
	fabric.Image.fromURL(ASSETS_URL + param.data, function(oImg) {
		oImg.resizeFilters.push(
			new fabric.Image.filters.Resize({
				resizeType : 'sliceHack'
			})
		);
		resolve(oImg);
	},{
		lockUniScaling 	: true,
		originX			: 'center',
		originY			: 'center',
		top				: param.newObj ? __canvas[__curr].getHeight()/2 : param.oldState.top,
		left			: param.newObj ? __canvas[__curr].getWidth()/2 : param.oldState.left,
		angle			: param.newObj ? 0 : parseFloat(__canvas.rotation[param.oldState.side]) + parseFloat(param.oldState.angle),
		scaleX			: param.newObj ? 1 : param.oldState.scale,
		scaleY			: param.newObj ? 1 : param.oldState.scale
	});
}

function createText(param,resolve){
	var text = param.data.substr(1);
	var textObj  = new fabric.Text(text,{
		caching  		: false,
		lockUniScaling	: true,
		originX			: 'center',
		originY			: 'center',
		top				: param.newObj ? __canvas[__curr].getHeight()/2 : param.oldState.top,
		left			: param.newObj ? __canvas[__curr].getWidth()/2 : param.oldState.left,
		scaleX			: param.newObj ? 1 : param.oldState.scale,
		scaleY			: param.newObj ? 1 : param.oldState.scale,
		angle			: param.newObj ? 0 : parseFloat(__canvas.rotation[param.oldState.side]) + parseFloat(param.oldState.angle),
		fontSize		: param.newObj ? 12 : param.oldState.fontSize,
		fontFamily		: param.fontFam,
		fill			: param.color,
		opacity			: param.opacity
	});
	resolve(textObj);
}

function loadDesign(){
	$.ajax({
		type: 'GET',
		url : BASE_URL + 'acara/Kartu_acara/getDesign',
		dataType: 'json',
		error: function(){
			alert("Failed to load data!");
		},
		success: function(data){
			if(data.length > 0)
				loadObj(data,0);
		}
	});
}

function loadObj(data,idx){
	var loadPromise = new Promise(function(resolve, reject) {

		if(data[idx].value.substr(0,1) == 'g'){
			WebFont.load({
				google: {
					families: [data[idx].font_type]
				}
			});
		}

		var id = data[idx].comp_name.split(' ').join('-');
		var param = {
			type 		: data[idx].component_id,
			data 		: data[idx].value,
			nama 		: data[idx].comp_name,
			id 			: id,
			img 		: false,
			compTypeName: data[idx].component_name,
			fontFam		: data[idx].font_type,
			color 		: data[idx].color,
			opacity		: parseFloat(data[idx].opacity),
			newObj		: false,
			oldState	: {
				dbid	: parseInt(data[idx].design_id),
				scale	: parseFloat(data[idx].size),
				top 	: parseFloat(data[idx].x_axis),
				left 	: parseFloat(data[idx].y_axis),
				angle	: parseFloat(data[idx].rotation),
				fontSize: parseFloat(data[idx].font_size),
				side	: parseInt(data[idx].side),
				z_index	: parseInt(data[idx].z_index)
			},
			idx			: parseInt(idx),
			dynamic		: data[idx].is_dynamic == 1 ? true : false
		};

		if(data[idx].component_name.trim() == 'Gambar' || data[idx].component_name.trim() == 'QR Code') {
			param.img = true;
			param.fontFam = null;
			param.color = null;
			param.opacity = null;
			param.oldState.fontSize = null;
		}

		createObj(param,resolve);
	}).then(function(idx){
		if(idx < data.length){
			loadObj(data,idx);
		}
	});
}


function createControl(param){//title,nama,idx,type,compname,fontType){
	var ctrl = '<tr id="control'+ param.id +'">';
	ctrl += '<td class="title">' + param.nama + '</td>';
	if(param.id == '4') {
		ctrl += '<td class="type">Jumlah Peserta</td>';
	} else {
		ctrl += '<td class="type">' + param.compTypeName + '</td>';
	}
	// if(param.img)
	// {
	// 	ctrl += '<td class="font">-</td>';
	// 	ctrl += '<td><input type="number" disabled="true" class="fontSize form-control input-sm"></td>'
	// }
	// else
	// {
	// 	ctrl += '<td class="font">' + param.fontFam + '</td>';
	// 	ctrl += '<td><input type="number" class="fontSize form-control input-sm" min="2"></td>'
	// }
	ctrl += '<td><input type="number" class="rotation form-control input-sm" step="0.5"></td>';
	ctrl += '<td style="text-align:center"><span><i class="back glyphicon glyphicon-chevron-left"></i><span class="zidx"></span><i class="front glyphicon glyphicon-chevron-right"></i></span></td><td><i class="centering glyphicon glyphicon-screenshot"></i><i class="edit glyphicon glyphicon-pencil"></i><i class="remove glyphicon glyphicon-trash"></i></td></tr>';

	$("#editorTable").append(ctrl);

	var td = $("#control"+param.id);
	td.val(param.idx);
	// if(!param.img){
	// 	$(".fontSize",td).val(__map[__curr][param.idx].fontSize).bind('input propertychange',function(){
	// 		$(this).val(parseInt($(this).val()));
	// 		changeFontSize($(this).parent().parent().val(),parseInt($(this).val()));
	// 	});
	// }

	$(".rotation",td).val(__map[__curr][param.idx].rotation).bind('input propertychange',function(){
		var val = parseFloat($(this).val());
		val = (val < 0 ? 360 + val : val) % 360;
		$(this).val(val);
		rotateImg($(this).parent().parent().val(),parseFloat($(this).val()));
	});

	$(".zidx",td).text(' '+param.idx+' ');

	$(".back",td).click(function(){
		changeIdxZ($(this).parent().parent().parent().val(),-1);
	});

	$(".front",td).click(function(){
		changeIdxZ($(this).parent().parent().parent().val(),1);
	});

	$(".centering",td).click(function(){
		centering($(this).parent().parent().val());
	});

	$(".edit",td).click(function(){
		var idx = $(this).parent().parent().val();
		editModal(idx);
	});

	$(".remove",td).click(function(){
		var idx = $(this).parent().parent().val();
		$("#delButton").unbind('click').click(function(){
			deleteComp(idx);
			$("#deleteModal").modal('hide');
		});
		$("#deleteText").text('Anda yakin manghapus komponen '+ __map[__curr][idx].name +' ?');
		$("#deleteModal").modal('show');
	});
}


function editModal(idx){
	$.ajax({
		type: 'GET',
		url : BASE_URL + 'acara/Kartu_acara/getComponents',
		dataType : 'json',
		success : function(data){
			$('#editCompType',"#editModal").empty();
			for(var i = 0 ; i < data.length ; i++)
			{
				var componentName = "";
				if(data[i].component_id == '4') {
					componentName = 'Jumlah Peserta'
				} else {
					componentName = data[i].component_name;
				}
				$('#editCompType',"#editModal").append('<option value="'+data[i].component_id+'" source="'+data[i].value+'">'+componentName+'</option>');
				$('#editCompType option:last-child').data({
					source  : data[i].value,
					dynamic : parseInt(data[i].is_dynamic)
				});
			}
			$('input',"#editModal").val('');

			$('#editCompType').val(__map[__curr][idx].type);

			$("#editCompName").val(__map[__curr][idx].name);

			initInput($('#editCompType',"#editModal"),$('#editForm'));

			$("#editCompFile").val('');

			$('#editColor').minicolors('value',__map[__curr][idx].fontType !== null ? __map[__curr][idx].color : '#000000');
			$('#editColor').minicolors('opacity',__map[__curr][idx].fontType !== null ? __map[__curr][idx].opacity : 1);

			$('#editCompText').val(__map[__curr][idx].fontType !== null ? __map[__curr][idx].val.substr(1) : '');

			if(__map[__curr][idx].fontType != null){
				var type = __map[__curr][idx].val.substr(0,1);
				var fontFam = __map[__curr][idx].fontType;

				if(type == 's'){
					$('.editStandard').click();
					$('.editFonts').val(fontFam);
				}
				else{
					$('.editGoogle').click();
					$('.editGoogleFonts').val(fontFam).children('a').children('.bfh-selectbox-option').text(fontFam);
				}
			}

			$("#compEdit").unbind('click').click(function(){
				editComp(idx);
				$("#editModal").modal('hide');
			});

			$("#editModal").modal('show');
		}
	});
}

function editComp(idx){

	var nama = $("#editCompName").val() == '' ? __map[__curr][idx].name : $("#editCompName").val();
	var id = nama.split(' ').join('-');
	var dynamic = $('#editCompType option:selected').data().dynamic;

	if($('#editCompType option:selected').text().trim() == 'Gambar'){

		var newData = new FormData();
		newData.append('newImg',$("#editCompFile").get(0).files[0]);

		$.ajax({
			type: 'POST',
			url : BASE_URL + 'acara/Kartu_acara/uploadImg/'+id,
			contentType : false,
			processData : false,
			cache: false,
			data : newData,
			dataType:'json',
			error: function(e){
				alert('Error Uploading Image.');
			},
			success: function(data){
				if(data.status)
					changeObj({
						type 		: $('#editCompType').val(),
						data 		: data.val,
						nama 		: nama,
						id 			: id,
						img 		: true,
						compTypeName: $('#editCompType option:selected').text(),
						newObj		: false,
						idx			: idx,
						side		: __curr,
						dynamic		: dynamic,
						oldState	: {
							dbid	: __map[__curr][idx].dbid,
							id 		: __map[__curr][idx].id,
							top		: __map[__curr][idx].x,
							left	: __map[__curr][idx].y,
							scale	: __map[__curr][idx].scale,
							angle	: __map[__curr][idx].rotation,
							side	: __curr
						}
					});
			}
		});
	}
	else if ($('#editCompType option:selected').text().trim() == 'QR Code') {
		changeObj({
			type 		: $('#editCompType').val(),
			data 		: $('option:selected',$('#editCompType','#editModal')).data().source,
			nama 		: nama,
			id			: id,
			img 		: true,
			compTypeName: $('#editCompType option:selected').text(),
			newObj		: false,
			idx			: idx,
			side		: __curr,
			dynamic		: dynamic,
			oldState	: {
				dbid	: __map[__curr][idx].dbid,
				id 		: __map[__curr][idx].id,
				top		: __map[__curr][idx].x,
				left	: __map[__curr][idx].y,
				scale	: __map[__curr][idx].scale,
				angle	: __map[__curr][idx].rotation,
				side	: __curr
			}
		});
	}
	else{
		var data;
		if($('#editCompType option:selected').data().dynamic){
			data = $('option:selected',$('#editCompType','#editModal')).data().source;
		}
		else {
			data = $('#editCompText').val();
		}

		var fontType;
		var type;
		if($('.editStandard').hasClass('active')){
			type = 's';
			fontType = $('.editFonts').val();
		}
		else{
			type = 'g';
			fontType = $('.editGoogleFonts').val();
			WebFont.load({
				google: {
					families: [fontType]
				}
			});
		}
		changeObj({
			type 		: $('#editCompType').val(),
			data 		: type + data,
			nama 		: nama,
			id 			: id,
			img 		: false,
			compTypeName: $('#editCompType option:selected').text(),
			fontFam		: fontType,
			color 		: $('#editColor').minicolors('value'),
			opacity		: $('#editColor').minicolors('opacity'),
			newObj		: false,
			idx			: idx,
			side		: __curr,
			dynamic		: dynamic,
			oldState	: {
				dbid	: __map[__curr][idx].dbid,
				id 		: __map[__curr][idx].id,
				top		: __map[__curr][idx].x,
				left	: __map[__curr][idx].y,
				scale	: __map[__curr][idx].scale,
				angle	: __map[__curr][idx].rotation,
				fontSize: __map[__curr][idx].fontSize,
				color	: __map[__curr][idx].color,
				opacity	: __map[__curr][idx].opacity,
				side	: __curr
			}
		});
	}
}

function changeObj(param){
	var promise = new Promise(function(resolve,reject){
		if(param.img) {
			createImg(param,resolve);
		}
		else {
			createText(param,resolve);
		}
	}).then(function(obj){
		__canvas[param.side].item(param.idx).remove();
		__canvas[param.side].insertAt(obj,param.idx);

		__map[param.side][param.idx] =
		{
			id 		: param.id,
			name 	: param.nama,
			type 	: param.type,
			scale 	: obj.getScaleX(),
			x 		: obj.getTop(),
			y 		: obj.getLeft(),
			rotation: obj.getAngle(),
			fontType: null,
			fontSize: null,
			val 	: param.data,
			dbid 	: param.oldState.dbid,
			compname: param.compTypeName,
			color	: null,
			dynamic	: param.dynamic
		};

		if(!param.img){
			fabric.util.clearFabricFontCache(param.font_type);
			__map[param.side][param.idx].fontType = obj.getFontFamily();
			__map[param.side][param.idx].fontSize = obj.getFontSize();
			__map[param.side][param.idx].color = obj.getFill();
			__map[param.side][param.idx].opacity = obj.getOpacity();
		}

		updateControl({
			idx			: param.idx,
			oldID		: param.oldState.id,
			img			: param.img,
			side		: param.side
		});
		updateState(param.idx);
	});
}

function updateControl(param){
	var td = $("#control"+param.oldID);
	$(".title",td).text(__map[param.side][param.idx].nama);
	$(".type",td).text(__map[param.side][param.idx].compname);

	td.attr('id','control'+__map[param.side][param.idx].id);
}

function deleteComp(idx){

	idx = parseInt(idx);
	deactiveState(idx)
	__canvas[__curr].item(idx).remove();
	$("#control"+__map[__curr][idx].id).remove();

	for (; idx+1 < Object.keys(__map[__curr]).length ; idx++) {
		__map[__curr][idx] = __map[__curr][idx+1];
		var td = $("#control"+__map[__curr][idx+1].id);
		$(".zidx",td).text(' '+idx+' ');
	}
	delete __map[__curr][idx];

	__idx[__curr]--;
}

function changeIdxZ(idx,diff){
	var targetIdx = parseInt(idx) + parseInt(diff);

	if(targetIdx < 0 || targetIdx >= __idx[__curr]){
		return;
	}

	__canvas[__curr].item(idx).moveTo(targetIdx);

	var currCtrl = $("#control"+__map[__curr][idx].id);
	var targetCtrl = $("#control"+__map[__curr][targetIdx].id);

	currCtrl.val(targetIdx);
	targetCtrl.val(idx);

	$(".zidx",currCtrl).text(' '+ targetIdx +' ');
	$(".zidx",targetCtrl).text(' '+ idx +' ');

	var temp = __map[__curr][idx];
	__map[__curr][idx] = __map[__curr][targetIdx];
	__map[__curr][targetIdx] = temp;

	updateState(idx);
	updateState(targetIdx);
}

function rotateImg(idx,rotation){
	__canvas[__curr].item(idx).setAngle(rotation + __canvas.rotation[__curr]);
	__map[__curr][idx].rotation = rotation;
	updateState(idx);
}

function centering(idx){
	__canvas[__curr].fxCenterObjectH(__canvas[__curr].item(idx));
	__canvas[__curr].fxCenterObjectV(__canvas[__curr].item(idx));
	__map[__curr][idx].x = __canvas[__curr].getCenter().top;
	__map[__curr][idx].y = __canvas[__curr].getCenter().left;
	updateState(idx);
}

function rotateCard(){
	var isH = __canvas.rotation[__curr] == 0 ? 1 : 0;
	__canvas.rotation[__curr] = isH ? 270 : 0;
	if(isH){
		$('.card-buffer').addClass('hide');
	}
	else {
		$('.card-buffer').removeClass('hide');
	}
	$("#currStat").text(__canvas.status[__curr]+' - '+(isH ? 'Mode Vertikal' : 'Mode Horizontal'));
	$("#rotateCard").text(isH ? 'Mode Horizontal' : 'Mode Vertikal');

	__canvas[__curr].setDimensions({
		width: __canvas[__curr].getHeight(),
		height: __canvas[__curr].getWidth()
	});

	__canvas[__curr].forEachObject(function(obj,i){
		var l = obj.getLeft();
		l = isH ? 800-l : l;
		var t = obj.getTop();
		t = isH ? t : 800-t;
		var d = obj.getAngle();
		d = parseFloat(d);
		d += isH ? 270.00 : -270.00 ;
		d %= 360;
		obj.setLeft(t);
		obj.setTop(l);
		obj.setAngle(d);
		obj.setCoords();
	});
	__canvas[__curr].renderAll();
	__canvas[__curr].calcOffset();
}

function updateControls(data){
	var obj = data.target;

	var objects = __canvas[__curr].getObjects();

	var i = objects.length - 1;
	for (; i >= 0; i--) {
		if(objects[i] === obj)
		{
			id = __map[__curr][i].id;
			var td = $("#control"+id);
			__map[__curr][i].rotation = parseFloat(obj.getAngle() - __canvas.rotation[__curr]).toFixed(2);
			__map[__curr][i].scale = parseFloat(obj.getScaleX()).toFixed(2);
			if(__canvas.rotation[__curr] === 0)
			{
				__map[__curr][i].x = obj.getTop();
				__map[__curr][i].y = obj.getLeft();
			}
			else {
				__map[__curr][i].x = obj.getLeft();
				__map[__curr][i].y = 800 - obj.getTop();
			}


			$('.rotation',td).val(parseFloat(obj.getAngle() - __canvas.rotation[__curr]).toFixed(2));
			__canvas.updated = true;
			break;
		}
	}
}

function registerObj(idx,side){
	var obj = __map[side][idx];
	var dataToDB = obj.val;
	if(obj.dynamic){
		if(obj.fontType == undefined) {
			dataToDB = null;
		}
		else {
			dataToDB = obj.val.substr(0,1);
		}
	}
	$.ajax({
		type: 'POST',
		url : BASE_URL + 'acara/Kartu_acara/saveObj',
		data: {
			compID : obj.type,
			scale : obj.scale,
			x : obj.x,
			y : obj.y,
			rotation : obj.rotation,
			idx : idx,
			fontType : obj.fontType,
			fontSize : obj.fontSize,
			val : dataToDB,
			name: obj.name,
			side: side,
			color: obj.color,
			opacity : obj.opacity
		},
		error :function(){
			alert('Error : cannot save canvas object state to database');
			// location.reload();
		},
		success: function(id){
			obj.dbid = id;
		}
	});
}

function afterInteract(data){
	if(data.target !== null && __canvas.updated)
	{
		var obj = data.target;
		var objects = __canvas[__curr].getObjects();
		var i = objects.length - 1;
		for (; i >= 0; i--) {
			if(objects[i] === obj)
			{
				updateState(i);
				break;
			}
		}
		__canvas.updated = false;
	}
}

function updateState(idx){
	var obj = __map[__curr][idx];
	var dataToDB = obj.val;
	if(obj.dynamic){
		if(obj.fontType == undefined) {
			dataToDB = null;
		}
		else {
			dataToDB = obj.val.substr(0,1);
		}
	}
	$.ajax({
		type: 'POST',
		url : BASE_URL + 'acara/Kartu_acara/updateObjState',
		data: {
			compID : obj.type,
			scale : obj.scale,
			x : obj.x,
			y : obj.y,
			rotation : obj.rotation,
			idx : idx,
			fontType : obj.fontType,
			fontSize : obj.fontSize,
			val : dataToDB,
			name: obj.name,
			side: __curr,
			dbid : obj.dbid,
			color: obj.color,
			opacity:obj.opacity
		},
		error: function(){
			alert('Error : cannot update canvas object state to database');
			location.reload();
		}
	});
}

function deactiveState(idx){
	var obj = __map[__curr][idx];
	$.ajax({
		type: 'POST',
		url : BASE_URL + 'acara/Kartu_acara/deactiveObjState',
		data: {
			dbid : obj.dbid
		},
		error:function(e){
			alert('Error : cannot remove canvas object from database');
			location.reload();
		},
		success: function(s){
			return true;
		}
	});
}

function prepareMassPrint() {
	if(objSize(__map[0]) > 0 || objSize(__map[1]) > 0){
		// $("#loadingModal").modal('show');
		$.ajax({
		    type: 'POST',
		    url: BASE_URL + 'acara/Kartu_acara/prepareMassPrint',
		    dataType: 'JSON',
		    error:function(e) {
		    	alert('Error : cannot remove canvas object from database');
				location.reload();
		    },
		    success:function(data) {
		    	if(data.length > 0){

					if(__canvas['rotation'][__curr]!= 0){
						$('#rotateCard').click();
						$("#flipCard").click();
						$("#flipCard").click();
					}

		    		mirrorCanvas();

					var jspdf = new jsPDF();

					var pdf = {
						topoffset 	: 2,
						leftoffset 	: 7,
						height 		: 55,
						width 		: 87,
						gutter		: 5,
						pdf 		: jspdf
					};

					massPrint(0,data,pdf,0);
		    	}
		    }
	  	});
	} else {
		alert('Nothing to print');
	}
}

function massPrint(count,data,pdf,idx){
	if(idx < data.length){
		var massPromise = new Promise(function(r,j){
			updateCanvas(data,idx,r)
		}).then(function(){
			if(count%10 == 0 && count > 0){
				pdf.pdf.addPage();
				count = 0;
		    }

			var front = __canvas[0].toDataURL('JPG',1.0);
		    pdf.pdf.addImage(front,'JPG',pdf.leftoffset+((count%2)*(pdf.width+pdf.leftoffset+pdf.gutter)),pdf.topoffset+(Math.floor(count/2)*(pdf.height+pdf.topoffset)),pdf.width,pdf.height);
		    pdf.pdf.rect((pdf.leftoffset+((count%2)*(pdf.width+pdf.leftoffset+pdf.gutter))),(pdf.topoffset+(Math.floor(count/2)*(pdf.height+pdf.topoffset))),pdf.width,pdf.height);
		    count++

		    if(data[idx].is_flip == 1){
		    	// __canvas[1].set('flipY', true);
				var rear = __canvas[1].toDataURL('JPG',1.0);
				pdf.pdf.addImage(rear,'JPG',pdf.leftoffset+((count%2)*(pdf.width+pdf.leftoffset+pdf.gutter)),pdf.topoffset+(Math.floor(count/2)*(pdf.height+pdf.topoffset)),pdf.width,pdf.height);
				pdf.pdf.rect((pdf.leftoffset+((count%2)*(pdf.width+pdf.leftoffset+pdf.gutter))),(pdf.topoffset+(Math.floor(count/2)*(pdf.height+pdf.topoffset))),pdf.width,pdf.height);
		    	count++;
		    }
		    massPrint(count,data,pdf,idx+1);
		});
	}
	else
	{
		finishPrint(pdf.pdf);
	}
}

function updateCanvas(data,idx,r){
	if(idx < data.length){
		var frontPromise = new Promise(function(resolve,reject) {
			updateElm(idx,data,0,resolve,0);
		}).then(function(){
			if(data[idx].is_flip == 1){
				var rearPromise = new Promise(function(resolve,reject){
					updateElm(idx,data,0,resolve,1);
				}).then(function(){
					r();
				});
			}
			else {
            	r();
            }
		});
	}
	else{
		r();
	}
}

function updateElm(idx,data,count,resolve,isRear) {
	if(count < objSize(__map[isRear])){
		var val = __map[isRear][count];
		var promise = new Promise(function(res,rej){
			if(val.dynamic){
				if(val.type == '1'){
					__canvas[isRear].item(count).setSrc("data:image/jpeg;base64,"+data[idx].card_id,function(){
						res();
					});
				}
				else if(val.type == '3'){
					__canvas[isRear].item(count).setText(data[idx].participant_name);
					res();
				}
				else if (val.type == '4') {
					__canvas[isRear].item(count).setText(data[idx].follower);
					res();

				}
				else if (val.type == '5') {
					__canvas[isRear].item(count).setText(data[idx].group_name);
					res();
				}
				else{
                    res();
                }
			}
			else{
				res();
			}
		}).then(function(){
    		refreshCanvas(isRear);
			updateElm(idx,data,count+1,resolve,isRear);
		});
	}
	else{
		resolve();
	}
}

function finishPrint(pdf){
	normalizeCanvas();
	$('#loadingModal').modal('hide');

	pdf.save("cetak_kartu.pdf");
}

function mirrorCanvas(){
	for(var i = 0 ; i < 2 ; i++){
		__canvas[i].forEachObject(function(obj){
			obj.setLeft( 800 - obj.getLeft());
			obj.setAngle( 360 - obj.getAngle() );
			obj.setAngle(obj.getAngle()+180).set('flipY',true);
		});
	}
}

function normalizeCanvas(){
	for(var i = 0 ; i < 2 ; i++){
		$.each(__map[i],function(key,val) {
			if(val.dynamic && val.type != '1'){
				if(val.type == '3'){
					__canvas[i].item(key).setText(val.compname);
				}
				else if (val.type == '4') {
					__canvas[i].item(key).setText(val.compname);
				}
				else if (val.type == '5') {
					__canvas[i].item(key).setText(val.compname);
				}
			}
		});
	}

	for(var i = 0 ; i < 2 ; i++){
		__canvas[i].forEachObject(function(obj){
			obj.setAngle(obj.getAngle()-180).set('flipY',false).set('flipX',false);
		});
	}
}

function refreshCanvas(idx) {
  fabric.util.clearFabricFontCache();
  __canvas[idx].forEachObject(function(obj,i){
    if(__map[idx][i].fontType !== null){
      obj._initDimensions();
    }
  });
  __canvas[idx].renderAll();
  __canvas[idx].renderAll();
}

function objSize(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
