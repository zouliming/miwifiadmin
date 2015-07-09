<!DOCTYPE html>
<html>
    <head>
        <title>新版后台</title>
        <style class="text/css">
/*            * {
                    margin:0;
                    padding:0;
            }*/
            body{
                    background-color: blue;
                    margin: 0px;
                    padding: 0px;
            }
            .header{
                    height: 60px;
                    background-color: #4A8BC2;
                    width: 100%;
            }
            .container{
                    width: 100%;
                    background-color: #333;
            }
            .sidebar{
                    width: 220px;
                    background: #333 none repeat scroll 0% 0%;
                    height: 100%;
                    position: absolute;
            }
            .sidebar ul{

            }
            .sidebar ul li{
                    list-style: none;
            }
            .sidebar ul li a{
                    color: white;
                    text-decoration: none;
            }
            .main-content{
                    margin-left: 220px;
                    position: relative;
                    min-height: 1000px;
                    background-color: white;
            }
            .footer{
                    text-align: center;
                    margin: 0px;
                    background-color: #ddd;
                    padding: 10px 0px;
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
                            <i class="ico ico-nav-1"></i>
                            <span>首页</span>
                        </a>
                    </li>
                    <li class="manage active">
                        <a href="/site/manage">
                            <i class="ico ico-nav-2"></i>
                            <span>后台设置</span>
                        </a>
                    </li>
                    <li class="status">
                        <a href="/site/status">
                            <i class="ico ico-nav-3"></i>
                            <span>没用</span>
                        </a>
                    </li>
                    <li class="equipments">
                        <a href="/site/equipments">
                            <i class="ico ico-nav-4"></i>
                            <span>设备</span>
                        </a>
                    </li>
                    <li class="weightdoor">
                        <a href="/weight/door">
                            <i class="ico ico-nav-5"></i>
                            <span>体重模块</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="main-content">
                这是主要内容
            </div>
        </div>
        <div class="footer">
            邹立明个人所有
        </div>
    </body>
</html>
