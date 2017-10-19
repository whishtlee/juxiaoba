
var MH = window.MH || {};

/*
 *用到的域名变量
 */
MH.mainDomain = 'http://m.mahua.com/';
MH.userDomain = 'http://m.mahua.com/';
MH.cookieDomain = '.mahua.com'
MH.staticDomain = 'http://static.mahua.com/'
/*
 *滑出弹框
 */
MH.slideDialog = function(tthis,dtype){
  var type = dtype || 1;
  
  if(type == 1){
    if($('#dialogBg').length<=0){$('body').append('<div id="dialogBg" class="dialogBg"></div>');}
    $('#dialogBg').css('display','block').css('z-index','998').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');
    $('#dialogBg').animate({
      'opacity':0.5,
      '["-moz-opacity"]':0.5,
      '["filter"]':'alpha(opacity=50)'
    },300);
    tthis.animate({
      bottom:'0'
    },300);
    $('#dialogBg').click(function(){
      MH.closeDialog(tthis);
    });
  }else if(type == 2){
    var winHeight = $(window).height();
    var tthisHeightt = tthis.height();
    var bottom = (winHeight - tthisHeightt)/2;
    tthis.css('bottom',bottom).css('border-radius','4px').css('width','96%').css('left','2%').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');
    
    if($('#dialogBg').length<=0){$('body').append('<div id="dialogBg" class="dialogBg"></div>');}
    $('#dialogBg').css('display','block').css('z-index','998').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');
    $('#dialogBg').animate({
      'opacity':0.5,
      '["-moz-opacity"]':0.5,
      '["filter"]':'alpha(opacity=50)'
    },300);
    tthis.animate({
      'opacity':1,
      '["-moz-opacity"]':1,
      '["filter"]':'alpha(opacity=100)'
    },300);
    $('#dialogBg').click(function(){
      MH.closeDialog(tthis , type);
    });
  
  }
}

/**
 * 关闭滑出弹框
 */
MH.closeDialog = function(tthis, dtype){
  var type = dtype || 1;
  
  if(type == 1){
    tthis.animate({
      bottom:'-280px'
    },300)
  }else if(type == 2){
    tthis.animate({
      'opacity':0,
      '["-moz-opacity"]':0,
      '["filter"]':'alpha(opacity=0)'
    },300)
  }
  $('#dialogBg').animate({
    opacity:'0'
  },300)
  
  setTimeout(function(){
    tthis.css('display','none');
    $('#dialogBg').css('display','none');
  },350);
}

/*
 *顶踩的动画效果
 */
MH.votingNum = function(content,tthis) {
  var top=tthis.offset().top;
  var left=tthis.offset().left;
  if($('#votingNum').length<=0){
    $('body').append('<div id="votingNum"></div>');
  }
  $('#votingNum').html(content).css('display','block').css('top',top).css('left',left).css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');
  $('#votingNum').animate({
    'z-index':90,
    'margin':0,
    'top':top-25,
    'opacity':1,
    '["-moz-opacity"]':1,
    '["filter"]':'alpha(opacity=100)'
  },300)
  setTimeout(function(){
    $('#votingNum').html('').css('display','none');
  },310)
};

/*
 *笑话顶采提交
 */
MH.jokeVote = function(tthis, type){
  
  var Jid = tthis.parent().parent('dl').attr('data-j-id');
  var jokeType = tthis.parent().parent('dl').attr('joke-type');
  tthis.find('i').text(Number(tthis.find('i').text())+1);
  tthis.parent().find('.j-bad').attr('class','j-baded').unbind('click');
  tthis.parent().find('.j-good').attr('class','j-gooded').unbind('click');
  
  $.ajax({
    url: voteUrl,
    type: 'POST',
    data : {
      'joke_id': Jid,
      'type': type,
      'joke_type': jokeType
    }
  })
  
  var vote;
  if(!$.fn.cookie('MH_VOTE_JOKES')){
    vote=','+Jid+','
  }else{
    vote=','+Jid+$.fn.cookie('MH_VOTE_JOKES')
  }
  var voteArrs = vote.split(',');
  if(voteArrs.length>=100){
    vote = '';
    for(var i=0; i<=100; i++){
      if(voteArrs[i] != '') vote += ','+voteArrs[i];
    }
  }
  $.fn.cookie('MH_VOTE_JOKES', vote, {expires: 365 , path: '/', domain: MH.cookieDomain});
}

