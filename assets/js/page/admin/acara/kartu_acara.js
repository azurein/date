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
	//create canvas
	__canvas[0] = new fabric.Canvas(__canvas.id[0],{
		backgroundColor : "white",
		width : 500,
		height : 300
	});
	__canvas[1] = new fabric.Canvas(__canvas.id[1],{
		backgroundColor : "white",
		width : 500,
		height : 300
	});
	setInterval(function(){
		fabric.util.clearFabricFontCache();
		__canvas[__curr].forEachObject(function(obj,i){
			if(__map[__curr][i].type == 6)
				obj._initDimensions();
		});
		__canvas[__curr].renderAll();
		__canvas[__curr].renderAll();
	},16);

	$("#currStat").text(__canvas.status[__curr]+' - '+(__canvas.rotation[__curr] == 0 ? 'Mode Horizontal' : 'Mode Vertikal'));
	$('#'+__canvas.id[1]).parent().addClass('hide');


	// $.ajax({
	// 	url : BASE_URL + 'acara/Kartu_acara/getForm',
	// 	success:function(data){
	// 		$("#Img-Upload").append(data+'<div class="form-group">'
	// 		+'<span class="label label-default">Gambar</span>'
	// 		+'</div><input id="compFile" name="compFile" type="file" class="input-file"></form>');
	// 	}
	// });

	initEvents();
	loadDesign();
});

function initInput(e,form){
	if($('option:selected',e).text() == 'Text')
	{
		$('#Img-Upload',form).addClass('hide');
		$('#Text',form).removeClass('hide');
		$('.bfh-selectbox').val('Arial');
	}
	else if($('option:selected',e).attr('source') == 'null')
	{
		$('#Img-Upload',form).removeClass('hide');
		$('#Text',form).addClass('hide');
	}
	else
	{
		$('#Img-Upload',form).addClass('hide');
		$('#Text',form).addClass('hide');
	}
}

