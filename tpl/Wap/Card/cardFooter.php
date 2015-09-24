<div style="height:40px;"></div>
<div class="footermenu">
    <ul>
        <li>
            <a href="/wap.php?g=Wap&c=Card&a=index&token={pigcms{$token}&cardid={pigcms{$thisCard.id}">
           	<img src="/static/images/card/home.png">
            <p>首页</p>
            </a>
        </li>
        
        <li>
            <a <php>if(ACTION_NAME=='card'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=card&token={pigcms{$token}&cardid={pigcms{$thisCard.id}">
           	<img src="/static/images/card/c.png">
            <p>会员卡</p>
            </a>
        </li>

        <li>
            <a <php>if(ACTION_NAME=='notice'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=notice&token={pigcms{$token}&cardid={pigcms{$thisCard.id}">
           	<img src="/static/images/card/prev.png">
            <p>通知</p>
            </a>
        </li>

        <li>
            <a <php>if(ACTION_NAME=='signscore'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=signscore&token={pigcms{$token}&cardid={pigcms{$thisCard.id}">
           	<img src="/static/images/card/intergral.png">
            <p>签到</p>
            </a>
        </li>

        <li>
            <a <php>if(ACTION_NAME=='cards'){</php>class="active"<php>}</php> href="/wap.php?g=Wap&c=Card&a=cards&token={pigcms{$token}&cardid={pigcms{$thisCard.id}">
           	<img src="/static/images/card/my.png">
            <p>会员中心</p>
            </a>
        </li>
    </ul>
</div>