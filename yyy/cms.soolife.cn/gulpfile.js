var gulp=require('gulp'),
    uglifyJs = require('gulp-uglify'),
    concat = require('gulp-concat'),
    connect = require('gulp-connect'),
    sass = require('gulp-ruby-sass'),
    sourcemaps = require('gulp-sourcemaps');
    autoPrefixer = require('gulp-autoprefixer'), // 自动补全css浏览器前缀
    minifyCss = require('gulp-clean-css'),
    clean = require('gulp-clean'),
    rename = require("gulp-rename"),//文件(路径)重命名
    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector');


// 格式化日期
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S")
Date.prototype.Format = function(fmt) {
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
        if(new RegExp("("+ k +")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
};
// 根据当前时间生成版本号(为了跟md5统一处理,生成的版本号为10位)
var version = (new Date()).Format('yyMMddhhmm');
console.log(version);

// 清除js
// gulp.task('cleanJsApp',function(cb){
//     return gulp.src('dist/mobile/js',{read:false})
//                .pipe(clean());
//                cb(err)
// });

// 压缩js
gulp.task('uglifyJApp',function () {
    gulp.src('public/mobile/js/index.js')
    .pipe(uglifyJs())
    .pipe(concat('index.min.js'))
    .pipe(gulp.dest('dist/mobile/js'))
})

gulp.task('uglifyScanApp',function () {
    gulp.src('public/mobile/js/scan.js')
    .pipe(uglifyJs())
    .pipe(concat('scan.min.js'))
    .pipe(gulp.dest('dist/mobile/js'))
})

//编译newScss
gulp.task('sassApp', function (cb) {
    return sass('public/mobile/sass/*.scss', {verbose: true})
        .on('error', sass.logError)
        .pipe(autoPrefixer({
            browsers: ['last 5 versions'],  
            cascade: true,  
            remove: false    
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/mobile/css'))
        cb(err)
});

//清空文件夹，避免资源冗余
gulp.task('cleanCssApp',function(cb){
    return gulp.src('dist/mobile/css',{read:false})
               .pipe(clean());
               cb(err)
});

//压缩css
gulp.task('minCssApp', function (){
    gulp.src('public/mobile/css/index.css')
        .pipe(concat('index.min.css'))
        .pipe(minifyCss({
            advanced: false,
            compatibility: 'ie7',
            keepBreaks: false,
            keepSpecialComments: '*'
        }))
        // .pipe(rev())
        .pipe(gulp.dest('dist/mobile/css'))
        // .pipe(rev.manifest())
        // .pipe(gulp.dest('dist/mobile/rev'))  

});
gulp.task('minScanCssApp', function (){
    gulp.src('public/mobile/css/scan.css')
        .pipe(concat('scan.min.css'))
        .pipe(minifyCss({
            advanced: false,
            compatibility: 'ie7',
            keepBreaks: false,
            keepSpecialComments: '*'
        }))
        // .pipe(rev())
        .pipe(gulp.dest('dist/mobile/css'))
        // .pipe(rev.manifest())
        // .pipe(gulp.dest('dist/mobile/rev'))  

});

// 监听
gulp.task('defaultApp',function(){
	gulp.watch('public/mobile/**/*.*',['sassApp','minCssApp','minScanCssApp','uglifyJApp','uglifyScanApp'])
})





//清空文件夹，避免资源冗余
gulp.task('cleanJsPc',function(cb){
    return gulp.src('dist/pc/js',{read:false})
               .pipe(clean());
               cb(err)
});

// pc
gulp.task('uglifyPc',function () {
    gulp.src('public/pc/js/index.js')
    .pipe(uglifyJs())
    .pipe(concat('index.min.js'))
    .pipe(gulp.dest('dist/pc/js'))
})
// pcTest
gulp.task('uglifyScanPc',function () {
    gulp.src('public/pc/js/scan.js')
    .pipe(uglifyJs())
    .pipe(concat('scan.min.js'))
    .pipe(gulp.dest('dist/pc/js'))
})
//编译newScss
gulp.task('sassPc',function (cb) {
	return sass('public/pc/sass/*.scss', {verbose: true})
		.on('error', sass.logError)
		.pipe(autoPrefixer({
            browsers: ['last 5 versions'], 
            cascade: true,  
            remove: false 
        }))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('public/pc/css'))
		cb(err)
});
//压缩css
gulp.task('minCssPc',function (){
    gulp.src('public/pc/css/index.css')
        .pipe(concat('index.min.css'))
        .pipe(minifyCss({
            advanced: false,
            compatibility: 'ie7',
            keepBreaks: false,
            keepSpecialComments: '*'
        }))
        // .pipe(rev())
        .pipe(gulp.dest('dist/pc/css'))
        // .pipe(rev.manifest())
        // .pipe(gulp.dest('dist/pc/css'))  

});
//压缩css
gulp.task('minCssScanPc',function (){
    gulp.src('public/pc/css/scan.css')
        .pipe(concat('scan.min.css'))
        .pipe(minifyCss({
            advanced: false,
            compatibility: 'ie7',
            keepBreaks: false,
            keepSpecialComments: '*'
        }))
        // .pipe(rev())
        .pipe(gulp.dest('dist/pc/css'))
        // .pipe(rev.manifest())
        // .pipe(gulp.dest('dist/pc/css'))  

});
// 监听
gulp.task('defaultPc',function(){
	gulp.watch('public/pc/**/*.*',['uglifyPc','uglifyScanPc','sassPc','minCssScanPc','minCssPc'])
})














// 定义一个http服务器
gulp.task('serve',function () {
	// 创建一个服务器，默认监听8080端口
	connect.server({
		root:'vtools.soolife.cn',//网页的根目录
		livereload:true //实现文件变化直接刷新网页
	});
	// 文件发生改变
	gulp.watch('vtools.soolife.cn/**/*.*',['reload']);
})
gulp.task('reload',function () {
	// 找到被监视的文件
	gulp.src('vtools.soolife.cn/**/*.*')
    .pipe(connect.reload());
})