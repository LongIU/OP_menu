<!DOCTYPE html>
<html>
<head>
	<?php
	include('./OP_menu_php/PHP/fwrite.php')
	?>
    <meta charset="UTF-8">
    <title>OP Document</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="stylesheets/dist/op_menu.css" rel="stylesheet">
    <script src='javascripts/dist/jquery-1.9.1.min.js' type='text/javascript'>
    </script>
    <script>
    $(function(){
    var w = $("#mwt_slider_content").width();
    $('#mwt_slider_content').css('height', ($(window).height() - 20) + 'px' ); 


    $("#mwt_fb_tab").mouseover(function(){
        if ($("#mwt_mwt_slider_scroll").css('left') == '-'+w+'px')
        {
            $("#mwt_mwt_slider_scroll").animate({ left:'0px' }, 300 ,'swing');
            $("#mwt_fb_tab").css('opacity', 0.3);
            $("div.background").css('opacity', 0.6);
        }
    });


    $("#mwt_slider_content").mouseleave(function(){
        $("#mwt_mwt_slider_scroll").animate( { left:'-'+w+'px' }, 350 ,'swing');
        $(".main>a").next().parent().siblings().find(".child").slideUp(10);
        $("#mwt_fb_tab").css('opacity', 1);
        $("div.background").css('opacity', 1);
      
    }); 
    });

    </script><!-- Analytics -->

    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-11834194-75', 'auto');
    ga(function(){
    try {
      var cID = ga.getAll().map(function(gainstance){return gainstance.get('clientId')}).toString();
      ga('set','dimension3',cID);
    } catch(e){}
    });
    ga('send', 'pageview');
    </script><!-- GA Tag Manager -->

    <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NCHR33');
    </script>
    <script>
    $(function(){
    //垂直導航欄，點選下拉子選單
    $(".main>a").click(function(){
    $(this).next().slideToggle(300)
    .parent().siblings().find(".child").slideUp(300);
    });

    })


    </script>
</head>
<body>
    <div id="body_div"></div>
    <div id="mwt_mwt_slider_scroll">
        <div id="mwt_fb_tab">
            <span></span> <span></span> <span></span> <span>O</span> <span>P</span> <span>選</span> <span>單</span> <span></span> <span></span> <span></span>
        </div>
        <div id="mwt_slider_content">
            <div class='browse'>
                <div class='browse__inner'>
                    <ul class='browse__menu'>
<?php
	$row = show_table();
	foreach($row as $key => $value){
		if (!is_null($value['Main_name'])){
		    $Main_list[] = $value['Main_name'];
			$Main_name = $value['Main_name'];
		    $Menu_table[$Main_name][] = array(
			    "Sub_name" => $value['Sub_name'], 
			    "url" => $value['url']
		    );
		}	
	}
    $Main_list = array_unique($Main_list);
	foreach($Menu_table as $key => $value){
		echo '<li class="main">';
        echo '  <a class="browse__menu-link" href="#">'.$key.' 選單</a>';
        echo '  <ul class="child">';
		foreach($value as $nu => $Name){
			echo '<li>';
            echo '<a class="browse__menu-link" href="http://'.$Name['url'].'" style="text-decoration: none" target="targetText">'.$Name['Sub_name'].'</a';
            echo '</li>';
		}
		echo '</ul></li>';
	}

						
?>
                    </ul>
                    <script>
                    $(function(){
                    //當滑鼠滑入時將div的class換成divOver
                        $('.main ').hover(function(){
                            $(this).addClass('.main active');
                        },function(){
                    //滑開時移除divOver樣式
                            $(this).removeClass('.main active');
                        });
                    });

                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="background">
        <iframe height="100%" id="targetText" name="targetText" src="" style="" width="100%"></iframe>
    </div>
</body>
</html>