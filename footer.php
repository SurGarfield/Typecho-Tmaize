</div>
<footer class="footer">
  <span><?php $this->options->banquan();?></span>
  <a href="/static/xml/rss.xml">RSS订阅</a>
</footer>
<div id="to-top">
  <span></span>
  <span></span>
</div>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/jquery.pjax.min.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/pjax.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/blog.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/nprogress.min.js'); ?>"></script>

<!-- 点击页面文字冒出特效 -->
<script>
;(function(){
  var textArr = ['富强', '民主', '文明', '和谐', '自由', '平等', '公正', '法治', '爱国', '敬业', '诚信', '友善']
  window.blog.initClickEffect(textArr)
})()
</script>
<script>
    function getBaseUrl() {
    var ishttps = 'https:' == document.location.protocol ? true : false;
    var url = window.location.host;
    if (ishttps) {
        url = 'https://' + url;
    } else {
        url = 'http://' + url;
    }
    return url;
    }
    
    let url = '"'+getBaseUrl()+'"';
    $(document).pjax('a[href^='+ url +']:not(a[target="_blank"], a[no-pjax])', {
    container: '#pjax',
    fragment: '#pjax',
    timeout: 8000
    })
    $(document).on('pjax:start',function() { NProgress.start(); });
    $(document).on('pjax:end',function() { NProgress.done(); });
        //表单提交事件
        $(document).on('.submit', function (event) {
        event.preventDefault();
        // $.pjax.submit(event, '#pjax');
        $.pjax.submit(event, '#pjax', {timeout: 10000});
    }); 
        //表单提交成功事件
        $(document).on('pjax:success', function (event) {
        //console.log("关闭搜索框之类的操作");
    });
    //「页面刷新」事件触发运行
    $(document).ready(function()
    {
        MyApp.initPjax();
    });

</script>
<?php $this->footer(); ?>

</body>
</html>