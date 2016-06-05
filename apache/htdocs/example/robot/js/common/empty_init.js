/**
 * @desc
 * @author cifer
 * @date 2016/5/25
 */
/**
 * Created by cifer on 2016/05/03.
 */
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


requirejs(['jquery','global',], function ($,global) {
    global.init();
});