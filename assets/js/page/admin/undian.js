var imgDir = '../assets/img/hadiah/';
var participant;
var allParticipant;
var _currentPrize;
var _prizeIndex = 0;
var pemenang = [];
var _shuffle;
var _lotteryStatus;
var _first;
var old_data = [];

$(document).ready(function(){
    init();
    $('nav').hide();
    $('body').on('click', '.fa-close', function() {
        var key = $(this).parent().data('id');
        participant = $.grep(participant,function(e){
            return e.participant_id != key;
        });
        $(this).parent().parent().remove();

        //update class to fit size
        if($('.lottery-col').length == 1){
            $('.lottery-col').removeClass('col-lg-6 col-md-6 col-sm-6 lottery-col').addClass('col-lg-12 col-md-12 col-sm-12 lottery-col-single');
        }
    });
});

function init(){
    $.ajax({
        type      : 'POST',
        url       : BASE_URL + 'Undian/getAllParticipant',
        dataType  : 'JSON',
        success   : function(data){
            allParticipant = data;
        }
    }).then(function(){
        getPrize(0);
        loadAction();
    });
}

function getPrize(idx){
    _prizeIndex = idx;

    $.ajax({
        type      : 'POST',
        url       : BASE_URL + 'Undian/getPrize',
        dataType  : 'JSON',
        data      : {
            index   : idx
        },
        success   : function(data){
            _currentPrize = data;
            _first = true;
        }
    }).then(function(){
        $.ajax({
            type    : 'POST',
            url     : BASE_URL + 'Undian/getAllRightfulParticipant',
            dataType: 'JSON',
            data    : {
                prize_id: _currentPrize[0].prize_id
            },
            success : function(data){
                participant = data;
                initViewState(_currentPrize);
            }
        });
    });
}

function initViewState(_currentPrize){
    clearInterval(_shuffle);

    if(_prizeIndex > 0){
        $('#prev-prize').css('display','');
    }
    else{
        $('#prev-prize').css('display','none');
    }

    if(_currentPrize[0].nextAvailable){
        $('#next-prize').css('display','');
    }
    else{
        $('#next-prize').css('display','none');
    }

    $('#prev-prize').removeAttr('disabled');
    $('#next-prize').removeAttr('disabled');

    $('.lottery-title').text(_currentPrize[0].prize_descr);

    var imageUrl = imgDir + _currentPrize[0].prize_img;
    $('body').addClass('prize-bg-body');
    $('.prize-bg-body').css('background','url(' + imageUrl + ')');
    $('.prize-bg-body').css('background-repeat','no-repeat');
    $('.prize-bg-body').css('background-size','100%');

    if(_currentPrize[0].decided){
        _lotteryStatus = 2;
        $('#trigger-btn').text('Acak ulang');
        $('#trigger-btn').removeClass('btn-success');
        $('#trigger-btn').removeClass('lottery-start');
        $('#trigger-btn').addClass('lottery-reshuffle');
        $('#trigger-btn').addClass('btn-link');
    }
    else{
        _lotteryStatus = 0;
        $('#trigger-btn').text('START');
        $('#trigger-btn').removeClass('lottery-reshuffle');
        $('#trigger-btn').removeClass('btn-link');
        $('#trigger-btn').removeClass('btn-danger');
        $('#trigger-btn').addClass('btn-success').addClass('lottery-start');
    }

    loadTemplate(_currentPrize);

}

function loadTemplate(data){
    $('.rowC').remove();
    var size, e;

    if(data[0].total_winner == 1){
        $('#rowT').before(e);
        e = $('#rowT').clone().css('display','').removeAttr('id').addClass('rowC');
        $('#container').append(e);
        e.append('<div class="haha0 col-lg-12 col-md-12 col-sm-12 col-xs-12 lottery-col-single"><span class="label label-default winner-candidate">???<i class="fa fa-close pull-right"><i></span></div>');
    }
    else{
        for(var i = 0 ; i < data[0].total_winner ; i++){
            if(i%2 == 0){
                $('#rowT').before(e);
                e = $('#rowT').clone().css('display','').removeAttr('id').addClass('rowC');
                $('#container').append(e);
            }
            e.append('<div class="haha'+i+' col-lg-6 col-md-6 col-sm-6 col-xs-12 lottery-col"><span class="label label-default winner-candidate">???<i class="fa fa-close pull-right"><i></span></div>');
        }
    }

    if(_currentPrize[0].decided){
        _first = false;
        for(var i = 0 ; i < data[0].total_winner ; i++){
            $(".haha"+i).children().html(_currentPrize[0].result[i].participant_name+'<i class="fa fa-close pull-right"><i>');
            $(".haha"+i).children().data('id',_currentPrize[0].result[i].participant_id);
        }
    }

}

