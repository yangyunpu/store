<!-- 参数及方法说明 -->

autoPrefixer({
    browsers: ['last 5 versions'],  // 兼容主流浏览器的最新n个版本
    cascade: true,                  // 是否美化属性值,默认:true
    remove: false                   // 是否去掉不必要的前缀,默认:true
})

minifyCss({
    advanced: false,            
    //类型：Boolean 默认：true [是否开启高级优化（合并选择器等）]
    compatibility: 'ie7',      
    //保留ie7及以下兼容写法 类型：String 默认：''or'*' [启用兼容模式； 'ie7'：IE7兼容模式，'ie8'：IE8兼容模式，'*'：IE9+兼容模式]
    keepBreaks: true,          
    //类型：Boolean 默认：false [是否保留换行]
    keepSpecialComments: '*'   
    //保留所有特殊前缀 当你用autoprefixer生成的浏览器前缀，如果不加这个参数，有可能将会删除你的部分前缀
})

gulp-rev  //添加MD5后缀并为它们生成manifest文件

gulp-rev-collector //从manifests中获取静态资源版本数据并替换html中的链接