<include file="Public:header"/>
        <div class="mainbox">
            <div id="nav" class="mainnav_title">
                <ul>
                    <a href="__SELF__" class="on">会员注册邀请码</a>
                </ul>
            </div>
            <br>
            <a href="{pigcms{:U('InvitCode/create', array('type'=>$type))}" class="button">生成邀请码</a>
            <form name="myform" id="myform" action="" method="post">
                <div class="table-list">
                    <table width="100%" cellspacing="0">
                        <colgroup>
                            <col/>
                            <col/>
                            <col/>
                            <col/>
                            <col/>
                            <col/>
                            <col/>
                            <col width="180" align="center"/>
                        </colgroup>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>邀请码</th>
                                <th>状态</th>
                                <th>使用时间</th>
                            </tr>
                        </thead>
                        <tbody>
                            <if condition="is_array($list)">
                                <volist name="list" id="vo">
                                    <tr>
                                        <td>{pigcms{$vo.id}</td>
                                        <td>{pigcms{$vo.code}</td>
                                        <td>{pigcms{$vo.phone}
                                        <eq name="vo.is_used" value="1">已使用
                                        <else />未使用</eq>
                                        </td>
                                       <td>{pigcms{$vo.utime}</td>
                                    </tr>
                                </volist>
                                <tr><td class="textcenter pagebar" colspan="9">{pigcms{$pagebar}</td></tr>
                            <else/>
                                <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                            </if>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
<include file="Public:footer"/>