/*
 *下一页
 */
MH.nextPage = function(tthis){
  var tthisParent = tthis.parent();
  var page = tthis.attr('page');
  tthisParent.html('<a href="javascript:void(0)" class="mahua j-p-loding">加载中<i class="page-loading"></i></a>');
  $.ajax({
    type : 'GET',
    url : nextPageUrl,
    timeout : 3000,
    data : {
      'page' : page
    },
    success : function(data){
      tthisParent.before(data);
      tthisParent.remove();
      MH.lzLoad();
    },
    error : function(){
      tthisParent.html('<a href="javascript:void(0)" class="mahua j-page-next" page="'+page+'">请重新加载</a>');
    }
  })
}


/*
 *页面信息提示框
 */
MH.tips = function(a){
  a = a||{};
  var opts = {
    id : a.id || 'mhTips',    //提示框ID
    text : a.text || '',    //提示内容
    time : a.time || 3000,    //提示框展示时间
    y : a.y || ($(window).height()-80)/2,       //提示框坐标Y
    x : a.x || ($(window).width()-270)/2,       //提示框坐标X
    color : a.color || '#ff7e69',       //字体颜色;#333
    bgcolor : a.bgcolor || '#303237'      //背景色;#fcf9a1
  };
  var objId='#'+opts.id;
  if(opts.text!=''){
    if($(objId).length<=0){$('body').append('<div id="'+opts.id+'"></div>')}
    $(objId).html('<p>'+opts.text+'</p>').css('background',opts.bgcolor).css('color',opts.color).css('top',opts.y+'px').css('left',opts.x+'px');
    
    $(objId).animate({
      'opacity':1,
      '["-moz-opacity"]':1,
      '["filter"]':'alpha(opacity=100)'
    },300)
    setTimeout(function(){
      $(objId).animate({
        'opacity':0,
        '["-moz-opacity"]':0,
        '["filter"]':'alpha(opacity=0)'
      },300)
    },opts.time);
  }
}

/*
 *字符串加密
 */
MH.fiskerEncode = function(s){
    var es = [],c='',ec='';
    s = s.split('');
    for(var i=0,length=s.length;i<length;i++){
        c = s[i];
        ec = encodeURIComponent(c);
        if(ec==c){
            ec = c.charCodeAt().toString(16);
            ec = ('00' + ec).slice(-2);
        }
        es.push(ec);
    }
    return es.join('').replace(/%/g,'').toUpperCase();
}

/*
 *记时跳转
 */
MH.jumpTime = function(tthis , url){ 
  tthis.text(tthis.text()-1);
  if(tthis.text()<=0){
    window.location.href=url;
  }
  setTimeout(function(){MH.jumpTime(tthis , url)},1000);
}

/*
 *图片懒加载
 */
MH.lzLoad = function(){
  var line=$(window).scrollTop()+2*$(window).height();
  $('img[mahuaimg]').each(function(){
    var top = $(this).offset().top;
    if (top < line){
      if($(this).attr('mahuaimg')!=''){
        $(this).attr('src', $(this).attr('mahuaimg'));
        $(this).removeAttr('mahuaimg');
        var imgH = $(this).height() || (320/Number($(this).attr('width')))*Number($(this).attr('height')) || 0;
        if(imgH>600){
          $(this).attr('data-showPic',1);
        }
      }
    }
  });
  //动态加播放按钮
  $('img[mahuagifimg]').each(function() {
    $(this).parent().addClass('gif-play-btn').prepend('<span>播放GIF</span><i></i>');
    $(this).attr('mahuagifimg_s',$(this).attr('mahuagifimg'));
    $(this).removeAttr('mahuagifimg');
  });
  
  
  
}