function initEvents(){

	$('#compType').change(function(e){
		initInput(e.target,$('#addForm'));
	});
	$('#editCompType').change(function(e){
		initInput(e.target,$('#editForm'));
	});
	$('.editGoogle').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').hide();
		$(this).parent().parent().parent().find('.bfh-googlefonts').show();
	});
	$('.editStandard').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').show();
		$(this).parent().parent().parent().find('.bfh-googlefonts').hide();
	});
	$('.addGoogle').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').hide();
		$(this).parent().parent().parent().find('.bfh-googlefonts').show();
	});
	$('.addStandard').click(function(){
		$(this).parent().parent().parent().find('.bfh-fonts').show();
		$(this).parent().parent().parent().find('.bfh-googlefonts').hide();
	});
	$("#addButton").click(function(e){
		$("#addModal").modal("show");
		$('.addStandard').click();
		$.ajax({
			url : BASE_URL + 'acara/Kartu_acara/getComponents',
			dataType : 'json',
			success : function(data){
				$('#compType').empty();
				for(var i = 0 ; i < data.length ; i++)
				{
					$('#compType').append('<option value="'+data[i].component_id+'" source="'+data[i].default_img+'">'+data[i].component_name+'</option>');
				}
				$("#compFile").val('');
				$('#compText').val('');
				$('#compName').val('');
				$('#compType').val($("#compType option:first").val());

				initInput($('#compType'),$('#addForm'));
			}
		});
	});
	$("#compAdd").click(function(){
		var nama = $("#compName").val();
		var d = new Date();
		var nnama = ('0' + d.getHours()).slice(-2) + ('0' + d.getMinutes()).slice(-2) + ('0' + d.getSeconds()).slice(-2);
		nama = nama === '' ? 'comp_'+ nnama : nama;
		if($('#compType').val() == 6)
		{
			var fontType;
			if($('.addStandard').hasClass('active')){
				fontType = $('.addFonts').val();
			}else {
				fontType = $('.addGoogleFonts').val();
				WebFont.load({
		        	google: {
		        		families: [fontType]
		        	}
			  	});
			}
			createObj($('#compType').val(),$('#compText').val(),nama,3,$('#compType option:selected').text(),fontType);
		}
		else if($('option:selected',$('#compType','#addModal')).attr('source') == 'null')
		{
			createObj($('#compType').val(),$("#compFile").get(0).files[0],nama,2,$('#compType option:selected').text());
		}
		else
		{
			createObj($('#compType').val(),$('option:selected',$('#compType','#addModal')).attr('source'),nama,1,$('#compType option:selected').text());
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
}

function flipCard(){
	$('#'+__canvas.id[__curr]).parent().addClass('hide');

	var t = __curr;
	__curr = __curr == 0 ? 1 : 0;

	if(__canvas.rotation[__curr] != __canvas.rotation[t])
		rotateCard();

	$("#currStat").text(__canvas.status[__curr]+' - '+(__canvas.rotation[__curr] == 0 ? 'Mode Horizontal' : 'Mode Vertikal'));
	$('#'+__canvas.id[__curr]).parent().removeClass('hide');

	$("#editorTable").empty();

	for (var i = 0; i < Object.keys(__map[__curr]).length ; i++) {
		createControl(__map[__curr][i].name,__map[__curr][i].id,i,__map[__curr][i].type,__map[__curr][i].compname,__map[__curr][i].fontType);
	}
}

function loadDesign(){
	$.ajax({
		type: 'GET',
		url : BASE_URL + 'acara/Kartu_acara/getDesign',
		dataType: 'json',
		error: function(e){
			console.log(e.responseText);
			//try again
			loadDesign();
		},
		success: function(data){
			if(data.length > 0)
				loadObj(data,0);
		}
	});
}

function loadObj(data,i){
	if(data[i].component_id == 6){
		loadText(data[i]);
		if(i+1 < data.length)
			loadObj(data,i+1);
	}else{
		loadImg(data,data[i],i);
	}
}

function loadText(data){
	WebFont.load({
		google: {
			families: [data.font_type]
		}
	});
	var nama = data.comp_name;
	id = nama.split(' ').join('-');
	var textObj = new fabric.Text(data.value,{
		caching  : false
	});

	textObj.lockUniScaling = true;
	textObj.setOriginX('center');
	textObj.setOriginY('center');
	textObj.scale(data.size);
	textObj.setFontFamily(data.font_type);
	textObj.setAngle(data.rotation + __canvas.rotation[data.side]);
	fabric.util.clearFabricFontCache(data.font_type);
	textObj.setFontSize(data.font_size);
	textObj.setTop(data.x_axis);
	textObj.setLeft(data.y_axis);

	__canvas[data.side].insertAt(textObj,data.z_index);

	// setTimeout(function(){
	// 	__canvas[data.side].setTop(data.x_axis);
	// 	__canvas[data.side].setLeft(data.y_axis);
	// },50);

	__map[data.side][data.z_index] =
	{
		id : id,
		name : nama,
		type : data.component_id,
		scale : data.size,
		x : data.x_axis,
		y : data.x_axis,
		rotation : data.rotation,
		fontType : data.font_type,
		fontSize : data.font_size,
		val : data.value,
		dbid : data.design_id,
		compname : data.component_name
	};
	if(__curr == data.side)
		createControl(nama,id,data.z_index,data.component_id,data.component_name,data.font_type);
	__idx[data.side]++;
}

function loadImg(allData,data,idx){
	var name = data.comp_name;
	var id = name.split(' ').join('-');
	fabric.Image.fromURL(data.value, function(oImg) {
		oImg.lockUniScaling = true;

		oImg.resizeFilters.push(
			new fabric.Image.filters.Resize({
				resizeType : 'sliceHack'
			})
		);

		oImg.setOriginX('center');
		oImg.setOriginY('center');
		oImg.setTop(data.x_axis);
		oImg.setLeft(data.y_axis);
		oImg.setAngle(data.rotation + __canvas.rotation[data.side]);
		oImg.scale(data.size);
		__canvas[data.side].insertAt(oImg,data.z_index);

		__map[data.side][data.z_index] =
		{
			id : id,
			name : data.comp_name,
			type : data.component_id,
			scale : oImg.getScaleX(),
			x : oImg.getTop(),
			y : oImg.getLeft(),
			rotation : oImg.getAngle(),
			fontType : null,
			fontSize : null,
			val : data.value,
			dbid : data.design_id,
			compname : data.component_name
		};
		if(__curr == data.side)
			createControl(data.comp_name,id,data.z_index,data.component_id,data.component_name);
		__idx[data.side]++;
		if(idx+1 < allData.length)
			loadObj(allData,idx+1);
	});
}

function createObj(type,data,nama,objtype,compType,fontType){
	if(objtype == '1')
	{
		data = ASSETS_URL + data;
		createImg(data,nama,type,compType);
	}
	else if(objtype == '2')
	{
		var newData = new FormData();
		newData.append('newImg',data);
		var name = nama.split(' ').join('-');
		$.ajax({
			type: 'POST',
			url : BASE_URL + 'acara/Kartu_acara/uploadImg/'+name,
			contentType : false,
			processData : false,
			cache: false,
			data : newData,
			dataType:'json',
			success: function(data){
				if(data.status)
					createImg(data.val,nama,type,compType);
			}
		});
	}
	else
	{
		createText(data,nama,type,compType,fontType);
	}
}

function createImg(src,nama,type,compname){
	var title = nama;
	nama = nama.split(' ').join('-');
	fabric.Image.fromURL(src, function(oImg) {
		oImg.lockUniScaling = true;

		oImg.resizeFilters.push(
			new fabric.Image.filters.Resize({
				resizeType : 'sliceHack'
			})
		);

		oImg.setOriginX('center');
		oImg.setOriginY('center');
		oImg.setTop(__canvas[__curr].getHeight()/2);
		oImg.setLeft(__canvas[__curr].getWidth()/2);
		oImg.setAngle(__canvas.rotation[__curr]);

		__canvas[__curr].insertAt(oImg,__idx[__curr]);

		var idx = __idx[__curr];

		__map[__curr][idx] =
		{
			id : nama,
			name : title,
			type : type,
			scale : oImg.getScaleX(),
			x : oImg.getTop(),
			y : oImg.getLeft(),
			rotation : oImg.getAngle(),
			fontType : null,
			fontSize : null,
			val : src,
			dbid : null,
			compname : compname
		};
		createControl(title,nama,__idx[__curr],type,compname);
		__idx[__curr]++;
		registerObj(idx,__curr);
	});
}

function createText(text,nama,type,fontType,compname){
	var title = nama;
	nama = nama.split(' ').join('-');
	var textObj = new fabric.Text(text,{
		caching  : false
	});

	textObj.lockUniScaling = true;
	textObj.setOriginX('center');
	textObj.setOriginY('center');
	textObj.setTop(__canvas[__curr].getHeight()/2);
	textObj.setLeft(__canvas[__curr].getWidth()/2);
	textObj.setFontSize(12);
	textObj.setFontFamily(fontType);
	textObj.setAngle(__canvas.rotation[__curr]);

	__canvas[__curr].insertAt(textObj,__idx[__curr]);

	var idx = __idx[__curr];

	__map[__curr][idx] =
	{
		id : nama,
		name : title,
		type : type,
		scale : textObj.getScaleX(),
		x : textObj.getTop(),
		y : textObj.getLeft(),
		rotation : textObj.getAngle(),
		fontType : textObj.getFontFamily(),
		fontSize : textObj.getFontSize(),
		val : text,
		dbid : null,
		compname : compname
	};

	createControl(title,nama,__idx[__curr],type,compname,fontType);
	__idx[__curr]++;
	registerObj(idx,__curr);
}

function createControl(title,nama,idx,type,compname,fontType){
	var ctrl = '<tr id="control'+ nama +'">';
	ctrl += '<td class="title">' + title + '</td>';
	ctrl += '<td class="type">' + compname + '</td>';
	if(type != 6)
	{
		ctrl += '<td class="font">-</td>';
		ctrl += '<td><input type="number" disabled="true" class="fontSize form-control input-sm"></td>'
	}
	else
	{
		ctrl += '<td class="font">' + fontType + '</td>';
		ctrl += '<td><input type="number" class="fontSize form-control input-sm" min="2"></td>'
	}
	ctrl += '<td><input type="number" class="rotation form-control input-sm" step="0.5"></td>';
	ctrl += '<td><span><i class="back glyphicon glyphicon-chevron-left"></i><span class="zidx"></span><i class="front glyphicon glyphicon-chevron-right"></i></span></td><td><i class="centering glyphicon glyphicon-screenshot"></i><i class="edit glyphicon glyphicon-pencil"></i><i class="remove glyphicon glyphicon-trash"></i></td></tr>';

	$("#editorTable").append(ctrl);

	var td = $("#control"+nama);
	td.val(idx);

	if(type == 6){
		$(".fontSize",td).val(__map[__curr][idx].fontSize).bind('input propertychange',function(){
			$(this).val(parseInt($(this).val()));
			changeFontSize($(this).parent().parent().val(),parseInt($(this).val()));
		});
	}

	$(".rotation",td).val(__map[__curr][idx].rotation).bind('input propertychange',function(){
		var val = parseFloat($(this).val());
		val = (val < 0 ? 360 + val : val) % 360;
		$(this).val(val);
		rotateImg($(this).parent().parent().val(),parseFloat($(this).val()));
	});

	$(".zidx",td).text(' '+idx+' ');

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
		$("#deleteText").text('Anda yakin manghapus komponen '+ __map[__curr][idx].name +' ?')
		$("#deleteModal").modal('show');
	});
}

