<!DOCTYPE html>
<html>
    <head>
        <title>新版后台</title>
        <style class="text/css">
            /*  RESET */
            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, font, img, ins, kbd, q, s, samp,
            small, strike, strong, sub, sup, tt, var,
            b, i, center, dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, audio, canvas, details, figcaption,
            figure, footer, header, hgroup, mark, menu, meter, nav,
            output, progress, section, summary, time, video {
                    margin: 0;
                    padding: 0;
            }
            body{
                    background-color: blue;
                    margin: 0px;
                    padding: 0px;
            }
            .header{
                    height: 60px;
                    background-color: #16a085;
                    width: 100%;
            }
            .container{
                    width: 100%;
                    background-color: #333;
                    position: relative;
            }
            .sidebar{
                    width: 220px;
                    background: #333 none repeat scroll 0% 0%;
                    height: 100%;
                    float:left;
            }
            .sidebar ul{
                    border-top: 1px solid #000;
                    border-bottom: 1px solid #484848;
            }
            .sidebar ul li{
                    list-style: none;
                    border-top: 1px solid #484848;
                    border-bottom: 1px solid #000;
            }
            .sidebar ul li a{
                    color: white;
                    text-decoration: none;
                    height: 49px;
                    line-height: 49px;
                    display: block;
                    /*padding-left: 20px;*/
            }
            .sidebar ul li a span{
                    margin-left: 20px;
            }
            .asidebar{
                    width: 220px;
                    background-color: white;

                    float: left;
                    border-right: 1px solid #E5E5E5;
                        min-height: 650px;
            }
            .asidebar ul{
                    
            }
            .asidebar ul li{
                    list-style: none;
            }
            .asidebar ul li a{
                height: 49px;
                line-height: 49px;
                color: black;
                text-decoration: none;
                background:#F2F2F2 none repeat scroll 0% 0%;
                text-indent: 20px;
                display: block;
                border-bottom: 1px solid #E5E5E5;
            }
            .main-content{
                    margin-left: 441px;
                    position: relative;
                    min-height: 1000px;
                    background-color: white;
                    padding: 20px;
            }
            .footer{
                    text-align: center;
                    margin: 0px;
                    background-color: #ddd;
                    padding: 10px 0px;
                    font-size: 11px;
                    color: #666;
            }
            .clear{
                    clear: both;
            }
        </style>
    </head>
    <body>
        <div class="header">这是头</div>
        <div class="container">
            <div class="sidebar">
                <ul>
                    <li class="index">
                        <a href="/site/index">
                            <span>首页</span>
                        </a>
                    </li>
                    <li class="manage active">
                        <a href="/site/manage">
                            <span>后台设置</span>
                        </a>
                    </li>
                    <li class="status">
                        <a href="/site/status">
                            <span>没用</span>
                        </a>
                    </li>
                    <li class="equipments">
                        <a href="/site/equipments">
                            <span>设备</span>
                        </a>
                    </li>
                    <li class="weightdoor">
                        <a href="/weight/door">
                            <span>体重模块</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="asidebar">
                <ul>
                    <li class="">
                        <a href="#">
                            <span>第一个功能</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <span>第二个功能</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <span>第三个功能</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="main-content">
                这是主要内容
            </div>
        </div>
        <div class="footer">
            版权终身所有
        </div>
    </body>
</html>
