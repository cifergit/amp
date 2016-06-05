
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global'
    }
});

requirejs(['jquery','global'], function ($,global) {
    global.init();

    $('.intro-choose-list').on('click','.intro-choose-item',function(){
    	var index = $(this).index();
    	$(this).addClass('active').siblings().removeClass('active');
    	if($('.js-intro-item[data-index="'+index+'"]').length > 0){
    		$('.js-intro-item[data-index="'+index+'"]').show().siblings('.js-intro-item').hide();
    		return false;
    	}
    	var params = {
    		news_id : $(this).attr('data-tid')
    	}

    	var htmlArr = [];
    	$.post('/news/company_detail',params,function(backData){
			htmlArr.push('<div class="intro-list first js-intro-item active" data-index="'+index+'">');
			htmlArr.push('	<h3 class="intro-title">'+backData.msg.company.title+'</h3>');
			htmlArr.push('	<p>'+backData.msg.company.brief+'</p>');
			htmlArr.push('  <div>'+backData.msg.company.content+'</div>')
			htmlArr.push('</div>');
	    	$(".js-intro-list").find('.js-intro-item').removeClass('active');
	    	$(".js-intro-list").append(htmlArr.join(''));
    	},'json');
    });
});