function loadAction(){
    $('.lottery-start').click(function(){
        switch (_lotteryStatus) {
            case 1:
                $(this).text('Acak ulang');
                $(this).removeClass('btn-danger');
                $(this).removeClass('lottery-start');
                $(this).addClass('lottery-reshuffle');
                $(this).addClass('btn-link');
                _lotteryStatus = 2;

                stopShuffle();
                break;
            case 2:
                $('#confirmPopup').modal('show');
                break;
            default:
                $(this).text('STOP');
                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
                _lotteryStatus = 1;

                $(".winner-candidate").each(function(i,e){
                    old_data[i] = $(this).data('id');
                });

                _shuffle = setInterval(function(){
                    do {
                        for(var i = 0 ; i < _currentPrize[0].total_winner ; i++ )
                        {
                            pemenang[i] = Math.floor(Math.random()*allParticipant.length);
                        }
                    } while(hasDuplicates(pemenang));

                    for(var i = 0 ; i < _currentPrize[0].total_winner ; i++ ){
                        $(".haha"+i).children().text(allParticipant[pemenang[i]].participant_name);
                        $(".haha"+i).children().data('id',allParticipant[pemenang[i]].participant_id);
                    }
                }, 50);
        }
    });

    $('.reshuffle-btn').click(function(){

        var data = [];

        $(".winner-candidate").each(function(i,e){
            var key = $(this).data('id');
            participant = $.grep(participant,function(e){
                return e.participant_id != key;
            });
        });

        //reshuffle only if rightfull participant is equal or more than win slot
        if( participant.length >= _currentPrize[0].total_winner ){
            $('.lottery-reshuffle').addClass('lottery-start');
            $('.lottery-start').removeClass('lottery-reshuffle');
            // $('.lottery-start').addClass('btn-danger');
            $('.lottery-start').removeClass('btn-link');
            // $('.lottery-start').text('STOP');
            _lotteryStatus = 0;
            _first = false;
            $('.lottery-start').click();
        }
    });

     $('#prev-prize').click(function(){
         getPrize(_prizeIndex-1);
         $(this).attr('disabled','disabled');
     });

     $('#next-prize').click(function(){
         getPrize(_prizeIndex+1);
         $(this).attr('disabled','disabled');
     });
}

function hasDuplicates(array) {
    return (new Set(array)).size !== array.length;
}

function stopShuffle(){
    clearInterval(_shuffle);

    // random for all rightfull participant
    do {
        for(var i = 0 ; i < _currentPrize[0].total_winner ; i++ )
        {
            pemenang[i] = Math.floor(Math.random()*participant.length);
        }
    } while(hasDuplicates(pemenang));

    for(var i = 0 ; i < _currentPrize[0].total_winner ; i++ ){
        $(".haha"+i).children().html(participant[pemenang[i]].participant_name+'<i class="fa fa-close pull-right"><i>');
        $(".haha"+i).children().data('id',participant[pemenang[i]].participant_id);
    }

    // set winners by settings

    if(_currentPrize[0].set && _first){
        for(var i = 0 ; i < _currentPrize[0].winners.length ; i++ ){
            var pos = -1;
            $(".winner-candidate").each(function(idx,e){
                if($(this).data('id') == _currentPrize[0].winners[i].participant_id){
                    pos = idx;
                }
            });
            if(pos == -1){
                $(".haha"+i).children().html(_currentPrize[0].winners[i].participant_name+'<i class="fa fa-close pull-right"><i>');
                $(".haha"+i).children().data('id',_currentPrize[0].winners[i].participant_id);
            }
            else{
                $(".haha"+pos).children().text($(".haha"+i).children().text());
                $(".haha"+pos).children().data('id',$(".haha"+i).children().data('id'));
                $(".haha"+i).children().html(_currentPrize[0].winners[i].participant_name+'<i class="fa fa-close pull-right"><i>');
                $(".haha"+i).children().data('id',_currentPrize[0].winners[i].participant_id);
            }
        }
    }

    var data = [];

    $(".winner-candidate").each(function(i,e){
        data[i] = $(this).data('id');
    });

    $.ajax({
        type    : 'POST',
        url     : BASE_URL + 'Undian/saveWinner',
        dataType: 'json',
        data    : {
           old_participant  : old_data,
           participant  : data,
           prize_id     : _currentPrize[0].prize_id
        },
        success : function(data){

        }
    });
}