function editModal(idx){
	$.ajax({
		url : BASE_URL + 'acara/Kartu_acara/getComponents',
		dataType : 'json',
		success : function(data){
			$('#editCompType',"#editModal").empty();
			for(var i = 0 ; i < data.length ; i++)
			{
				$('#editCompType',"#editModal").append('<option value="'+data[i].component_id+'" source="'+data[i].default_img+'">'+data[i].component_name+'</option>');
			}
			$('input',"#editModal").val('');
			$('#editCompType').val(__map[__curr][idx].type);
			$('.editStandard').click();
			$("#editCompName").val(__map[__curr][idx].name);
			initInput($('#editCompType',"#editModal"),$('#editForm'));
			$("#editCompFile").val('');
			$('#editCompText').val(__map[__curr][idx].fontType !== null ? __map[__curr][idx].val : '');
			$("#compEdit").unbind('click').click(function(){
				editComp(idx);
				$("#editModal").modal('hide');
			});
			$("#editModal").modal('show');
		}
	});
}

function editComp(idx){
	if($("#editCompName").val() == '')
		$("#editCompName").val(__map[__curr][idx].name);
	var nama = $("#editCompName").val();
	if($('#editCompType').val() == 6)
	{
		var fontType;
		if($('.editStandard').hasClass('active')){
			fontType = $('.editFonts').val();
		}else {
			fontType = $('.editGoogleFonts').val();
			WebFont.load({
	        	google: {
	        		families: [fontType]
	        	}
		  	});
		}
		changeObj($("#editCompType").val(),$('#editCompText').val(),nama,3,idx,$('#editCompType option:selected').text(),fontType);
	}
	else if($('option:selected',$('#editCompType','#editModal')).attr('source') == 'null')
	{
		changeObj($("#editCompType").val(),$("#editCompFile").get(0).files[0],nama,2,idx,$('#editCompType option:selected').text());
	}
	else
	{
		changeObj($("#editCompType").val(),$('option:selected',$('#editCompType','#editModal')).attr('source'),nama,1,idx,$('#editCompType option:selected').text());
	}
}