//动态加展开笑话
MH.showPic = function(){
  $('img[data-showPic="1"]').each(function(){
    $(this).parent().css('position','relative').css('padding-bottom','20px').css('height','400px').css('overflow','hidden');
    $(this).after('<p class="j-content-show j-c-s-all"><span>展开图片</span></p><p class="j-content-show j-c-s-hidden"><span>收起图片</span></p><i class="j-pic-show-click"></i>');
    $(this).attr('data-showPic',2);
    
  })
}

$(function(){
  //new FastClick(document.body);
  //页面图片懒加载
  MH.lzLoad();
  $(window).scroll(function(){
    MH.lzLoad();
  });
  
  //展开全部图片
  $('.j-pic-show-click').on('click',function(){
    //jokeImgScrollTop = $(window).scrollTop();
    //alert('a'+jokeImgScrollTop);
    var tthis = $(this).parent().find('img');
    if(tthis.attr('data-showPic') == 2){
      tthis.attr('data-scrollTop',$(window).scrollTop());
      tthis.attr('data-showPic',3);
      $(this).parent().css('height','auto').css('overflow','auto');
      $(this).parent().find('.j-c-s-all').css('display','none');
      $(this).parent().find('.j-c-s-hidden').css('display','block');
    }else{
      if(tthis.attr('data-scrollTop') != '') $('body').scrollTop(tthis.attr('data-scrollTop'));
      tthis.attr('data-showPic',2);
      $(this).parent().css('height','400px').css('overflow','hidden');
      $(this).parent().find('.j-c-s-all').css('display','block');
      $(this).parent().find('.j-c-s-hidden').css('display','none');
    }
  })
  
  //导航菜单
  $('.i-h-menu a').first().click(function(){
    var tthis = $('.i-h-menu-list');
    tthis.css('display','block').css('-webkit-transform','rotateZ(-45deg) translate3d(70px, 71px,0px)').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');
    if($('#dialogBg').length<=0){$('body').append('<div id="dialogBg"></div>')};
    $('#dialogBg').css('display','block').css('z-index','9').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');
    tthis.animate({
      'opacity':1,
      '["-moz-opacity"]':1,
      '["filter"]':'alpha(opacity=100)',
      rotateZ: '0deg',
      translate3d: '0,0,0'
    },200);
    $('#dialogBg').click(function(){
      tthis.animate({
        'opacity':0,
        '["-moz-opacity"]':0,
        '["filter"]':'alpha(opacity=0)',
        rotateZ: '-45deg',
        translate3d: '70px, 71px, 0px'
      },200);
      $('#dialogBg').animate({
        opacity:'0'
      },100)
      
      setTimeout(function(){
        tthis.css('display','none');
        $('#dialogBg').css('display','none');
      },110);
    });
  });
  
  //动态图播放按钮
  $('.gif-img').each(function() {
    var x, y;
    
    x = $(this).offset().left + ($(this).width()/2) - 25;
    y = $(this).offset().top + ($(this).height()/2) - 35;
    //$(this).append('');
    $(this).parent().find('.gif-play-btn').css('top', y).css('left', x);
  });
  
  
  //顶 、 踩
  $('.j-good').on('click',function(){
    MH.votingNum('<b style="color:#ff7e69;">+1</b>',$(this));
    MH.jokeVote($(this) , 'up');
  })
  $('.j-bad').on('click',function(){
    MH.votingNum('<b style="color:#88cbea;">-1</b>',$(this));
    MH.jokeVote($(this) , 'down');
  })
  
  //分享
  $('.j-share').on('click',function(){
    var htm , dataGet;
    dataGet = $(this).attr('data-get');
    htm = '<dt>分享到</dt>';
    htm += '<dd class="share-channel">';
      htm += '<a href="'+MH.userDomain+'common/share?obj_type=joke&type=weibo&'+dataGet+'" class="s-tsina"><span><i></i></span><p>新浪微博</p></a>';
      htm += '<a href="'+MH.userDomain+'common/share?obj_type=joke&type=qq_weibo&'+dataGet+'" class="s-tqq"><span><i></i></span><p>腾讯微博</p></a>';
      htm += '<a href="'+MH.userDomain+'common/share?obj_type=joke&type=qzone&'+dataGet+'" class="s-qzone"><span><i></i></span><p>QQ空间</p></a>';
      htm += '<a href="'+MH.userDomain+'common/share?obj_type=joke&type=qq_share&'+dataGet+'"><span><i></i></span><p>QQ好友</p></a>';
    htm += '</dd>';
    htm += '<dd class="share-close"><a href="javascript:void(0)">取消</a></dd>';
    if($('#mahuaShare').length<=0){$('body').append('<dl class="xj-share" id="xjShare"></dl>')};
    $('#xjShare').html(htm);
    $('#xjShare').css('display','block').css('position','fixed').css('bottom','-280px').css('z-index','999');
    MH.slideDialog($('#xjShare') , 2);
    $('.share-close').click(function(){
      MH.closeDialog($('#xjShare') , 2);
    });
    $.ajax({
      //url: MH.mainDomain+'ajax/stats/clickShareButton'
    })
  })
  
  //打赏
  $('.j-maryane').on('click',function(){
    var htm , jId , tthis , tScore , uScore;
    
    tthis = $(this);
    jId = $(this).parent().parent().attr('data-j-id');
    tScore = parseInt($(this).attr('total-score'));
    uScore = parseInt($(this).attr('user-score'));
    
    htm = '<form id="form_maryane"><dl>';
    htm += '<dt><i></i><span>大爷们赏了<em class="s-color-red">'+tScore+'</em>麻币</span></dt>';
    htm += '<dd>';
      if(uScore > 0){
        htm += '<p>你给TA打赏了<em class="s-color-red">'+uScore+'</em>麻币</p>';
        htm += '<p>只能打赏一次哦 ^_^</p>';
      }else{
        htm += '<a href="javascript:void(0);" data-id="1"><span>5麻币</span></a>';
        htm += '<a href="javascript:void(0);" data-id="2" class="hover"><span>10麻币</span></a>';
        htm += '<a href="javascript:void(0);" data-id="3"><span>20麻币</span></a>';
        htm += '<a href="javascript:void(0);" data-id="4"><span>30麻币</span></a>';
        htm += '<a href="javascript:void(0);" data-id="5"><span>40麻币</span></a>';
        htm += '<a href="javascript:void(0);" data-id="6"><span>50麻币</span></a>';
        htm += '<input name="joke_id" type="hidden" id="joke_id" value="'+jId+'">'
        htm += '<input name="maryane_level" type="hidden" id="maryane_level" value="2">'
      }
    htm += '</dd>';
    htm += '<dd class="j-m-message"></dd>';
    if(uScore > 0){
      htm += '<dd class="j-m-btn"><input type="reset" class="maryane-close" value="关闭"/></dd>';
    }else{
      htm += '<dd class="j-m-btn"><input type="submit" class="maryane-submit" value="打赏"/><input type="reset" class="maryane-close" value="不理他"/></dd>';
    }
    htm += '</dl></form>';
    
    if($('#jMaryane').length<=0){$('body').append('<div class="j-maryane-box" id="jMaryane"></div>')};
    $('#jMaryane').html(htm);
    $('#jMaryane').css('display','block').css('position','fixed').css('bottom','-280px').css('z-index','999');
    MH.slideDialog($('#jMaryane') , 2);
    $('.maryane-close').click(function(){
      MH.closeDialog($('#jMaryane') , 2);
    });
    
    $('#jMaryane').find('a').click(function(){
      $('#jMaryane').find('a').removeClass('hover');
      $(this).addClass('hover');
      $('#maryane_level').val($(this).attr('data-id'));
    });
    
    $('.maryane-submit').click(function(){
      $('.maryane-submit').attr("disabled",true).val('打赏中..').css('background','#bcbcbd');
      $.ajax({
        url : maryaneUrl,
        dataType : 'json',
        type : 'POST',
        data : $('#form_maryane').serialize(),
        success : function(ret){
          if(ret.code > 0) {
            tthis.attr('user-score',ret.data.maryaneScore);
            MH.closeDialog($('#jMaryane') , 2);
            MH.tips({text:ret.message,color:'#fff'});
          } else {
            $('.j-m-message').html(ret.message);
            $('.maryane-submit').attr("disabled",false).val('打赏').css('background','#ff845b');
          }
        }
      })
    })
  })
  
  
  //包养
  $('.j-kept').on('click',function(){
    var htm , jId , score , tthis;
    
    tthis = $(this);
    score = $(this).attr('data-score');
    jId = $(this).parent().parent().attr('data-j-id');
    htm = '<form id="form_kept">';
    htm += '<div class="j-kept_1"><i></i></div>';
    htm += '<div class="j-k-content">';
      htm += '<p>包养我吧！只需<span class="s-color-red">'+score+'</span>麻币哦！</p>';
      htm += '<p class="j-k-message"></p>';
    htm += '</div>';
    htm += '<div class="j-k-btn"><input type="submit" class="kept-submit" value="包养"/><input type="reset" class="kept-close" value="走开"/></div>';
    htm += '<input type="hidden" name="joke_id" value="'+jId+'"/>';
    htm += '</form>';
    
    if($('#jKept').length<=0){$('body').append('<div class="j-kept-box" id="jKept"></div>')};
    $('#jKept').html(htm);
    $('#jKept').css('display','block').css('position','fixed').css('bottom','-280px').css('z-index','999');
    MH.slideDialog($('#jKept') , 2);
    $('.kept-close').click(function(){
      MH.closeDialog($('#jKept') , 2);
    });
    
    $('.kept-submit').click(function(){
      $('.kept-submit').attr("disabled",true).val('包养中..').css('background','#bcbcbd');
      $.ajax({
        url : keptUrl,
        dataType : 'json',
        type : 'POST',
        data : $('#form_kept').serialize(),
        success : function(ret){
          if(ret.code > 0) {
            $('.j-kept_1').attr('class','j-kept_2');
            $('.j-k-content').html('<p class="j-k-red">这条投稿被你承包了 ! </p><p class="j-k-red j-k-big">以后赚钱都归你 !!!</p>');
            $('.j-k-btn').html('<input type="reset" class="kept-close" value="走开"/>');
            setTimeout(function(){
              MH.closeDialog($('#jKept') , 2);
            },2000);
            tthis.after(ret.data.html);
            tthis.remove();
          } else {
            $('.j-k-message').html(ret.message);

            $('.kept-submit').attr("disabled",false).val('包养').css('background','#ff845b');
          }
        }
      })
    })
  })
  
  //下一页
  $('.j-page-next').on('click' , function(){
    MH.nextPage($(this));
  })
  
  //签到
  $('.checkining').click(function(){
    var tthis=$(this);
    $.ajax({
      url : checkinUrl,
      type : 'POST',
      dataType : 'json',
      success : function(ret){
        if(ret.code > 0) {
          tthis.unbind('click');
          tthis.addClass('checkined').removeClass('checkining');
          MH.tips({text:ret.message,color:'#fff'});
        } else {
          MH.tips({text:ret.message});
        }
      }
    })
  })
  
  //顶评论
  $('.c-good').on('click',function(){
    //$(this).die('click');
    var userId = parseInt($.fn.cookie('MH_USER_ID'));
    if(userId <= 0 || isNaN(userId)){
      MH.tips({text:'亲~你还没有登录哦'});
    }else{
      commentVote($(this));
    }
    return false;
  })
  //评论顶采提交
  function commentVote(t){
    var ispost=true;
    var id=t.attr('comment_info');
    var voteArr=$.fn.cookie('MH_VOTE_COMMENTS');
    if(voteArr){
      if(voteArr.indexOf(','+id+',')>-1){
        ispost=false;
      }
    }
    if(ispost){
      t.text(Number(t.text())+1);
      $.ajax({
        type : 'POST',
        url : upCommentUrl,
        dataType : 'json',
        data : {
          'comment_info':id
        }
      })
      
      var vote;
      if(!$.fn.cookie('MH_VOTE_COMMENTS')){
        vote=','+id+',';
      }else{
        vote=','+id+$.fn.cookie('MH_VOTE_COMMENTS');
      }
      var voteArrs = vote.split(',');
      if(voteArrs.length>=100){
        vote = '';
        for(var i=0; i<=100; i++){
          if(voteArrs[i] != '') vote += ','+voteArrs[i];
        }
      }
      $.fn.cookie('MH_VOTE_COMMENTS',vote,{expires:365,path:'/',domain:MH.cookieDomain});
    }
  }
  
  //返回顶部
  if($('#goTop').length>0){
    $(window).scroll(function(){
      var top=$(window).scrollTop();
      if (top>50){
        $('#goTop').css('display','block');
      }else{
        $('#goTop').css('display','none');
      }
    });
    $('#goTop').click(function(){
      $('body').scrollTop(0)
    })
  }
  
  //投稿审稿浮动
  if($('.h-publish-audit-fixed').length>0){
    $(window).scroll(function(){
      var top=$(window).scrollTop();
      if (top>45){
        //$('body').swipeDown(function(){
          $('.h-publish-audit-fixed').css('position','fixed').css('z-index','10').css('top','0').css('left','0');
        //})
      }else{
        $('.h-publish-audit-fixed').css('position','static');
      }
    });
  }
  
  //点击查看大图
//  var scrollHeight = 0;
//  $('img[xjBigImg]').click(function(){
//    var imgSrc = $(this).attr('xjBigImg');
//    if(imgSrc != ''){
//      if($('#showBigImg').length<=0){$('body').append('<div id="showBigImg" class="showBigImg"><div class="showBigImgBg"></div><span><img src="" id="showPic" /></span><div class="closeShowPic"><a href="javascript:void(0)">关闭</a></div></div>');}
//      //$('#showBigImgBox').css('height',$(window).height()+'px').css('display','block');
//      $('#showBigImg').css('display','table').find('img').attr('src',imgSrc).css('overflow','auto');
//      scrollHeight = $(window).scrollTop()
//      $('#box').css('display','none');
//    }
//  });
//  $('#showPic').live('click',function(){
//    $('#showBigImg').css('display','none');
//    $('#box').css('display','block');
//    $('body').scrollTop(scrollHeight);
//  })
//  $('.closeShowPic a').live('click',function(){
//    $('#showBigImg').css('display','none');
//    $('#box').css('display','block');
//    $('body').scrollTop(scrollHeight);
//  })
  //点击播放动态图
  $('.gif-play-btn i').on('click',function(){
    var tthis = $(this).parent();
    var imgSrc = tthis.find('img').attr('mahuagifimg_s');
    if(imgSrc != ''){
      
      tthis.find('img').attr('src',imgSrc);
      tthis.find('span').css('display','none');
      tthis.find('i').remove();
      tthis.find('img').removeAttr('mahuagifimg_s');
    }
  });

  
})

