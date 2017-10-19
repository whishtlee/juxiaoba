seajs.config({
	alias: {
		'jquery':'js/jquery.min',
		'uploadfile' : 'js/jquery.uploadfile.min',
		'layer':'js/layer.mobile-v1.7/layer',
		'template':'js/template',
		'city':'js/city-choose',
		'md5':'js/jquery.md5',
		'touch':'js/touch.min',//百度手势库
		'swiper':'js/swiper/js/swiper.min',
		'app':'js/app',
		'user':'js/user',
		'shop':'js/shop',
		'iscroll':'js/iscroll',
		'index':'js/index',
		'share':'js/share'
	},
	debug: true,
	base: '/Public/wap/',
	charset: 'utf-8',
	preload:['jquery']
});