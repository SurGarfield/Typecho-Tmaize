(function ($) {

    var MyApp = {
        initPjax: function () {
            var self = this;
  
            // 初始化
            $(document).pjax('a:not(a[target="_blank"])', '#pjax', {
              container: '#pjax',
              fragment: "#pjax",
              timeout: 1600,
              maxCacheLength: 500,
          });
         
            // PJAX 渲染结束时
            $(document).on('pjax:end', function () {
                // 这里的调用 **只有** 在「局部刷新」时才会运行
                self.siteBootUp();
            });
            self.siteBootUp();
        },

        siteBootUp: function () {

            var self = this;
            self.dengxiang();
            self.ajaxComment()

        },

dengxiang: function () {
// 点击图片全屏预览

    if (!document.querySelector('.page-post')) {
      return
    }
    console.debug('init post img click event')
    let imgMoveOrigin = null
    let restoreLock = false
    let imgArr = document.querySelectorAll('.page-post img')
  
    let css = `.img-move-bg {
      transition: opacity 300ms ease;
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      opacity: 0;
      background-color: #000000;
      z-index: 100;
    }
    .img-move-item {
      transition: all 300ms ease;
      position: fixed;
      opacity: 0;
      cursor: pointer;
      z-index: 101;
    }`
    var styleDOM = document.createElement('style')
    styleDOM.type = 'text/css'
    if (styleDOM.styleSheet) {
      styleDOM.styleSheet.cssText = css
    } else {
      styleDOM.appendChild(document.createTextNode(css))
    }
    document.querySelector('head').appendChild(styleDOM)
  
    window.addEventListener('resize', toCenter)
  
    for (let i = 0; i < imgArr.length; i++) {
      imgArr[i].addEventListener('click', imgClickEvent, true)
    }
  
    function prevent(ev) {
      ev.preventDefault()
    }
  
    function toCenter() {
      if (!imgMoveOrigin) {
        return
      }
      let width = Math.min(imgMoveOrigin.naturalWidth, parseInt(document.documentElement.clientWidth * 0.9))
      let height = (width * imgMoveOrigin.naturalHeight) / imgMoveOrigin.naturalWidth
      if (window.innerHeight * 0.95 < height) {
        height = Math.min(imgMoveOrigin.naturalHeight, parseInt(window.innerHeight * 0.95))
        width = (height * imgMoveOrigin.naturalWidth) / imgMoveOrigin.naturalHeight
      }
  
      let img = document.querySelector('.img-move-item')
      img.style.left = (document.documentElement.clientWidth - width) / 2 + 'px'
      img.style.top = (window.innerHeight - height) / 2 + 'px'
      img.style.width = width + 'px'
      img.style.height = height + 'px'
    }
  
    function restore() {
      if (restoreLock == true) {
        return
      }
      restoreLock = true
      let div = document.querySelector('.img-move-bg')
      let img = document.querySelector('.img-move-item')
  
      div.style.opacity = 0
      img.style.opacity = 0
      img.style.left = imgMoveOrigin.x + 'px'
      img.style.top = imgMoveOrigin.y + 'px'
      img.style.width = imgMoveOrigin.width + 'px'
      img.style.height = imgMoveOrigin.height + 'px'
  
      setTimeout(function () {
        restoreLock = false
        document.body.removeChild(div)
        document.body.removeChild(img)
        imgMoveOrigin = null
      }, 300)
    }
  
    function imgClickEvent(event) {
      imgMoveOrigin = event.target
  
      let div = document.createElement('div')
      div.className = 'img-move-bg'
  
      let img = document.createElement('img')
      img.className = 'img-move-item'
      img.src = imgMoveOrigin.src
      img.style.left = imgMoveOrigin.x + 'px'
      img.style.top = imgMoveOrigin.y + 'px'
      img.style.width = imgMoveOrigin.width + 'px'
      img.style.height = imgMoveOrigin.height + 'px'
  
      div.onclick = restore
      div.onmousewheel = restore
      div.ontouchmove = prevent
  
      img.onclick = restore
      img.onmousewheel = restore
      img.ontouchmove = prevent
      img.ondragstart = prevent
  
      document.body.appendChild(div)
      document.body.appendChild(img)
  
      setTimeout(function () {
        div.style.opacity = 0.5
        img.style.opacity = 1
        toCenter()
      }, 0)
    }
},

ajaxComment: function () {
  $('#comment-form').submit(function(event){
      var commentdata=$(this).serializeArray();
      $.ajax({
          url:$(this).attr('action'),
          type:$(this).attr('method'),
          data:commentdata,
          beforeSend:function() {},
          error:function(request) {},
          success:function(data){
              
              var error=/<title>Error<\/title>/;
              if (error.test(data)){
                  var text=data.match(/<div(.*?)>(.*?)<\/div>/is);
                  var str='发生了未知错误';if (text!=null) str=text[2];
                
              } else {
                  //评论框复位（清空文本，刷新高度）
                  $('.textarea_box').val('');$('.textarea_box').css('height','75px');
                  //评论框复位（取消回复）
                  if ($('#cancel-comment-reply-link').css('display')!='none') $('#cancel-comment-reply-link').click();
                  var target='#comments',parent=true;
                  $.each(commentdata,function(i,field) {if (field.name=='parent') parent=false;});
                  if (!parent || !$('ol.page-navigator .prev').length){
                      var latest=-19260817;
                      $('#comments .comment-parent',data).each(function(){
                          var id=$(this).attr('id'),coid=parseInt(id.substring(8));
                          if (coid>latest) {latest=coid;target='#'+id;}
                      });
                  }
                  $('.comment').html($('.comment',data).html()); //更新最新评论
                  $('.comments-title').html($('.comments-title',data).html()); //更新评论数量
                  $('.comments_lie').html($('.comments_lie',data).html()); //更新评论列表
              }
          }
      });
      return false;
  });
},

      };
    window.MyApp = MyApp;
  
  })(jQuery);