function changeObj(type,data,nama,objtype,idx,compType,fontType){
	if(objtype == '1')
	{
		data = ASSETS_URL + data;
		changeImg(data,nama,type,idx,compType);
	}
	else if(objtype == '2')
	{
		var newData = new FormData();
		newData.append('newImg',data);
		var name = nama.split(' ').join('-');
		$.ajax({
			type: 'POST',
			url : BASE_URL + 'acara/Kartu_acara/uploadImg/'+name,
			contentType : false,
			processData : false,
			cache: false,
			data : newData,
			dataType:'json',
			success: function(data){
				if(data.status)
					changeImg(data.val,nama,type,idx,compType);
			}
		});
	}
	else
	{
		changeText(data,nama,type,fontType,idx,compType);
	}
}

function changeImg(src,nama,type,idx,compType){
	var title = nama;
	nama = nama.split(' ').join('-');
	fabric.Image.fromURL(src, function(oImg) {
		oImg.lockUniScaling = true;

		oImg.resizeFilters.push(
			new fabric.Image.filters.Resize({
				resizeType : 'sliceHack'
			})
		);

		oImg.setOriginX('center');
		oImg.setOriginY('center');

		if(__canvas.rotation[__curr] === 0)
		{
			oImg.setTop(__map[__curr][idx].x);
			oImg.setLeft(__map[__curr][idx].y);
		}
		else {
			oImg.setTop(__map[__curr][idx].y);
			oImg.setLeft(300-__map[__curr][idx].x);
		}


		oImg.setAngle(__map[__curr][idx].rotation + __canvas.rotation[__curr]);
		oImg.scale(__map[__curr][idx].scale);

		__canvas[__curr].item(idx).remove();
		__canvas[__curr].insertAt(oImg,idx);

		idLama = __map[__curr][idx].id;
		__map[__curr][idx].id = nama;
		__map[__curr][idx].name = title;
		__map[__curr][idx].type = type;
		__map[__curr][idx].fontType = null;
		__map[__curr][idx].fontSize = null;
		__map[__curr][idx].val = src;
		__map[__curr][idx].compname = compType;

		updateControl(idLama,title,idx,type,compType);
		updateState(idx);
	});
}