//comment提交验证
function commentValidate(){
  var c=$('#j-c-form').find('.j-c-text');
  var content=c.val();
  
  if(content.length<2){
    MH.tips({text:'至少要写两个字吧'});
    return false;
  }else{
    $('.j-c-submit').attr("disabled",true).val('提交中...').css('background','#bcbcbd').css('box-shadow','0 3px 0 0 #aeaeaf');
    $.ajax({
      type : 'POST',
      url : addCommentUrl,
      dataType : 'json',
      data : {
        'content': content,
        'obj_info' : $('#object-comment').attr('obj_info')
      },
      success : function(ret){
        if(ret.code>0){
          if(ret.code==2){
            MH.tips({text:ret.data.taskMessage,color:'#fff'});
          }
          $('#j-c-list').find('.nocomment').remove();
          $('.j-c-submit').val('完成');
          c.val('');
          $('#j-c-list').find('dt').after(ret.data.html);
          $('#j-c-form').find('.j-c-text').css('color','#c9c9c9');
          setTimeout(function(){
            $('.j-c-submit').removeAttr("disabled").val('评论').css('background','#04ce9b').css('box-shadow','0 3px 0 0 #01b688');
          },10000);
        }else{
          MH.tips({text:ret.message});
          $('.j-c-submit').removeAttr("disabled").val('评论').css('background','#04ce9b').css('box-shadow','0 3px 0 0 #01b688');
        }
      }
    })
  }
  return false;
}