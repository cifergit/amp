/**
 * @desc 产品详情
 * @author cifer
 * @date 2016-05-09
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global',
        mod_product: 'robot/js/product/mod_product'
    }
});

requirejs(['jquery','global','mod_product'], function ($,global,mod_product) {
    global.init();
    mod_product.init();
    init();
    function init(){
        $('#applyPriceBtn').on('click',function(){
            $('.js_cover').removeClass('hide');
            $('.js_apply_price_wrap').removeClass('hide');
        });
        $('.js_icon_delete').on('click',function(){
            $('.js_cover').addClass('hide');
            $('.js_apply_price_wrap').addClass('hide');
        });

        //选择规格
        $('.option').on('click',function(){
            if(!$(this).hasClass('option_selected')){
                $(this).addClass('option_selected');
            }
            else {
                $(this).removeClass('option_selected');
            }

        });

        //选择小图，展示大图
        $('.pic_list .img').on('click',function(){
            var thisSrc = $(this).attr('src');
            if(thisSrc){
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.current_pic .img').attr('src',thisSrc);

            }
        });

        $('#inquiryPriceBtn').on('click',function(){
            turnToNewPage('inquiry_new');
        });

        $('#sellOnCreditBtn').on('click',function(){
            turnToNewPage('sell_on_credit_new');
        });

        $('#installmentBtn').on('click',function(){
            turnToNewPage('installment_new');
        });

        $('#leaseBtn').on('click',function(){
            turnToNewPage('lease_new');
        });

        function turnToNewPage(str){//inquiry,lease,sale,amortized
            var specStr = getSpecString();
            var specNameStr = getSpecNameString();
            var thisUrl = '';
            var productId = pageMess.productId;
            thisUrl = baseUrl + 'product/' + str + '/' + productId;
            if(specStr){
                thisUrl = thisUrl + '?attr_ids=' + specStr;
                if(specNameStr){
                    thisUrl = thisUrl + '&attr_names=' + encodeURIComponent(specNameStr);
                }
            }
            else {
                if(specNameStr){
                    thisUrl = thisUrl + '?attr_names=' + encodeURIComponent(specNameStr);
                }
            }
            location.href = thisUrl;
        }

    }

    function getSpecString() {
        var specStr = '';
        $('.sku_spec').each(function(){
            var attrItemId = $(this).data('attr_item_id');
            if(attrItemId){
                var selectIdFlag = false;
                var selectIds = [];
                $(this).find('.option_selected').each(function(){
                    if($(this).data('attr_id')){
                        selectIds.push($(this).data('attr_id'));
                        selectIdFlag = true;
                    }
                });
                if(selectIdFlag){
                    if(specStr){
                        specStr = specStr + '|' +attrItemId + ':' + selectIds.join(',');
                    }
                    else {
                        specStr = attrItemId + ':' + selectIds.join(',');
                    }
                }
            }
        });
        return specStr;
    }

    function getSpecNameString() {
        var specNameStr = '';
        $('.sku_spec').each(function(){
            var specTypeName = $(this).find('.js_spec_type_name').text();
            if(specTypeName){
                var selectNameFlag = false;
                var selectNameArr = [];
                $(this).find('.option_selected').each(function(){
                    if($(this).text()){
                        selectNameArr.push($(this).text());
                        selectNameFlag = true;
                    }
                });
                if(selectNameFlag){
                    if(specNameStr){
                        specNameStr = specNameStr + '|' +specTypeName + ':' + selectNameArr.join(',');
                    }
                    else {
                        specNameStr = specTypeName + ':' + selectNameArr.join(',');
                    }
                }
            }
        });
        return specNameStr;
    }
});