function changeText(text,nama,type,fontType,idx,compType){
	var title = nama;
	nama = nama.split(' ').join('-');
	var textObj = new fabric.Text(text,{
		caching  : false
	});

	textObj.lockUniScaling = true;
	textObj.setOriginX('center');
	textObj.setOriginY('center');
	if(__canvas.rotation[__curr] === 0)
	{
		textObj.setTop(__map[__curr][idx].x);
		textObj.setLeft(__map[__curr][idx].y);
	}
	else {
		textObj.setLeft(__map[__curr][idx].y);
		textObj.setTop(300-__map[__curr][idx].x);
	}


	textObj.setFontFamily(fontType);
	fabric.util.clearFabricFontCache(__map[__curr][idx].fontType);
	textObj.setFontSize(__map[__curr][idx].fontSize === null ? 12 : __map[__curr][idx].fontSize);
	textObj.setAngle(__map[__curr][idx].rotation + __canvas.rotation[__curr]);
	textObj.scale(__map[__curr][idx].scale)

	__canvas[__curr].item(idx).remove();
	__canvas[__curr].insertAt(textObj,idx);

	idLama = __map[__curr][idx].id;
	__map[__curr][idx].id = nama;
	__map[__curr][idx].name = title;
	__map[__curr][idx].type = type;
	__map[__curr][idx].fontType = fontType;
	__map[__curr][idx].fontSize = __map[__curr][idx].fontSize === null ? 12 : __map[__curr][idx].fontSize;
	__map[__curr][idx].val = text;
	__map[__curr][idx].compname = compType;

	updateControl(idLama,title,idx,type,compType,fontType);
	updateState(idx);
}

function updateControl(idLama,title,idx,type,compname,fontType){
	var td = $("#control"+idLama);
	$(".title",td).text(title);
	$(".type",td).text(compname);
	if(type != 6)
	{
		$('.font',td).text('-');
		$('.fontSize',td).prop('disabled',true);
	}
	else
	{
		$('.font',td).text(fontType);
		$('.fontSize',td).prop('disabled',false);
	}
	if(type == 6){
		$(".fontSize",td).val(__map[__curr][idx].fontSize).bind('input propertychange',function(){
			$(this).val(parseInt($(this).val()));
				changeFontSize($(this).parent().parent().val(),parseInt($(this).val()));
		});
	}else{
		$(".fontSize",td).val('').unbind();
	}
	td.attr('id','control'+__map[__curr][idx].id);
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

function changeFontSize(idx,fontSize){
	fabric.util.clearFabricFontCache(__map[__curr][idx].fontType);
	__canvas[__curr].item(idx).setFontSize(fontSize);
	__map[__curr][idx].fontSize = fontSize;
	updateState(idx);
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
	__canvas.rotation[__curr] = isH ? 90 : 0;
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
		l = isH ? l : 300-l;
		var t = obj.getTop();
		t = isH ? 300-t : t;
		var d = obj.getAngle();
		d = parseFloat(d);
		d += isH ? 90.00 : -90.00 ;
		d %= 360;
		obj.setLeft(t);
		obj.setTop(l);
		obj.setAngle(d);
		obj.setCoords();
	});
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
				__map[__curr][i].x = 300 - obj.getLeft();
				__map[__curr][i].y = obj.getTop();
			}


			$('.rotation',td).val(parseFloat(obj.getAngle() - __canvas.rotation[__curr]).toFixed(2));
			__canvas.updated = true;
			break;
		}
	}
}

function registerObj(idx,side){
	var obj = __map[side][idx];
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
			val : obj.val,
			name: obj.name,
			side: side
		},
		error: function(e){
			console.log(e.responseText);
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
			val : obj.val,
			name: obj.name,
			side: __curr,
			dbid : obj.dbid
		},
		error:function(e){
			console.log(e.responseText);
		},
		success: function(s){
			console.log(s);
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
			return 0;
		},
		success: function(s){
			return true;
		}
	});
}
