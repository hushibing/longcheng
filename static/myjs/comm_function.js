/**
 * Created by Bing on 2015-01-31.
 */

/**
 *
 */
function checkbrowser(){
    var sUserAgent = navigator.userAgent;
    var sUsername = navigator.appName;
    //parseFloat 运行时逐个读取字符串中的字符，当他发现第一个非数字符是就停止
    var fAppVersion = parseFloat(navigator.appVersion);
    var browser = new Array();
    var isOpera = sUserAgent.indexOf("Opera") > -1 ;
    if(isOpera){
        //首先检测Opera是否进行了伪装
        var version;
        if(navigator.appName == 'Opera'){
            version = fAppVersion;//如果没有进行伪装，则直接后去版本号
        }else{
            var reOperaVersion = /Opera (\d+\.\d+)/;
            reOperaVersion.exec(sUserAgent);//使用正则表达式的test方法测试并将版本号保存在RegExp.$1中
            version = parseFloat(RegExp.$1);
        }
        browser[0] = "Opera";
        browser[1] = version;
    }

    // IE
    var isIE = sUserAgent.indexOf("compatible") > -1 && sUserAgent.indexOf("MSIE") > -1 && !isOpera; //!isOpera 避免是由Opera伪装成的IE
    if(isIE){
        var reIE = /MSIE (\d+\.\d+);/;
        reIE.exec(sUserAgent);
        var version = parseFloat(RegExp.$1);
        browser[0] = "Internet Explorer";
        browser[1] = version;
    }

    //Chrome
    var isChrome = sUserAgent.indexOf("Chrome") > -1 ;
    if(isChrome){
        var reChorme = /Chrome\/(\d+\.\d+)/;
        reChorme.exec(sUserAgent);
        var version = parseFloat(RegExp.$1);
        browser[0] = "Chrome";
        browser[1] = version;
    }

    //Safari
    //排除Chrome信息，因为在Chrome的user-agent字符串中会出现Konqueror/Safari的关键字
    var isKHTML = (sUserAgent.indexOf("KHTML") > -1
        || sUserAgent.indexOf("Konqueror") > -1
        || sUserAgent.indexOf("AppleWebKit") > -1) && !isChrome ;
    if(isKHTML){//判断是否基于KHTML，如果时的话在继续判断属于何种KHTML浏览器
        var isSafari1 = sUserAgent.indexOf("AppleWebKit") > -1;
        var isKonq = sUserAgent.indexOf("Konqueror") > -1;
        var version='';
        if(isSafari1){
            var reAppleWebKit = /AppleWebKit\/(\d+\.\d+)/;
            reAppleWebKit.exec(sUserAgent);
            version = parseFloat(RegExp.$1);
        }else if(isKonq){
            var reKong = /Konqueror\/(\d+\.\d+)/;
            reKong.exec(sUserAgent);
            version = parseFloat(RegExp.$1);
        }
        browser[0] = "Safari";
        browser[1] = version;
    }

    //firefox
    var isMoz = sUserAgent.indexOf("Gecko") > -1 && !isChrome &&!isKHTML; //排除Chrome 及Konqueror/Safari的伪装

    if(isMoz){
        var reMoz = /rv:(\d+\.\d+)/;
        reMoz.exec(sUserAgent);
        var version = parseFloat(RegExp.$1);
        browser[0] = "Firefox";
        browser[1] = version;
    }
    browsertype = browser[0];
    console.info(browser);
    alert(browser[0] + '' + browser[1]);
    //检测结果
    //$('#browser').html(browser[0]+' '+browser[1]);
    var alert_text = '';
    switch(browser[0]){
        case 'Internet Explorer':
            if(browser[1]<=4){
                alert('IE浏览器需要IE10+ ！');
            }
            break;
        case 'Chrome':
            if(browser[1]>=8){
                //imgname = 'good.png';
            }
            break;
        case 'Safari':
            if(browser[1]>=2){
                //imgname = 'good.png';
            }
            break;
        case 'Firefox':
            if(browser[1]>=2){
                //imgname = 'good.png';
            }
            break;
    }
    //var imgurl = '../../../images/'+imgname;
    //$('#browser_img').attr('src',imgurl);
}



/**
 * 格式化数据金额输出
 * @param s numbers 数字
 * @param n int    保留位数
 * @returns {string}
 */
function fmoney(s, n) {
    if(s==0) return '';
    n = n > 0 && n <= 20 ? n : 2;
    s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
    var l = s.split(".")[0].split("").reverse(),
        r = s.split(".")[1];
    t = "";
    for (i = 0; i < l.length; i++) {
        t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
    }
    return t.split("").reverse().join("") + "." + r;
}


/**
 * 对Date的扩展，将 Date 转化为指定格式的String
 * 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
 * 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
 *  例子：
 *  (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
 *  (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18
 * @param fmt
 * @returns {*}
 * @constructor
 */
Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1,//月分
        "d+": this.getDate(),   //日
        "h+": this.getHours(),  //小时
        "m+": this.getMinutes(),//分
        "s+": this.getSeconds(),//秒
        "q+": Math.floor((this.getMonth() + 3) / 3),//季度
        "S": this.getMilliseconds()//毫秒
    };
    if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(fmt)) {
            //console.info(RegExp.$1);
            //console.info(o[k]);
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    return fmt;

};

/**
 * 判断起始日期大于期末日期
 * @param date_start ：2015-01-31
 * @param date_end   ：2015-01-31
 * @returns {boolean}
 */
function check_two_date(date_start, date_end) {
    if (date_start == '' || date_end == '' || typeof(date_start) == null || typeof(date_start) == null) {
        //alert('日期参数为空');
        return false;
    }
    var dateformate_ymd = /^(\d{4})-(0\d{1}|1[0-2])-(0\d{1}|[12]\d{1}|3[01])$/;
    if (!dateformate_ymd.test(date_start) || !dateformate_ymd.test(date_end)) {
        alert('格式不正确,正确格式如:2015-01-22');
        return false;
    }
    var date_start_num = parseInt(date_start.replace(/-/g, ''), 10);
    var date_end_num = parseInt(date_end.replace(/-/g, ''), 10);
    if (date_start_num > date_end_num) {
        alert('结束时间不能在开始时间之前！');
        return false;
    } else {
        return true;
    }


}

/**
 * 计算两日期相差的天数
 * @param date_start
 * @param date_end
 * @returns {*}
 */
function datediff(date_start, date_end) {
    var formate_date_s, formate_date_e;
    var formate_date_s_a, formate_date__e_a;
    var diff_dates;
    formate_date_s_a = date_start.split('_');
    formate_date_e_a = date_end.split('_');
    formate_date_s = new Date(formate_date_s_a[0] + '_' + formate_date_s_a[1] + '_' + formate_date_s_a[2]);
    formate_date_e = new Date(formate_date_e_a[0] + '_' + formate_date_e_a[1] + '_' + formate_date_e_a[2]);
    diff_dates = parent(Math.abs(formate_date_s - formate_date_e) / 1000 / 60 / 60 / 24);
    return diff_dates;
}