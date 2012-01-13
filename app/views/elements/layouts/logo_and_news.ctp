<style type="text/css">
    #ticker-area{
        font-size:16px;
        display:block;
        position: absolute;
        margin-top:-90px;
        margin-left:35px;
        font-family:comic Sans MS;
        color:#FFF;
    }
    #ticker-area ol{
        margin-left:20px;
    }
</style>
<div id="header">
    <div id="top-area">
        <?php echo $this->Html->image('background_top.png',array('style'=>'width:940px;height:200px;-moz-border-radius: 5px;-webkit-border-radius: 5px;-moz-box-shadow: 0px 5px 10px #888;-webkit-box-shadow: 0px 5px 10px #888;box-shadow: 0px 5px 10px #888;','alt'=>"")); ?>
        <div id="ticker-area">
            <strong style="display:none">
                A Grade Receiving Teacher Name
            </strong>
            <ol>
                <li style="display:none">
                    Mr. A K Solanki - Lakadiya Kanya Primary School - Bhachau
                </li>
                <li style="display:none">
                    Mr. M G Jani - Vithon Kumar Primary School - Nakhtrana
                </li>
            </ol>
        </div>
        <script type="text/javascript">
            setNews();
            var i1=setInterval("setNews()",17400);
            function setNews(){
                $("#ticker-area strong").show().typewriter();
                var t1=setTimeout(function(){
                    $("#ticker-area ol li:first-child").show().typewriter();
                    var t2=setTimeout(function(){
                        $("#ticker-area ol li:nth-child(2)").show().typewriter();
                        var t3=setTimeout(function(){
                            $("#ticker-area strong,#ticker-area ol li:first-child,#ticker-area ol li:nth-child(2)").hide();
                        },7820);
                    },6020);
                },3510);
            }
        </script>
    </div>
</div>