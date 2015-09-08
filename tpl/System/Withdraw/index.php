<include file="Public:header"/>
        <div class="mainbox">
            <div id="nav" class="mainnav_title">
                <ul>
                    <a href="{pigcms{:U('Withdraw/index')}" class="on">提现列表</a>
                </ul>
            </div>
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
                                <th>用户类型</th>
                                <th>用户id</th>
                                <th>提现金额</th>
                                <th>状态</th>
                                <th>申请时间</th>
                                <th class="textcenter">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <if condition="is_array($list)">
                                <volist name="list" id="vo">
                                    <tr>
                                        <td>{pigcms{$vo.id}</td>
                                        <td>
                                            <eq name="vo.user_type" value="1">会员<else/>商户</eq>
                                        </td>
                                        <td>{pigcms{$vo.uid}</td>
                                        <td>{pigcms{$vo.amount}</td>
                                        <td>
                                            <switch name="vo.status">
                                                <case value="1">已完成</case>
                                                <case value="0">等待提现</case>
                                                <case value="-1">驳回申请</case>
                                            </switch>
                                        </td>
                                        <td>{pigcms{$vo.ctime}</td>
                                        <td class="textcenter">
                                            <eq name="vo.status" value="0">
                                                <a href="{pigcms{:U('status',array('id'=>$vo['id'],'status'=>1))}">完成提现</a>
                                                <a href="{pigcms{:U('status',array('id'=>$vo['id'],'status'=>-1))}">驳回申请</a>
                                            </eq>
                                        </td>
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