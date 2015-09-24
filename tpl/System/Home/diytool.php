<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title>自定义插件</title>
	<link href="/static/img/css/reset.css" rel="stylesheet" type="text/css" /> 
	<link href="/static/img/css/codemirror.css" rel="stylesheet" type="text/css"/>
	<link href="/static/img/css/farbtastic.css" rel="stylesheet" type="text/css"/> 
</head>
<body>
	<div class="big_main"> 
    	<div class="m"> 
    		<div class="box">&nbsp;</div>
	        <div id="tabbox"> 
	         <div style="background:#fefbe4;border:1px solid #f3ecb9;color:#993300;padding:10px;font-size:12px;line-height:20px;">使用方式:先选择元素，然后点击“编辑选中”，然后点击“插入编辑器”</div>
	         <ul class="tabs" id="tabs"> 
	          <li class="thistab"><a href="javascript:void(0);" tab="tab1" class="ttitle">标题</a></li> 
	          <li><a href="javascript:void(0);" tab="tab2" class="ttitle">文本</a></li> 
	          <li><a href="javascript:void(0);" tab="tab3" class="ttitle">关注</a></li> 
	          <li><a href="javascript:void(0);" tab="tab4" class="ttitle">分割</a></li> 
	          <li><a href="javascript:void(0);" tab="tab5" class="ttitle">原文</a></li> 
	          <li><a href="javascript:void(0);" tab="tab6" class="ttitle">其他</a></li> 
	          <li class="sub"><a href="javascript:void(0);" tab="tab7" class="ttitle">编辑选中</a></li> 
	         </ul> 
	        </div> 
	        <!--标题开始 --> 
	        <div id="tab1" class="tab_con" style="display: none;"> 
	         <!--标题开始 --> 
	         <div class="element-list" style="width: 100%;"> 
	          <!--样式0--> 
	          <div class="element-item" data-color="section.main:border-color;section.main2:color;section.main3:background-color;section.main4:border-color"> 
	           <div class="content"> 
	            <fieldset style="margin:0;padding:0;border:0;max-width:100%;box-sizing:border-box;color:#3e3e3e;font-family:微软雅黑;line-height:25px;white-space:normal;text-align:center;clear:both;word-wrap:break-word!important">
	             <section class="main" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;border:.4em solid #00bbec;background-color:#f8f7f5">
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin:-.4em .5em;padding:.5em;border-top-width:.5em;border-top-style:solid;border-top-color:#f8f7f5;border-bottom-width:.5em;border-bottom-style:solid;border-bottom-color:#f8f7f5">
	               <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">
	                <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-table;vertical-align:middle">
	                 <section class="main2" style="max-width:100%;display:table;vertical-align:middle;line-height:1.5;font-size:1em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:#00bbec;word-wrap:break-word!important;box-sizing:border-box!important">
	                  本站出品
	                  <br style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important" />必是精品
	                  <br style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important" />
	                 </section>
	                </section>
	                <section class="main3" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box;display:inline-block;vertical-align:middle;margin:0;height:3em;width:3em;border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:0;border-bottom-left-radius:50%;background-color:#00bbec">
	                 <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box;height:2.6em;width:2.6em;margin:.2em;border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:50%;border-bottom-left-radius:50%;border:.2em solid #fff;background-color:transparent">
	                  <section style="max-width:100%;margin-top:.05em;line-height:1;font-size:2em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:#fff;word-wrap:break-word!important;box-sizing:border-box!important">
	                   1
	                  </section>
	                 </section>
	                </section>
	               </section>
	               <section class="main4" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin:.5em 0;border-top-width:1px;border-top-style:solid;border-color:#00bbec"></section>
	               <section style="max-width:100%;line-height:1;font-size:.9em;font-family:inherit;text-align:inherit;text-decoration:inherit;word-wrap:break-word!important;box-sizing:border-box!important">
	                这里可输入标题，自适应宽度
	               </section>
	              </section>
	             </section>
	            </fieldset> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color="p:border-top-color;span:background-color"> 
	           <div class="content"> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1.5em; white-space: normal; color: rgb(62, 62, 62); line-height: 2em; font-family: 微软雅黑; padding: 0px; border-top-color: rgb(0, 187, 236); border-top-width: 2px; border-top-style: solid; box-sizing: border-box !important;"> <span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding: 5px 10px; color: rgb(255, 255, 255); font-size: 13px; display: inline-block; background-color: rgb(0, 187, 236);">这可输入标题</span> </p> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: normal; color: rgb(62, 62, 62); font-family: 'Helvetica Neue', Helvetica, 'Hiragino Sans GB', 'Microsoft YaHei', 微软雅黑, Arial, sans-serif; line-height: 25px; background-color: rgb(255, 255, 255); box-sizing: border-box !important;"> </p> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color="h2:border-top-color;h2:color"> 
	           <div class="content"> 
	            <h2 data-page-model="title" style="margin: 25px 0px 20px; font-weight: 100; font-size: 22px; max-width: 100%; white-space: normal; padding: 5px 0px 10px 7px; clear: both; border-top-width: 2px; border-top-style: solid; border-top-color: rgb(0, 187, 236); background-image: url(/static/img/images/aticletitBg.png); background-color: rgb(255, 255, 255); font-family: 微软雅黑; line-height: 35px; color: rgb(0, 187, 236); word-wrap: break-word !important; box-sizing: border-box !important; background-position: 0px 100%; background-repeat: repeat no-repeat;">一、这可输入标题</h2> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color="section.main1:border-color;section.main2:background-color"> 
	           <div class="content"> 
	            <section class="main1" style="max-width: 100%; color: rgb(62, 62, 62); font-family: 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255); border-color: rgb(0, 187, 236); margin: 0.5em 0px; line-height: 1em; overflow: hidden; border-bottom-width: 1px; border-bottom-style: solid; display: inline-block; word-wrap: break-word !important; box-sizing: border-box !important;">
	             <section class="main2" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding: 0.2em; height: 2.8em; line-height: 1em; display: inline-block; background-color: rgb(0, 187, 236);"> 
	              <section class="main3" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(255, 255, 255); line-height: 1em; font-family: inherit; font-size: 2.5em;">
	               1
	              </section>
	             </section>
	             <section class="main4" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding: 0.2em; color: rgb(42, 52, 58); line-height: 1em; font-family: inherit; font-size: 1.5em; display: inline-block;">
	              这可输入标题
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color="section.main_3:background-color;section.main_4:border-left-color;section.main_4:border-right-color;"> 
	           <div class="content"> 
	            <section class="main_1" style="max-width: 100%; color: rgb(62, 62, 62); font-family: 微软雅黑; line-height: 25px; white-space: normal; background-color: rgb(255, 255, 255); word-wrap: break-word !important; box-sizing: border-box !important;">
	             <section class="main_2" style="max-width: 100%; margin: 0.8em 0px 0.5em; overflow: hidden; word-wrap: break-word !important; box-sizing: border-box !important;">
	              <section class="main_3" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; height: 2em; display: inline-block; padding: 0.3em 0.5em; color: white; text-align: center; font-size: 1em; line-height: 1.4em; vertical-align: top; background-color: rgb(0, 187, 236);">
	               <strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">第一步</strong>
	              </section>
	              <section class="main_4" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; height: 2em; width: 0.5em; display: inline-block; vertical-align: top; border-left-width: 0.5em; border-left-style: solid; border-left-color: rgb(0, 187, 236); border-right-color: rgb(0, 187, 236); border-top-width: 1em !important; border-top-style: solid !important; border-top-color: transparent !important; border-bottom-width: 1em !important; border-bottom-style: solid !important; border-bottom-color: transparent !important;"></section> 
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color="span:background-color:"> 
	           <div class="content"> 
	            <section style="max-width: 100%; color: rgb(62, 62, 62); font-family: 微软雅黑; line-height: 25px; white-space: normal; margin: 0.8em 0px 0.5em; word-wrap: break-word !important; box-sizing: border-box !important;">
	             <span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; display: inline-block; padding: 0.3em 0.5em; border-top-left-radius: 0.5em; border-top-right-radius: 0.5em; border-bottom-right-radius: 0.5em; border-bottom-left-radius: 0.5em; color: white; text-align: center; font-size: 1em; box-shadow: rgb(165, 165, 165) 0.2em 0.2em 0.1em; background-color: #00BBEC;"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; font-size: 1em; font-family: inherit;">1、这里输入标题</span></strong></span>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式-1 --> 
	          <div class="element-item" data-color="span:border-bottom-color;span.hao:background-color"> 
	           <div class="content"> 
	            <h2 style="white-space: normal; margin: 8px 0px 0px; padding: 0px; font-size: 16px; font-weight: normal; max-width: 100%; color: rgb(0, 187, 236); height: 32px; line-height: 18px; font-family: 微软雅黑; border-bottom-color: rgb(227, 227, 227); border-bottom-width: 1px; border-bottom-style: solid; text-align: justify; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px 2px 3px; max-width: 100%; color: rgb(0, 187, 236); line-height: 28px; border-bottom-color: rgb(0, 187, 236); border-bottom-width: 2px; border-bottom-style: solid; float: left; display: block; word-wrap: break-word !important;"><span class="hao" style="margin: 0px 8px 0px 0px; padding: 4px 10px; max-width: 100%; border-top-left-radius: 80%; border-top-right-radius: 100%; border-bottom-right-radius: 90%; border-bottom-left-radius: 20%; color: rgb(255, 255, 255); background-color: rgb(0, 187, 236); word-wrap: break-word !important;">1</span></span><span style="margin: 0px; padding: 0px 2px 7px; max-width: 100%; color: rgb(38, 38, 38); line-height: 28px; border-bottom-color: rgb(0, 187, 236); border-bottom-width: 2px; border-bottom-style: solid; float: left; display: block; word-wrap: break-word !important;"><strong style="color: rgb(60, 117, 45); max-width: 100%; line-height: 24px; word-wrap: break-word !important;">这可输入标题</strong></span></h2> 
	           </div> 
	          </div> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="section.s0002:border-top-color;section.s0002:border-bottom-color"> 
	           <div class="content"> 
	            <section class="s0002" style="display: inline-block; height: 2em; max-width: 100%; line-height: 1em;box-sizing: border-box; border-top: 1.1em solid #00BBEC; border-bottom: 1.1em solid #00BBEC; border-right: 1em solid transparent;">
	             <section style="height: 2em; margin-top: -1em; color: white; padding: 0.5em 1em; max-width: 100%; white-space: nowrap;text-overflow: ellipsis;">
	              这里输入标题
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式2 --> 
	          <div class="element-item" data-color="section.s0002:background-color;section.s0003:color"> 
	           <div class="content"> 
	            <section style="margin: 0.8em 0 0.5em 0;">
	             <section class="s0002" style="display: inline-block; width: 2.5em; height: 2.5em; border-radius: 2em; vertical-align: top; text-align: center; background-color: #00BBEC;">
	              <section style="display: table; width: 100%; ">
	               <section style="display: table-cell; vertical-align: middle; font-weight: bolder; line-height: 1.3em; font-size: 2em; font-family: inherit; font-style: normal; color: rgb(255, 255, 255);">
	                1
	               </section>
	              </section>
	             </section>
	             <section style="display: inline-block; margin-left: 0.7em;padding-top: 0.3em;">
	              <section class="s0003" style="line-height: 1.4em; font-size: 1.5em; font-family: inherit; font-style: normal; color: #00BBEC;">
	               请输入标题
	              </section>
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式3 --> 
	          <div class="element-item" data-color="h2:color;h2 .i_num:background-color"> 
	           <div class="content"> 
	            <h2 style="margin: 8px 0px 0px; padding: 0px; height: 32px; text-align: justify; color: #00BBEC; line-height: 18px; font-family: 微软雅黑; font-size: 16px; font-weight: normal; white-space: normal;"><span style="padding: 0px 2px 3px; line-height: 28px; float: left; display: block;"><span class="i_num" style="padding: 4px 10px; border-radius: 80% 100% 90% 20%; color: rgb(255, 255, 255); margin-right: 8px; background-color: #00BBEC;">1</span><strong class="ue_t">这可输入标题</strong></span></h2> 
	           </div> 
	          </div> 
	          <!--样式4 --> 
	          <div class="element-item" data-color="h2:color;h2 .i_num:background-color"> 
	           <div class="content"> 
	            <h2 style="margin: 8px 0px 0px; padding: 0px; height: 32px; text-align: justify; color: #00BBEC; line-height: 18px; font-family: 微软雅黑; font-size: 16px; font-weight: normal; white-space: normal;"><span style="padding: 0px 2px 3px; line-height: 28px; float: left; display: block;"><span class="i_num" style="padding: 4px 10px; color: #ffffff; margin-right: 8px; background-color: #00BBEC;">2</span><strong class="ue_t">这可输入标题</strong></span></h2> 
	           </div> 
	          </div> 
	          <!--样式5 --> 
	          <div class="element-item" data-color="section .s001:border-top-color;section .s001:border-bottom-color"> 
	           <div class="content"> 
	            <section style="text-align: center; font-size: 1em; vertical-align: middle; white-space: nowrap;">
	             <section class="s001" style="margin: 0 1em; white-space: nowrap; height: 0;border-top: 1.5em solid #00BBEC; border-bottom: 1.5em solid #00BBEC; border-left: 1.5em solid transparent; border-right: 1.5em solid transparent;"></section>
	             <section style="margin: -2.75em 1.65em; white-space: nowrap; height: 0;border-top: 1.3em solid #ffffff; border-bottom: 1.3em solid #ffffff; border-left: 1.3em solid transparent; border-right: 1.3em solid transparent;"></section>
	             <section class="s001" style="margin: 0.45em 2.1em; white-space: nowrap; height: 0; vertical-align: middle;border-top: 1.1em solid #00BBEC; border-bottom: 1.1em solid #00BBEC; border-left: 1.1em solid transparent; border-right: 1.1em solid transparent;">
	              <section style="padding: 0 1em; margin-top: -0.5em; font-size: 1.2em; line-height: 1em; color: white; white-space: nowrap;max-height: 1em; overflow: hidden;">
	               请输入标题
	              </section>
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式6 --> 
	          <div class="element-item" data-color="h2 .i_num:background-color;h2 .i_tit:;h2&gt;span:border-bottom-color"> 
	           <div class="content"> 
	            <h2 style="margin: 8px 0px 0px; padding: 0px; height: 32px; text-align: justify; color: rgb(62, 62, 62); line-height: 18px; font-family: 微软雅黑; font-size: 16px; font-weight: normal; border-bottom-color: rgb(227, 227, 227); border-bottom-width: 1px; border-bottom-style: solid; white-space: normal;"><span style="padding: 0px 2px 3px; color: rgb(0, 112, 192); line-height: 28px; border-bottom-color: #00BBEC; border-bottom-width: 2px; border-bottom-style: solid; float: left; display: block;"><span class="i_num" style="padding: 4px 10px; border-radius: 80% 100% 90% 20%; color: rgb(255, 255, 255); margin-right: 8px; background-color: #00BBEC;">序号.</span><strong class="ue_t i_tit" style="color: #00BBEC;">标题党</strong></span></h2> 
	           </div> 
	          </div> 
	          <!--样式7 --> 
	          <div class="element-item" data-color="h2 .i_num:background-color;h2 .i_tit:color;h2&gt;span:border-bottom-color"> 
	           <div class="content"> 
	            <h2 style="margin: 8px 0px 0px; padding: 0px; height: 32px; text-align: justify; color: rgb(62, 62, 62); line-height: 18px; font-family: 微软雅黑; font-size: 16px; font-weight: normal; border:0; white-space: normal;"><span style="padding: 0px 2px 3px; color: rgb(0, 112, 192); line-height: 28px; border-bottom-color: #00BBEC; border-bottom-width: 2px; border-bottom-style: solid; float: left; display: block;"><span class="i_num" style="padding: 4px 10px; border-radius: 80% 100% 90% 20%; color: rgb(255, 255, 255); margin-right: 8px; background-color: #00BBEC;">序号.</span><strong class="ue_t i_tit" style="color: #00BBEC;">标题党</strong></span></h2> 
	           </div> 
	          </div> 
	          <!--样式8 --> 
	          <div class="element-item" data-color="h2:border-bottom-color;h2&gt;span:border-bottom-color"> 
	           <div class="content"> 
	            <h2 style="white-space: normal; margin: 0; font-weight: normal; font-size: 20px; max-width: 100%; padding: 1px 0; color: rgb(48, 55, 64); font-family: 微软雅黑; text-align: justify; line-height: 2px; height: 35px; border-bottom-color: #00BBEC; border-bottom-width: 1px; border-bottom-style: solid; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="max-width: 100%; padding: 8px 8px 2px; border-bottom-color: #00BBEC; border-bottom-width: 20px; border-bottom-style: solid; float: left; display: block; word-wrap: break-word !important; box-sizing: border-box !important;"><strong style="max-width: 100%; line-height: 24px; word-wrap: break-word !important; box-sizing: border-box !important;"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">1</strong></strong></span><p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; min-height: 1.5em; white-space: pre-wrap; padding: 0px; line-height: 2em; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="background-color: rgb(255, 192, 0);padding: 0 5px;"><strong>标题<span style="font-size: 14px; color: rgb(127, 127, 127);">副标题</span></strong></span><br style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;" /></p></h2> 
	            <p>&nbsp;</p> 
	           </div> 
	          </div> 
	          <!--样式9 --> 
	          <div class="element-item" data-color="h2 .i_num:background-color"> 
	           <div class="content"> 
	            <h2 style="margin: 8px 0px 0px; padding: 0px; height: 32px; text-align: justify; line-height: 18px; font-family: 微软雅黑; font-size: 16px; font-weight: normal; white-space: normal;"><span style="padding: 0px 2px 3px; line-height: 28px; float: left; display: block;"><span class="i_num" style="padding: 4px 10px; border-radius: 80% 100% 90% 20%; color: #ffffff; margin-right: 8px; background-color: #00BBEC;">这可输入标题</span></span></h2> 
	           </div> 
	          </div> 
	          <!--样式10 --> 
	          <div class="element-item" data-color="p span:background-color"> 
	           <div class="content"> 
	            <p style="margin: 0px; padding: 0px; color: rgb(255, 255, 255); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: pre-wrap; word-wrap: break-word !important; min-height: 1.5em; max-width: 100%; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;"><strong><span style="padding: 4px 10px; border-radius: 5px; color: rgb(255, 255, 255); font-family: 微软雅黑,Microsoft YaHei; margin-right: 8px; word-wrap: break-word !important; max-width: 100%; background-color:#00BBEC;">这可输入标题</span></strong></p> 
	           </div> 
	          </div> 
	          <!--样式11 --> 
	          <div class="element-item" data-color="p span:background-color"> 
	           <div class="content"> 
	            <p style="margin: 0px; padding: 0px; color: rgb(255, 255, 255); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: pre-wrap; word-wrap: break-word !important; min-height: 1.5em; max-width: 100%; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;"><strong><span style="padding: 4px 10px; color: rgb(255, 255, 255); font-family: 微软雅黑,Microsoft YaHei; margin-right: 8px; word-wrap: break-word !important; max-width: 100%; background-color:#00BBEC;">这可输入标题</span></strong></p> 
	           </div> 
	          </div> 
	          <!--样式12 --> 
	          <div class="element-item" data-color="h2 span:color;h2 span:border-bottom-color"> 
	           <div class="content"> 
	            <h2 style="font-family: 微软雅黑, 宋体, tahoma, arial; margin: 8px 0px 0px; padding: 0px; font-size: 12px; font-weight: normal; white-space: normal; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(227, 227, 227); height: 32px; line-height: 18px;"><span style="font-family: 微软雅黑, sans-serif !important; font-size: 14px; color: #00BBEC; display: block; float: left; padding: 0px 2px 3px; line-height: 28px; border-bottom-width: 2px; border-bottom-style: solid; border-bottom-color: #00BBEC; font-weight: bold;" class="ue_t">这可输入标题</span></h2> 
	           </div> 
	          </div> 
	          <!--样式13 --> 
	          <div class="element-item" data-color="h2 span:color;h2 span:border-bottom-color"> 
	           <div class="content"> 
	            <h2 style="font-family: 微软雅黑, 宋体, tahoma, arial; margin: 8px 0px 0px; padding: 0px; font-size: 12px; font-weight: normal; white-space: normal; border:0; height: 32px; line-height: 18px;"><span style="font-family: 微软雅黑, sans-serif !important; font-size: 14px; color: #00BBEC; display: block; float: left; padding: 0px 2px 3px; line-height: 28px; border-bottom-width: 2px; border-bottom-style: solid; border-bottom-color: #00BBEC; font-weight: bold;" class="ue_t">这可输入标题</span></h2> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="h2:color;h2:border-left-color"> 
	           <div class="content"> 
	            <h2 style="margin: 5px 0px 13px 0px; padding: 0px 10px; border-width: 0px 0px 0px 5px; border-left-style: solid; border-left-color: #00BBEC; -webkit-font-smoothing: antialiased; font-size: 16px; color: #00BBEC; font-family: Georgia, Simsun, serif; line-height: 25px; white-space: normal;font-family: 微软雅黑;" class="ue_t">这可输入标题</h2> 
	           </div> 
	          </div> 
	          <!--样式14
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section style="text-align: center; margin: 0 1em; line-height: 1.6em; ">
	             <img style="height: 36px !important;width: 100%; vertical-align: middle;" src="/static/img/images/640.png" />
	             <section style="color: white; font-size: 1em; margin-top: -2.1em; white-space: nowrap;">
	              请输入标题
	             </section>
	            </section> 
	           </div> 
	          </div>  --> 
	          <!--样式15 --> 
	          <div class="element-item" data-color="blockquote:border-left-color"> 
	           <div class="content"> 
	            <blockquote data-mce-style="margin: 5px 0px 0px; padding: 10px; max-width: 100%; orphans: 2; widows: 2; line-height: 25px; font-family: arial, helvetica, sans-serif; text-shadow: #225f87 0px 1px 0px; color: #ffffff; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; box-shadow: #999999 2px 2px 4px; border-left-width: 10px; border-left-style: solid; border-left-color: #fdd000; background-color: #373939; word-wrap: break-word !important;" style="max-width: 100%; line-height: 25px; white-space: normal; font-size: 14px; font-family: arial, helvetica, sans-serif; margin: 5px 0px 0px; padding: 10px; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; color: rgb(255, 255, 255); border-left-color: rgb(0, 187, 236); border-left-width: 10px; border-left-style: solid; box-shadow: rgb(153, 153, 153) 2px 2px 4px; text-shadow: rgb(34, 95, 135) 0px 1px 0px; background-color: rgb(55, 57, 57); word-wrap: break-word !important; box-sizing: border-box !important;"> 
	             <strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; font-family: 微软雅黑; font-size: 16px;">1、这里输入标题</span></strong> 
	            </blockquote> 
	           </div> 
	          </div> 
	          <!--样式16--> 
	          <div class="element-item" data-color="strong.span:text-shadow"> 
	           <div class="content"> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: 微软雅黑; line-height: 25px; background-color: rgb(255, 255, 255); box-sizing: border-box !important;"> <strong style="color: rgb(255, 255, 255); max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><span glowfont="display:inline-block; color:white; text-shadow:1px 0 4px #ff0000,0 1px 4px #ff0000,0 -1px 4px #ff0000,-1px 0 4px #ff0000;filter:glow(color=#ff0000,strength=3)" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; display: inline-block; text-shadow: rgb(0, 187, 236) 1px 0px 4px, rgb(0, 187, 236) 0px 1px 4px, rgb(0, 187, 236) 0px -1px 4px, rgb(0, 187, 236) -1px 0px 4px;">请输入标题</span></strong><br /> </p> 
	           </div> 
	          </div> 
	          <!--样式17--> 
	          <div class="element-item" data-color="span:background-color"> 
	           <div class="content"> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: normal; color: rgb(62, 62, 62); font-family: 微软雅黑; line-height: 25px; background-color: rgb(255, 255, 255); box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding: 4px 10px; border-top-left-radius: 0.5em 4em; border-top-right-radius: 3em 1em; border-bottom-right-radius: 0.5em 2em; border-bottom-left-radius: 3em 1em; text-align: justify; color: rgb(255, 255, 255); font-family: 微软雅黑, sans-serif; box-shadow: rgb(165, 165, 165) 4px 4px 2px; background-color: rgb(0, 187, 236);"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">请输入标题</span></strong></strong></span> </p> 
	           </div> 
	          </div>
	         </div> 
	        </div> 
	        <div style="display: none;" id="tab2" class="tab_con"> 
	         <div class="element-list" style="width: 100%;"> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="span:color"> 
	           <div class="content"> 
	            <fieldset style="border: 0px; margin: 1em 0px; ">
	             <span style="float: left; padding-right: 0.1em; font-size: 2.7em; line-height: 1em; font-family: inherit; text-align: inherit; text-decoration: inherit; color: rgb(0, 187, 236);">请</span>这里输入文字内容... 在线微信内容编辑器
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="span.main:background-color"> 
	           <div class="content"> 
	          <blockquote class="brcolor" style="max-width: 100%; margin: 5px 0px 0px; padding: 10px; border-left-width: 10px; border-left-style: solid; border-color: rgb(212, 110, 110); color: rgb(62, 62, 62); white-space: normal; border-right-width: 10px; border-right-style: solid; font-family: arial, helvetica, sans-serif; font-size: 14px; box-shadow: rgb(153, 153, 153) 2px 1px 4px; border-radius: 4px; word-wrap: break-word !important; box-sizing: border-box !important; background-color: rgba(255, 255, 255, 0.388235);"> 
	           <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; box-sizing: border-box; min-height: 1em; font-family: inherit; font-weight: inherit; text-align: inherit; font-size: 0.65em; line-height: 1.75em; padding-left: 3px; text-decoration: inherit; color: rgb(51, 51, 51);"> <span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; font-size: 14px;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">微信编辑&nbsp; 这里输入文字内容</span></span> </p> 
	          </blockquote> 
	          	</div> 
	          </div> 
	          <p> <br /> </p> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="span.main:background-color"> 
	           <div class="content"> 
	            <section style="max-width:100%;color:#3e3e3e;font-family:微软雅黑;line-height:25px;white-space:normal;background-color:#fff;padding:0;word-wrap:break-word!important;box-sizing:border-box!important">
	             <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin-left:1em;line-height:1.4em">
	              <span class="main" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;font-size:.8em;font-family:inherit;padding:.2em .5em;border-top-left-radius:.3em;border-top-right-radius:.3em;border-bottom-right-radius:.3em;border-bottom-left-radius:.3em;color:#fff;text-align:center;background-color:#00bbec">这输入标题</span>&nbsp;
	              <span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:1.2em;padding:.2em .5em;margin-left:.3em;border-top-left-radius:1.2em;border-top-right-radius:1.2em;border-bottom-right-radius:1.2em;border-bottom-left-radius:1.2em;color:#fff;font-size:.8em;line-height:1.2em;font-family:inherit;background-color:#ccc">微信号：weixinhao</span>
	             </section>
	             <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin-top:-.7em;padding:1.4em 1em 1em;border:1px solid #c0c8d1;border-top-left-radius:.3em;border-top-right-radius:.3em;border-bottom-right-radius:.3em;border-bottom-left-radius:.3em;color:#333;font-size:1em;font-family:inherit;background-color:#efefef">
	              可在这输入内容，微信编辑器，微信编辑器。
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="section.main1:border-color;section.main2:border-color;section.main3:border-color;section.main4:border-color;section.main5:border-color;"> 
	           <div class="content"> 
	            <fieldset style="margin:.5em 0;padding:0;border:0;max-width:100%;color: rgb(68, 68, 68);font-family:微软雅黑;line-height:25px;white-space:normal;background-color:#fff;word-wrap:break-word!important;box-sizing:border-box!important">
	             <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box;height:1em">
	              <section class="main1" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:16px;width:1.5em;float:left;border-top-width:.4em;border-top-style:solid;border-color: rgb(0, 187, 236);border-left-width:.4em;border-left-style:solid"></section>
	              <section class="main2" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:16px;width:1.5em;float:right;border-top-width:.4em;border-top-style:solid;border-color: rgb(0, 187, 236);border-right-width:.4em;border-right-style:solid"></section>
	             </section>
	             <section class="main3" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box;margin:-.8em .1em -.8em .2em;padding:.8em;border:1px solid  rgb(0, 187, 236);border-top-left-radius:.3em;border-top-right-radius:.3em;border-bottom-right-radius:.3em;border-bottom-left-radius:.3em">
	              <section style="max-width:100%;word-wrap:break-word;box-sizing:border-box!important;padding:0;margin:0;border:none;line-height:1.4;word-break:break-all;background-image:none;font-size:1em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:rgb(68, 68, 68)">
	               可在这输入内容， 微信编辑器，微信编辑器。
	              </section>
	             </section>
	             <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box;height:1em">
	              <section class="main4" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:16px;width:1.5em;float:left;border-bottom-width:.4em;border-bottom-style:solid;border-color: rgb(0, 187, 236);border-left-width:.4em;border-left-style:solid"></section>
	              <section class="main5" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:16px;width:1.5em;float:right;border-bottom-width:.4em;border-bottom-style:solid;border-color: rgb(0, 187, 236);border-right-width:.4em;border-right-style:solid"></section>
	             </section>
	            </fieldset> 
	           </div> 
	          </div> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="margin: 0px; padding: 10px; border: 6px double rgb(0, 187, 236); color: rgb(68, 68, 68); font-family: 微软雅黑; word-break: break-all; word-wrap: break-word !important; box-sizing: border-box !important;">
	             <p class="ue_t" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px;">可在这输入内容， 微信编辑器，微信编辑器。</p> 
	            </blockquote> 
	           </div> 
	          </div> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="section.main:background-color"> 
	           <div class="content"> 
	            <section style="max-width:100%;color:#3e3e3e;font-family:'Helvetica Neue',Helvetica,'Hiragino Sans GB','Microsoft YaHei',微软雅黑,Arial,sans-serif;line-height:25px;white-space:normal;background-color:#fff;word-wrap:break-word!important;box-sizing:border-box!important">
	             <section style="max-width:100%;margin:0;border:1px solid #e2e2e2;box-shadow:#e2e2e2 0 1em .1em -.8em;font-size:1em;line-height:1em;padding:.5em;text-align:right;word-wrap:break-word!important;box-sizing:border-box!important">
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;vertical-align:top;width:1.2em;line-height:1.2em;margin-right:.2em;font-size:.7em;font-family:inherit;color:#787c81">
	               展现微信营销魅力
	              </section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;vertical-align:top;width:1.2em;line-height:1.2em;margin-right:.2em;font-size:.7em;font-family:inherit;color:#787c81">
	               引领微信内容新风尚
	              </section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;vertical-align:top;width:1.2em;line-height:1.2em;margin-right:.2em;font-size:.7em;font-family:inherit;color:#787c81">
	               微信营销权威发布
	              </section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;vertical-align:top;width:1.2em;line-height:1.2em;margin-right:.2em;font-size:.7em;font-family:inherit;color:#787c81">
	               微信营销整体解决方案提供商
	              </section>
	              <section class="main" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;vertical-align:top;width:1.2em;line-height:1.2em;text-align:center;margin-right:1em;background-color:#00bbec">
	               <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;font-size:1em;font-family:inherit;color:#fff">
	                专业
	               </section>
	              </section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;vertical-align:top;width:1.2em;line-height:1em;font-size:1.5em;font-family:inherit">
	               微信编辑器
	              </section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;text-align:left;line-height:1.6em;font-size:.8em;font-family:inherit">
	               微信号：weixinhao
	              </section>
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式1 --> 
	          <div class="element-item" data-color="section.main:background-color;section.main2:border-color"> 
	           <div class="content"> 
	            <fieldset style="margin-left: 10px; padding: 0px; border: 0px; max-width: 100%; color: rgb(62, 62, 62); font-family: 微软雅黑; line-height: 25px; white-space: normal; background-color: rgb(255, 255, 255); word-wrap: break-word !important; box-sizing: border-box !important;">
	             <section style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; margin-left: -0.5em; line-height: 1.4em;">
	              <section class="main" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; display: inline-block; padding: 0.2em 0.5em; border-top-left-radius: 0.3em; border-top-right-radius: 0.3em; border-bottom-right-radius: 0.3em; border-bottom-left-radius: 0.3em; color: white; font-size: 0.8em; text-align: center; -webkit-transform: rotateZ(-10deg); -webkit-transform-origin: 0% 100%; background-color: #00BBEC;">
	               我的观点
	              </section>
	             </section>
	             <section class="main2" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; margin-top: -1.5em; border: 1px solid #00BBEC; font-size: 1em;">
	              <section style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding: 1.4em 1em 1em;">
	               <span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; font-size: 1em; line-height: 1.2; font-family: inherit; text-align: inherit; text-decoration: inherit; color: rgb(253, 176, 0);"></span>
	               <span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; font-size: 1em; line-height: 1.2; font-family: inherit; text-align: inherit; text-decoration: inherit; color: rgb(51, 51, 51);">可在这输入内容， 微信编辑器，微信编辑器。</span>
	              </section>
	             </section>
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="margin: 0px; padding: 15px; border: 3px dashed #00BBEC;border-radius: 10px;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="margin: 0px; padding: 15px; border: 1px solid #00BBEC;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="margin: 0px; padding: 15px; border: 1px solid #00BBEC;border-radius: 5px;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-left-color"> 
	           <div class="content"> 
	            <blockquote style="margin:0;max-width: 100%; word-wrap: break-word; padding: 15px 25px; top: 0px; line-height: 24px; font-size: 14px; vertical-align: baseline; border-left-color: #00BBEC; border-left-width: 10px; border-left-style: solid; display: block; background-color: #efefef;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="margin: 0px; padding: 20px 15px 15px 48px; border: 1px solid #00BBEC; border-radius: 5px; line-height: 1.5; background-image: url(/static/img/images/mmbizgif.gif); background-position: 10px 11px; background-repeat: no-repeat;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="margin: 0px; padding: 20px 15px 15px 48px; border: 1px solid #00BBEC; border-radius: 5px; line-height: 1.5; background-image: url(/static/img/images/mh.png); background-position: 10px 11px; background-repeat: no-repeat;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="fieldset&gt;legend&gt;p:background-color;fieldset:border-color"> 
	           <div class="content"> 
	            <fieldset style="padding: 15px; border: 1px dotted #00BBEC; line-height: 2em; font-family: 宋体; word-wrap: break-word !important; min-height: 1.5em; max-width: 100%; border-bottom-right-radius: 15px; border-bottom-left-radius: 10px;"> 
	             <legend style="margin: 0px; padding: 0px; text-align: center; color: rgb(0, 0, 0); font-family: 微软雅黑; word-wrap: break-word !important; max-width: 100%;"> <p style="margin: 0px; padding: 0px 20px 4px; color: rgb(255, 255, 255); line-height: 2em; font-size: 14px; white-space: pre-wrap; word-break: normal; word-wrap: normal; min-height: 1.5em; max-width: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; background-color: #00BBEC;"><strong style="max-width: 100%;" class="ue_t">请输入标题</strong></p> </legend> 
	             <p style="margin: 0px; padding: 0px; line-height: 2em; word-break: normal; word-wrap: normal; min-height: 1.5em; max-width: 100%;"> <span style="line-height: 2em; word-wrap: break-word !important; max-width: 100%;" class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</span> </p> 
	            </fieldset> 
	           </div> 
	          </div> 
	          <!--样式8 --> 
	          <div class="element-item" data-color="fieldset&gt;legend&gt;span:background-color;fieldset:border-color"> 
	           <div class="content"> 
	            <fieldset style="margin: 0px; padding: 5px; border: 1px solid #00BBEC;"> 
	             <legend style="margin: 0px 10px;"><span style="padding: 5px 10px; color: #ffffff; font-weight: bold; font-size: 14px; background-color: #00BBEC;" class="ue_t">这输入标题</span></legend> 
	             <blockquote style="margin: 0px; padding: 10px; "> 
	              <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p> 
	             </blockquote> 
	            </fieldset> 
	           </div> 
	          </div> 
	          <!--样式9--> 
	          <div class="element-item" data-color="fieldset&gt;legend&gt;span:background-color;fieldset:border-color"> 
	           <div class="content"> 
	            <fieldset style="margin: 0px; padding: 5px; border: 1px solid #00BBEC;"> 
	             <legend style="margin: 0px 10px;"><span style="padding: 5px 10px; color: #ffffff; font-weight: bold; font-size: 14px; background-color: #00BBEC;border-radius: 5px;" class="ue_t">这输入标题</span></legend> 
	             <blockquote style="margin: 0px; padding: 10px; "> 
	              <p class="ue_t">我的标题是圆角，如果看我和上面长得一样，那是因为你的浏览器版本被全国 N% 的电脑击败了。</p> 
	             </blockquote> 
	            </fieldset> 
	           </div> 
	          </div> 
	          <!--样式10--> 
	          <div class="element-item" data-color="fieldset&gt;legend&gt;span:background-color;fieldset:border-color"> 
	           <div class="content"> 
	            <fieldset style="margin: 0px; padding: 5px; border: 1px solid #00BBEC;border-radius: 5px;background-color: #efefef;"> 
	             <legend style="margin: 0px 10px;"><span style="padding: 5px 10px; color: #ffffff; font-weight: bold; font-size: 14px; background-color: #00BBEC;border-radius: 5px;" class="ue_t">这输入标题</span></legend> 
	             <blockquote style="margin: 0px; padding: 10px;"> 
	              <p class="ue_t">我的标题内容区是圆角,微信编辑器 </p> 
	             </blockquote> 
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="fieldset&gt;legend&gt;span&gt;strong&gt;span:background-color;fieldset:border-color"> 
	           <div class="content"> 
	            <fieldset style="font: 16px/24px 宋体; margin: 0px; padding: 15px; border: 1px solid #00BBEC; text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; word-wrap: break-word !important; max-width: 100%; orphans: 2; widows: 2; font-size-adjust: none; font-stretch: normal; box-shadow: 5px 5px 2px rgb(165,165,165); background-color: #efefef; -webkit-text-stroke-width: 0px;">
	             <legend style="margin: 0px; padding: 0px; text-align: center; font-size: medium; word-wrap: break-word !important; max-width: 100%;"><span style="font-family: 微软雅黑; font-size: 14px; word-wrap: break-word !important; max-width: 100%;"><strong style="word-wrap: break-word !important; max-width: 100%;"><span style="padding: 4px 10px; border-radius: 2em 1em 4em / 0.5em 3em; color: rgb(255, 255, 255); word-wrap: break-word !important; max-width: 100%; box-shadow: 4px 4px 2px rgb(165,165,165); background-color: #00BBEC;">这输入标题</span></strong></span></legend>
	             <p style="font: 14px/24px 微软雅黑, Microsoft YaHei; color: rgb(89, 89, 89); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; word-wrap: break-word !important; max-width: 100%; orphans: 2; widows: 2; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="fieldset&gt;legend&gt;span&gt;strong&gt;span:background-color;fieldset:border-color"> 
	           <div class="content"> 
	            <fieldset style="font: 16px/24px 宋体; margin: 0px; padding: 15px; border: 1px solid #00BBEC; text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; word-wrap: break-word !important; max-width: 100%; orphans: 2; widows: 2; font-size-adjust: none; font-stretch: normal; background-color: #efefef; -webkit-text-stroke-width: 0px;">
	             <legend style="margin: 0px; padding: 0px; text-align: center; font-size: medium; word-wrap: break-word !important; max-width: 100%;"><span style="font-family: 微软雅黑; font-size: 14px; word-wrap: break-word !important; max-width: 100%;"><strong style="word-wrap: break-word !important; max-width: 100%;"><span style="padding: 4px 10px; border-radius: 2em 1em 4em / 0.5em 3em; color: #ffffff; word-wrap: break-word !important; max-width: 100%; background-color: #00BBEC;">这输入标题</span></strong></span></legend>
	             <p style="font: 14px/24px 微软雅黑, Microsoft YaHei; color: rgb(89, 89, 89); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; word-wrap: break-word !important; max-width: 100%; orphans: 2; widows: 2; font-size-adjust: none; font-stretch: normal; -webkit-text-stroke-width: 0px;">我是IOS7风格，没阴影。</p>
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:background-color"> 
	           <div class="content"> 
	            <blockquote style="margin:0 ;border-bottom: rgb(225,225,225) 2px dotted; text-align: justify; border-left: rgb(225,225,225) 2px dotted; padding-bottom: 10px; widows: 2; text-transform: none; background-color: #00BBEC; text-indent: 0px; padding-left: 20px; padding-right: 20px; font: medium/21px 微软雅黑; max-width: 100%; white-space: normal; orphans: 2; letter-spacing: normal; color: #ffffff; border-top: rgb(225,225,225) 2px dotted; border-right: rgb(225,225,225) 2px dotted; word-spacing: 0px; padding-top: 10px; box-shadow: rgb(225, 225, 225) 5px 5px 2px; border-top-left-radius: 0.5em 4em; border-top-right-radius: 3em 0.5em; -webkit-text-size-adjust: none; -webkit-text-stroke-width: 0px; border-bottom-right-radius: 0.5em 1em; border-bottom-left-radius: 0em 3em">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:background-color"> 
	           <div class="content"> 
	            <blockquote style="margin:0 ;border-width: 2px; font: 16px/24px 微软雅黑; padding: 10px 15px; border-radius: 5px; color: rgb(255, 255, 255); text-transform: none; text-indent: 0px; letter-spacing: normal; word-spacing: 0px; white-space: normal; font-size-adjust: none; font-stretch: normal; background-color: #00BBEC; -webkit-text-stroke-width: 0px;">
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote.f:background-color;"> 
	           <div class="content"> 
	            <blockquote class="f" style="max-width: 100%; margin: 0; padding: 5px 15px; color: rgb(255, 255, 255); line-height: 25px; font-weight: bold; background-color: #00BBEC; text-align: left;border-radius: 5px 5px 0 0;border: 0;">
	             <span class="ue_t">这输入标题</span>
	            </blockquote> 
	            <blockquote class="l" style="max-width: 100%; margin: 0px; padding: 10px 15px 20px 15px; border-radius: 0 0 5px 5px;border: 0 ;background-color: #efefef; line-height: 25px;"> 
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote.f:background-color;blockquote.l:border-color"> 
	           <div class="content"> 
	            <blockquote class="f" style="max-width: 100%; margin: 0; padding: 5px 15px; color: #ffffff; line-height: 25px; font-weight: bold; background-color: #00BBEC; text-align: left;border-radius: 5px 5px 0 0;border: 0;">
	             <span class="ue_t">这输入标题</span>
	            </blockquote> 
	            <blockquote class="l" style="max-width: 100%; margin: 0px; padding: 10px 15px 20px 15px; border-radius: 0 0 5px 5px;border: 1px solid #00BBEC; line-height: 25px;"> 
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote.f:background-color;blockquote.l:border-color"> 
	           <div class="content"> 
	            <blockquote class="f" style="max-width: 100%; margin: 0; padding: 5px 15px; color: #ffffff; line-height: 25px; font-weight: bold; background-color: #00BBEC; text-align: left;border-radius: 5px 5px 0 0;border: 0;display:inline-block;">
	             <span class="ue_t">这输入标题</span>
	            </blockquote> 
	            <blockquote class="l" style="max-width: 100%; margin: 0px; padding: 10px 15px; border: 1px solid #00BBEC; line-height: 25px;"> 
	             <p class="ue_t">可在这输入内容， 微信编辑器，微信编辑器。</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="section:border-color;section .s0002:background-color;"> 
	           <div class="content"> 
	            <section> 
	             <section style="margin:0; border: 1px solid #00BBEC; text-align: center;"> 
	              <section class="s0001" style="margin: 1em auto; width: 12em; height: 12em;border-radius: 6em; border: 0.1em solid #00BBEC;"> 
	               <section class="s0002" style="width: 11em; height: 11em;margin: 0.4em auto; border-radius: 5.5em; background-color: #00BBEC; text-align:center; display: table; max-height: 11em;"> 
	                <section style="display: table-cell; vertical-align: middle; font-size: 1.5em; line-height: 1.2em; margin: 1em;padding: 1em; color: white; max-height: 11em;">
	                 请输入标题
	                </section> 
	               </section> 
	              </section> 
	              <section class="s0002" style="display: inline-block; margin: 1em 1em 2em; color: white; background-color: #00BBEC; font-size: 1em; line-height: 1.5em;padding: 0.5em 1em; border-radius: 1em; white-space: nowrap; max-width: 100%;">
	               副标题
	              </section> 
	             </section> 
	             <section style="margin:0; padding: 1em; color: #000000; text-align: center; border: 1px solid #00BBEC; border-top: 0; font-size: 1em; line-height: 1.4em;">
	              <p>请输入内容请输入内容<br />请输入内容请输入内容</p>
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="section:border-color;section.s0001:background-color;section.s0002:border-top-color;section.s0002:border-bottom-color"> 
	           <div class="content"> 
	            <section> 
	             <section style="background-color: white; border: 1px solid #00BBEC; box-shadow: rgb(165, 165, 165) 0em 1em 0.1em -0.6em; line-height: 1.6em;">
	              <section class="s0001" style="padding: 1em; text-align: center; font-size: 1.4em; font-weight: bold; line-height: 1.4em; color: white;background-color: #00BBEC; ">
	               请输入名称
	              </section>
	              <section style="text-align: left; margin-top: 1.5em;">
	               <img style="vertical-align: top; margin-left: 1em; width: 30px;" src="/static/img/images/640_006.png" />
	               <section style="display: inline-block; width: 40%; margin-left: 0.5em; padding: 0.2em;">
	                时间
	               </section>
	              </section>
	              <section style="text-align: left; margin-top: 1em;">
	               <img style="vertical-align: top; margin-left: 1em; width: 30px;" src="/static/img/images/640_002.png" />
	               <section style="display: inline-block; width: 40%; margin-left: 0.5em; padding: 0.2em;">
	                地点
	               </section>
	              </section>
	              <br />
	              <br />
	              <br />
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="section.s0002:border-top-color;section.s0002:border-bottom-color"> 
	           <div class="content"> 
	            <section class="s0002" style="margin-top: 1.5em; display: inline-block; height: 2em; max-width: 100%; line-height: 1em;box-sizing: border-box; border-top: 1.1em solid #00BBEC; border-bottom: 1.1em solid #00BBEC; border-right: 1em solid transparent;">
	             <section style="height: 2em; margin-top: -1em; color: white; padding: 0.5em 1em; max-width: 100%; white-space: nowrap;text-overflow: ellipsis;">
	              事项1
	             </section>
	            </section> 
	            <section style="padding: 1em;">
	             <p>请输入活动内容<br />请输入活动内容<br />......</p>
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <blockquote style="max-width: 100%; margin: 0px; padding: 10px 15px; border: 6px solid #00BBEC; border-top-left-radius: 50px; border-bottom-right-radius: 50px; box-shadow: rgb(165, 165, 165) 5px 5px 2px; word-wrap: break-word !important;">
	             <p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 24px; max-width: 100%; min-height: 1.5em; word-wrap: break-word !important;">看见我左上角 和 右下角的曲线美了没；没看到的话，那是…………你的电脑又被全国 N% 的电脑击败了。微信编辑器</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="p:border-color;span:color"> 
	           <div class="content"> 
	            <p style="margin: 15px; max-width: 100%; word-wrap: normal; min-height: 1.5em; white-space: pre-wrap; padding: 20px; border: 1px dotted rgb(0, 187, 236); text-align: justify; color: rgb(73, 68, 41); line-height: 2em; font-family: 微软雅黑; font-size: 14px; border-bottom-right-radius: 15px; border-bottom-left-radius: 10px; background-color: rgb(255, 255, 255); box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(0, 187, 236);"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">请输入内容</strong></span> </p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="span:color"> 
	           <div class="content"> 
	            <fieldset class="comment_quote" style="margin: 5px 0px; padding: 5px; border: 1px solid rgb(204, 204, 204); max-width: 100%; color: rgb(62, 62, 62); font-family: 微软雅黑; line-height: 25px; white-space: normal; box-shadow: rgb(165, 165, 165) 5px 5px 2px; background-color: rgb(248, 247, 245); word-wrap: break-word !important; box-sizing: border-box !important;">
	             <legend style="padding: 0px; max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; margin: 0px; line-height: 1.8em;"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(89, 89, 89); font-family: 微软雅黑; font-size: 18px; line-height: 42.66666793823242px; text-align: center; white-space: pre-wrap;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(0, 187, 236); text-shadow: rgb(201, 201, 201) 5px 3px 1px;">精彩内容</span></strong></legend>
	             <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: pre-wrap; box-sizing: border-box !important;">请输入内容<br /></p>
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <blockquote style="max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 25.600000381469727px; background-color: rgb(255, 255, 255); margin: 0.2em; padding: 10px; border: 3px solid rgb(201, 201, 201); border-image-source: none; font-family: 微软雅黑; box-shadow: rgb(170, 170, 170) 0px 0px 10px; -webkit-box-shadow: rgb(170, 170, 170) 0px 0px 10px; word-wrap: break-word !important; box-sizing: border-box !important;"> 
	             <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; box-sizing: border-box !important;"> <span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; line-height: 25.6000003814697px;">可在这输入内容， 微信编辑器，微信编辑器。</span> </p> 
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="blockquote:border-color"> 
	           <div class="content"> 
	            <p>&nbsp;</p> 
	            <section style="color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, 'Trebuchet MS'; background: url(/static/img/images/line-bg.png) 104px 30px repeat-y;"> 
	             <p style="line-height: 40px;font-size:24px;">2014年</p> 
	             <h1 style="line-height: 40px;margin-top:-40px; margin-left: 85px; padding-left: 60px; top: 0px; color: rgb(88, 166, 251); font-size: 24px; background: url(/static/img/images/clock.png) 0% 0% no-repeat;">台更新日志</h1> 
	             <section style="clear: both; line-height: 32px;"> 
	              <p style="line-height: 32px;">&nbsp;</p> 
	              <p style="font-size: 20px; line-height: 32px;">9月8日</p> 
	              <p style="margin-top: -42px; margin-left: 90px;"><img src="/static/img/images/circle-h.png" style="vertical-align:bottom" /></p> 
	              <section style="margin-left: 140px; margin-top: -32px;"> 
	               <p style="color: rgb(99, 208, 41); font-size: 20px;">微信图文编辑器上线！</p> 
	               <p>提供丰富的图文样式,微信编辑器</p> 
	               <p>自由定义颜色，批量更换颜色,微信编辑器</p> 
	               <p>&nbsp;</p> 
	              </section> 
	              <p style="line-height: 32px; font-size: 20px;">9月3日</p> 
	              <p style="margin-top: -42px; margin-left: 90px; line-height: 32px;"><img src="/static/img/images/circle-h.png" style="vertical-align:bottom" /></p> 
	              <section style="margin-left: 140px; margin-top: -32px;"> 
	               <p style="color: rgb(99, 208, 41); font-size: 20px;">测试测试测试测试</p> 
	               <p>新增了一大批功能,微信编辑器</p> 
	              </section> 
	              <p>&nbsp;</p> 
	              <p>&nbsp;</p> 
	             </section> 
	            </section> 
	            <p>&nbsp;</p>
	           </div> 
	          </div> 
	         </div> 
	        </div> 
	        <div style="display: none;" id="tab3" class="tab_con"> 
	         <div class="element-list" style="width: 100%;"> 
	          <!--样式-0 --> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img src="/static/img/images/0_018.gif" width="100%" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_036.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="section.main2:border-color;p.main2:border-color"> 
	           <div class="content"> 
	            <section style="margin-top:15px; max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">
	             <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">
	               <section style="max-width:100%;color:#222;font-family:微软雅黑,arial,sans-serif;font-size:14px;height:75px;background-color:#fff;word-wrap:break-word!important;box-sizing:border-box!important">
	                <section class="main" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-right-radius:50px;border-bottom-left-radius:50px;padding:5px;border:2px solid #00bbec;margin:0">
	                 <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;float:left;height:60px;width:60px">
	                  <img class="awb_avatar" data-src="imges/0.png" data-ratio="1" data-w="60" _width="60px" src="/static/img/images/0_008.png" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:auto!important;border:0;border-top-left-radius:30px;border-top-right-radius:30px;border-bottom-right-radius:30px;border-bottom-left-radius:30px;width:60px!important;float:left;visibility:visible!important" />
	                  <img data-src="imges/01.png" data-ratio="1" data-w="20" src="/static/img/images/01.png" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;height:auto!important;border:0;float:right;margin-top:-60px;width:auto!important;visibility:visible!important" />
	                 </section>
	                 <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block;height:60px;padding:0 10px;line-height:30px">
	                  <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;border-bottom-width:1px;border-bottom-color:#767676;border-bottom-style:dashed">
	                   <span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;color:#000;font-weight:bold">点击「<span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;color:#16b3ff">箭头所指处</span>」可快速关注</span>
	                  </section>
	                  <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">
	                   <span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;color:#000">微信号：<span class="awb_wxwechatid" style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;color:#b00">XXXXXXXXX</span></span>
	                  </section>
	                 </section>
	                </section>
	                <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin:-98px 0 0 80px">
	                 <p class="main" style="margin-top:0;margin-bottom:0;max-width:100%;word-wrap:normal;min-height:1em;white-space:pre-wrap;padding:0;width:0;height:0;border-width:12px;border-style:solid;border-color:transparent transparent #00bbec;float:none;box-sizing:border-box!important"><br style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important" /></p>
	                 <p style="margin-top:-21px;margin-bottom:0;max-width:100%;word-wrap:normal;min-height:1em;white-space:pre-wrap;padding:0;width:0;height:0;border-width:12px;border-style:solid;border-color:transparent transparent #fff;float:none;box-sizing:border-box!important"><br style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important" /></p>
	                </section>
	               </section>
	              </section>
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式-1 --> 
	          <div class="element-item" data-color="blockquote.main:background-color;span.main:background-color:;span.main2:color"> 
	           <div class="content"> 
	            <blockquote class="main" style="padding:5px 20px;margin:0;font-family:微软雅黑;font-size:16px;white-space:normal;max-width:100%;border:2px #42f9ff;color:#fff;text-align:center;font-weight:700;line-height:24px;width:180px;background-color:#00bbec;border-top-left-radius:15px;border-top-right-radius:15px;box-shadow:#999 0 -1px 6px;border-bottom-left-radius:2px;border-bottom-right-radius:2px;text-shadow:#0a0a0a 0 -1px 2px;word-wrap:break-word!important;box-sizing:border-box!important">
	             微信名
	            </blockquote>
	            <blockquote style="padding:10px;margin:0;font-family:微软雅黑;font-size:12px;white-space:normal;max-width:100%;color:#3e3e3e;border:1px solid #ccc;line-height:24px;background-color:#e4e4e4;border-top-left-radius:0;border-top-right-radius:0;box-shadow:#ccc 0 -1px 6px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;word-wrap:break-word!important;box-sizing:border-box!important">
	             <span style="max-width:100%;color:#00b050;word-wrap:break-word!important;box-sizing:border-box!important">微信号：</span>
	             <span style="max-width:100%;font-weight:700;word-wrap:break-word!important;box-sizing:border-box!important"></span>
	             <span class="main" style="max-width:100%;font-weight:700;color:#fff;padding:2px 5px;background-color:#00bbec;word-wrap:break-word!important;box-sizing:border-box!important">weixinhao</span>
	             <span class="main2" style="max-width:100%;color:#00bbec;padding-left:5px;word-wrap:break-word!important;box-sizing:border-box!important">(←长按复制)</span>
	             <p style="padding:10px 0 0;margin-top:0;margin-bottom:0;max-width:100%;word-wrap:normal;min-height:1.5em;white-space:pre-wrap;word-break:normal;color:#666;line-height:2em;box-sizing:border-box!important">微信营销整体解决方案提供商</p>
	            </blockquote> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="fieldset:border-color;span.main:background-color"> 
	           <div class="content"> 
	            <fieldset style="padding: 5px; margin: 0px; border: 1px solid rgb(0, 187, 236); background-color: rgb(248, 247, 245); color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 12px; white-space: normal;">
	             <legend style="margin: 0px 10px;"><span class="main" style="padding: 5px 10px; color: rgb(255, 255, 255); font-weight: bold; font-size: 14px; background-color: rgb(0, 187, 236); border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;"><span style="color: rgb(255, 255, 255); font-family: 微软雅黑; font-size: 14px; line-height: 24px; max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">点微信名</span><img data-s="300,640" data-src="/static/img/images/640_005.png" data-ratio="1.35" data-w="20" src="/static/img/images/640_005.png" style="max-width: 100%; color: rgb(255, 255, 255); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal; border: 0px; height: auto !important; word-wrap: break-word !important; box-sizing: border-box !important; visibility: visible !important;" /><span style="color: rgb(255, 255, 255); font-family: 微软雅黑; font-size: 14px; line-height: 24px;">关注我哟</span></span></legend>
	             <blockquote style="padding: 0px; margin: 0px;">
	              <p style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"><span style="font-family: 微软雅黑; line-height: 24px; max-width: 100%; color: rgb(255, 192, 0); font-size: 14px; word-wrap: break-word !important; box-sizing: border-box !important;"></span><span style="font-family: 微软雅黑; line-height: 24px; background-color: rgb(248, 247, 245); max-width: 100%; color: rgb(255, 192, 0); font-size: 14px; word-wrap: break-word !important; box-sizing: border-box !important;">☀&nbsp;</span><span style="font-family: 微软雅黑; background-color: rgb(248, 247, 245); max-width: 100%; font-size: 12px; color: rgb(127, 127, 127); line-height: 28px; white-space: pre-wrap; word-wrap: break-word !important; box-sizing: border-box !important;">定期推送微信营销</span><span style="font-family: 微软雅黑; background-color: rgb(248, 247, 245); max-width: 100%; font-size: 12px; color: rgb(255, 192, 0); line-height: 28px; white-space: pre-wrap; word-wrap: break-word !important; box-sizing: border-box !important;">微信运营</span><span style="font-family: 微软雅黑; background-color: rgb(248, 247, 245); max-width: 100%; font-size: 12px; color: rgb(127, 127, 127); line-height: 28px; white-space: pre-wrap; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">，<span style="max-width: 100%; color: rgb(0, 176, 80); word-wrap: break-word !important; box-sizing: border-box !important;">微信平台搭建</span><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">，<span style="max-width: 100%; color: rgb(112, 48, 160); word-wrap: break-word !important; box-sizing: border-box !important;">微信游戏开发</span>，<span style="max-width: 100%; color: rgb(0, 176, 240); word-wrap: break-word !important; box-sizing: border-box !important;">微信编辑器</span>，<span style="max-width: 100%; color: rgb(146, 208, 80); word-wrap: break-word !important; box-sizing: border-box !important;">微信WIFI</span></span></span>等诸多优质内容，<span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">专业微信平台</span>、<span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">重服务</span>的微信运营！关注我们妥妥没错！（联系电话：00000000000）</span><span style="font-family: 微软雅黑; max-width: 100%; font-size: 12px; color: rgb(127, 127, 127); line-height: 28px; white-space: pre-wrap; word-wrap: break-word !important; box-sizing: border-box !important;"></span></p>
	             </blockquote> 
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="p:border-color;span.main:background-color"> 
	           <div class="content"> 
	            <p style="margin: 0px auto; max-width: 600px; word-wrap: normal; min-height: 1em; border: 1px solid rgb(0, 187, 236); font-family: 微软雅黑; font-size: 12px; border-top-left-radius: 2em; border-top-right-radius: 2em; border-bottom-left-radius: 2em; border-bottom-right-radius: 2em; box-sizing: border-box !important;"><span class="main" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding: 2px 2px 2px 6px; color: rgb(255, 255, 255); border-top-left-radius: 2em; border-bottom-left-radius: 2em; background-color: rgb(0, 187, 236);"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; line-height: 0px;">﻿</span><img data-src="/static/img/images/d1cb6b2d4d3843d8ad8e77a79a337039.gif" data-ke-src="/static/img/images/d1cb6b2d4d3843d8ad8e77a79a337039.gif" data-ratio="0.5" data-w="22" src="/static/img/images/d1cb6b2d4d3843d8ad8e77a79a337039.gif" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; height: auto !important; visibility: visible !important;" />&nbsp;<strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">提示</strong>：</span><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding-left: 2px;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(127, 127, 127);">点击上方</span><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding-left: 2px;">&quot;</span><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(0, 112, 192); padding-left: 2px;">微信编辑器</span></strong><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding-left: 2px;">&quot;</span><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; padding-left: 2px; color: rgb(0, 187, 236);">↑</span><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(127, 127, 127);">免费订阅本刊</span></span></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="p.qipao:background-color"> 
	           <div class="content"> 
	            <p class="qipao" style="padding: 5px 20px; margin-top: auto; margin-bottom: auto; font-family: 微软雅黑; white-space: normal; font-size: medium; max-width: 100%; word-wrap: normal; min-height: 1em; line-height: 25px; text-align: center; background-color: rgb(0, 187, 236); color: rgb(255, 255, 255); border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; box-sizing: border-box !important;"> <span style="font-size: 12px;"><span style="font-family: 微软雅黑, 'Microsoft YaHei'; border-color: rgb(103, 61, 189);">点击&quot;阅读全文&quot;，了解详情</span></span> </p> 
	            <p class="qipao2" style="margin: auto 55px; font-size: medium; white-space: normal; max-width: 100%; word-wrap: normal; min-height: 1em; color: rgb(62, 62, 62); line-height: 25px; border: 0px solid rgb(255, 0, 0); padding: 0px; width: auto; font-family: 微软雅黑; box-sizing: border-box !important;"> <span class="bot" style="max-width: 100%; border-color: rgb(0, 187, 236) transparent transparent; border-width: 20px; border-style: solid dashed dashed; width: 50px; bottom: -60px; height: 50px; font-size: 0px; word-wrap: break-word !important; box-sizing: border-box !important;"></span> </p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s2:background-color;.awb-s1:border-bottom-color"> 
	           <div class="content"> 
	            <section style="text-align: left; vertical-align: top;"> 
	             <section class="awb-s1" style="width: 0px; margin-left: 48%; border-bottom-width: 0.8em; border-bottom-style: solid; border-bottom-color: #00BBEC; border-left-width: 0.8em !important; border-left-style: solid !important; border-left-color: transparent !important; border-right-width: 0.8em !important; border-right-style: solid !important; border-right-color: transparent !important; border-top-color: transparent !important;"></section> 
	             <section class="awb-s2" style="margin: 0px; height: 2.5em; border-radius: 2em; background-color: #00BBEC;">
	              <img style="height: 1.6em; vertical-align: top; margin: 0.5em 0.6em;" src="/static/img/images/640_008.png" />
	              <section style="display: inline-block; width: 70%; margin-top: 0.3em;text-align: center; font-size: 1.2em;  white-space: nowrap; overflow: hidden;">
	               <section style="display: inline-block; color: rgb(255, 255, 255);">
	                点击上方
	               </section>
	               <section style="display: inline-block; color: rgb(64, 84, 115);">
	                &quot;蓝色字&quot;
	               </section>
	               <section style="display: inline-block; color: rgb(255, 255, 255);">
	                可关注我们！
	               </section>
	              </section>
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="fieldset:border-color;legend:border-color"> 
	           <div class="content"> 
	            <fieldset style="white-space: normal; margin: 0px; padding: 5px 15px; border-width: 1px 0px; border-style: solid; border-color: rgb(0, 187, 236); border-image-source: none; max-width: 100%; color: rgb(62, 62, 62); font-family: 微软雅黑; font-size: 14px; background-color: rgb(255, 255, 255); word-wrap: break-word !important; box-sizing: border-box !important;"> 
	             <legend style="padding: 4px 10px; max-width: 100%; border: 1px solid rgb(0, 187, 236); border-image-source: none; color: rgb(34, 34, 34); font-size: 16px; word-wrap: break-word !important; box-sizing: border-box !important;"> <strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;">如何关注</strong> </legend> 
	             <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: pre-wrap; box-sizing: border-box !important;">①复制&quot;weixinhao&quot;，在&quot;添加朋友&quot;中粘贴搜索号码关注。</p>
	             <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: pre-wrap; box-sizing: border-box !important;">②点击微信右上角的&quot;+&quot;，会出现&quot;添加朋友&quot;，进入&quot;查找公众号&quot;，输入以下公众号的名字，即可找到。</p> 
	            </fieldset> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/640.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_013.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_010.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_023.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_016.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_005.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_003.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_014.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_030.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="" src="/static/img/images/0.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_002.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_009.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_006.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_024.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_005.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_003.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_021.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_003.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_015.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_031.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_006.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/640_002.jpg" /></p> 
	           </div> 
	          </div>
	         </div> 
	        </div> 
	        <div style="display: none;" id="tab4" class="tab_con"> 
	         <div class="element-list" style="width: 100%;"> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section class="tn-Powered-by-XIUMI" style="max-width: 100%; color: rgb(62, 62, 62); font-family: 'Helvetica Neue', Helvetica, 'Hiragino Sans GB', 'Microsoft YaHei', 微软雅黑, Arial, sans-serif; line-height: 25px; white-space: normal; background-color: rgb(255, 255, 255); margin: 0.5em 0px; border-top-style: dotted; border-top-width: 1px; border-color: rgb(0, 201, 50); word-wrap: break-word !important; box-sizing: border-box !important;"></section> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: 'Helvetica Neue', Helvetica, 'Hiragino Sans GB', 'Microsoft YaHei', 微软雅黑, Arial, sans-serif; line-height: 25px; background-color: rgb(255, 255, 255); box-sizing: border-box !important;"> <br /> </p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/gezi.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_025.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_034.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_005.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_012.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_037.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_002.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_020.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_002.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_007.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_029.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_007.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_027.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_040.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_004.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_004.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important; width:100%;" src="/static/img/images/0_035.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s1:border-color;"> 
	           <div class="content"> 
	            <hr class="awb-s1" style="margin: 0px; border: 0; border-top: 5px #00BBEC solid;" /> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s1:border-color;"> 
	           <div class="content"> 
	            <hr class="awb-s1" style="margin: 0px; border: 0; border-top: 5px #00BBEC dashed;" /> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s1:border-color;"> 
	           <div class="content"> 
	            <hr class="awb-s1" style="margin: 0px; border: 0; border-top: 5px #00BBEC dotted;" /> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s1:border-color;"> 
	           <div class="content"> 
	            <hr class="awb-s1" style="margin: 0px; border: 0; border-top: 5px #00BBEC double;" /> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color="section:background-color;"> 
	           <div class="content"> 
	            <section style="height: 10px; background: url(/static/img/images/640_1.png) repeat-x #00BBEC;"></section> 
	           </div> 
	          </div>
	         </div> 
	        </div> 
	        <div style="display: block;" id="tab5" class="tab_con"> 
	         <div class="element-list" style="width: 100%;"> 
	          <!--样式1--> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section style="max-width:100%;font-family:inherit;font-size:1em;padding:.7em 0;line-height:1.4em;border-top-width:1px;border-top-style:solid;border-top-color:#3f474e;font-family:微软雅黑;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#3f474e;font-style:italic;color:#3f474e;word-wrap:break-word!important;box-sizing:border-box!important">
	             <span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;font-size:12px"><strong style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important"><em style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">点击&quot;<span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;font-size:16px;color:#c0504d">阅读原文</span>&quot;体验一次简单不过的微信编辑体验，不用太久，不用太难，<span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;font-size:16px;color:#9bbb59">瞬间</span>即可！</em></strong></span>
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section> 
	             <section style="height: 8em; white-space: nowrap; overflow: hidden;">
	              <img style="max-width: 100%;max-height: 100%;" src="/static/img/images/640_009.png" />
	             </section> 
	             <section style="height: 2em; margin: -7.2em 0.5em 5.5em; font-size: 1em; line-height: 1.6em; padding: 0.5em;">
	              <span style="color: inherit; white-space: nowrap; overflow: hidden; font-size: 0.9em; font-family: inherit; font-style: normal;">点击下方</span>
	              <span style="color: rgb(64, 84, 115); white-space: nowrap; overflow: hidden; font-size: 0.9em; font-family: inherit; font-style: normal;">&quot;阅读原文&quot;</span>
	              <span style="color: inherit; white-space: nowrap; overflow: hidden; font-size: 0.9em; font-family: inherit; font-style: normal;">查看更多</span>
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <blockquote style="white-space: normal; text-align: center; padding: 12px 8px; background-color: rgb(45, 163, 7); margin: 0px; max-width: 100%;border-radius: 5px;">
	             <span style="max-width: 100%; color: white;"><strong style="max-width: 100%;">点击左下角查看更多</strong></span>
	            </blockquote> 
	            <p><img src="/static/img/images/0_008.gif" style="border-width: 0px; height: auto !important; visibility: visible !important;" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; min-height: 1.5em; word-wrap: break-word; word-break: normal; white-space: pre-wrap; line-height: 36px; font-family: 微软雅黑; text-align: center; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-shadow: rgb(69, 117, 58) 0px 1px 1px;">点击左下角查看更多</p> 
	            <p><img src="/static/img/images/0_011.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s1:background-color;.awb-s3:border-color;.awb-s4:color"> 
	           <div class="content"> 
	            <section> 
	             <section class="awb-s1" style="margin: 0px; height: 0.1em; background-color: #00BBEC;"></section> 
	             <section class="awb-s1" style="margin: 0.3em 0px; height: 0.3em; background-color: #00BBEC;"></section> 
	             <section class="awb-s3" style="margin: 0; background-color: white; border: 1px solid #00BBEC; box-shadow: #e2e2e2 0em 1em 0.1em -0.8em;font-size: 1em; line-height: 1.6em; padding: 0.5em;">
	              <span style="color: inherit; font-size: 1em; font-family: inherit; font-style: normal;">点击下方</span>
	              <span style="color: rgb(64, 84, 115); font-size: 1em; font-family: inherit; font-style: normal;">&quot;阅读原文&quot;</span>
	              <span style="color: inherit; font-size: 1em; font-family: inherit; font-style: normal;">查看更多</span>
	             </section> 
	             <section class="awb-s4" style="color: #00BBEC; font-size: 2em;">
	              ↓↓↓
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=".awb-s1:background-color;.awb-s2:border-top-color"> 
	           <div class="content"> 
	            <p class="awb-s1" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; min-height: 1.5em; word-wrap: break-word; word-break: normal; white-space: pre-wrap; line-height: 36px; font-family: 微软雅黑; text-align: center; background-color: #00BBEC; color: #ffffff; border-radius: 5px;">点击左下角查看更多</p> 
	            <p class="awb-s2" style="margin: -5px 0 0 50px;display: inline-block;border-left-width: 1em;border-left-style: solid;border-left-color: transparent !important;border-right-width: 1em;border-right-style: solid;border-right-color: transparent !important;border-top-width: 1.5em !important;border-top-style: solid !important;border-top-color: #00BBEC;"></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important;" src="/static/img/images/0_038.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important;" src="/static/img/images/0_026.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important;" src="/static/img/images/0_033.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important;" src="/static/img/images/0.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="height: auto !important;" src="/static/img/images/0_006.gif" /></p> 
	           </div> 
	          </div>
	         </div> 
	        </div> 
	        <div style="display: none;" id="tab6" class="tab_con"> 
	         <div class="element-list" style="width: 100%;"> 
	          <!--样式0--> 
	          <div class="element-item" data-color="section.main:background-color"> 
	           <div class="content"> 
	            <fieldset style="border:0">
	             <section style="margin:0;background-color:#fff;border:1px solid #e2e2e2;box-shadow:#e2e2e2 0 1em .1em -.8em;font-size:1em;line-height:1em;padding:.3em">
	              <section class="main" style="padding:.5em;background-color:rgb(0, 187, 236)">
	               <section style="margin-top:0;margin-left:8px">
	                <img style="width:50px;float:right;margin-top:12px;margin-right:10px" src="/static/img/images/640_010.png" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	                <section style="line-height:1.2em;font-size:1.2em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:#fff">
	                 这里是地址
	                </section>
	                <section style="line-height:1.2em;font-size:1.2em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:#fff">
	                 微信编辑器
	                </section>
	                <section style="line-height:1.6em;font-size:.7em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:rgba(255,255,255,.85098)">
	                 请输入内容
	                </section>
	               </section>
	               <section style="margin-top:1em;margin-right:0;text-align:right;clear:both">
	                <section style="line-height:1.6em;font-size:.7em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:rgba(255,255,255,.85098)">
	                 请输入内容
	                </section>
	                <section style="line-height:1.6em;font-size:.7em;font-family:inherit;text-align:inherit;text-decoration:inherit;color:rgba(255,255,255,.85098)">
	                 请输入内容
	                </section>
	               </section>
	              </section>
	             </section>
	            </fieldset>
	            <p><br /></p> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color="span.main:border-color;strong.main2:border-color;strong.main2:background-color"> 
	           <div class="content"> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: normal; font-family: 微软雅黑; background-color: rgb(255, 255, 255); padding: 10px 20px; font-size: 14px; line-height: 1.5em; color: rgb(0, 187, 236); box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; color: rgb(62, 62, 62);"><strong style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><span class="main" style="max-width: 100%; display: inline-block; border: 3px solid rgb(0, 187, 236); line-height: 2em; padding: 10px 0px 10px 20px; box-shadow: rgba(0, 0, 0, 0.247059) 4px 4px 8px 1px inset; font-size: 13px; float: left; width: 160px; word-wrap: break-word !important; box-sizing: border-box !important;">微信号：weixinhao</span></strong></span><strong class="main2" style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important; display: inline-block; line-height: 2em; padding: 10px; border: 2px solid rgb(0, 187, 236); color: rgb(255, 255, 255); background-color: rgb(0, 187, 236); background-position: initial initial; background-repeat: initial initial;">加关注</strong></p> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section style="max-width:100%;color:#3e3e3e;font-family:'Helvetica Neue',Helvetica,'Hiragino Sans GB','Microsoft YaHei',微软雅黑,Arial,sans-serif;line-height:25px;white-space:normal;background-color:#fff;text-align:center;word-wrap:break-word!important;box-sizing:border-box!important">
	             <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;display:inline-block">
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin:.2em .5em .1em;color:#2a343a;font-size:1.8em;line-height:1;font-family:inherit">
	               <strong style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">微信编辑器</strong>
	              </section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;width:240px;border-top-style:solid;border-top-width:1px;border-top-color:#000;line-height:1"></section>
	              <section style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;margin:.5em 1em;font-size:1em;line-height:1;font-family:inherit;color:#787c81">
	               <strong style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important">微信号：<span style="max-width:100%;word-wrap:break-word!important;box-sizing:border-box!important;color:#9bbb59">weixinhao</span></strong>
	              </section>
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><br /></p>
	            <fieldset class="tn-Powered-by-XIUMI" style="margin:.5em 0;padding:0;max-width:100%;box-sizing:border-box;color:#3e3e3e;font-family:'Helvetica Neue',Helvetica,'Hiragino Sans GB','Microsoft YaHei',&Icirc;&cent;&Egrave;&iacute;&Ntilde;&Aring;&ordm;&Uacute;,Arial,sans-serif;font-size:15px;line-height:24px;white-space:normal;border:none;text-align:center;word-wrap:break-word!important;background-color:#fff">
	             <section class="tn-Powered-by-XIUMI" style="margin:auto;padding:.5em 0 0;max-width:100%;box-sizing:border-box;width:2.2em;height:2.2em;border:.12em solid #e1e0e0;border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:50%;border-bottom-left-radius:50%;box-shadow:#c2bebe 0 .2em .2em;word-wrap:break-word!important"></section>
	             <section class="tn-Powered-by-XIUMI" style="margin:-1.7em 0 0;padding:0;max-width:100%;box-sizing:border-box;width:668px;word-wrap:break-word!important">
	              <section class="tn-Powered-by-XIUMI" style="margin:-.5em auto;padding:0;max-width:100%;box-sizing:border-box;width:1.2em;height:1.2em;border:.1em solid rgba(102,102,102,.45098);border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:50%;border-bottom-left-radius:50%;word-wrap:break-word!important;background-color:#ccc"></section>
	             </section>
	             <section class="tn-Powered-by-XIUMI" style="margin:.3em auto;padding:0;max-width:100%;box-sizing:border-box;width:2.5em;height:2.5em;border-left-width:.1em;border-left-style:solid;border-left-color:#ccc;border-top-width:.1em;border-top-style:solid;border-top-color:#ccc;transform:rotate(45deg);-webkit-transform:rotate(45deg);word-wrap:break-word!important"></section>
	             <section class="tn-Powered-by-XIUMI" style="margin:-2.9em 0 0;padding:0;max-width:100%;box-sizing:border-box;word-wrap:break-word!important;text-align:center">
	              <section class="tn-Powered-by-XIUMI" style="margin:auto auto -1em;padding:0;max-width:100%;box-sizing:border-box;width:3.5em;height:.5em;display:inline-block;vertical-align:middle;word-wrap:break-word!important;background:#f8f7f5"></section>
	             </section>
	             <section class="tn-Powered-by-XIUMI" style="margin:1.3em 0 0;padding:0;max-width:100%;box-sizing:border-box;width:668px;word-wrap:break-word!important">
	              <img data-src="/static/img/images/20130303205827_VMAes.thumb.600_0.jpeg" class="tn-Powered-by-XIUMI" data-ratio="0.6659619450317125" data-w="473" _width="100%" src="/static/img/images/20130303205827_VMAes.jpg" style="margin:-1.5em 0 0;padding:1em;max-width:100%;box-sizing:border-box;float:left;border-top-left-radius:.5em;border-top-right-radius:.5em;border-bottom-right-radius:.5em;border-bottom-left-radius:.5em;width:80%;border:.1em solid #ccc;text-align:start;height:auto!important;word-wrap:break-word!important;visibility:visible!important" />
	             </section>
	            </fieldset>
	            <p><br /></p> 
	           </div> 
	          </div> 
	          <!--样式0--> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p style="margin-top: 0px; margin-bottom: 0px; max-width: 100%; word-wrap: normal; min-height: 1em; white-space: pre-wrap; box-sizing: border-box !important;"><span style="max-width: 100%; word-wrap: break-word !important; box-sizing: border-box !important;"><input style="padding: 0px; font-family: inherit; margin: 0px; max-width: 100%; word-wrap: break-word !important;" type="checkbox" /></span><span style="max-width: 100%; margin-left: 10px; word-wrap: break-word !important; box-sizing: border-box !important; font-family: 微软雅黑;">此处修改为选项值</span></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_039.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_017.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section>
	             <section style="margin: 0; font-size:1em; line-height:1.4em;">
	              <section style="font-size:2.7em; line-height: 1em; float:left; padding-right:0.1em;">
	               微
	              </section>信在线编辑器，帮助商家快速搭建微信营销平台。记得把这个工具分享给小伙伴们哦。
	             </section>
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_019.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_007.png" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_028.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img src="/static/img/images/0_022.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_032.gif" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section> 
	             <section style="text-align: left;">
	              <img style="vertical-align: top; width: 40px;" src="/static/img/images/640.png" />
	              <img style="vertical-align: top; margin-top: 1.8em;" src="/static/img/images/640_007.png" />
	              <section style="display: inline-block; width: 50%; margin-top: 0.7em; margin-left: -0.4em; padding: 1em; background-color: #ffe4c8; border-radius: 1em;">
	               <p>请输入对话</p>
	              </section>
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <section> 
	             <section style="text-align: right;">
	              <section style="display: inline-block; width: 50%; margin-top: 0.7em; margin-right: -0.4em; padding: 1em; background-color: #bce3f9; border-radius: 1em; text-align: left;">
	               <p>请输入对话</p>
	              </section>
	              <img style="vertical-align: top; margin-top: 1.8em;" src="/static/img/images/640_004.png" />
	              <img style="vertical-align: top; width: 40px;" src="/static/img/images/640_003.png" />
	             </section> 
	            </section> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0_004.jpg" /></p> 
	           </div> 
	          </div> 
	          <div class="element-item" data-color=""> 
	           <div class="content"> 
	            <p><img style="width:100%;" src="/static/img/images/0.jpg" /></p> 
	           </div> 
	          </div>
	         </div> 
	        </div> 
	        <div id="tab7" class="tab_con" style="display: none;">
	          <div class="element-picker"> 
	           <div id="picker">
	            <div class="farbtastic">
	             <div class="color" style="background-color: rgb(255, 0, 0);"></div>
	             <div class="wheel"></div>
	             <div class="overlay"></div>
	             <div class="h-marker marker" style="left: 97px; top: 13px;"></div>
	             <div class="sl-marker marker" style="left: 147px; top: 147px;"></div>
	            </div>
	           </div> 
	          </div> 
	          <div class="element-preview"> 
	           <div id="preview_content" contenteditable="true" style="float: left;width: 290px;height: 195px; overflow-y: auto;overflow-x: hidden;background: white;margin:10px;padding: 0px;"></div>
	          </div>
	        
		        <div style="float: right;width:100%;padding:10px 0;margin:0 auto;text-align :center;"> 
		            <input id="preview_btok" type="button" class="btn" value="插入编辑器" onclick=""/> 
		        </div> 
	        </div>
      	</div> 
	</div>
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script src="/static/img/js/bang.widget.style.js" type="text/javascript"></script>
<script src="/static/img/js/codemirror.js" type="text/javascript" defer="defer"></script>
<script src="/static/img/js/ZeroClipboard.js" type="text/javascript" defer="defer"></script>
<script src="/static/img/js/farbtastic.js" type="text/javascript"></script>
<script src="/static/img/js/gongyong.js" type="text/javascript"></script> 
</body>
</html>