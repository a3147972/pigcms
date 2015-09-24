-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 08 月 19 日 23:41
-- 服务器版本: 5.5.36
-- PHP 版本: 5.4.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jiami77`
--

-- --------------------------------------------------------

--
-- 表的结构 `update`
--

CREATE TABLE IF NOT EXISTS `update` (
  `update` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_access`
--

CREATE TABLE IF NOT EXISTS `wy_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wy_access`
--

INSERT INTO `wy_access` (`role_id`, `node_id`, `pid`, `level`, `module`) VALUES
(1, 47, 46, 3, NULL),
(1, 46, 45, 2, NULL),
(1, 45, 1, 0, NULL),
(1, 81, 80, 2, NULL),
(1, 80, 1, 2, NULL),
(1, 63, 60, 3, NULL),
(1, 62, 60, 3, NULL),
(1, 61, 60, 3, NULL),
(1, 60, 5, 2, NULL),
(1, 59, 57, 3, NULL),
(1, 58, 57, 3, NULL),
(1, 57, 5, 2, NULL),
(1, 42, 38, 3, NULL),
(1, 41, 38, 3, NULL),
(1, 40, 38, 3, NULL),
(1, 39, 38, 3, NULL),
(1, 38, 5, 2, NULL),
(1, 5, 1, 0, NULL),
(1, 56, 50, 3, NULL),
(1, 55, 50, 3, NULL),
(1, 54, 50, 3, NULL),
(1, 53, 50, 3, NULL),
(1, 52, 50, 3, NULL),
(1, 51, 50, 3, NULL),
(1, 50, 3, 2, NULL),
(1, 49, 48, 3, NULL),
(1, 48, 3, 2, NULL),
(1, 31, 25, 3, NULL),
(1, 30, 25, 3, NULL),
(1, 29, 25, 3, NULL),
(1, 28, 25, 3, NULL),
(1, 27, 25, 3, NULL),
(1, 26, 25, 3, NULL),
(1, 25, 3, 2, NULL),
(1, 24, 18, 3, NULL),
(1, 23, 18, 3, NULL),
(1, 22, 18, 3, NULL),
(1, 21, 18, 3, NULL),
(1, 20, 18, 3, NULL),
(1, 19, 18, 3, NULL),
(1, 18, 3, 2, NULL),
(1, 3, 1, 0, NULL),
(1, 37, 35, 3, NULL),
(1, 36, 35, 3, NULL),
(1, 35, 2, 2, NULL),
(1, 17, 11, 3, NULL),
(1, 16, 11, 3, NULL),
(1, 15, 11, 3, NULL),
(1, 14, 11, 3, NULL),
(1, 13, 11, 3, NULL),
(1, 12, 11, 3, NULL),
(1, 11, 2, 2, NULL),
(1, 83, 6, 3, NULL),
(1, 32, 6, 3, NULL),
(1, 10, 6, 3, NULL),
(1, 9, 6, 3, NULL),
(1, 8, 6, 3, NULL),
(1, 7, 6, 3, NULL),
(1, 6, 2, 2, NULL),
(1, 2, 1, 0, NULL),
(1, 79, 73, 3, NULL),
(1, 78, 73, 3, NULL),
(1, 77, 73, 3, NULL),
(1, 76, 73, 3, NULL),
(1, 75, 73, 3, NULL),
(1, 74, 73, 3, NULL),
(1, 73, 4, 2, NULL),
(1, 72, 66, 3, NULL),
(1, 71, 66, 3, NULL),
(1, 70, 66, 3, NULL),
(1, 69, 66, 3, NULL),
(1, 68, 66, 3, NULL),
(1, 67, 66, 3, NULL),
(1, 66, 4, 2, NULL),
(1, 65, 64, 3, NULL),
(1, 64, 4, 2, NULL),
(1, 4, 1, 0, NULL),
(1, 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wy_adma`
--

CREATE TABLE IF NOT EXISTS `wy_adma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `url` varchar(100) NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `info` varchar(120) NOT NULL,
  `title` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_adma`
--

INSERT INTO `wy_adma` (`id`, `uid`, `token`, `url`, `copyright`, `info`, `title`) VALUES
(1, 1, '5e8aeeeabe2d84d', '/tpl/Home/new/common/images/ewm2.jpg', '© 2001-2013 某某微信版权所有', '微信营销管理平台为个人和企业提供基于微信公众平台的一系列功能，包括智能回复、微信3G网站、互动营销活动，会员管理，在线订单，数据统计等系统功能,带给你全新的微信互动营销体验。', '微赢CMS');

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent`
--

CREATE TABLE IF NOT EXISTS `wy_agent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(800) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `usercount` int(10) NOT NULL DEFAULT '0',
  `wxusercount` int(10) NOT NULL DEFAULT '0',
  `sitename` varchar(50) NOT NULL DEFAULT '',
  `sitelogo` varchar(200) NOT NULL DEFAULT '',
  `qrcode` varchar(100) NOT NULL DEFAULT '',
  `sitetitle` varchar(60) NOT NULL DEFAULT '',
  `siteurl` varchar(100) NOT NULL DEFAULT '',
  `robotname` varchar(40) NOT NULL DEFAULT '',
  `connectouttip` varchar(50) NOT NULL DEFAULT '',
  `needcheckuser` tinyint(1) NOT NULL DEFAULT '0',
  `regneedmp` tinyint(1) NOT NULL DEFAULT '1',
  `reggid` int(10) NOT NULL DEFAULT '0',
  `regvaliddays` mediumint(4) NOT NULL DEFAULT '30',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `metades` varchar(300) NOT NULL DEFAULT '',
  `metakeywords` varchar(200) NOT NULL DEFAULT '',
  `statisticcode` varchar(300) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  `alipayaccount` varchar(50) NOT NULL DEFAULT '',
  `alipaypid` varchar(100) NOT NULL DEFAULT '',
  `alipaykey` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(6) NOT NULL DEFAULT '',
  `money` int(10) NOT NULL DEFAULT '0',
  `moneybalance` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `lastloginip` varchar(26) NOT NULL DEFAULT '',
  `lastlogintime` int(11) NOT NULL DEFAULT '0',
  `wxacountprice` mediumint(4) NOT NULL DEFAULT '0',
  `monthprice` mediumint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent_expenserecords`
--

CREATE TABLE IF NOT EXISTS `wy_agent_expenserecords` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `amount` int(10) NOT NULL DEFAULT '0',
  `orderid` varchar(60) NOT NULL DEFAULT '',
  `des` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `agentid` (`agentid`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent_function`
--

CREATE TABLE IF NOT EXISTS `wy_agent_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` tinyint(3) NOT NULL,
  `usenum` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `funname` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `isserve` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent_price`
--

CREATE TABLE IF NOT EXISTS `wy_agent_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `minaccount` int(10) NOT NULL DEFAULT '0',
  `maxaccount` int(10) NOT NULL DEFAULT '0',
  `price` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_alipay_config`
--

CREATE TABLE IF NOT EXISTS `wy_alipay_config` (
  `token` varchar(60) NOT NULL,
  `paytype` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `pid` varchar(40) NOT NULL DEFAULT '',
  `key` varchar(200) NOT NULL DEFAULT '',
  `partnerkey` varchar(100) NOT NULL DEFAULT '',
  `appsecret` varchar(200) NOT NULL DEFAULT '',
  `appid` varchar(60) NOT NULL DEFAULT '',
  `paysignkey` varchar(200) NOT NULL DEFAULT '',
  `partnerid` varchar(200) NOT NULL DEFAULT '',
  `open` tinyint(1) NOT NULL DEFAULT '0',
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wy_alipay_config`
--

INSERT INTO `wy_alipay_config` (`token`, `paytype`, `name`, `pid`, `key`, `partnerkey`, `appsecret`, `appid`, `paysignkey`, `partnerid`, `open`) VALUES
('gohywy1397897860', '1', '', '', '', '123', '123', '123', '123', '123', 0),
('ugmbpt1399525902', 'alipay', '76020694@qq.com', '2088212880578966', 'qkji1049ff1qrkssbugbksvvo5nbvn1y', '', '', '', '', '', 1),
('eawfce1399780777', 'alipay', 'cgwfirst@163.com', '2088002020797568', 'dhehhkqdaupx2bqigcdxsxchagu5wkw3', '', '', '', '', '', 1),
('{Pigcms:$token}', 'weixin', '', '', '', '123', '123', '123', '123', '123', 1),
('{Pigcms:$token}', 'weixin', '', '', '', '231', '123', '12312', '123', '1231', 0),
('mngdjc1400655569', 'weixin', '1231', '12312', '1231', '23', '123', '123', '123', '123', 0),
('5e8aeeeabe2d84d', 'alipay', '111', '111', '111', 'FF4', '23R', 'FAFASF', 'WRDF2', '23RDFA', 1),
('a717713db81322c', 'weixin', '', '', '', '', '33', '11', '22', '44', 1),
('86df3e5db3c8443', '1', '', '', '', '25cee23b1771816d55efc59cc8691d29', '', '', '', '1219002101', 1),
('mfquez1400927795', '1', '', '', '', '25cee23b1771816d55efc59cc8691d29', '', '', '', '1219002101', 1),
('eeejav1400912906', '1', '', '', '', '25cee23b1771816d55efc59cc8691d29', '', '', '', '1219002101', 1),
('2118574217f66b1', '1', '', '', '', '25cee23b1771816d55efc59cc8691d29', '', '', '', '1219002101', 1),
('yixxnr1400929637', '1', '', '', '', '25cee23b1771816d55efc59cc8691d29', '', '', '', '1219002101', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_api`
--

CREATE TABLE IF NOT EXISTS `wy_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `url` varchar(100) NOT NULL,
  `number` tinyint(1) NOT NULL,
  `order` tinyint(1) NOT NULL,
  `is_colation` tinyint(1) NOT NULL,
  `colation_keyword` text NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `apitoken` varchar(100) DEFAULT NULL,
  `noanswer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `wy_api`
--

INSERT INTO `wy_api` (`id`, `uid`, `token`, `keyword`, `type`, `url`, `number`, `order`, `is_colation`, `colation_keyword`, `time`, `status`, `apitoken`, `noanswer`) VALUES
(1, 1, '9fb09d2547e5425', '中国', 2, 'http://www.baoweidian.com/api/weixin_api.php', 0, 0, 0, '', 1400772822, 1, NULL, NULL),
(2, 1, 'posvfl1400901820', 'm M 小白', 1, 'http://ahu114.sinaapp.com/func/music/wx_interface.php', 0, 0, 0, '', 1400902075, 1, NULL, NULL),
(3, 1, '5e8aeeeabe2d84d', 'movie ', 2, '/index.php?g=Wap&m=Repast&a=select&token=lylmkx1400730355&wecha_id={wechat_id}', 0, 0, 0, '', 1401070782, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wy_areply`
--

CREATE TABLE IF NOT EXISTS `wy_areply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `token` char(30) NOT NULL,
  `home` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `wy_areply`
--

INSERT INTO `wy_areply` (`id`, `keyword`, `content`, `uid`, `uname`, `createtime`, `updatetime`, `token`, `home`) VALUES
(1, '首页', '\r\n\r\n\r\n\r\n帮助信息填写到这里\r\n\r\n', 3, '', '1399284128', '1399290296', 'jbbjyc1399284024', '1'),
(2, '首页', '\r\n\r\n', 12, '', '1399690460', '', '0945509e684dcee', '0'),
(3, '首页', '\r\n1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京', 14, '', '1399707105', '', 'yduzak1399706977', '0'),
(4, '首页', '1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help\r\n\r\n帮助信息填写到这里\r\n\r\n', 19, '', '1399797875', '1399799105', 'eawfce1399780777', '1'),
(5, '', '123', 1, '', '1400656773', '', 'mngdjc1400655569', '0'),
(6, '首页', '撒打算', 1, '', '1400671449', '', 'uhsmvp1400670523', '0'),
(7, '首页', '首页', 1, '', '1400719116', '1400720036', 'jvysfw1400718965', '1'),
(8, '首页', '首页', 1, '', '1400741257', '', 'tzkynx1400740983', '0'),
(9, '首页', '首页', 1, '', '1400756195', '', '188146798718486', '0'),
(17, '', '欢迎您关注ovxin\r\n\r\n\r\n\r\n\r\n\r\n1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳/跳跳', 1, '', '1400998838', '1401068741', 'a717713db81322c', '0'),
(22, '', '6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　', 1, '', '1401086606', '', 'uqnrmt1401086437', '0'),
(11, '', '欢迎来到微赢网络', 22, '', '1400826671', '1400827456', 'femkzf1400826278', '1'),
(18, '首页', '请回复【首页】', 1, '', '1401002574', '', 'bmmzlc1401001546', '0'),
(19, '回复首页', '', 1, '', '1401005469', '1401011887', 'jthtom1401004976', '1'),
(20, '首页', 'help', 1, '', '1401066997', '1401154896', 'bcxxiq1401066548', '0'),
(21, '', '1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help', 39, '', '1401067156', '', 'ohljtk1401066991', '0'),
(14, '', '1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help', 1, '', '1400937441', '', 'oudsvk1400937241', '0'),
(15, '你好', '你好', 1, '', '1400938366', '', 'cippza1400938053', '0'),
(23, '首页', '', 1, '', '1401091311', '1401092965', 'fwphni1401088997', '1'),
(24, '么么哒', '参考范例：\r\n1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help', 35, '', '1401096824', '1401096862', 'btiler1401096543', '1'),
(25, '么么哒', '参考范例：\r\n1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help', 35, '', '1401098651', '1401098661', 'lpjsaf1401097201', '1'),
(26, '么么哒', '参考范例：\r\n1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help', 35, '', '1401099255', '1401099356', 'prxpct1401098941', '1'),
(28, '', '1.天气查询　城市名＋天气　\r\n2.笑话　直接发送笑话\r\n', 1, '', '1401106444', '1401106495', 'okaxul1401105869', '0'),
(31, '', '欢迎关注华佑装饰集团，\r\n1、回复“首页”了解华佑装饰集团信息\r\n2.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.陪聊　直接输入聊天关键词即可\r\n12.聊天　直接输入聊天关键词即可\r\n13.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n14.笑话　直接发送笑话\r\n15.糗事　直接发送糗事\r\n16.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n17.健康指数查询　健康＋高，＋重　例：健康170,65\r\n18.朗读 朗读＋关键词　例：朗读微赢CMS多用户营销系统\r\n19.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n20.输入价格了解微赢CMS平台系统的价格\r\n21.输入服务了解微赢CMS平台系统的售后服务\r\n23.输入抽奖，即可玩幸运大抽奖\r\n2４.输入会员即可填写会员资料\r\n25.更多功能请回复帮助，或者help\r\n', 1, '', '1401173484', '1401173489', '04cdd8941f09d37', '0'),
(29, '', '121212', 1, '', '1401111894', '', 'zidiqh1401110610', '0'),
(30, '', '我关注你了 /得意', 1, '', '1401167960', '', 'ctmfim1401167762', '0'),
(32, '汽车', '长安铃木销售热线： 6282227\r\n长安汽车销售热线： 8106488\r\n天津一汽销售热线： 8151489\r\n昌河铃木销售热线： 8106588', 41, '', '1401177508', '1401179701', '9814ef0462957fa', '0');

-- --------------------------------------------------------

--
-- 表的结构 `wy_article`
--

CREATE TABLE IF NOT EXISTS `wy_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  `description` char(255) NOT NULL,
  `author` varchar(15) NOT NULL,
  `form` varchar(30) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `content` text NOT NULL,
  `imgs` char(40) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_attribute`
--

CREATE TABLE IF NOT EXISTS `wy_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `catid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `name` varchar(100) NOT NULL COMMENT '属性名',
  `value` varchar(100) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`catid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_attribute`
--

INSERT INTO `wy_attribute` (`id`, `token`, `catid`, `name`, `value`) VALUES
(1, 'wtxzkd1402555540', 70, '123', '123');

-- --------------------------------------------------------

--
-- 表的结构 `wy_baoming`
--

CREATE TABLE IF NOT EXISTS `wy_baoming` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `jianjie` text NOT NULL,
  `tp` char(255) NOT NULL,
  `logo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_baoming_list`
--

CREATE TABLE IF NOT EXISTS `wy_baoming_list` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `zhuti` varchar(100) NOT NULL,
  `feiyong` text,
  `time` text,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `banner` varchar(200) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_baoming_order`
--

CREATE TABLE IF NOT EXISTS `wy_baoming_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL,
  `wecha_id` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weixin` varchar(100) NOT NULL,
  `beizhu` text NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_behavior`
--

CREATE TABLE IF NOT EXISTS `wy_behavior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `date` varchar(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `model` varchar(60) NOT NULL,
  `num` int(11) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=864 ;

--
-- 转存表中的数据 `wy_behavior`
--

INSERT INTO `wy_behavior` (`id`, `fid`, `token`, `openid`, `date`, `enddate`, `model`, `num`, `keyword`, `type`) VALUES
(1, 1, 'jzpvbg1397481244', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-17', 1397738461, 'Member_card_set', 0, '会员卡', 0),
(2, 0, 'gohywy1397897860', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397902819, 'home', 0, '首页', 1),
(3, 1, 'gohywy1397897860', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397902877, 'Lottery', 0, '水果达人', 0),
(4, 0, 'gohywy1397897860', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397902901, 'chat', 0, '你好', 0),
(5, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397902963, 'chat', 0, '林俊杰', 0),
(6, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905183, 'home', 3, '首页', 1),
(7, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905243, 'chat', 6, '订餐', 0),
(8, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905676, 'Wedding', 0, '喜贴', 0),
(9, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905725, 'chat', 0, '房产', 0),
(10, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905757, 'chat', 0, '酒店', 0),
(11, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905806, 'chat', 0, '医疗', 0),
(12, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397905830, 'chat', 0, '美容', 0),
(13, 29, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397906025, 'Meirong', 4, 'yyy18968920219', 0),
(14, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397906963, 'chat', 0, '砸金蛋', 0),
(15, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397906973, 'chat', 0, '水果达人', 0),
(16, 2, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397908064, 'Lottery', 0, '砸金蛋', 0),
(17, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397908143, 'chat', 0, '喜贴', 0),
(18, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397908158, 'Wedding', 0, '喜帖', 0),
(19, 28, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397908179, 'Estate', 0, '房产', 0),
(20, 20, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397908225, 'Jiudian', 0, '酒店', 0),
(21, 29, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397908289, 'Meirong', 2, '美容', 0),
(22, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397909043, 'Reservation', 0, '预约', 0),
(23, 21, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397909090, 'Yiliao', 0, '医疗', 0),
(24, 2, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397909952, 'Member_card_set', 1, '会员卡', 0),
(25, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910121, 'chat', 0, 'http://weiwincms.weiwin.cc/index.php?g=Wap&m=Card&a=get_card', 0),
(26, 30, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910397, 'Lvyou', 0, '旅游', 0),
(27, 31, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910432, 'Jianshen', 0, '健身', 0),
(28, 32, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910549, 'Zhengwu', 1, '政务', 0),
(29, 33, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910573, 'wuye', 2, '物业', 0),
(30, 34, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910659, 'Ktv', 0, 'ktv', 0),
(31, 33, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910693, 'wuye', 0, '我是', 0),
(32, 35, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910773, 'Jiuba', 0, '酒吧', 0),
(33, 36, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910806, 'Hunqing', 0, '婚庆', 0),
(34, 37, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910837, 'Zhuangxiu', 0, '装修', 0),
(35, 38, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910851, 'Jiaoyu', 0, '教育', 0),
(36, 39, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397910878, 'Huadian', 0, '花店', 0),
(37, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397911033, 'Carset', 0, '汽车', 0),
(38, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397911107, 'Greeting_card', 0, '贺卡', 0),
(39, 6, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397911237, 'Diaoyan', 1, '调研', 0),
(40, 7, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397912417, 'Diaoyan', 0, '调研', 0),
(41, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397912453, 'Vote', 0, '投票', 0),
(42, 22, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397912556, 'Yuyue', 0, '预定', 0),
(43, 0, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-19', 1397912595, 'chat', 0, '留言板', 0),
(44, 1, 'lddrag1397902912', 'ozNqmt5MtHrSuXFtTsKHMM4GqJK0', '2014-04-20', 1397982045, 'Product', 0, '用户关注', 0),
(45, 29, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995002, 'Meirong', 2, '美容', 0),
(46, 30, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995154, 'Lvyou', 0, '旅游', 0),
(47, 28, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995313, 'Estate', 2, '房产', 0),
(48, 21, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995334, 'Yiliao', 0, '医疗', 0),
(49, 31, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995345, 'Jianshen', 0, '健身', 0),
(50, 32, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995351, 'Zhengwu', 0, '政务', 0),
(51, 33, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995358, 'wuye', 0, '我是', 0),
(52, 33, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995384, 'wuye', 0, '物业', 0),
(53, 34, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995396, 'Ktv', 0, 'ktv', 0),
(54, 35, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995404, 'Jiuba', 0, '酒吧', 0),
(55, 36, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995410, 'Hunqing', 0, '婚庆', 0),
(56, 37, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995417, 'Zhuangxiu', 0, '装修', 0),
(57, 38, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995419, 'Jiaoyu', 0, '教育', 0),
(58, 39, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995422, 'Huadian', 0, '花店', 0),
(59, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995426, 'Carset', 0, '汽车', 0),
(60, 2, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397995741, 'Member_card_set', 0, '会员卡', 0),
(61, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397997217, 'Greeting_card', 2, '贺卡', 0),
(62, 7, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397997449, 'Diaoyan', 0, '调研', 0),
(63, 1, 'lddrag1397902912', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-20', 1397997525, 'Vote', 0, '投票', 0),
(64, 1, 'lddrag1397902912', 'ozNqmt0F8simrqR_SOGQ_dj0maFA', '2014-04-20', 1398008133, 'Product', 0, '用户关注', 0),
(65, 0, 'lddrag1397902912', 'ozNqmtye2DFsgC6HJBsv9QbLDy6I', '2014-04-22', 1398149537, 'home', 0, '首页', 1),
(66, 0, 'bbe6c6ebb14076c', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-23', 1398232103, 'home', 0, '首页。', 1),
(67, 0, 'bbe6c6ebb14076c', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-23', 1398232104, 'home', 0, '首页', 1),
(68, 2, 'bbe6c6ebb14076c', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-24', 1398317711, 'Vote', 0, '投票', 0),
(69, 3, 'bbe6c6ebb14076c', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-24', 1398317731, 'Member_card_set', 1, '会员卡', 0),
(70, 0, 'bbe6c6ebb14076c', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-04-25', 1398399842, 'home', 0, '首页', 1),
(71, 0, 'bbe6c6ebb14076c', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-04', 1399216162, 'home', 0, '首页', 1),
(72, 0, 'wtzdew1399216337', 'oO31MuOISeomiBUV9vnMP3Yko1EA', '2014-05-04', 1399216371, 'home', 0, '首页', 1),
(73, 0, 'wtzdew1399216337', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-05', 1399275066, 'home', 0, '首页', 1),
(74, 0, 'wtzdew1399216337', 'ozNqmt6g2h4G4U62icXblNFFVuyo', '2014-05-05', 1399275067, 'home', 1, '首页', 1),
(75, 0, 'wygjkv1399277066', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-05-05', 1399277092, 'home', 0, '首页', 1),
(76, 0, 'wtzdew1399216337', 'oO31MuG99_EZniFEtTQM65ElhlGk', '2014-05-05', 1399279513, 'chat', 0, '用户关注', 0),
(77, 0, 'jbbjyc1399284024', 'oXWLTjoy_b9W-82I7uZghojALrP8', '2014-05-05', 1399284146, 'home', 1, '首页', 1),
(78, 0, 'wtzdew1399216337', 'oO31MuL1XGglRHI0u7CVw1rLZBS8', '2014-05-05', 1399284819, 'chat', 0, '用户关注', 0),
(79, 0, 'jbbjyc1399284024', 'oXWLTjoy_b9W-82I7uZghojALrP8', '2014-05-05', 1399290196, 'chat', 2, '用户关注', 0),
(80, 1, 'jbbjyc1399284024', 'oXWLTjoy_b9W-82I7uZghojALrP8', '2014-05-05', 1399290202, 'follow', 2, '用户关注', 0),
(81, 0, 'jbbjyc1399284024', 'oXWLTjoy_b9W-82I7uZghojALrP8', '2014-05-05', 1399290305, 'home', 0, '用户关注', 1),
(82, 1, 'jbbjyc1399284024', 'oXWLTjoDyP-y9a_OlJBETxCD7b0w', '2014-05-05', 1399290522, 'follow', 0, '用户关注', 0),
(83, 0, 'jbbjyc1399284024', 'oXWLTjoDyP-y9a_OlJBETxCD7b0w', '2014-05-05', 1399290522, 'home', 0, '用户关注', 1),
(84, 4, 'jbbjyc1399284024', 'oXWLTjoy_b9W-82I7uZghojALrP8', '2014-05-05', 1399293589, 'Member_card_set', 0, '会员卡', 0),
(85, 4, 'jbbjyc1399284024', 'oXWLTjoy_b9W-82I7uZghojALrP8', '2014-05-05', 1399293653, 'Member_card_set', 0, '会员', 0),
(86, 0, 'qkqdnw1399374805', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-05-06', 1399375419, 'home', 2, '首页', 1),
(87, 0, 'speoac1399377486', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-05-06', 1399377544, 'home', 3, '首页', 1),
(88, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-06', 1399391117, 'chat', 1, '美容', 0),
(89, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-06', 1399391155, 'chat', 2, '旅游', 0),
(90, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-06', 1399391689, 'chat', 1, '房产', 0),
(91, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399392428, 'chat', 3, '美容', 0),
(92, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399392430, 'chat', 0, '旅游', 0),
(93, 1, 'speoac1399377486', 'ojb0SuGKlWQx737OMMxXf4on8KBc', '2014-05-07', 1399394625, 'follow', 0, '用户关注', 0),
(94, 1, 'speoac1399377486', 'ojb0SuBJBrLTasPgEHy3ftcIgUMo', '2014-05-07', 1399424792, 'follow', 0, '用户关注', 0),
(95, 0, 'speoac1399377486', 'ojb0SuBJBrLTasPgEHy3ftcIgUMo', '2014-05-07', 1399424802, 'chat', 0, '在吗', 0),
(96, 41, 'speoac1399377486', 'ojb0SuC82MbTWKnsaKgwXGx_H7tU', '2014-05-07', 1399425186, 'Lvyou', 0, '用户关注', 0),
(97, 1, 'speoac1399377486', 'ojb0SuH5Mu_5-clxHlEKB_QVfXv4', '2014-05-07', 1399432551, 'follow', 0, '用户关注', 0),
(98, 0, 'speoac1399377486', 'ojb0SuH5Mu_5-clxHlEKB_QVfXv4', '2014-05-07', 1399432569, 'home', 0, '首页', 1),
(99, 0, 'speoac1399377486', 'ojb0SuH5Mu_5-clxHlEKB_QVfXv4', '2014-05-07', 1399432594, 'usernameCheck', 0, '审核kerry', 1),
(100, 41, 'speoac1399377486', 'ojb0SuH5Mu_5-clxHlEKB_QVfXv4', '2014-05-07', 1399432621, 'Lvyou', 0, '用户关注', 0),
(101, 1, 'speoac1399377486', 'ojb0SuAfy7TDXYUyP6Syw90iEWCA', '2014-05-07', 1399433101, 'follow', 0, '用户关注', 0),
(102, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399433589, 'home', 5, '首页', 1),
(103, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399434527, 'chat', 0, '房产', 0),
(104, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399434751, 'chat', 3, '大转盘', 0),
(105, 0, 'speoac1399377486', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-05-07', 1399438700, 'home', 0, '首页', 1),
(106, 0, 'speoac1399377486', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-05-07', 1399438705, 'chat', 0, '美容', 0),
(107, 0, 'speoac1399377486', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-05-07', 1399438864, 'chat', 0, '大转盘', 0),
(108, 0, 'speoac1399377486', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399439626, 'chat', 0, '刮刮卡', 0),
(109, 0, 'speoac1399377486', 'ojb0SuLr40ogj3N6dLDgyvokqD7c', '2014-05-07', 1399440410, 'chat', 0, '客服', 0),
(110, 0, 'xtgbyc1399434437', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399452817, 'chat', 0, '美容', 0),
(111, 43, 'xtgbyc1399434437', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399452835, 'Meirong', 0, '美容', 0),
(112, 42, 'xtgbyc1399434437', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399452838, 'Estate', 0, '房产', 0),
(113, 3, 'xtgbyc1399434437', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-07', 1399452855, 'Lottery', 0, '大转盘', 0),
(114, 44, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399526213, 'Estate', 0, '房产', 0),
(115, 45, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399526754, 'Meirong', 0, '美容', 0),
(116, 3, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399528488, 'Vote', 1, '投票', 0),
(117, 5, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399530968, 'Lottery', 0, '大转盘', 0),
(118, 6, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399530987, 'Lottery', 0, '砸金蛋', 0),
(119, 4, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399531001, 'Lottery', 0, '水果达人', 0),
(120, 0, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399533528, 'home', 5, '首页', 1),
(121, 0, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399535390, 'chat', 0, '喜贴', 0),
(122, 2, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-08', 1399535684, 'Wedding', 0, '喜帖', 0),
(123, 45, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399609366, 'Meirong', 3, '美容', 0),
(124, 0, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399609470, 'Member_card_set', 0, '会员卡', 0),
(125, 0, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399609491, 'chat', 0, 'http://wx.weiwinbao.com/index.php?g=Wap&m=Card&a=index&token', 0),
(126, 4, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399611118, 'Reservation', 1, '美容', 0),
(127, 40, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399611506, 'Reservation', 0, '123', 0),
(128, 4, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399640935, 'Wedding', 0, '喜帖', 0),
(129, 0, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399650079, 'home', 0, '首页', 1),
(130, 46, 'ugmbpt1399525902', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-09', 1399650088, 'Ktv', 0, 'ktv', 0),
(131, 0, 'eqfnaq1399652180', 'oVydWuE-6_3nVYbYGLxzImhg00d8', '2014-05-10', 1399652567, 'chat', 0, '用户关注', 0),
(132, 1, 'eqfnaq1399652180', 'oVydWuE-6_3nVYbYGLxzImhg00d8', '2014-05-10', 1399652641, 'follow', 0, '用户关注', 0),
(133, 0, 'eqfnaq1399652180', 'oVydWuE-6_3nVYbYGLxzImhg00d8', '2014-05-10', 1399652661, 'home', 0, '首页', 1),
(134, 0, 'ugmbpt1399525902', 'ozNqmt6g2h4G4U62icXblNFFVuyo', '2014-05-10', 1399654850, 'home', 0, '首页', 1),
(135, 23, '0945509e684dcee', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-10', 1399692026, 'Jiudian', 0, '酒店', 0),
(136, 47, 'd5bd801052e0b53', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-10', 1399693148, 'Estate', 3, '房产', 0),
(137, 48, 'd5bd801052e0b53', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-10', 1399705919, 'Ktv', 0, 'ktv', 0),
(138, 1, '8050de3edfcb364', 'oyQeQuBBoPnDTzsTD829mP3TbMmM', '2014-05-10', 1399706979, 'follow', 0, '用户关注', 0),
(139, 49, '8050de3edfcb364', 'oyQeQuBBoPnDTzsTD829mP3TbMmM', '2014-05-10', 1399706984, 'Reservation', 0, '预约', 0),
(140, 0, 'yduzak1399706977', 'oifmdjmsZnNK77ufc0dnVVDifU98', '2014-05-10', 1399707301, 'home', 0, '首页', 1),
(141, 0, '8050de3edfcb364', 'oyQeQuBBoPnDTzsTD829mP3TbMmM', '2014-05-10', 1399707327, 'chat', 1, '你好', 0),
(142, 0, '8050de3edfcb364', 'oyQeQuBBoPnDTzsTD829mP3TbMmM', '2014-05-10', 1399707375, 'chat', 0, '北京天气', 0),
(143, 50, '8050de3edfcb364', 'oyQeQuPTgzJJDf6Nnz2lDtnog7V8', '2014-05-10', 1399707875, 'Reservation', 0, '用户关注', 0),
(144, 4, 'yduzak1399706977', 'oifmdjmsZnNK77ufc0dnVVDifU98', '2014-05-10', 1399707875, 'Vote', 0, '投票', 0),
(145, 1, 'yduzak1399706977', 'oifmdjraW4bPsl5CFHnbC_N3r9Jk', '2014-05-10', 1399708689, 'follow', 1, '用户关注', 0),
(146, 4, 'yduzak1399706977', 'oifmdjraW4bPsl5CFHnbC_N3r9Jk', '2014-05-10', 1399708708, 'Vote', 0, '用户关注', 0),
(147, 49, '8050de3edfcb364', 'oyQeQuBBoPnDTzsTD829mP3TbMmM', '2014-05-10', 1399709164, 'Estate', 0, '楼盘', 0),
(148, 0, '8050de3edfcb364', 'oyQeQuBBoPnDTzsTD829mP3TbMmM', '2014-05-10', 1399709173, 'home', 0, '首页', 1),
(149, 1, 'yduzak1399706977', 'oifmdjn40WtP0uEzGYwT3L8hC7bE', '2014-05-10', 1399711043, 'follow', 0, '用户关注', 0),
(150, 0, 'f1a283db9e62a23', 'ogSeut4HudaLR3gEtojnN8eiRDhM', '2014-05-10', 1399712561, 'chat', 0, 'f', 0),
(151, 0, 'f1a283db9e62a23', 'ogSeut4HudaLR3gEtojnN8eiRDhM', '2014-05-10', 1399715731, 'chat', 0, '14', 0),
(152, 4, 'yduzak1399706977', 'oifmdjgJXf0W2bZSywc6_yfctCWw', '2014-05-10', 1399719840, 'Vote', 0, '用户关注', 0),
(153, 4, 'yduzak1399706977', 'oifmdjgJXf0W2bZSywc6_yfctCWw', '2014-05-10', 1399719840, 'Vote', 0, '用户关注', 0),
(154, 1, 'yduzak1399706977', 'oifmdjoej4MT6SrHSoJguqWP3_WU', '2014-05-10', 1399722862, 'follow', 0, '用户关注', 0),
(155, 1, 'yduzak1399706977', 'oifmdjrX0gg6f_rWhfU41knBaOFo', '2014-05-10', 1399728913, 'follow', 0, '用户关注', 0),
(156, 4, 'yduzak1399706977', 'oifmdjrX0gg6f_rWhfU41knBaOFo', '2014-05-10', 1399729356, 'Vote', 0, '用户关注', 0),
(157, 1, 'yduzak1399706977', 'oifmdjj82vAJE2F4s6tAeGNc7Iz0', '2014-05-10', 1399730610, 'follow', 0, '用户关注', 0),
(158, 4, 'yduzak1399706977', 'oifmdjj82vAJE2F4s6tAeGNc7Iz0', '2014-05-10', 1399730662, 'Vote', 0, '用户关注', 0),
(159, 0, '8050de3edfcb364', 'oyQeQuEkSLKtCrULpWZ_-60k0HQg', '2014-05-10', 1399733956, 'home', 0, '首页', 1),
(160, 5, 'eqfnaq1399652180', 'oVydWuPYUTy3sxXwyLTXZMhDr1As', '2014-05-10', 1399736876, 'Vote', 0, '投票', 0),
(161, 9, 'yduzak1399706977', 'oifmdjmsZnNK77ufc0dnVVDifU98', '2014-05-11', 1399768741, 'Lottery', 0, '水果达人', 0),
(162, 1, 'yduzak1399706977', 'oifmdjuO6BA6vvsEOcO6OWG1UuBo', '2014-05-11', 1399769375, 'follow', 0, '用户关注', 0),
(163, 1, 'yduzak1399706977', 'oifmdjnHDsAp2yawi7nmJJkYXgOk', '2014-05-11', 1399771067, 'follow', 0, '用户关注', 0),
(164, 1, 'yduzak1399706977', 'oifmdjiYrxzyQiJEPC22ES-KPYhM', '2014-05-11', 1399772188, 'follow', 0, '用户关注', 0),
(165, 10, 'a64dad7e7ab8eb4', 'oWcfKt1zjwQnrA__IaRd4WGDfqso', '2014-05-11', 1399778437, 'Lottery', 0, '刮刮卡', 0),
(166, 1, 'yduzak1399706977', 'oifmdjp7nyskEBgMLEyyCmUZMIOM', '2014-05-11', 1399779380, 'follow', 1, '用户关注', 0),
(167, 1, '1c2e75a93c95d89', 'osjWMt_2otvf5dlMJKc9Ic32wSho', '2014-05-11', 1399782237, 'follow', 0, '用户关注', 0),
(168, 1, '1c2e75a93c95d89', 'osjWMt2jhSnkfuajs8xFPpIEUPKU', '2014-05-11', 1399788179, 'follow', 0, '用户关注', 0),
(169, 0, 'd5bd801052e0b53', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-11', 1399792678, 'chat', 0, 'wife', 0),
(170, 1, 'eawfce1399780777', 'ofKEjt_Gg_CrtI8Gt8RHiRtD-E70', '2014-05-11', 1399797892, 'follow', 3, '用户关注', 0),
(171, 2, 'eawfce1399780777', 'ofKEjt_Gg_CrtI8Gt8RHiRtD-E70', '2014-05-11', 1399797914, 'Text', 3, '用户关注', 0),
(172, 0, 'eawfce1399780777', 'ofKEjt_Gg_CrtI8Gt8RHiRtD-E70', '2014-05-11', 1399797944, 'home', 1, '用户关注', 1),
(173, 0, 'eawfce1399780777', 'ofKEjt_Gg_CrtI8Gt8RHiRtD-E70', '2014-05-11', 1399798138, 'home', 0, '首页', 1),
(174, 1, 'eawfce1399780777', 'ofKEjt_Oh6LDVbUpu9PiHEe8RwSs', '2014-05-11', 1399798275, 'follow', 0, '用户关注', 0),
(175, 0, 'eawfce1399780777', 'ofKEjt_Oh6LDVbUpu9PiHEe8RwSs', '2014-05-11', 1399798275, 'home', 0, '用户关注', 1),
(176, 0, 'eawfce1399780777', 'ofKEjt_Oh6LDVbUpu9PiHEe8RwSs', '2014-05-11', 1399798283, 'home', 1, '首页', 1),
(177, 2, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798347, 'Text', 5, '用户关注', 0),
(178, 1, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798355, 'follow', 0, '用户关注', 0),
(179, 0, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798355, 'home', 0, '用户关注', 1),
(180, 0, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798407, 'home', 0, '首页', 1),
(181, 2, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798412, 'Text', 0, '客服电话', 0),
(182, 0, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798437, 'chat', 0, '缎条价格', 0),
(183, 7, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399798690, 'Member_card_set', 0, '会员卡', 0),
(184, 0, 'eawfce1399780777', 'ofKEjt4VyQO8SXXGX0O6zCpSKK3Q', '2014-05-11', 1399799114, 'chat', 0, '1', 0),
(185, 0, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400646624, 'chat', 2, 'yyy18968920219', 0),
(186, 5, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400647618, 'Shake', 1, '摇一摇', 0),
(187, 2, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400651997, 'Wall', 7, '微信墙', 0),
(188, 0, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400652054, 'chat', 1, '你好', 0),
(189, 0, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400652067, 'chat', 2, '##你好', 0),
(190, 11, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400652282, 'Lottery', 1, '大转盘', 0),
(191, 6, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400652380, 'Shake', 5, '摇一摇', 0),
(192, 0, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400652902, 'chat', 1, '留言板', 0),
(193, 3, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400653003, 'Wall', 4, '活动', 0),
(194, 0, 'umlbah1400600498', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400653051, 'chat', 1, '微信墙', 0),
(195, 0, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400660098, 'home', 4, '首页', 1),
(196, 0, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400668713, 'chat', 1, '微订餐', 0),
(197, 1, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400669529, 'Estate', 1, '房产', 0),
(198, 2, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400669757, 'medicalSet', 1, '微医疗', 0),
(199, 2, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670349, 'Meirong', 2, '美容', 0),
(200, 0, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670374, 'chat', 1, '旅游', 0),
(201, 3, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670435, 'Lvyou', 1, '旅游', 0),
(202, 4, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670470, 'Jianshen', 1, '健身', 0),
(203, 5, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670495, 'Zhengwu', 1, '政务', 0),
(204, 6, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670596, 'wuye', 1, '物业', 0),
(205, 7, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670686, 'Ktv', 0, 'ktv', 0),
(206, 8, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670705, 'Jiuba', 0, '酒吧', 0),
(207, 9, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670753, 'Hunqing', 0, '婚庆', 0),
(208, 10, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400670775, 'Zhuangxiu', 1, '装修', 0),
(209, 0, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400670822, 'chat', 0, ' 50+50', 0),
(210, 0, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400670854, 'chat', 0, '笑话', 0),
(211, 0, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400670905, 'chat', 0, '聊天', 0),
(212, 2, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400671690, 'Schoolset', 0, '教育', 0),
(213, 2, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400671714, 'Schoolset', 1, '学校', 0),
(214, 11, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672117, 'Huadian', 1, '花店', 0),
(215, 2, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672308, 'Greeting_card', 1, '贺卡', 0),
(216, 9, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672329, 'Diaoyan', 2, '调研', 0),
(217, 6, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672599, 'Vote', 1, '投票', 0),
(218, 24, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672629, 'Yuyue', 2, '预约', 0),
(219, 7, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672708, 'Shake', 1, '摇一摇', 0),
(220, 4, 'xndgbo1400659291', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400672829, 'Wall', 2, '微信墙', 0),
(221, 0, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400673095, 'home', 3, '首页', 1),
(222, 12, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400673568, 'Lottery', 1, '大转盘', 0),
(223, 0, 'qcryrk1400673224', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400673627, 'chat', 1, 'http://jjl.weiwin.cc/index.php?g=Wap&m=Repast&a=select&token', 0),
(224, 0, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400673725, 'chat', 1, '优惠劵', 0),
(225, 13, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400673742, 'Lottery', 1, '我的', 0),
(226, 0, 'qcryrk1400673224', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400674278, 'chat', 1, '温州天气', 0),
(227, 0, 'qcryrk1400673224', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-21', 1400674334, 'chat', 1, '上海天气', 0),
(228, 0, 'uhsmvp1400670523', 'o6ghct51tvCuFvTnmWcXAy2zR5To', '2014-05-21', 1400675436, 'chat', 1, '点餐', 0),
(229, 0, 'uhsmvp1400670523', 'o6ghct-RcaGCRndW_hYl5NuncM0Y', '2014-05-21', 1400675657, 'chat', 1, '微平台', 0),
(230, 16, '02fc536af9c7466', 'oEI7RjibI0cV2pCcshUynLHKGT3c', '2014-05-22', 1400691937, 'Lottery', 1, '大转盘', 0),
(231, 1, 'c77c845a9509342', 'oNiPDjoV6ipNdkhwsYBWKDeQr3L8', '2014-05-22', 1400702852, 'follow', 1, '用户关注', 0),
(232, 1, 'efldmy1400635676', 'oOwNruNh4a5MCoVaT1m_fGTp_Igo', '2014-05-22', 1400707722, 'follow', 1, '用户关注', 0),
(233, 1, 'f0c1a4fdca1ef4a', 'oRM0DuH4e3QYx91j6atLtrSU1Hjk', '2014-05-22', 1400709043, 'follow', 1, '用户关注', 0),
(234, 1, '6515e805658a5cf', 'oNrsut48yBra4IXNFxAfcI0reSmo', '2014-05-22', 1400715814, 'follow', 1, '用户关注', 0),
(235, 0, 'jvysfw1400718965', 'oeN8Nt8IgBJySbw6SuYGEtNSrDrM', '2014-05-22', 1400719900, 'chat', 4, '用户关注', 0),
(236, 1, 'jvysfw1400718965', 'oeN8Nt8IgBJySbw6SuYGEtNSrDrM', '2014-05-22', 1400719917, 'follow', 4, '用户关注', 0),
(237, 0, 'jvysfw1400718965', 'oeN8Nt8IgBJySbw6SuYGEtNSrDrM', '2014-05-22', 1400720056, 'home', 1, '用户关注', 1),
(238, 2, 'jvysfw1400718965', 'oeN8Nt8IgBJySbw6SuYGEtNSrDrM', '2014-05-22', 1400721242, 'Carset', 1, '汽车', 0),
(239, 1, 'naswhg1400686082', 'ojb0SuAkmzH0-djJM_BpkAkp1_1Q', '2014-05-22', 1400727296, 'follow', 1, '用户关注', 0),
(240, 6, 'da3667d53358b45', 'o6DfEjl19RgcfK22SfFE_pfLpi78', '2014-05-22', 1400728454, 'Wall', 2, '微信墙', 0),
(241, 17, 'azlyfs1400728173', 'oAdlMuDE6-erwC4M-HEmDKJsQTmg', '2014-05-22', 1400728646, 'Lottery', 1, '刮刮卡', 0),
(242, 1, 'f0c1a4fdca1ef4a', 'oRM0DuNMdSGdteA_cqqdgdtg3K6c', '2014-05-22', 1400728774, 'follow', 1, '用户关注', 0),
(243, 18, 'azlyfs1400728173', 'oAdlMuDE6-erwC4M-HEmDKJsQTmg', '2014-05-22', 1400728778, 'Lottery', 1, '刮刮卡', 0),
(244, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400730102, 'chat', 1, '微信墙', 0),
(245, 0, 'azlyfs1400728173', 'oAdlMuDE6-erwC4M-HEmDKJsQTmg', '2014-05-22', 1400730508, 'chat', 1, '水果达人', 0),
(246, 0, 'azlyfs1400728173', 'oAdlMuDE6-erwC4M-HEmDKJsQTmg', '2014-05-22', 1400730515, 'chat', 1, '砸金蛋', 0),
(247, 0, 'azlyfs1400728173', 'oAdlMuDE6-erwC4M-HEmDKJsQTmg', '2014-05-22', 1400730536, 'chat', 1, '力威物流园', 0),
(248, 0, 'azlyfs1400728173', 'oAdlMuDE6-erwC4M-HEmDKJsQTmg', '2014-05-22', 1400730539, 'chat', 2, '关于力威', 0),
(249, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400730984, 'chat', 1, '微信大屏幕', 0),
(250, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400730992, 'chat', 1, '上墙', 0),
(251, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400730999, 'chat', 1, '上墙13581239951', 0),
(252, 7, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400731073, 'Wall', 4, '123', 0),
(253, 1, 'da3667d53358b45', 'o6DfEjhLPqZ9euLhOAX4CVuHFGis', '2014-05-22', 1400731146, 'follow', 1, '用户关注', 0),
(254, 1, 'lylmkx1400730355', 'oHdr_jpdYX00JFw0yjW1jzBlGI8o', '2014-05-22', 1400731316, 'follow', 1, '用户关注', 0),
(255, 0, 'lylmkx1400730355', 'oHdr_jpdYX00JFw0yjW1jzBlGI8o', '2014-05-22', 1400731367, 'home', 2, '首页', 1),
(256, 0, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400731377, 'help', 1, '帮助', 1),
(257, 39, '5e8aeeeabe2d84d', 'o5C4_t4kIg89qqtlcqcis7xbgMds', '2014-05-22', 1400731531, 'Product', 1, '吊灯', 0),
(258, 0, 'rhvbvp1400731169', 'oE2XAuMM4JkjgTkCqr6GkSUZN7pk', '2014-05-22', 1400731731, 'help', 1, '帮助', 1),
(259, 0, 'rhvbvp1400731169', 'oE2XAuMM4JkjgTkCqr6GkSUZN7pk', '2014-05-22', 1400731737, 'home', 4, '首页', 1),
(260, 3, 'rhvbvp1400731169', 'oE2XAuMM4JkjgTkCqr6GkSUZN7pk', '2014-05-22', 1400732241, 'Text', 1, 'aa', 0),
(261, 0, 'rhvbvp1400731169', 'oE2XAuMM4JkjgTkCqr6GkSUZN7pk', '2014-05-22', 1400732567, 'chat', 2, '1111', 0),
(262, 0, 'rhvbvp1400731169', 'oE2XAuMM4JkjgTkCqr6GkSUZN7pk', '2014-05-22', 1400732575, 'chat', 1, '11111', 0),
(263, 1, 'naswhg1400686082', 'ojb0SuAbVZJLHhmcGfGojFf2alSQ', '2014-05-22', 1400733092, 'follow', 1, '用户关注', 0),
(264, 0, 'rhvbvp1400731169', 'oE2XAuMM4JkjgTkCqr6GkSUZN7pk', '2014-05-22', 1400733150, 'chat', 1, '公司简介', 0),
(265, 0, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400733759, 'chat', 1, '微企', 0),
(266, 0, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400733911, 'chat', 1, '测试', 0),
(267, 1, 'lylmkx1400730355', 'oHdr_jvl2x5XlUWgvdQ4uK0xXSZs', '2014-05-22', 1400733962, 'follow', 1, '用户关注', 0),
(268, 0, 'lylmkx1400730355', 'oHdr_jvl2x5XlUWgvdQ4uK0xXSZs', '2014-05-22', 1400733972, 'home', 1, '首页', 1),
(269, 6, 'da3667d53358b45', 'o6DfEjtf2XUOeitbc-z1RMkL896w', '2014-05-22', 1400736104, 'Wall', 1, '用户关注', 0),
(270, 23, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400736346, 'Img', 1, '1', 0),
(271, 19, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400736427, 'Lottery', 1, '大转盘', 0),
(272, 0, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400736552, 'home', 1, '首页', 1),
(273, 3, 'lylmkx1400730355', 'oHdr_jsExaVMJUpoWoVgowLUThx8', '2014-05-22', 1400736693, 'Greeting_card', 1, '9527', 0),
(274, 1, 'naswhg1400686082', 'ojb0SuJIt1mQghnl6q2iiXS490X0', '2014-05-22', 1400737739, 'follow', 1, '用户关注', 0),
(275, 1, 'da3667d53358b45', 'o6DfEjm4T-1SinprMiM6PFYtAAlI', '2014-05-22', 1400738301, 'follow', 1, '用户关注', 0),
(276, 1, 'ddfbtu1400505347', 'o2NN5t8XEt6iiDbwjNSY_Xt6IaSc', '2014-05-22', 1400739453, 'follow', 1, '用户关注', 0),
(277, 12, 'rbodof1400739698', 'oa7PRjp9iiD7RH2ypsmFPAvarrko', '2014-05-22', 1400740719, 'Member_card_set', 6, '会员卡', 0),
(278, 0, 'rbodof1400739698', 'oa7PRjp9iiD7RH2ypsmFPAvarrko', '2014-05-22', 1400740822, 'chat', 1, 'http://test.weiwinbao.com/index.php?g=Wap&m=Card&a=index&tok', 0),
(279, 0, 'rbodof1400739698', 'oa7PRjp9iiD7RH2ypsmFPAvarrko', '2014-05-22', 1400740831, 'chat', 1, '？', 0),
(280, 12, 'rbodof1400739698', 'oa7PRjp9iiD7RH2ypsmFPAvarrko', '2014-05-22', 1400741423, 'Member_card_set', 1, '会员', 0),
(281, 0, '37e9c481cd549e0', 'oqIVVuIvJg6knE5PCQ78eS1_1HjE', '2014-05-22', 1400741580, 'chat', 1, '用户关注', 0),
(282, 1, '37e9c481cd549e0', 'oqIVVuIvJg6knE5PCQ78eS1_1HjE', '2014-05-22', 1400741597, 'follow', 1, '用户关注', 0),
(283, 0, '37e9c481cd549e0', 'oqIVVuIvJg6knE5PCQ78eS1_1HjE', '2014-05-22', 1400741608, 'chat', 1, '微社区', 0),
(284, 1, 'da3667d53358b45', 'o6DfEjjy3Z7ijROUgd0hr9tlFeno', '2014-05-22', 1400743017, 'follow', 1, '用户关注', 0),
(285, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400744255, 'chat', 1, '社区', 0),
(286, 1, 'naswhg1400686082', 'ojb0SuI9GuVo38txkCw4Tl-tbNYM', '2014-05-22', 1400744841, 'follow', 1, '用户关注', 0),
(287, 13, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400744843, 'Estate', 1, '楼盘', 0),
(288, 7, 'a717713db81322c', 'ouvWijjjmR5XqqOAdGcLkGUp1t3E', '2014-05-22', 1400745544, 'Wall', 2, '123', 0),
(289, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400746510, 'chat', 1, '哦哦', 0),
(290, 4, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-22', 1400746588, 'Text', 1, '11', 0),
(291, 1, '5e8aeeeabe2d84d', 'o5C4_t2IE23d20JiFLsz20EIlwWQ', '2014-05-22', 1400750547, 'follow', 1, '用户关注', 0),
(292, 0, '5e8aeeeabe2d84d', 'o5C4_t2IE23d20JiFLsz20EIlwWQ', '2014-05-22', 1400750573, 'home', 1, '首页', 1),
(293, 1, 'efldmy1400635676', 'oOwNruOECHq_QALJseU5T1zFkPIQ', '2014-05-22', 1400750954, 'follow', 1, '用户关注', 0),
(294, 5, 'lylmkx1400730355', 'oPWqQt6h3ljbXz1dgDRr3muBkHio', '2014-05-22', 1400752655, 'Text', 1, '123', 0),
(295, 23, 'lylmkx1400730355', 'oPWqQt6h3ljbXz1dgDRr3muBkHio', '2014-05-22', 1400752844, 'Lottery', 1, '大转盘', 0),
(296, 24, 'lylmkx1400730355', 'oPWqQt6h3ljbXz1dgDRr3muBkHio', '2014-05-22', 1400753118, 'Lottery', 1, '大转盘', 0),
(297, 14, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400753584, 'Member_card_set', 1, '会员卡', 0),
(298, 25, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400753873, 'Lottery', 1, '1', 0),
(299, 0, 'lylmkx1400730355', 'oPWqQt6h3ljbXz1dgDRr3muBkHio', '2014-05-22', 1400754060, 'home', 1, '首页', 1),
(300, 0, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400754705, 'chat', 1, '2', 0),
(301, 1, 'efldmy1400635676', 'oOwNruB7A01IFzRo4lRr3C5fYuQs', '2014-05-22', 1400755304, 'follow', 1, '用户关注', 0),
(302, 7, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400756039, 'Vote', 1, '投票', 0),
(303, 0, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400756177, 'home', 3, '首页', 1),
(304, 41, '5e8aeeeabe2d84d', 'o5C4_t2IE23d20JiFLsz20EIlwWQ', '2014-05-22', 1400757770, 'Product', 1, '用户关注', 0),
(305, 0, '9fb09d2547e5425', 'oB5kKj0_X4GoFMfe90pGLegaYWkA', '2014-05-22', 1400758189, 'chat', 1, '科技', 0),
(306, 0, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400763486, 'chat', 1, '咯嘛', 0),
(307, 1, '7b310b43106ccf4', 'oVIyXjtRLV2mbfEtxdRKbIX28Np0', '2014-05-22', 1400764273, 'follow', 1, '用户关注', 0),
(308, 0, '188146798718486', 'otOYGj8xDbGPGSiKDvJE81Jwc5os', '2014-05-22', 1400764389, 'chat', 2, 'e12', 0),
(309, 1, 'cwgcij1400317706', 'oOx-CuBRC0ZyvIy1Ot5Rr_37e4xw', '2014-05-22', 1400764928, 'follow', 2, '用户关注', 0),
(310, 1, 'naswhg1400686082', 'ojb0SuKHPia96VcZJcqBu6iR3oXk', '2014-05-22', 1400765271, 'follow', 1, '用户关注', 0),
(311, 1, 'ddfbtu1400505347', 'o2NN5txUwA6dWRY-gR_52TWv-PdA', '2014-05-22', 1400765460, 'follow', 1, '用户关注', 0),
(312, 1, 'zmgmot1400567419', 'omTAwuDFgQStEbbYNT5VsefkVBcY', '2014-05-22', 1400766863, 'follow', 1, '用户关注', 0),
(313, 1, 'naswhg1400686082', 'ojb0SuIzajKUWHWt3s90iUGlSXns', '2014-05-22', 1400772887, 'follow', 1, '用户关注', 0),
(314, 1, '9fb09d2547e5425', 'oB5kKj0oPa7ooYUliksCdkLKuaH8', '2014-05-22', 1400773493, 'follow', 1, '用户关注', 0),
(315, 0, '9fb09d2547e5425', 'oB5kKj0oPa7ooYUliksCdkLKuaH8', '2014-05-22', 1400773520, 'chat', 1, 'Ddddd', 0),
(316, 45, '9fb09d2547e5425', 'oB5kKj0oPa7ooYUliksCdkLKuaH8', '2014-05-22', 1400773767, 'Product', 1, '用户关注', 0),
(317, 0, '9fb09d2547e5425', 'oNBRit3AXRuRUqleNNmgV8Nseyos', '2014-05-22', 1400773888, 'chat', 1, '/::|', 0),
(318, 0, '9fb09d2547e5425', 'oNBRit3AXRuRUqleNNmgV8Nseyos', '2014-05-22', 1400773914, 'chat', 1, '/::B', 0),
(319, 0, '9fb09d2547e5425', 'oNBRit3AXRuRUqleNNmgV8Nseyos', '2014-05-23', 1400775267, 'chat', 1, '/::B', 0),
(320, 1, 'fyxtnk1400577626', 'oSky7uKkPjUfKGiHpMnmliOTx0Lc', '2014-05-23', 1400776316, 'follow', 1, '用户关注', 0),
(321, 0, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-23', 1400778059, 'home', 1, '首页', 1),
(322, 3, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-23', 1400779090, 'Schoolset', 2, '学校', 0),
(323, 46, 'lylmkx1400730355', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-23', 1400779771, 'Product', 1, '宝贝', 0),
(324, 0, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-23', 1400786814, 'chat', 1, '计算5+5', 0),
(325, 0, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-23', 1400786847, 'chat', 1, '你好', 0),
(326, 0, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-23', 1400786918, 'chat', 1, '聊天', 0),
(327, 14, 'a2554513584822c', 'owbtat1zhouchWqcfildyhodTYnU', '2014-05-23', 1400797626, 'Estate', 2, '222', 0),
(328, 0, 'a2554513584822c', 'owbtat1zhouchWqcfildyhodTYnU', '2014-05-23', 1400797966, 'chat', 1, '2222', 0),
(329, 0, '188146798718486', 'oCGCTuLSCP4Vt2iJPbDzPSScXsVc', '2014-05-23', 1400801068, 'chat', 1, '哈', 0),
(330, 0, '188146798718486', 'oCGCTuLSCP4Vt2iJPbDzPSScXsVc', '2014-05-23', 1400801329, 'help', 1, 'help', 1),
(331, 0, '188146798718486', 'oCGCTuLSCP4Vt2iJPbDzPSScXsVc', '2014-05-23', 1400801343, 'help', 1, '帮助', 1),
(332, 0, '188146798718486', 'oCGCTuLSCP4Vt2iJPbDzPSScXsVc', '2014-05-23', 1400801392, 'home', 1, '首页', 1),
(333, 15, '188146798718486', 'oCGCTuLSCP4Vt2iJPbDzPSScXsVc', '2014-05-23', 1400801849, 'Estate', 1, 'haha', 0),
(334, 1, '5e8aeeeabe2d84d', 'o5C4_t39yZnAXI2rcCGRJFTNoNW8', '2014-05-23', 1400801962, 'follow', 1, '用户关注', 0),
(335, 0, '04cdd8941f09d37', 'omTAwuGOVzvpgtgXMgUdT7E01NHc', '2014-05-23', 1400808850, 'home', 3, '首页', 1),
(336, 0, '04cdd8941f09d37', 'omTAwuGOVzvpgtgXMgUdT7E01NHc', '2014-05-23', 1400809075, 'chat', 1, '天气查询', 0),
(337, 1, 'hrndlw1400127535', 'ounZNuGO83xwzRWC_lwTPkrekWDA', '2014-05-23', 1400809244, 'follow', 1, '用户关注', 0),
(338, 1, 'naswhg1400686082', 'ojb0SuEs9FMdRFJEXOaU7ge7A4Y0', '2014-05-23', 1400810025, 'follow', 1, '用户关注', 0),
(339, 1, '5e8aeeeabe2d84d', 'o5C4_t9N1dZ4PHH-8SXOjLwcTmhA', '2014-05-23', 1400810230, 'follow', 1, '用户关注', 0),
(340, 0, '5e8aeeeabe2d84d', 'o5C4_t9N1dZ4PHH-8SXOjLwcTmhA', '2014-05-23', 1400810240, 'chat', 1, '您好', 0),
(341, 0, '5e8aeeeabe2d84d', 'o5C4_t9N1dZ4PHH-8SXOjLwcTmhA', '2014-05-23', 1400810466, 'chat', 1, '11', 0),
(342, 1, '5e8aeeeabe2d84d', 'o5C4_twYbTHSSBFVznXUgRsmL48A', '2014-05-23', 1400811785, 'follow', 2, '用户关注', 0),
(343, 26, '5e8aeeeabe2d84d', 'o5C4_twYbTHSSBFVznXUgRsmL48A', '2014-05-23', 1400811928, 'Lottery', 2, '用户关注', 0),
(344, 25, '5e8aeeeabe2d84d', 'o5C4_twYbTHSSBFVznXUgRsmL48A', '2014-05-23', 1400813038, 'Yuyue', 1, '用户关注', 0),
(345, 6, 'tshhtj1400813819', 'oRqHst8d_nlM3YaicHIVIbAR1-pc', '2014-05-23', 1400814020, 'Text', 8, '用户关注', 0),
(346, 1, 'tshhtj1400813819', 'oRqHst8d_nlM3YaicHIVIbAR1-pc', '2014-05-23', 1400814032, 'follow', 3, '用户关注', 0),
(347, 0, 'tshhtj1400813819', 'oRqHst8d_nlM3YaicHIVIbAR1-pc', '2014-05-23', 1400815089, 'chat', 1, '糗事', 0),
(348, 0, 'tshhtj1400813819', 'oRqHst8d_nlM3YaicHIVIbAR1-pc', '2014-05-23', 1400815111, 'chat', 2, '50-50', 0),
(349, 1, 'hrndlw1400127535', 'ounZNuN7ckQf8wccalnbdX677ppQ', '2014-05-23', 1400820847, 'follow', 1, '用户关注', 0),
(350, 1, 'naswhg1400686082', 'ojb0SuOCwEMjI1pYcrL825-0xnLg', '2014-05-23', 1400823679, 'follow', 2, '用户关注', 0),
(351, 1, 'naswhg1400686082', 'ojb0SuKUys0-9FiiGN9bAwzjBdLY', '2014-05-23', 1400828019, 'follow', 1, '用户关注', 0),
(352, 18, '04cdd8941f09d37', 'omTAwuGOVzvpgtgXMgUdT7E01NHc', '2014-05-23', 1400829862, 'Zhuangxiu', 1, '华佑装饰', 0),
(353, 1, 'f0c1a4fdca1ef4a', 'oRM0DuGzPS2CADdejEQaeX472q7M', '2014-05-23', 1400831327, 'follow', 1, '用户关注', 0),
(354, 0, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-23', 1400832764, 'chat', 1, '有', 0),
(355, 26, '04cdd8941f09d37', 'omTAwuG9v-A07eTMYXZWJygMZfxs', '2014-05-23', 1400834900, 'Yuyue', 1, '用户关注', 0),
(356, 1, 'efldmy1400635676', 'oOwNruJMwCcsBhhyhpqPuoDdLmes', '2014-05-23', 1400835277, 'follow', 1, '用户关注', 0),
(357, 1, 'dsnebz1400733899', 'ofhQDj0wBoeadDRU9AiOZ2-X2PQo', '2014-05-23', 1400840588, 'follow', 1, '用户关注', 0),
(358, 1, 'dsnebz1400733899', 'ofhQDjyC5xwTvLTsIhRmOiB6Ku2A', '2014-05-23', 1400842596, 'follow', 1, '用户关注', 0),
(359, 0, 'dsnebz1400733899', 'ofhQDjxWS5CCbC4R8MjWa8QGdDeg', '2014-05-23', 1400842642, 'chat', 1, '用户关注', 0),
(360, 1, 'naswhg1400686082', 'ojb0SuPMMkEhs7SlOSFCsDTb32RU', '2014-05-23', 1400844692, 'follow', 1, '用户关注', 0),
(361, 1, '5f787625fc823a2', 'oENrSjmxJ1ikelQWEB3MBR0n6dp4', '2014-05-23', 1400845804, 'follow', 1, '用户关注', 0),
(362, 1, 'e979f170a4a9169', 'oF1UUtzazh97qd4110-DpCd6J-QI', '2014-05-23', 1400847661, 'follow', 1, '用户关注', 0),
(363, 32, '86df3e5db3c8443', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-23', 1400848865, 'Img', 1, '用户关注', 0),
(364, 1, '86df3e5db3c8443', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-23', 1400848883, 'follow', 3, '用户关注', 0),
(365, 0, '86df3e5db3c8443', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-23', 1400848925, 'Member_card_set', 3, '会员卡', 0),
(366, 0, '86df3e5db3c8443', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-23', 1400848945, 'chat', 1, '大妙火锅', 0),
(367, 1, '5f787625fc823a2', 'oENrSjr2w0hgpfLZmkLbQnotJliM', '2014-05-23', 1400850042, 'follow', 1, '用户关注', 0),
(368, 1, 'naswhg1400686082', 'ojb0SuKG7Yc1qMkK1qwjS8Zi9mYQ', '2014-05-23', 1400852706, 'follow', 1, '用户关注', 0),
(369, 1, 'naswhg1400686082', 'ojb0SuKp2IfyrVwWvYfaUAbDiuMM', '2014-05-23', 1400853329, 'follow', 1, '用户关注', 0),
(370, 26, '04cdd8941f09d37', 'omTAwuHEcQrcoC7zzCOsmUVacp3Q', '2014-05-23', 1400857320, 'Yuyue', 1, '用户关注', 0),
(371, 1, 'f0c1a4fdca1ef4a', 'oRM0DuFa5binJohfzRB0GuuqYuW0', '2014-05-23', 1400857455, 'follow', 1, '用户关注', 0),
(372, 1, 'dsnebz1400733899', 'ofhQDj4V8O8EJdu--W6gMpu6QWNE', '2014-05-23', 1400858298, 'follow', 1, '用户关注', 0),
(373, 32, 'pnxvgh1400856440', 'oahjejvkjDHn2lCkRUH1dUcB8bNw', '2014-05-23', 1400859061, 'Lottery', 3, '用户关注', 0),
(374, 1, 'pnxvgh1400856440', 'oahjejvkjDHn2lCkRUH1dUcB8bNw', '2014-05-23', 1400859221, 'follow', 2, '用户关注', 0),
(375, 1, 'dsnebz1400733899', 'ofhQDj6CEFGYrjEzYOfrTZ8E5RmQ', '2014-05-23', 1400860156, 'follow', 1, '用户关注', 0),
(376, 0, 'trybtb1400856298', 'oUhMMtyFK50uFy60Onj6_N4oJ1EA', '2014-05-24', 1400861172, 'help', 2, '帮助', 1),
(377, 0, 'trybtb1400856298', 'oUhMMtyFK50uFy60Onj6_N4oJ1EA', '2014-05-24', 1400861504, 'chat', 1, '糗事', 0),
(378, 0, 'trybtb1400856298', 'oUhMMtyFK50uFy60Onj6_N4oJ1EA', '2014-05-24', 1400861943, 'chat', 2, 'e12', 0),
(379, 1, '23d214d2a37ed14', 'ol158uC2QSGC4Nm8kAAvX59fqjjg', '2014-05-24', 1400862289, 'follow', 1, '用户关注', 0),
(380, 0, 'trybtb1400856298', 'oUhMMtyFK50uFy60Onj6_N4oJ1EA', '2014-05-24', 1400862764, 'home', 2, 'home', 1),
(381, 1, 'tzvryd1399901582', 'oNcLojjeLIgSUuFQa7uEBHE6_wp8', '2014-05-24', 1400865741, 'follow', 1, '用户关注', 0),
(382, 1, 'dsnebz1400733899', 'ofhQDjyi1lEcsiIN9szW3hghTHAI', '2014-05-24', 1400866664, 'follow', 1, '用户关注', 0),
(383, 1, 'efldmy1400635676', 'oOwNruPnxWg8IWvj8qLFLYQkbgx4', '2014-05-24', 1400879757, 'follow', 1, '用户关注', 0),
(384, 0, 'pnxvgh1400856440', 'oahjejvkjDHn2lCkRUH1dUcB8bNw', '2014-05-24', 1400888953, 'home', 2, '首页', 1),
(385, 1, '04cdd8941f09d37', 'omTAwuAOeQCKohAXZIq09cb-FX20', '2014-05-24', 1400895992, 'follow', 1, '用户关注', 0),
(386, 0, '04cdd8941f09d37', 'omTAwuAOeQCKohAXZIq09cb-FX20', '2014-05-24', 1400895992, 'chat', 1, '用户关注', 0),
(387, 0, 'dsnebz1400733899', 'ofhQDj4PzCHiEi34Oz_I4bJB4C-4', '2014-05-24', 1400896676, 'chat', 1, '用户关注', 0),
(388, 0, 'dsnebz1400733899', 'ofhQDj9KmkPw0BkIaNmh-jM4BvP8', '2014-05-24', 1400897028, 'chat', 1, '用户关注', 0),
(389, 1, 'naswhg1400686082', 'ojb0SuLdF-FHO7NPJz6dpDmYGv98', '2014-05-24', 1400897030, 'follow', 1, '用户关注', 0),
(390, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400897501, 'chat', 5, '用户关注', 0),
(391, 1, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400897533, 'follow', 6, '用户关注', 0),
(392, 1, 'naswhg1400686082', 'ojb0SuIfajx7XuizYfjBWNJ5JWxI', '2014-05-24', 1400898388, 'follow', 1, '用户关注', 0),
(393, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400899243, 'chat', 3, '促销', 0),
(394, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400899246, 'chat', 3, '产品销售', 0),
(395, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400899249, 'home', 2, '首页', 1),
(396, 0, 'posvfl1400901820', 'ov7KZuB7B04pKiYbyAeLe2GITJuQ', '2014-05-24', 1400902087, 'chat', 1, '哈哈哈', 0),
(397, 0, 'posvfl1400901820', 'ov7KZuB7B04pKiYbyAeLe2GITJuQ', '2014-05-24', 1400902096, 'chat', 1, '小白', 0),
(398, 0, 'posvfl1400901820', 'ov7KZuB7B04pKiYbyAeLe2GITJuQ', '2014-05-24', 1400902099, 'chat', 4, 'm', 0),
(399, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400902490, 'chat', 5, '/index.php?g=Wap&m=Product&a=c', 0),
(400, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400902495, 'chat', 3, '电话', 0),
(401, 1, 'dsnebz1400733899', 'ofhQDj-VozbG-veHukY5xOK1kjJ0', '2014-05-24', 1400902819, 'follow', 1, '用户关注', 0),
(402, 0, 'dsnebz1400733899', 'ofhQDj-VozbG-veHukY5xOK1kjJ0', '2014-05-24', 1400902993, 'chat', 1, '可以发布吗', 0),
(403, 34, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-24', 1400903042, 'Lottery', 1, '用户关注', 0),
(404, 0, 'dsnebz1400733899', 'ofhQDj9K-1Mx9ZGJTLcBer1XKqsQ', '2014-05-24', 1400903141, 'chat', 1, '1', 0),
(405, 0, 'dsnebz1400733899', 'ofhQDj9K-1Mx9ZGJTLcBer1XKqsQ', '2014-05-24', 1400903153, 'chat', 1, 'hello', 0),
(406, 1, 'naswhg1400686082', 'ojb0SuNcqVgCxQT6tCuANMP1dmzQ', '2014-05-24', 1400906896, 'follow', 1, '用户关注', 0),
(407, 1, '5f787625fc823a2', 'oENrSjswtfT6USwH89vJmQOa1u7Q', '2014-05-24', 1400910431, 'follow', 1, '用户关注', 0),
(408, 1, 'dsnebz1400733899', 'ofhQDj4M1jiFlqT8JEdJvJM0YWUo', '2014-05-24', 1400910463, 'follow', 1, '用户关注', 0),
(409, 0, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400913077, 'chat', 1, '摇一摇', 0),
(410, 12, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400913090, 'Shake', 1, '云动科技', 0),
(411, 0, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400913337, 'chat', 1, 'zaime', 0),
(412, 0, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400913363, 'chat', 1, '你好', 0),
(413, 36, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400913746, 'Lottery', 3, '水果达人', 0),
(414, 0, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400914373, 'chat', 2, '陪聊', 0),
(415, 1, 'nipljx1399962330', 'olDjDjiaDLmNgyBv8j0BkBFeumgk', '2014-05-24', 1400914448, 'follow', 1, '用户关注', 0),
(416, 0, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400914560, 'chat', 1, '水果机', 0),
(417, 37, 'eeejav1400912906', 'oMftCt5L5aSoCZ4dfNQTxawpRbEw', '2014-05-24', 1400914819, 'Lottery', 1, '水果达人', 0),
(418, 26, '04cdd8941f09d37', 'omTAwuFyWiv3S3nMm0nJSIKAMLOg', '2014-05-24', 1400915330, 'Yuyue', 2, '用户关注', 0),
(419, 1, '23d214d2a37ed14', 'ol158uENrVYiQPTAMWw85L2jlyI0', '2014-05-24', 1400917053, 'follow', 1, '用户关注', 0),
(420, 1, 'dsnebz1400733899', 'ofhQDj0p_i6TQDrKGoVeLSJI1LcA', '2014-05-24', 1400919034, 'follow', 1, '用户关注', 0),
(421, 1, 'dsnebz1400733899', 'ofhQDj9kSd48DNYQxOhp1IUbozLw', '2014-05-24', 1400919256, 'follow', 1, '用户关注', 0),
(422, 0, 'dsnebz1400733899', 'ofhQDj9kSd48DNYQxOhp1IUbozLw', '2014-05-24', 1400919499, 'chat', 1, '用户关注', 0),
(423, 1, 'naswhg1400686082', 'ojb0SuLO8V-p32tpKzv_CN8W2izY', '2014-05-24', 1400921054, 'follow', 1, '用户关注', 0),
(424, 1, 'dsnebz1400733899', 'ofhQDj5THr3PeZnHVlAARqdm5qS0', '2014-05-24', 1400921089, 'follow', 1, '用户关注', 0),
(425, 0, 'dsnebz1400733899', 'ofhQDj5THr3PeZnHVlAARqdm5qS0', '2014-05-24', 1400921768, 'chat', 1, '租房', 0),
(426, 0, 'dsnebz1400733899', 'ofhQDj5THr3PeZnHVlAARqdm5qS0', '2014-05-24', 1400921775, 'chat', 1, '整套租', 0),
(427, 0, '2118574217f66b1', 'oygE7t1arbR7ZlOxnL4qqianQyvE', '2014-05-24', 1400921849, 'home', 1, '首页', 1),
(428, 0, '2118574217f66b1', 'oygE7t1arbR7ZlOxnL4qqianQyvE', '2014-05-24', 1400921871, 'chat', 1, '糗事', 0),
(429, 26, '04cdd8941f09d37', 'omTAwuG9v-A07eTMYXZWJygMZfxs', '2014-05-24', 1400924729, 'Yuyue', 1, '用户关注', 0),
(430, 1, 'nipljx1399962330', 'olDjDjkYvhXS9lx-Ucz7XQ89ChoM', '2014-05-24', 1400924904, 'follow', 1, '用户关注', 0),
(431, 1, 'efldmy1400635676', 'oOwNruKehqzdiOWWjAsyNtLWpjKQ', '2014-05-24', 1400925134, 'follow', 1, '用户关注', 0),
(432, 1, 'c77c845a9509342', 'oNiPDjhtIl8xY5kOEMuhIs8fgNig', '2014-05-24', 1400926555, 'follow', 1, '用户关注', 0),
(433, 0, 'mfquez1400927795', 'o2l9StxkPgBFZ5luuwzol2nHxwwk', '2014-05-24', 1400928115, 'home', 5, '首页', 1),
(434, 0, 'mfquez1400927795', 'o2l9StxkPgBFZ5luuwzol2nHxwwk', '2014-05-24', 1400928198, 'help', 1, '帮助', 1),
(435, 1, 'eeejav1400912906', 'oMftCt66pZ8ARnN_XyIsqoPz5ceE', '2014-05-24', 1400929344, 'follow', 1, '用户关注', 0),
(436, 51, 'eeejav1400912906', 'oMftCt66pZ8ARnN_XyIsqoPz5ceE', '2014-05-24', 1400929350, 'Product', 2, '111', 0);
INSERT INTO `wy_behavior` (`id`, `fid`, `token`, `openid`, `date`, `enddate`, `model`, `num`, `keyword`, `type`) VALUES
(437, 51, 'eeejav1400912906', 'oMftCt66pZ8ARnN_XyIsqoPz5ceE', '2014-05-24', 1400929632, 'Product', 1, '用户关注', 0),
(438, 53, 'yixxnr1400929637', 'ojpZ7uFfyda3PLxJVtmvHCiJ3Qcg', '2014-05-24', 1400929964, 'Product', 4, '133', 0),
(439, 0, 'yixxnr1400929637', 'ojpZ7uFfyda3PLxJVtmvHCiJ3Qcg', '2014-05-24', 1400930154, 'chat', 2, '123', 0),
(440, 1, '6515e805658a5cf', 'oNrsut13dMcyvz6vPCOLMEn5nc80', '2014-05-24', 1400930189, 'follow', 1, '用户关注', 0),
(441, 10, '86df3e5db3c8443', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-24', 1400932257, 'Diaoyan', 1, '用户关注', 0),
(442, 1, '86df3e5db3c8443', 'o3zmCuI1TFpQpdu_Kz_zgopui41s', '2014-05-24', 1400932271, 'follow', 1, '用户关注', 0),
(443, 1, 'naswhg1400686082', 'ojb0SuNQCgwZN01cM84ePMODXid8', '2014-05-24', 1400936068, 'follow', 1, '用户关注', 0),
(444, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937530, 'chat', 1, '用户关注', 0),
(445, 1, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937534, 'follow', 1, '用户关注', 0),
(446, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937548, 'chat', 1, '聊天', 0),
(447, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937554, 'chat', 2, '你好', 0),
(448, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937568, 'chat', 1, '在干嘛？', 0),
(449, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937748, 'chat', 1, '就会说这个嘛？', 0),
(450, 1, 'oudsvk1400937241', 'oERk8t8Dk4Mn7bGGPZYnRVM4pSTE', '2014-05-24', 1400937800, 'follow', 1, '用户关注', 0),
(451, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937830, 'chat', 1, '陪聊', 0),
(452, 0, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400937922, 'chat', 1, '糗事', 0),
(453, 9, 'oudsvk1400937241', 'oERk8twLJx5SaKb-2ykuzmYy-fNc', '2014-05-24', 1400938107, 'Text', 1, '你好', 0),
(454, 0, 'cippza1400938053', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-24', 1400938446, 'chat', 1, '你好', 0),
(455, 0, 'cippza1400938053', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-24', 1400938456, 'chat', 1, '你是哪个', 0),
(456, 0, 'cippza1400938053', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-24', 1400938505, 'chat', 2, '糗事', 0),
(457, 0, 'cippza1400938053', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-24', 1400938617, 'chat', 1, '聊天', 0),
(458, 0, 'cippza1400938053', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-24', 1400938709, 'chat', 2, '计算', 0),
(459, 0, 'cippza1400938053', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-24', 1400938755, 'chat', 1, '计算50+8', 0),
(460, 1, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940667, 'follow', 1, '用户关注', 0),
(461, 0, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940752, 'chat', 1, 'lbs', 0),
(462, 0, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940764, 'chat', 1, '滚', 0),
(463, 0, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940781, 'chat', 1, '？？？？？', 0),
(464, 0, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940897, 'chat', 1, '大转盘', 0),
(465, 0, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940931, 'chat', 1, '转盘', 0),
(466, 0, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400940976, 'chat', 1, '砸金蛋', 0),
(467, 0, '66093e12760a046', 'ohbTsjr9NK8I-j1QeZbNLBFRKpH8', '2014-05-24', 1400941071, 'chat', 1, '微喜帖', 0),
(468, 5, '66093e12760a046', 'ohbTsjr9NK8I-j1QeZbNLBFRKpH8', '2014-05-24', 1400941089, 'Wedding', 1, 'xt', 0),
(469, 13, '66093e12760a046', 'ohbTsjr9NK8I-j1QeZbNLBFRKpH8', '2014-05-24', 1400941635, 'Shake', 1, 'yyy', 0),
(470, 1, '66093e12760a046', 'ohbTsjm9ng-gP4utm0srtwYon7Rg', '2014-05-24', 1400941893, 'follow', 1, '用户关注', 0),
(471, 1, 'efldmy1400635676', 'oOwNruGm5u-ShVgCiDeEdzvaAcr4', '2014-05-24', 1400942083, 'follow', 1, '用户关注', 0),
(472, 0, '66093e12760a046', 'ohbTsjm9ng-gP4utm0srtwYon7Rg', '2014-05-24', 1400942329, 'chat', 3, '哈哈', 0),
(473, 0, '66093e12760a046', 'ohbTsjr9NK8I-j1QeZbNLBFRKpH8', '2014-05-24', 1400942673, 'chat', 2, 'Z', 0),
(474, 0, '66093e12760a046', 'ohbTsjr9NK8I-j1QeZbNLBFRKpH8', '2014-05-24', 1400942683, 'chat', 1, 'A', 0),
(475, 0, '66093e12760a046', 'ohbTsjr9NK8I-j1QeZbNLBFRKpH8', '2014-05-24', 1400942700, 'chat', 1, '你好', 0),
(476, 13, '66093e12760a046', 'ohbTsjsKn_5STmTCBfiMwn4tMQPI', '2014-05-24', 1400943004, 'Shake', 1, '用户关注', 0),
(477, 1, '6515e805658a5cf', 'oNrsut1NkxgNedopvDsEk3Q0SclQ', '2014-05-24', 1400943382, 'follow', 1, '用户关注', 0),
(478, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944052, 'help', 1, '帮助', 1),
(479, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944129, 'chat', 1, 'd', 0),
(480, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944134, 'chat', 1, 'f', 0),
(481, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944200, 'home', 6, '首页', 1),
(482, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944267, 'chat', 1, '计算器', 0),
(483, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944377, 'chat', 1, 'h', 0),
(484, 1, 'dcabgw1400943501', 'oFEsouK-VpiAibG0mkIK2-KLXMa8', '2014-05-24', 1400944527, 'follow', 1, '用户关注', 0),
(485, 0, 'dcabgw1400943501', 'oFEsouK-VpiAibG0mkIK2-KLXMa8', '2014-05-24', 1400944558, 'chat', 1, '用户关注', 0),
(486, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400944563, 'chat', 1, 'r', 0),
(487, 36, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400945228, 'Img', 1, '活动', 0),
(488, 39, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400945737, 'Lottery', 3, '大转盘', 0),
(489, 0, '23d214d2a37ed14', 'ol158uKJkY2Vhe1wzoE1qBL4vPKE', '2014-05-24', 1400946087, 'home', 1, '首页', 1),
(490, 40, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400946389, 'Lottery', 1, '水果', 0),
(491, 41, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-24', 1400946585, 'Lottery', 1, '金蛋', 0),
(492, 0, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952579, 'chat', 2, '微信墙', 0),
(493, 0, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952589, 'chat', 1, '##你好', 0),
(494, 0, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952600, 'chat', 1, '功能', 0),
(495, 0, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952603, 'home', 1, '首页', 1),
(496, 0, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952647, 'chat', 1, '？', 0),
(497, 31, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952695, 'Lottery', 1, '大转盘', 0),
(498, 0, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952746, 'chat', 1, '摇一摇', 0),
(499, 16, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400952774, 'Wall', 2, '年会', 0),
(500, 16, '04cdd8941f09d37', 'oXMeYt3jjx88Woieh5tE1ugF1D4o', '2014-05-25', 1400952953, 'Wall', 2, '年会', 0),
(501, 14, '04cdd8941f09d37', 'oXMeYt3jjx88Woieh5tE1ugF1D4o', '2014-05-25', 1400953248, 'Shake', 1, 'yyy', 0),
(502, 14, '04cdd8941f09d37', 'oXMeYt_ZQLKkvWkzXU-NpgzJrlYw', '2014-05-25', 1400953294, 'Shake', 1, 'yyy', 0),
(503, 1, '5e8aeeeabe2d84d', 'ojb0SuFU-YCE0tefuEzz4Vde4mMU', '2014-05-25', 1400956688, 'follow', 1, '用户关注', 0),
(504, 0, '5e8aeeeabe2d84d', 'ojb0SuFU-YCE0tefuEzz4Vde4mMU', '2014-05-25', 1400956707, 'home', 1, '首页', 1),
(505, 1, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400957109, 'follow', 1, '用户关注', 0),
(506, 0, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400957151, 'chat', 1, '你好', 0),
(507, 0, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400957271, 'chat', 1, '计算20-50', 0),
(508, 0, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400957521, 'chat', 1, '123456', 0),
(509, 2, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400957569, 'Voiceresponse', 1, '111111', 0),
(510, 19, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400957890, 'Estate', 1, '5566', 0),
(511, 60, 'yteauc1400955117', 'odtpEt1gQcWpcBkrqavl7eedEeY8', '2014-05-25', 1400958042, 'Product', 1, '2233', 0),
(512, 42, 'yteauc1400955117', 'oCP-It6C3IJsy1CdAs_YplrnebkM', '2014-05-25', 1400958174, 'Lottery', 1, '砸金蛋', 0),
(513, 61, 'yteauc1400955117', 'oCP-It6C3IJsy1CdAs_YplrnebkM', '2014-05-25', 1400958342, 'Product', 1, '1234', 0),
(514, 1, 'eeejav1400912906', 'oMftCt5BWHhXlmNuDPTSaBMStd6o', '2014-05-25', 1400968802, 'follow', 1, '用户关注', 0),
(515, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-25', 1400973160, 'chat', 2, '/index.php?g=Wap&m=Product&a=c', 0),
(516, 0, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-25', 1400973164, 'chat', 2, '电话', 0),
(517, 34, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-25', 1400973174, 'Lottery', 1, '用户关注', 0),
(518, 1, 'zjxkgy1400897053', 'ojdtTuDxa-34oHXk0cK7r5elbJZA', '2014-05-25', 1400973191, 'follow', 1, '用户关注', 0),
(519, 1, 'efldmy1400635676', 'oOwNruEpLi7cGgastiKPsakLxC3I', '2014-05-25', 1400980334, 'follow', 1, '用户关注', 0),
(520, 1, 'nipljx1399962330', 'olDjDjp2PdU4PIVJxYhpom3pWg8I', '2014-05-25', 1400981698, 'follow', 1, '用户关注', 0),
(521, 1, '04cdd8941f09d37', 'omTAwuMErs2kj09gPzmSD8-JgMkI', '2014-05-25', 1400982529, 'follow', 1, '用户关注', 0),
(522, 0, '04cdd8941f09d37', 'omTAwuMErs2kj09gPzmSD8-JgMkI', '2014-05-25', 1400982529, 'chat', 1, '用户关注', 0),
(523, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-25', 1400983412, 'chat', 1, '生活小助手', 0),
(524, 1, 'efldmy1400635676', 'oOwNruHe25p0AeZ-AfFiaR74OOcQ', '2014-05-25', 1400983463, 'follow', 1, '用户关注', 0),
(525, 5, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-25', 1400984436, 'Panorama', 1, '用户关注', 0),
(526, 1, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-25', 1400984462, 'follow', 1, '用户关注', 0),
(527, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-25', 1400984484, 'chat', 2, '用户关注', 0),
(528, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-25', 1400984530, 'home', 1, '首页', 1),
(529, 0, 'dcabgw1400943501', 'oFEsouNZY5f-L03o_29Y2DwX2qkI', '2014-05-25', 1400984591, 'help', 1, '帮助', 1),
(530, 20, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400986555, 'Member_card_set', 1, '会员', 0),
(531, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400986842, 'chat', 1, '陪聊', 0),
(532, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400986850, 'chat', 2, '你好', 0),
(533, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400986859, 'chat', 1, '说话啊', 0),
(534, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400986887, 'chat', 1, '你是？', 0),
(535, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400986903, 'chat', 1, '男的女的？', 0),
(536, 0, '37ba541feeb5f2a', 'olgxmuFS0tZMovT-sft50VOzrS0M', '2014-05-25', 1400986920, 'chat', 3, '用户关注', 0),
(537, 1, '37ba541feeb5f2a', 'olgxmuFS0tZMovT-sft50VOzrS0M', '2014-05-25', 1400986971, 'follow', 1, '用户关注', 0),
(538, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400987001, 'chat', 1, '聊天', 0),
(539, 0, 'ceab170c3dec82a', 'osYvajm8luAnaEIL650lN85Vay6c', '2014-05-25', 1400987021, 'chat', 1, '在吗', 0),
(540, 0, 'ceab170c3dec82a', 'osYvajvTNGsnQ3QifetRUb-nXBkY', '2014-05-25', 1400988917, 'chat', 1, '南乐城那里有自助餐厅', 0),
(541, 1, 'nipljx1399962330', 'olDjDjpZdhvSwFb3l-6M7wk9fYP4', '2014-05-25', 1400991189, 'follow', 1, '用户关注', 0),
(542, 1, 'f0c1a4fdca1ef4a', 'oRM0DuCVqCXO1TCj8FC0dyvCm1-U', '2014-05-25', 1400991351, 'follow', 1, '用户关注', 0),
(543, 1, '5e8aeeeabe2d84d', 'ojb0SuHuKuUACU9NkedFV-zoGphA', '2014-05-25', 1400992247, 'follow', 1, '用户关注', 0),
(544, 1, 'c77c845a9509342', 'oNiPDjoV6ipNdkhwsYBWKDeQr3L8', '2014-05-25', 1400993335, 'follow', 1, '用户关注', 0),
(545, 1, '04cdd8941f09d37', 'omTAwuOpEKa385a8hpreneLECkBQ', '2014-05-25', 1400998111, 'follow', 1, '用户关注', 0),
(546, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-25', 1400998850, 'chat', 1, '用户关注', 0),
(547, 1, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-25', 1400998863, 'follow', 1, '用户关注', 0),
(548, 11, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-25', 1400998907, 'Text', 1, '皮斌', 0),
(549, 0, 'bd3feef40f31c41', 'opg2QuKLRwH1XWIgDnDQHqLaXcPg', '2014-05-25', 1400998927, 'home', 1, '首页', 1),
(550, 0, 'bd3feef40f31c41', 'opg2QuKLRwH1XWIgDnDQHqLaXcPg', '2014-05-25', 1400998984, 'chat', 1, '糗事', 0),
(551, 0, 'bd3feef40f31c41', 'opg2QuKLRwH1XWIgDnDQHqLaXcPg', '2014-05-25', 1400999022, 'chat', 1, '藏头诗我是老师', 0),
(552, 1, '04cdd8941f09d37', 'omTAwuH2gqrYtALw2FoNWIAGEXWg', '2014-05-25', 1400999173, 'follow', 4, '用户关注', 0),
(553, 1, '6515e805658a5cf', 'oNrsut5uzImoTyaj0OYVIHVSZeKE', '2014-05-25', 1401001311, 'follow', 1, '用户关注', 0),
(554, 0, 'taqiha1401000318', 'onQAHtwi_2TrJ93TeP1-i_FIx-_g', '2014-05-25', 1401001413, 'home', 1, '首页', 1),
(555, 0, 'bmmzlc1401001546', 'oUhMMtyFK50uFy60Onj6_N4oJ1EA', '2014-05-25', 1401002419, 'home', 2, '首页', 1),
(556, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401002703, 'chat', 1, '麻城', 0),
(557, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401002730, 'home', 2, '首页', 1),
(558, 12, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401003154, 'Text', 1, '麻城', 0),
(559, 22, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401003705, 'Member_card_set', 1, '会员', 0),
(560, 11, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401004081, 'Diaoyan', 2, '武汉人数', 0),
(561, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401004521, 'chat', 1, '摇一摇', 0),
(562, 15, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401004546, 'Shake', 1, '哈哈', 0),
(563, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401004757, 'chat', 2, '123', 0),
(564, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401004836, 'chat', 3, '微信墙', 0),
(565, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-25', 1401004863, 'chat', 1, '微信墙13469587436', 0),
(566, 0, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401005488, 'chat', 2, '功能', 0),
(567, 0, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401005512, 'home', 8, '首页', 1),
(568, 0, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401006827, 'chat', 1, '收我的', 0),
(569, 0, 'gjehca1401004322', 'o-d6vjlQBKVh7bzcMtXKiVLCgb6k', '2014-05-25', 1401007586, 'home', 1, '首页', 1),
(570, 64, 'gjehca1401004322', 'o-d6vjlQBKVh7bzcMtXKiVLCgb6k', '2014-05-25', 1401007631, 'Product', 1, '111', 0),
(571, 0, '7b37f944108c95e', 'oSDiVt8H0cOzHbNZlp_zaesxDC4I', '2014-05-25', 1401007653, 'home', 1, '首页', 1),
(572, 64, 'gjehca1401004322', 'o-d6vjmIN4vd5f-PO648HVxC_YKU', '2014-05-25', 1401007789, 'Product', 1, '111', 0),
(573, 0, '7b37f944108c95e', 'oSDiVt8H0cOzHbNZlp_zaesxDC4I', '2014-05-25', 1401007805, 'chat', 1, '/::~', 0),
(574, 0, '7b37f944108c95e', 'oSDiVt8H0cOzHbNZlp_zaesxDC4I', '2014-05-25', 1401007929, 'chat', 1, '/::)', 0),
(575, 0, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-25', 1401008416, 'help', 2, '帮助', 1),
(576, 17, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-25', 1401008440, 'Shake', 1, '用户关注', 0),
(577, 1, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-25', 1401008442, 'follow', 1, '用户关注', 0),
(578, 0, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-25', 1401008473, 'chat', 1, 'menu_20140513171731', 0),
(579, 17, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-25', 1401008525, 'Shake', 1, '上墙', 0),
(580, 0, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-25', 1401008539, 'home', 1, '首页', 1),
(581, 0, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401008552, 'chat', 1, '5', 0),
(582, 1, 'gabnjc1401007613', 'oI89luJXf3X5oiqPiZKoji1e0Wgk', '2014-05-25', 1401008757, 'follow', 1, '用户关注', 0),
(583, 1, 'efldmy1400635676', 'oOwNruF3YJPtRRMhZ-9FIDGYLer4', '2014-05-25', 1401011257, 'follow', 1, '用户关注', 0),
(584, 66, 'gjehca1401004322', 'o-d6vjkw-vHYkN_-F7L1-IRfJJEw', '2014-05-25', 1401011965, 'Product', 1, '用户关注', 0),
(585, 0, 'kijblm1401012135', 'oTHzPjqz5rHDMZhY8M4fhCCc0BcQ', '2014-05-25', 1401012350, 'chat', 1, '用户关注', 0),
(586, 1, 'kijblm1401012135', 'oTHzPjqz5rHDMZhY8M4fhCCc0BcQ', '2014-05-25', 1401012354, 'follow', 1, '用户关注', 0),
(587, 0, 'kijblm1401012135', 'oTHzPjqz5rHDMZhY8M4fhCCc0BcQ', '2014-05-25', 1401012364, 'home', 1, '首页', 1),
(588, 1, 'fyxtnk1400577626', 'oSky7uA84cCSyzZkVuGmycjxRD8I', '2014-05-25', 1401013237, 'follow', 1, '用户关注', 0),
(589, 41, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401013327, 'Img', 1, '用户关注', 0),
(590, 1, 'nipljx1399962330', 'olDjDjkDf0hBCQlyD-GYPMIx0Qq8', '2014-05-25', 1401013806, 'follow', 1, '用户关注', 0),
(591, 45, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401013877, 'Lottery', 1, '大转盘', 0),
(592, 1, '5e8aeeeabe2d84d', 'ojb0SuLzCwgfy8bAjDGDG7N_spQo', '2014-05-25', 1401013933, 'follow', 1, '用户关注', 0),
(593, 0, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401014509, 'chat', 1, '优惠', 0),
(594, 0, 'jthtom1401004976', 'oHxGsuG3-4LUzD48D_WS9hsGVHDo', '2014-05-25', 1401014584, 'chat', 1, '简介', 0),
(595, 66, 'gjehca1401004322', 'o-d6vjie1ys2Qbh0WPap2oDXPuP4', '2014-05-25', 1401017713, 'Product', 1, '用户关注', 0),
(596, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020459, 'chat', 1, '用户关注', 0),
(597, 1, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020474, 'follow', 1, '用户关注', 0),
(598, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020504, 'chat', 1, '你好', 0),
(599, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020513, 'chat', 1, '什么啊', 0),
(600, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020521, 'chat', 1, '说话', 0),
(601, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020579, 'chat', 2, '糗事', 0),
(602, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020587, 'home', 2, '首页', 1),
(603, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020681, 'Member_card_set', 1, '会员', 0),
(604, 0, 'ahpezl1401020214', 'ovL8euE9vbPENw-oYnRemjdRPyi8', '2014-05-25', 1401020783, 'chat', 1, '聊天', 0),
(605, 0, '5e8aeeeabe2d84d', 'ojb0SuAfy7TDXYUyP6Syw90iEWCA', '2014-05-25', 1401021767, 'home', 1, '首页', 1),
(606, 1, 'bd3feef40f31c41', 'opg2QuLJaE0lcmhR-wl1vh26ENhE', '2014-05-25', 1401021793, 'follow', 1, '用户关注', 0),
(607, 1, 'vnqtpx1400192821', 'oQHTqtwx3VezAvuQosr7--lKPSWg', '2014-05-25', 1401023404, 'follow', 8, '用户关注', 0),
(608, 1, 'bd3feef40f31c41', 'opg2QuG0YWFQmx8o3U0IOHE526sk', '2014-05-25', 1401024961, 'follow', 1, '用户关注', 0),
(609, 1, 'gjehca1401004322', 'o-d6vjqSCa-G6DJBtatQoW_vl4co', '2014-05-25', 1401026109, 'follow', 1, '用户关注', 0),
(610, 1, 'gjehca1401004322', 'o-d6vjm1smhTlrWAYB3Ikj-kenuA', '2014-05-25', 1401028094, 'follow', 1, '用户关注', 0),
(611, 1, 'f0c1a4fdca1ef4a', 'oRM0DuJalZZlXGccM-2k9al-6nwE', '2014-05-25', 1401029746, 'follow', 1, '用户关注', 0),
(612, 0, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401030043, 'chat', 1, '糗事', 0),
(613, 46, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401030331, 'Lottery', 7, '123', 0),
(614, 47, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401030785, 'Lottery', 2, '222', 0),
(615, 48, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401031013, 'Lottery', 1, '大转盘', 0),
(616, 17, 'gabnjc1401007613', 'oI89luJEohHjVF8MM0AHhT2uAH2w', '2014-05-25', 1401031831, 'Shake', 14, '用户关注', 0),
(617, 0, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401031929, 'home', 2, '首页', 1),
(618, 42, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401032353, 'Img', 1, '123', 0),
(619, 17, 'gabnjc1401007613', 'oI89luDtw7JRfBIB2Oa188ayu1SE', '2014-05-25', 1401032361, 'Shake', 1, '用户关注', 0),
(620, 43, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401032511, 'Img', 2, '444', 0),
(621, 44, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-25', 1401032688, 'Img', 1, '444', 0),
(622, 0, 'gabnjc1401007613', 'oI89luJEohHjVF8MM0AHhT2uAH2w', '2014-05-25', 1401032728, 'chat', 1, 'menu_20140513171853', 0),
(623, 0, 'gabnjc1401007613', 'oI89luJEohHjVF8MM0AHhT2uAH2w', '2014-05-25', 1401032733, 'chat', 1, 'menu_20140513171731', 0),
(624, 0, 'oorlyp1401030014', 'oq34ouPNuFdm3xRSzX6kG0YOeNa0', '2014-05-25', 1401033332, 'chat', 1, '关于宝维', 0),
(625, 0, 'oorlyp1401030014', 'oq34ouPNuFdm3xRSzX6kG0YOeNa0', '2014-05-25', 1401033379, 'chat', 1, '房产', 0),
(626, 1, '23d214d2a37ed14', 'ol158uOJEl_l9Yhsa4EevNqVOL7Y', '2014-05-26', 1401035999, 'follow', 1, '用户关注', 0),
(627, 1, 'nipljx1399962330', 'olDjDjknkJKIbO3ZK7UD1WokVatE', '2014-05-26', 1401056617, 'follow', 1, '用户关注', 0),
(628, 1, 'nipljx1399962330', 'olDjDjrONcyh_2tQ2BX6vhnRqA-8', '2014-05-26', 1401058778, 'follow', 1, '用户关注', 0),
(629, 17, 'gabnjc1401007613', 'oI89luJEohHjVF8MM0AHhT2uAH2w', '2014-05-26', 1401063594, 'Shake', 8, '用户关注', 0),
(630, 1, 'gjehca1401004322', 'o-d6vjhIhyDUzmSVAEyjR1P-_sNg', '2014-05-26', 1401064802, 'follow', 1, '用户关注', 0),
(631, 3, '5f787625fc823a2', 'oENrSjod73RJu4pt-usk107UnclA', '2014-05-26', 1401065175, 'Schoolset', 1, '用户关注', 0),
(632, 1, 'efldmy1400635676', 'oOwNruMfLfzh6XUBpc31SSiPFpqo', '2014-05-26', 1401066442, 'follow', 1, '用户关注', 0),
(633, 1, 'efldmy1400635676', 'oOwNruEcdmZhMtNbz_6r9KdRBZ8Q', '2014-05-26', 1401066755, 'follow', 1, '用户关注', 0),
(634, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067109, 'chat', 1, '刚刚好', 0),
(635, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067115, 'chat', 1, 'hi 你好过', 0),
(636, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067121, 'chat', 1, '呵呵', 0),
(637, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067145, 'chat', 2, '1', 0),
(638, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067148, 'chat', 1, '2', 0),
(639, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067152, 'chat', 1, '用户关注', 0),
(640, 1, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067172, 'follow', 1, '用户关注', 0),
(641, 1, 'gjehca1401004322', 'o-d6vjt8jry4KnkHiJDoqfY6VbzY', '2014-05-26', 1401067348, 'follow', 1, '用户关注', 0),
(642, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067570, 'chat', 1, 'wifi', 0),
(643, 17, 'gabnjc1401007613', 'oI89luOYHwI0oAqqX_FU6eKK3F3M', '2014-05-26', 1401067701, 'Shake', 4, '用户关注', 0),
(644, 18, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401067776, 'Shake', 1, '摇一摇', 0),
(645, 17, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401067801, 'Wall', 3, '微信墙', 0),
(646, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401068072, 'chat', 1, '陪聊', 0),
(647, 0, 'ohljtk1401066991', 'oxBrijuUywiGVINNaAA7hdJ7TbX0', '2014-05-26', 1401068077, 'chat', 1, '说到底的', 0),
(648, 19, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401068122, 'Shake', 1, 'y', 0),
(649, 0, 'bcxxiq1401066548', 'onWb7t28vUMr7Z6Q05wGZJ3MTwcQ', '2014-05-26', 1401068449, 'home', 2, 'home', 1),
(650, 15, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401068772, 'Shake', 1, '用户关注', 0),
(651, 1, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401068800, 'follow', 1, '用户关注', 0),
(652, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401068831, 'chat', 1, '呵呵', 0),
(653, 0, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401068842, 'chat', 1, '嘿', 0),
(654, 12, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401070482, 'Text', 1, '麻城', 0),
(655, 11, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401070616, 'Diaoyan', 1, '武汉', 0),
(656, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-26', 1401070934, 'chat', 2, '微信墙', 0),
(657, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-26', 1401071049, 'chat', 1, '123', 0),
(658, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-26', 1401071086, 'chat', 3, '123123', 0),
(659, 11, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-26', 1401071115, 'Text', 1, '皮斌', 0),
(660, 20, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-26', 1401072117, 'Wall', 2, '112233', 0),
(661, 1, 'f0c1a4fdca1ef4a', 'oRM0DuBkpWldw_aoXgqtAtqWeD7k', '2014-05-26', 1401073195, 'follow', 1, '用户关注', 0),
(662, 1, '5e8aeeeabe2d84d', 'ojb0SuNcG7MeN_KnaweQbl4ONcx0', '2014-05-26', 1401074260, 'follow', 3, '用户关注', 0),
(663, 16, '5e8aeeeabe2d84d', 'ojb0SuNcG7MeN_KnaweQbl4ONcx0', '2014-05-26', 1401074276, 'Shake', 1, '用户关注', 0),
(664, 20, 'a717713db81322c', 'ouvWijp-qH580sPgnTGY0Uor7isc', '2014-05-26', 1401075366, 'Wall', 1, '112233', 0),
(665, 0, 'a717713db81322c', 'ouvWijr-L9teNlAitZkl38VYbv-w', '2014-05-26', 1401075609, 'chat', 1, '你好', 0),
(666, 49, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401076958, 'Img', 1, '37', 0),
(667, 0, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401077001, 'home', 8, '首页', 1),
(668, 50, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401077560, 'Img', 5, '双合盛', 0),
(669, 51, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401078045, 'Img', 3, '肯德基', 0),
(670, 1, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401078521, 'Host', 3, '333', 0),
(671, 1, '6515e805658a5cf', 'oNrsut9ss6nNQcD0cJqIASMXGxws', '2014-05-26', 1401080025, 'follow', 1, '用户关注', 0),
(672, 4, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401080175, 'Selfform', 2, '555', 0),
(673, 5, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401080316, 'Selfform', 1, '666', 0),
(674, 70, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401080489, 'Product', 1, '777', 0),
(675, 16, '5e8aeeeabe2d84d', 'ojb0SuIeWO0i8TxjOCPlk0piD-Ic', '2014-05-26', 1401080987, 'Shake', 1, '用户关注', 0),
(676, 1, 'd918c9065845bfa', 'o5S-njt4Yz88Tz4RZxAnl24_oY3Q', '2014-05-26', 1401081102, 'follow', 2, '用户关注', 0),
(677, 27, 'onmyfu1401084025', 'ox93Gt1IjyjMHYMZwlEzPrtpM5so', '2014-05-26', 1401084743, 'Member_card_set', 1, '会员', 0),
(678, 0, 'onmyfu1401084025', 'ox93Gt1IjyjMHYMZwlEzPrtpM5so', '2014-05-26', 1401085968, 'chat', 1, '装修', 0),
(679, 0, 'uqnrmt1401086437', 'oNB2huH6ZiQyEej5sGnpK7tGxvZs', '2014-05-26', 1401086593, 'chat', 1, '用户关注', 0),
(680, 1, 'uqnrmt1401086437', 'oNB2huH6ZiQyEej5sGnpK7tGxvZs', '2014-05-26', 1401086623, 'follow', 1, '用户关注', 0),
(681, 13, 'uqnrmt1401086437', 'oNB2huH6ZiQyEej5sGnpK7tGxvZs', '2014-05-26', 1401086656, 'Text', 1, '1', 0),
(682, 1, '6090253bfd0af40', 'o4tleuFx6Y_6_PfI1ed6m8HooF1M', '2014-05-26', 1401086737, 'follow', 1, '用户关注', 0),
(683, 0, 'uqnrmt1401086437', 'oNB2huH6ZiQyEej5sGnpK7tGxvZs', '2014-05-26', 1401086822, 'chat', 1, '啊啊啊', 0),
(684, 1, 'jkiliq1401087019', 'o4tleuFx6Y_6_PfI1ed6m8HooF1M', '2014-05-26', 1401087188, 'follow', 1, '用户关注', 0),
(685, 0, '6d33370a290ec23', 'oOSLOt3Ceh81at9cGxjkJOCyzXU8', '2014-05-26', 1401087873, 'chat', 1, 'www', 0),
(686, 0, 'fwibxd1401087466', 'oBT0Ct0wbOeyx-05prYE-BBya9-c', '2014-05-26', 1401088251, 'home', 2, '首页', 1),
(687, 0, 'fwibxd1401087466', 'oBT0Ct0wbOeyx-05prYE-BBya9-c', '2014-05-26', 1401088403, 'home', 1, 'home', 1),
(688, 1, '5e8aeeeabe2d84d', 'ojb0SuKG7Yc1qMkK1qwjS8Zi9mYQ', '2014-05-26', 1401089098, 'follow', 1, '用户关注', 0),
(689, 0, 'fwibxd1401087466', 'oBT0Ct0wbOeyx-05prYE-BBya9-c', '2014-05-26', 1401089623, 'chat', 1, '商量', 0),
(690, 0, 'fwibxd1401087466', 'oBT0Ct0wbOeyx-05prYE-BBya9-c', '2014-05-26', 1401089686, 'chat', 1, '微商城', 0),
(691, 6, '9814ef0462957fa', 'olP2st6ipG5E5P_qoLXo75mjqsjs', '2014-05-26', 1401089982, 'Carset', 3, '汽车', 0),
(692, 0, '9814ef0462957fa', 'olP2st690D1LYsOwsIoZXhAamfPo', '2014-05-26', 1401089987, 'chat', 1, 'Lljj', 0),
(693, 6, '9814ef0462957fa', 'olP2st690D1LYsOwsIoZXhAamfPo', '2014-05-26', 1401090004, 'Carset', 1, '汽车', 0),
(694, 1, '9814ef0462957fa', 'olP2st40-ECg5YxLf0Hlqqy3UkEQ', '2014-05-26', 1401090034, 'follow', 1, '用户关注', 0),
(695, 1, '9814ef0462957fa', 'olP2st51K-AYD9CdX55GeiXq-zNY', '2014-05-26', 1401090050, 'follow', 1, '用户关注', 0),
(696, 1, '5e8aeeeabe2d84d', 'ojb0SuMRQJngmHaz-0N5UyBs_YrY', '2014-05-26', 1401090090, 'follow', 1, '用户关注', 0),
(697, 0, '9814ef0462957fa', 'olP2st40-ECg5YxLf0Hlqqy3UkEQ', '2014-05-26', 1401090124, 'chat', 1, '1', 0),
(698, 0, '9814ef0462957fa', 'olP2stzflN34viik1Y2l3nt9Rcwo', '2014-05-26', 1401090137, 'chat', 1, 'jlu', 0),
(699, 6, '9814ef0462957fa', 'olP2stzflN34viik1Y2l3nt9Rcwo', '2014-05-26', 1401090182, 'Carset', 2, '汽车', 0),
(700, 0, '9814ef0462957fa', 'olP2st51K-AYD9CdX55GeiXq-zNY', '2014-05-26', 1401090333, 'chat', 1, '你好', 0),
(701, 0, '9814ef0462957fa', 'olP2stzflN34viik1Y2l3nt9Rcwo', '2014-05-26', 1401090402, 'chat', 1, '长安', 0),
(702, 52, 'fwibxd1401087466', 'oBT0Ct0wbOeyx-05prYE-BBya9-c', '2014-05-26', 1401090805, 'Img', 1, '用户关注', 0),
(703, 0, 'fwphni1401088997', 'oVauGjjTR5o_aIeeoCM7lvTRaxjo', '2014-05-26', 1401090990, 'home', 5, '首页', 1),
(704, 1, 'gjehca1401004322', 'o-d6vjthQYtQOVCahW9XOE0p7w74', '2014-05-26', 1401091140, 'follow', 1, '用户关注', 0),
(705, 1, '6d33370a290ec23', 'oOSLOt1c_ADSNqMIMahHrjX_-cBU', '2014-05-26', 1401091742, 'follow', 1, '用户关注', 0),
(706, 0, '6d33370a290ec23', 'oOSLOt1c_ADSNqMIMahHrjX_-cBU', '2014-05-26', 1401091770, 'chat', 1, '微信墙', 0),
(707, 0, '6d33370a290ec23', 'oOSLOt1c_ADSNqMIMahHrjX_-cBU', '2014-05-26', 1401091781, 'home', 1, '首页', 1),
(708, 21, 'fwibxd1401087466', 'oBT0Ct0wbOeyx-05prYE-BBya9-c', '2014-05-26', 1401092439, 'Ktv', 1, 'KTV', 0),
(709, 1, '5e8aeeeabe2d84d', 'ojb0SuPoRtwlhomhncsmJFrFIAOs', '2014-05-26', 1401092851, 'follow', 1, '用户关注', 0),
(710, 16, '5e8aeeeabe2d84d', 'ojb0SuPoRtwlhomhncsmJFrFIAOs', '2014-05-26', 1401092871, 'Shake', 1, '用户关注', 0),
(711, 0, 'fwphni1401088997', 'oVauGjjJQj4j2QQ9JWo8IkLuq-0o', '2014-05-26', 1401092997, 'chat', 1, '用户关注', 0),
(712, 1, 'fwphni1401088997', 'oVauGjjJQj4j2QQ9JWo8IkLuq-0o', '2014-05-26', 1401093010, 'follow', 1, '用户关注', 0),
(713, 0, 'fwphni1401088997', 'oVauGjjJQj4j2QQ9JWo8IkLuq-0o', '2014-05-26', 1401093010, 'home', 1, '用户关注', 1),
(714, 1, 'bcxxiq1401066548', 'onWb7t-dpfKAC2X0qEh9f50ImV_Q', '2014-05-26', 1401094192, 'follow', 1, '用户关注', 0),
(715, 0, 'fwphni1401088997', 'oVauGjjJQj4j2QQ9JWo8IkLuq-0o', '2014-05-26', 1401094667, 'chat', 1, '交', 0),
(716, 0, 'fwphni1401088997', 'oVauGjjJQj4j2QQ9JWo8IkLuq-0o', '2014-05-26', 1401094694, 'home', 1, '首页', 1),
(717, 0, 'bcxxiq1401066548', 'onWb7t-dpfKAC2X0qEh9f50ImV_Q', '2014-05-26', 1401094832, 'home', 1, 'home', 1),
(718, 0, '6d33370a290ec23', 'oOSLOt1c_ADSNqMIMahHrjX_-cBU', '2014-05-26', 1401095053, 'chat', 1, '糗事', 0),
(719, 21, '6d33370a290ec23', 'oOSLOt1c_ADSNqMIMahHrjX_-cBU', '2014-05-26', 1401095739, 'Wall', 1, '555', 0),
(720, 53, '9814ef0462957fa', 'olP2st6ipG5E5P_qoLXo75mjqsjs', '2014-05-26', 1401095743, 'Img', 1, '用户关注', 0),
(721, 1, '9814ef0462957fa', 'olP2st6ipG5E5P_qoLXo75mjqsjs', '2014-05-26', 1401095774, 'follow', 1, '用户关注', 0),
(722, 22, 'hsrrgl1400757175', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-05-26', 1401095799, 'Wall', 2, '微信墙', 0),
(723, 1, 'bcxxiq1401066548', 'onWb7t2S0IEVoyY-G9vVDxLtIdrY', '2014-05-26', 1401095806, 'follow', 1, '用户关注', 0),
(724, 0, 'bcxxiq1401066548', 'onWb7t2S0IEVoyY-G9vVDxLtIdrY', '2014-05-26', 1401095840, 'chat', 1, 'Home', 0),
(725, 0, 'bcxxiq1401066548', 'onWb7t2S0IEVoyY-G9vVDxLtIdrY', '2014-05-26', 1401095881, 'home', 1, '首页', 1),
(726, 22, 'hsrrgl1400757175', 'ozNqmt5MtHrSuXFtTsKHMM4GqJK0', '2014-05-26', 1401095935, 'Wall', 1, '用户关注', 0),
(727, 0, 'e62cf771df971a8', 'oE9qxjtRn9Tco6m_dV1yx13IqSz4', '2014-05-26', 1401096377, 'chat', 1, '水果机', 0),
(728, 0, 'e62cf771df971a8', 'oE9qxjtRn9Tco6m_dV1yx13IqSz4', '2014-05-26', 1401096407, 'chat', 2, '糗事', 0),
(729, 0, 'e62cf771df971a8', 'oE9qxjtRn9Tco6m_dV1yx13IqSz4', '2014-05-26', 1401096535, 'chat', 1, '歌曲千里香', 0),
(730, 20, 'e62cf771df971a8', 'oE9qxjtRn9Tco6m_dV1yx13IqSz4', '2014-05-26', 1401096624, 'Shake', 1, '222', 0),
(731, 12, 'bcxxiq1401066548', 'onWb7t28vUMr7Z6Q05wGZJ3MTwcQ', '2014-05-26', 1401097770, 'Diaoyan', 1, '用户关注', 0),
(732, 1, 'f0c1a4fdca1ef4a', 'oRM0DuDW_I8vBUBZ2I_miuWPkOsM', '2014-05-26', 1401100892, 'follow', 1, '用户关注', 0),
(733, 1, 'gjehca1401004322', 'o-d6vjriOKodSv708RZivbYvXkcA', '2014-05-26', 1401101012, 'follow', 1, '用户关注', 0),
(734, 21, '6d33370a290ec23', 'oOSLOtwRRkJBoT8msatRc8gSJssk', '2014-05-26', 1401101692, 'Wall', 1, '用户关注', 0),
(735, 50, 'e62cf771df971a8', 'oE9qxjtRn9Tco6m_dV1yx13IqSz4', '2014-05-26', 1401102321, 'Lottery', 1, '水果达人', 0),
(736, 1, 'gjehca1401004322', 'o-d6vjqTg4Wrk877mjjAuKxvb0pE', '2014-05-26', 1401103974, 'follow', 1, '用户关注', 0),
(737, 66, 'gjehca1401004322', 'o-d6vjie1ys2Qbh0WPap2oDXPuP4', '2014-05-26', 1401105729, 'Product', 1, '用户关注', 0),
(738, 1, 'fwphni1401088997', 'oVauGjp2KM9Np8bQ0f53Tmr9o96Q', '2014-05-26', 1401106369, 'follow', 1, '用户关注', 0),
(739, 0, 'fwphni1401088997', 'oVauGjp2KM9Np8bQ0f53Tmr9o96Q', '2014-05-26', 1401106369, 'home', 1, '用户关注', 1),
(740, 0, 'fwphni1401088997', 'oVauGjr3uKrpKxdFIwFk388jqDZ8', '2014-05-26', 1401106908, 'chat', 1, '用户关注', 0),
(741, 1, 'fwphni1401088997', 'oVauGjtFvti36M-k9cEy0rjo5fng', '2014-05-26', 1401107950, 'follow', 1, '用户关注', 0),
(742, 0, 'fwphni1401088997', 'oVauGjtFvti36M-k9cEy0rjo5fng', '2014-05-26', 1401107950, 'home', 1, '用户关注', 1),
(743, 1, 'fwphni1401088997', 'oVauGjh8lZgSl8maRzYXFCKLDdho', '2014-05-26', 1401108022, 'follow', 1, '用户关注', 0),
(744, 0, 'fwphni1401088997', 'oVauGjh8lZgSl8maRzYXFCKLDdho', '2014-05-26', 1401108022, 'home', 1, '用户关注', 1),
(745, 1, 'fwphni1401088997', 'oVauGjvO_UsaHRkxLykb3_tzvr4U', '2014-05-26', 1401108128, 'follow', 1, '用户关注', 0),
(746, 0, 'fwphni1401088997', 'oVauGjvO_UsaHRkxLykb3_tzvr4U', '2014-05-26', 1401108128, 'home', 1, '用户关注', 1),
(747, 1, '5e8aeeeabe2d84d', 'ojb0SuCRp3IrvemwIqGaWOK7fINk', '2014-05-26', 1401108131, 'follow', 1, '用户关注', 0),
(748, 66, 'gjehca1401004322', 'o-d6vjvQM0_U_H8fjawciFPd_Ufw', '2014-05-26', 1401108650, 'Product', 1, '用户关注', 0),
(749, 1, 'fwphni1401088997', 'oVauGjuiLjtZ6-DMzhuy3zO9C1a4', '2014-05-26', 1401108865, 'follow', 1, '用户关注', 0),
(750, 0, 'fwphni1401088997', 'oVauGjuiLjtZ6-DMzhuy3zO9C1a4', '2014-05-26', 1401108865, 'home', 1, '用户关注', 1),
(751, 19, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401109607, 'Shake', 17, '用户关注', 0),
(752, 51, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401109945, 'Lottery', 5, '砸金蛋', 0),
(753, 51, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401110114, 'Lottery', 2, '用户关注', 0),
(754, 1, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401110127, 'follow', 11, '用户关注', 0),
(755, 1, 'lpjsaf1401097201', 'oL52duEzr3IqH48V8SeQGQDxW5XU', '2014-05-26', 1401110359, 'follow', 3, '用户关注', 0),
(756, 0, 'lpjsaf1401097201', 'oL52duEzr3IqH48V8SeQGQDxW5XU', '2014-05-26', 1401110359, 'chat', 3, '用户关注', 0),
(757, 52, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401110401, 'Lottery', 5, '用户关注', 0),
(758, 52, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401110430, 'Lottery', 5, '水果达人', 0),
(759, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401110725, 'home', 3, '首页', 1),
(760, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401110876, 'chat', 3, '用户关注', 0),
(761, 55, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111094, 'Img', 5, '用户关注', 0),
(762, 1, 'gabnjc1401007613', 'oI89luM16hh8TfnNuSfT4IyMuRfs', '2014-05-26', 1401111368, 'follow', 1, '用户关注', 0),
(763, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111463, 'chat', 3, '你好', 0),
(764, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111562, 'chat', 1, '刮刮乐', 0),
(765, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111626, 'chat', 2, '呵呵', 0),
(766, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111655, 'chat', 1, '/::~', 0),
(767, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111706, 'chat', 2, '/::<', 0),
(768, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111887, 'chat', 1, '哥哥', 0),
(769, 0, 'zidiqh1401110610', 'ofUyXjhv0ToYF0igeCI12zTBBDKs', '2014-05-26', 1401111901, 'chat', 1, '用户关注', 0),
(770, 56, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401111921, 'Img', 2, '用户关注', 0),
(771, 1, 'zidiqh1401110610', 'ofUyXjhv0ToYF0igeCI12zTBBDKs', '2014-05-26', 1401111926, 'follow', 1, '用户关注', 0),
(772, 53, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401112167, 'Lottery', 1, '刮刮卡', 0),
(773, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401112973, 'chat', 1, '/::|', 0),
(774, 57, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401112999, 'Img', 4, '用户关注', 0),
(775, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113033, 'chat', 2, '你', 0),
(776, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113108, 'chat', 1, '拖', 0),
(777, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113142, 'chat', 1, '韩国', 0),
(778, 56, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113196, 'Img', 1, '首', 0),
(779, 0, 'zidiqh1401110610', 'ofUyXjhv0ToYF0igeCI12zTBBDKs', '2014-05-26', 1401113242, 'chat', 1, '受气', 0),
(780, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113257, 'chat', 1, '那个不是回答不上来', 0),
(781, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113374, 'chat', 1, 'ra', 0),
(782, 0, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113459, 'chat', 1, '糗事', 0),
(783, 55, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-26', 1401113713, 'Img', 1, '芭莎风采', 0),
(784, 66, 'gjehca1401004322', 'o-d6vjtdrlHkN5niMLROwfskePdY', '2014-05-26', 1401113927, 'Product', 1, '用户关注', 0),
(785, 22, 'eravog1401114256', 'o7Y7wjoFNlx1bt5if6uRBWhza_MM', '2014-05-26', 1401114465, 'Hunqing', 1, '无棣', 0),
(786, 66, 'gjehca1401004322', 'o-d6vjlSYLbCNOsGq4UzrSn4XLwM', '2014-05-26', 1401115031, 'Product', 1, '用户关注', 0),
(787, 1, 'ceab170c3dec82a', 'osYvajmmt-SfkImT7DH-J7Dh4o3U', '2014-05-26', 1401115128, 'follow', 1, '用户关注', 0),
(788, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401115497, 'home', 1, '首页', 1),
(789, 1, 'uacnke1401012062', 'oO31MuNXwegJgQu-oHbbT8CFw4C0', '2014-05-26', 1401115574, 'follow', 1, '用户关注', 0),
(790, 1, 'f0c1a4fdca1ef4a', 'oRM0DuOA82CNpuAzaUpZHLpl66uE', '2014-05-26', 1401115722, 'follow', 1, '用户关注', 0),
(791, 0, 'fwphni1401088997', 'oVauGjq-H-bQuBFz_gBR7qkIgGjI', '2014-05-26', 1401115767, 'chat', 1, '用户关注', 0),
(792, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401115992, 'chat', 1, '微论坛', 0),
(793, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401116894, 'chat', 1, '摇一摇', 0),
(794, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401117034, 'chat', 1, '##12343', 0),
(795, 21, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401117060, 'Shake', 2, '用户关注', 0),
(796, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401117175, 'chat', 1, '你好', 0),
(797, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401117207, 'chat', 1, '微信强', 0),
(798, 0, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401117218, 'chat', 1, '微信墙', 0),
(799, 23, 'fcopze1401114485', 'oNHmguDpjO_D2_nXP0AjcKIC8Nh4', '2014-05-26', 1401117442, 'Wall', 2, '用户关注', 0),
(800, 0, 'fwphni1401088997', 'oVauGjvL-WoZC-dwwygZZvk9c3n4', '2014-05-26', 1401118068, 'chat', 1, '哈哈', 0),
(801, 0, 'fwphni1401088997', 'oVauGjvL-WoZC-dwwygZZvk9c3n4', '2014-05-26', 1401118069, 'home', 1, '首页', 1),
(802, 0, '10e0351af4da7ba', 'ofZ9iuG1atsC64icQTQfZQ6_f9As', '2014-05-26', 1401118911, 'chat', 1, '微订餐', 0),
(803, 55, '10e0351af4da7ba', 'ofZ9iuG1atsC64icQTQfZQ6_f9As', '2014-05-26', 1401119278, 'Lottery', 1, '大转盘', 0),
(804, 0, '10e0351af4da7ba', 'ofZ9iuG1atsC64icQTQfZQ6_f9As', '2014-05-26', 1401119334, 'chat', 1, '水果机', 0),
(805, 54, '10e0351af4da7ba', 'ofZ9iuG1atsC64icQTQfZQ6_f9As', '2014-05-26', 1401119353, 'Lottery', 2, '水果达人', 0),
(806, 56, '10e0351af4da7ba', 'ofZ9iuG1atsC64icQTQfZQ6_f9As', '2014-05-26', 1401119606, 'Lottery', 1, '水果达人', 0),
(807, 1, 'efldmy1400635676', 'oOwNruDrNr-WX6KLx0zWQDZ-HDZI', '2014-05-26', 1401119906, 'follow', 1, '用户关注', 0),
(808, 1, 'tzvryd1399901582', 'oNcLojsiq6TU-tPODVS2R5dTq0x0', '2014-05-26', 1401119935, 'follow', 1, '用户关注', 0),
(809, 0, 'fwphni1401088997', 'oVauGjvL-WoZC-dwwygZZvk9c3n4', '2014-05-26', 1401119945, 'chat', 1, '天气预报', 0),
(810, 0, 'fwphni1401088997', 'oVauGjvL-WoZC-dwwygZZvk9c3n4', '2014-05-26', 1401119987, 'chat', 1, 'Pink', 0),
(811, 51, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-27', 1401124657, 'Lottery', 1, '砸金蛋', 0),
(812, 52, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-27', 1401124718, 'Lottery', 2, '水果达人', 0),
(813, 57, 'b316dd814640831', 'o3fPvjn-P_C9EuxpQn9wBm4mYqSA', '2014-05-27', 1401124736, 'Img', 5, '用户关注', 0),
(814, 74, '10e0351af4da7ba', 'ofZ9iuEPJscbhBACpPoiCM9VilTY', '2014-05-27', 1401124792, 'Product', 1, '用户关注', 0),
(815, 1, '10e0351af4da7ba', 'ofZ9iuI8DXJezLFIZc-6n6geBDs8', '2014-05-27', 1401125009, 'follow', 3, '用户关注', 0),
(816, 74, '10e0351af4da7ba', 'ofZ9iuI8DXJezLFIZc-6n6geBDs8', '2014-05-27', 1401125516, 'Product', 1, '用户关注', 0),
(817, 1, 'gjehca1401004322', 'o-d6vjuiXFOxZnMzTy16QwMfyWEI', '2014-05-27', 1401139565, 'follow', 1, '用户关注', 0),
(818, 1, 'gjehca1401004322', 'o-d6vjpzGslEAyMO5j2ytuGjhIKA', '2014-05-27', 1401141370, 'follow', 1, '用户关注', 0),
(819, 1, 'lpjsaf1401097201', 'oL52duHB3jl4JQuEPMIqCa88icE4', '2014-05-27', 1401144398, 'follow', 1, '用户关注', 0),
(820, 0, 'lpjsaf1401097201', 'oL52duHB3jl4JQuEPMIqCa88icE4', '2014-05-27', 1401144398, 'chat', 1, '用户关注', 0),
(821, 1, 'bcxxiq1401066548', 'onWb7t28vUMr7Z6Q05wGZJ3MTwcQ', '2014-05-27', 1401154386, 'follow', 1, '用户关注', 0),
(822, 0, 'bcxxiq1401066548', 'onWb7t28vUMr7Z6Q05wGZJ3MTwcQ', '2014-05-27', 1401154386, 'home', 1, '用户关注', 1),
(823, 0, '5f787625fc823a2', 'oENrSjoZ90c75bLAkmrTHzsT7x-k', '2014-05-27', 1401155276, 'home', 3, '首页', 1),
(824, 1, 'ae4eb9098f6d074', 'oP9YztyJ4L018k9PwnYChlPc-unI', '2014-05-27', 1401155534, 'follow', 5, '用户关注', 0),
(825, 0, 'gabnjc1401007613', 'oI89luBFbq4B-OoAqbkJuSloN02E', '2014-05-27', 1401156460, 'chat', 2, 'menu_20140513171853', 0),
(826, 1, 'odfcne1401118880', 'oWDRvt6ePsZmtUYKYms5VsfF9HoI', '2014-05-27', 1401156846, 'follow', 1, '用户关注', 0),
(827, 0, '5f787625fc823a2', 'oENrSjiMlJLq0qq6u2uIuzWlNJgU', '2014-05-27', 1401157146, 'home', 1, '首页', 1),
(828, 17, 'gabnjc1401007613', 'oI89luJEohHjVF8MM0AHhT2uAH2w', '2014-05-27', 1401157364, 'Shake', 1, '用户关注', 0),
(829, 1, 'nipljx1399962330', 'olDjDjthoRkr43DGjX1A5SeUc6jc', '2014-05-27', 1401160082, 'follow', 1, '用户关注', 0),
(830, 1, 'kmeckg140115933', 'oGIjjjkXJZij5mGobNVbAIwN7EvY', '2014-05-27', 1401161125, 'follow', 1, '用户关注', 0),
(831, 0, 'kmeckg1401159333', 'oGIjjjkXJZij5mGobNVbAIwN7EvY', '2014-05-27', 1401161403, 'home', 1, '首页', 1),
(832, 1, 'lpjsaf1401097201', 'oL52duL95xq244vvrQp3T-1Kkh-0', '2014-05-27', 1401161461, 'follow', 1, '用户关注', 0),
(833, 0, 'lpjsaf1401097201', 'oL52duL95xq244vvrQp3T-1Kkh-0', '2014-05-27', 1401161461, 'chat', 1, '用户关注', 0),
(834, 1, '5e8aeeeabe2d84d', 'ojb0SuEbyAeJP7NJMbJa-anYwrXI', '2014-05-27', 1401163287, 'follow', 1, '用户关注', 0),
(835, 0, 'gjehca1401004322', 'o-d6vjiu5aapGHnOS1lVJrRGn2vs', '2014-05-27', 1401163422, 'chat', 1, '/:eat', 0),
(836, 0, '5f9c359649351d1', 'otnVdtyvanXj_plv6_n9NQIwY-dw', '2014-05-27', 1401167178, 'chat', 1, '聊天', 0),
(837, 0, '5f9c359649351d1', 'otnVdtyvanXj_plv6_n9NQIwY-dw', '2014-05-27', 1401167190, 'chat', 1, '陪聊', 0),
(838, 1, '5e8aeeeabe2d84d', 'ojb0SuM7tJOkmMmUorhtnspmke7o', '2014-05-27', 1401167255, 'follow', 1, '用户关注', 0),
(839, 0, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401167994, 'chat', 1, '用户关注', 0),
(840, 1, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401168005, 'follow', 1, '用户关注', 0),
(841, 0, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401168023, 'chat', 1, '糗事', 0),
(842, 0, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401168126, 'Member_card_set', 1, '会员', 0),
(843, 0, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401168144, 'chat', 1, '陪聊', 0),
(844, 0, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401168154, 'chat', 1, '聊天', 0),
(845, 0, 'ctmfim1401167762', 'oDYTKt9Aii886tNiSJeXasK15cDY', '2014-05-27', 1401168219, 'help', 1, '帮助', 1),
(846, 1, 'bd3feef40f31c41', 'opg2QuGfiPx0YhENztP7ULYVsLgo', '2014-05-27', 1401169383, 'follow', 1, '用户关注', 0),
(847, 1, 'zjxkgy1400897053', 'ojdtTuIbuPANGLFFaz2A4mZ1xCVw', '2014-05-27', 1401171915, 'follow', 1, '用户关注', 0),
(848, 22, 'fwphni1401088997', 'oVauGjjBC_AfAjDVGObRNpaM10RU', '2014-05-27', 1401172121, 'Shake', 1, '用户关注', 0),
(849, 0, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401172234, 'help', 2, '帮助', 1),
(850, 0, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401172238, 'chat', 1, '宝宝', 0),
(851, 30, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401173393, 'Member_card_set', 1, '会员卡', 0),
(852, 1, '1919e4af43cdb6c', 'o2fikjn1I4i2-vYkRD5ufc6oL8eo', '2014-05-27', 1401175299, 'follow', 1, '用户关注', 0),
(853, 1, 'ceab170c3dec82a', 'osYvajm1ET4-7zeBVGhY7En15p7Q', '2014-05-27', 1401175870, 'follow', 1, '用户关注', 0),
(854, 23, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401175871, 'Shake', 2, '摇一摇', 0),
(855, 0, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401176832, 'chat', 1, '摇一摇', 0),
(856, 24, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401176958, 'Shake', 1, '摇一摇', 0),
(857, 1, '6515e805658a5cf', 'oNrsut9_u9MxsqMRaMtDxN89EHH0', '2014-05-27', 1401177180, 'follow', 1, '用户关注', 0),
(858, 22, 'fwphni1401088997', 'oVauGjojlovIixp_ZNWXebRoIeVY', '2014-05-27', 1401178138, 'Shake', 1, '用户关注', 0),
(859, 4, '50285496059e4f9', 'o8_H_jnYh7s0aXoAdbDQUMNsIcP8', '2014-05-27', 1401178600, 'Greeting_card', 1, '贺卡', 0),
(860, 0, 'bokunv1403419264', 'ojb0SuN-AB5_Brnio7iM1q9TO0wk', '2014-06-22', 1403420204, 'home', 3, '首页', 1),
(861, 0, 'pgafzd1403420356', 'ozNqmt3SZ_E-NcVVZNedTnmZgmOE', '2014-06-22', 1403420435, 'home', 2, '首页', 1),
(862, 0, 'pgafzd1403420356', 'ozNqmt6g2h4G4U62icXblNFFVuyo', '2014-06-22', 1403422256, 'chat', 1, '你好', 0),
(863, 0, 'pgafzd1403420356', 'ozNqmt6g2h4G4U62icXblNFFVuyo', '2014-06-22', 1403422280, 'home', 1, '首页', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_busines`
--

CREATE TABLE IF NOT EXISTS `wy_busines` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `mtitle` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `picurl` varchar(200) NOT NULL DEFAULT '',
  `album_id` int(11) NOT NULL,
  `toppicurl` varchar(200) NOT NULL DEFAULT '',
  `roompicurl` varchar(200) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `longitude` char(11) NOT NULL DEFAULT '',
  `latitude` char(11) NOT NULL DEFAULT '',
  `business_desc` text NOT NULL,
  `type` char(15) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL,
  `blogo` varchar(200) NOT NULL,
  `businesphone` char(13) NOT NULL DEFAULT '',
  `orderInfo` varchar(800) NOT NULL DEFAULT '',
  `compyphone` char(12) NOT NULL DEFAULT '',
  `path` varchar(3000) DEFAULT NULL,
  `tpid` int(5) DEFAULT NULL,
  `conttpid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_busines_comment`
--

CREATE TABLE IF NOT EXISTS `wy_busines_comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `type` char(15) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `position` varchar(50) NOT NULL DEFAULT '',
  `face_picurl` varchar(200) NOT NULL,
  `face_desc` varchar(1000) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_busines_main`
--

CREATE TABLE IF NOT EXISTS `wy_busines_main` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `sort` int(11) NOT NULL,
  `main_desc` text NOT NULL,
  `type` char(15) NOT NULL,
  `telphone` char(12) NOT NULL DEFAULT '',
  `maddress` varchar(50) NOT NULL DEFAULT '',
  `desc_pic` varchar(200) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_busines_pic`
--

CREATE TABLE IF NOT EXISTS `wy_busines_pic` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `bid_id` int(11) NOT NULL,
  `picurl_1` varchar(200) NOT NULL DEFAULT '',
  `picurl_2` varchar(200) NOT NULL DEFAULT '',
  `picurl_3` varchar(200) NOT NULL DEFAULT '',
  `picurl_4` varchar(200) NOT NULL DEFAULT '',
  `picurl_5` varchar(200) NOT NULL DEFAULT '',
  `token` varchar(50) NOT NULL,
  `type` char(15) NOT NULL,
  `ablum_id` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_busines_second`
--

CREATE TABLE IF NOT EXISTS `wy_busines_second` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `type` char(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mid_id` int(11) NOT NULL,
  `picurl` varchar(200) NOT NULL DEFAULT '',
  `learntime` varchar(100) NOT NULL,
  `datatype` varchar(100) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL,
  `second_desc` text NOT NULL,
  `oneprice` decimal(10,2) DEFAULT '0.00',
  `googsnumber` bigint(20) NOT NULL DEFAULT '0',
  `havenumber` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_canyu`
--

CREATE TABLE IF NOT EXISTS `wy_canyu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xid` int(11) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  `token` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `number` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `wy_canyu`
--

INSERT INTO `wy_canyu` (`id`, `xid`, `wecha_id`, `token`, `name`, `number`, `phone`, `time`) VALUES
(1, 68, 'null', 'lddrag1397902912', '图图', 5, '18968920219', 1398007353),
(2, 68, 'null', 'lddrag1397902912', '健健康康', 1, '旅途', 1398070857),
(3, 68, 'null', 'lddrag1397902912', '12312', 1, '12312312312', 1398071676),
(4, 68, 'null', 'lddrag1397902912', '123', 7, '123', 1398073617),
(5, 68, 'null', 'ugmbpt1399525902', '痛快淋漓', 1, '18968920219', 1399531295),
(6, 68, 'null', '1c2e75a93c95d89', '顾潇轲', 1, '17881198103', 1399649923);

-- --------------------------------------------------------

--
-- 表的结构 `wy_car`
--

CREATE TABLE IF NOT EXISTS `wy_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `www` varchar(50) NOT NULL DEFAULT '',
  `logo` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) DEFAULT NULL,
  `info` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `wy_car`
--

INSERT INTO `wy_car` (`id`, `token`, `name`, `www`, `logo`, `sort`, `info`) VALUES
(1, 'lddrag1397902912', '123', '123', './tpl/User/default/common/car/car_logo.png', 1, '123'),
(2, 'jvysfw1400718965', '一汽大众', '', 'http://test.weiwinbao.com/uploads/j/jvysfw1400718965/9/4/1/1/thumb_537d4cb599aad.jpg', 1, '一汽大众，德国品质'),
(3, '9814ef0462957fa', '奇瑞', '', 'http://test.weiwinbao.com/uploads/9/9814ef0462957fa/e/d/c/0/thumb_5382f139453bf.jpg', 1, '阿萨德发生的发生的法师打发');

-- --------------------------------------------------------

--
-- 表的结构 `wy_carmodel`
--

CREATE TABLE IF NOT EXISTS `wy_carmodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand_serise` varchar(50) NOT NULL,
  `model_year` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `panorama_id` int(11) NOT NULL,
  `guide_price` decimal(10,3) NOT NULL,
  `dealer_price` decimal(10,3) NOT NULL,
  `emission` double NOT NULL,
  `stalls` tinyint(4) NOT NULL,
  `box` tinyint(4) NOT NULL,
  `pic_url` varchar(200) NOT NULL,
  `s_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_carmodel`
--

INSERT INTO `wy_carmodel` (`id`, `token`, `name`, `brand_serise`, `model_year`, `sort`, `panorama_id`, `guide_price`, `dealer_price`, `emission`, `stalls`, `box`, `pic_url`, `s_id`) VALUES
(1, 'jvysfw1400718965', '2014迈腾', '一汽大众/大众', 2014, 1, 0, '25.980', '19.980', 1.8, 7, 6, 'http://test.weiwinbao.com/uploads/j/jvysfw1400718965/e/a/7/4/thumb_537d4dc7443cd.jpg', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_carnews`
--

CREATE TABLE IF NOT EXISTS `wy_carnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `news_id` int(11) NOT NULL,
  `pre_id` int(11) NOT NULL,
  `usedcar_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carowner`
--

CREATE TABLE IF NOT EXISTS `wy_carowner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '''''',
  `head_url` varchar(200) NOT NULL DEFAULT '''''',
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_carowner`
--

INSERT INTO `wy_carowner` (`id`, `token`, `keyword`, `title`, `head_url`, `info`) VALUES
(1, '{Pigcms:$token}', '关爱', '车主关爱', 'tpl/User/default/common/car/car_woner.png', '<p>\r\n	车主关爱车主关爱车主关爱车主关爱车主关爱\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	车主关爱车主关爱车主关爱车主关爱\r\n</p>');

-- --------------------------------------------------------

--
-- 表的结构 `wy_carsaler`
--

CREATE TABLE IF NOT EXISTS `wy_carsaler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `mobile` char(13) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `salestype` tinyint(4) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_carsaler`
--

INSERT INTO `wy_carsaler` (`id`, `token`, `name`, `picture`, `mobile`, `sort`, `salestype`, `info`) VALUES
(1, 'jvysfw1400718965', '小丽', 'tpl/User/default/common/car/car_sell.png', '067-2222222', 1, 1, '小丽');

-- --------------------------------------------------------

--
-- 表的结构 `wy_carseries`
--

CREATE TABLE IF NOT EXISTS `wy_carseries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shortname` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_carseries`
--

INSERT INTO `wy_carseries` (`id`, `brand_id`, `brand`, `token`, `name`, `shortname`, `picture`, `sort`, `info`) VALUES
(1, 2, '2@一汽大众', 'jvysfw1400718965', '大众', 'A', 'http://test.weiwinbao.com/uploads/j/jvysfw1400718965/e/0/8/b/thumb_537d4d12768ed.jpg', 1, '全新设计');

-- --------------------------------------------------------

--
-- 表的结构 `wy_carset`
--

CREATE TABLE IF NOT EXISTS `wy_carset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `head_url` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL,
  `title1` varchar(50) NOT NULL DEFAULT '',
  `title2` varchar(50) NOT NULL DEFAULT '',
  `title3` varchar(50) NOT NULL DEFAULT '',
  `title4` varchar(50) NOT NULL DEFAULT '',
  `title5` varchar(50) NOT NULL DEFAULT '',
  `title6` varchar(50) NOT NULL DEFAULT '',
  `head_url_1` varchar(200) NOT NULL DEFAULT '',
  `head_url_2` varchar(200) NOT NULL DEFAULT '',
  `head_url_3` varchar(200) NOT NULL DEFAULT '',
  `head_url_4` varchar(200) NOT NULL DEFAULT '',
  `head_url_5` varchar(200) NOT NULL DEFAULT '',
  `head_url_6` varchar(200) NOT NULL DEFAULT '',
  `url1` varchar(200) NOT NULL DEFAULT '',
  `url2` varchar(200) NOT NULL DEFAULT '',
  `url3` varchar(200) NOT NULL DEFAULT '',
  `url4` varchar(200) NOT NULL DEFAULT '',
  `url5` varchar(200) NOT NULL DEFAULT '',
  `url6` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `wy_carset`
--

INSERT INTO `wy_carset` (`id`, `token`, `keyword`, `title`, `head_url`, `url`, `title1`, `title2`, `title3`, `title4`, `title5`, `title6`, `head_url_1`, `head_url_2`, `head_url_3`, `head_url_4`, `head_url_5`, `head_url_6`, `url1`, `url2`, `url3`, `url4`, `url5`, `url6`) VALUES
(1, 'lddrag1397902912', '汽车', '123', 'tpl/User/default/common/car/car_title.jpg', '/index.php?g=Wap&amp;m=Selfform&amp;a=index&amp;token=bsvczh1397720611&amp;wecha_id={wechat_id}&amp;id=10', '经销车型', '销售顾问', '在线预约', '车主关怀', '实用工具', '车型欣赏', 'tpl/User/default/common/car/car_jx.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/carowner.png', 'tpl/User/default/common/car/tool-box-preferences.png', 'tpl/User/default/common/car/lanbo14.jpg', '12312312', 'http://www.baidu.com', '12312', '12312', '12312', '123'),
(2, '{Pigcms:$token}', '汽车', '欢迎来到一汽大众4S点', 'tpl/User/default/common/car/car_title.jpg', '', '经销车型', '销售顾问', '在线预约', '车主关怀', '实用工具', '车型欣赏', 'tpl/User/default/common/car/car_jx.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/carowner.png', 'tpl/User/default/common/car/tool-box-preferences.png', 'tpl/User/default/common/car/lanbo14.jpg', '', '', '', '', '', ''),
(3, '{Pigcms:$token}', '汽车', '汽车', 'tpl/User/default/common/car/car_title.jpg', '', '经销车型', '销售顾问', '在线预约', '车主关怀', '实用工具', '车型欣赏', 'tpl/User/default/common/car/car_jx.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/carowner.png', 'tpl/User/default/common/car/tool-box-preferences.png', 'tpl/User/default/common/car/lanbo14.jpg', '', '', '', '', '', ''),
(4, '{Pigcms:$token}', '汽车', '汽车', 'tpl/User/default/common/car/car_title.jpg', '', '经销车型', '销售顾问', '在线预约', '车主关怀', '实用工具', '车型欣赏', 'tpl/User/default/common/car/car_jx.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/carowner.png', 'tpl/User/default/common/car/tool-box-preferences.png', 'tpl/User/default/common/car/lanbo14.jpg', '', '', '', '', '', ''),
(5, '{Pigcms:$token}', '汽车', '汽车', 'tpl/User/default/common/car/car_title.jpg', '', '经销车型', '销售顾问', '在线预约', '车主关怀', '实用工具', '车型欣赏', 'tpl/User/default/common/car/car_jx.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/carowner.png', 'tpl/User/default/common/car/tool-box-preferences.png', 'tpl/User/default/common/car/lanbo14.jpg', '', '', '', '', '', ''),
(6, '{Pigcms:$token}', '汽车', '欢迎来到大庆盛鑫', 'tpl/User/default/common/car/car_title.jpg', '', '经销车型', '销售顾问', '在线预约', '车主关怀', '实用工具', '车型欣赏', 'tpl/User/default/common/car/car_jx.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/car_yuyue.jpg', 'tpl/User/default/common/car/carowner.png', 'tpl/User/default/common/car/tool-box-preferences.png', 'tpl/User/default/common/car/lanbo14.jpg', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `wy_caruser`
--

CREATE TABLE IF NOT EXISTS `wy_caruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `brand_serise` varchar(50) NOT NULL,
  `car_no` varchar(20) NOT NULL,
  `car_userName` varchar(50) NOT NULL,
  `car_startTime` varchar(50) NOT NULL,
  `car_insurance_lastDate` varchar(50) NOT NULL,
  `car_insurance_lastCost` decimal(10,2) NOT NULL,
  `car_care_mileage` int(11) NOT NULL,
  `user_tel` char(11) NOT NULL,
  `car_care_lastDate` varchar(50) NOT NULL,
  `car_care_lastCost` decimal(10,2) NOT NULL,
  `kfinfo` varchar(200) NOT NULL DEFAULT '',
  `insurance_Date` varchar(50) DEFAULT NULL,
  `insurance_Cost` decimal(10,2) DEFAULT NULL,
  `care_mileage` int(11) DEFAULT NULL,
  `car_care_Date` varchar(50) DEFAULT NULL,
  `car_care_Cost` decimal(10,2) DEFAULT NULL,
  `car_buyTime` varchar(50) NOT NULL DEFAULT '',
  `car_care_inspection` varchar(50) NOT NULL DEFAULT '',
  `care_next_mileage` int(11) NOT NULL DEFAULT '0',
  `next_care_inspection` varchar(50) NOT NULL DEFAULT '',
  `next_insurance_Date` varchar(50) NOT NULL DEFAULT '',
  `carmodel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_car_utility`
--

CREATE TABLE IF NOT EXISTS `wy_car_utility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_case`
--

CREATE TABLE IF NOT EXISTS `wy_case` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `url` char(255) NOT NULL,
  `img` char(200) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_catemenu`
--

CREATE TABLE IF NOT EXISTS `wy_catemenu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `name` varchar(120) NOT NULL,
  `orderss` varchar(10) NOT NULL DEFAULT '0',
  `picurl` varchar(120) NOT NULL,
  `url` varchar(120) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL,
  `RadioGroup1` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- 转存表中的数据 `wy_catemenu`
--

INSERT INTO `wy_catemenu` (`id`, `fid`, `token`, `name`, `orderss`, `picurl`, `url`, `status`, `RadioGroup1`) VALUES
(1, 0, 'lddrag1397902912', '12312', '0', 'http://weiwincms.weiwin.cc/tpl/User/default/common/images/photo/plugmenu16.png', 'tel:13888888888', '1', '0'),
(2, 0, 'lddrag1397902912', '12312', '0', 'http://weiwincms.weiwin.cc/tpl/User/default/common/images/photo/plugmenu5.png', '123', '1', '0'),
(3, 0, 'lddrag1397902912', '12312', '0', 'http://weiwincms.weiwin.cc/tpl/User/default/common/images/photo/plugmenu17.png', '/index.php?g=Wap&amp;m=Panorama&amp;a=index&amp;token=lddrag1397902912&amp;wecha_id={wechat_id}', '1', '0'),
(4, 0, 'jbbjyc1399284024', '一键点餐', '0', 'http://weiwincms.weiwin.cc/tpl/User/default/common/images/photo/plugmenu11.png', '/index.php?g=Wap&amp;m=Dining&amp;a=index&amp;dining=1&amp;token=jbbjyc1399284024&amp;wecha_id={wechat_id}', '1', '0'),
(5, 0, 'jbbjyc1399284024', '一键导航', '0', 'http://weiwincms.weiwin.cc/tpl/User/default/common/images/photo/plugmenu3.png', '/index.php?g=Wap&amp;m=Company&amp;a=map&amp;token=jbbjyc1399284024&amp;wecha_id={wechat_id}&amp;companyid=5', '1', '0'),
(6, 0, 'jbbjyc1399284024', '一键拨号', '0', 'http://weiwincms.weiwin.cc/tpl/User/default/common/images/photo/plugmenu1.png', 'tel:15558017771', '1', '0'),
(7, 0, 'ugmbpt1399525902', '12311', '0', 'http://wx.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu18.png', '', '1', '0'),
(8, 0, 'ugmbpt1399525902', '12312', '0', 'http://wx.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu8.png', '', '1', '0'),
(9, 0, 'juaqpy1399649560', '商城', '0', 'http://wx.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu9.png', '/index.php?g=Wap&amp;m=Product&amp;a=cats&amp;token=juaqpy1399649560&amp;wecha_id={wechat_id}', '1', '0'),
(10, 0, 'eawfce1399780777', '首页', '0', 'http://wx.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu6.png', 'http://wx.weiwinbao.com/index.php?g=Wap&m=Index&a=index&token=eawfce1399780777', '1', '0'),
(11, 0, 'eawfce1399780777', '客服电话', '0', 'http://wx.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu1.png', 'tel:4006186987 ', '1', '0'),
(12, 0, 'eawfce1399780777', '一键购物', '0', 'http://wx.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu3.png', '/index.php?g=Wap&m=Product&a=cats&token=eawfce1399780777&wecha_id={wechat_id}', '1', '0'),
(13, 0, 'xndgbo1400659291', '12312', '0', 'http://jjl.weiwin.cc/tpl/User/default/common/images/photo/plugmenu4.png', '', '1', '0'),
(14, 0, 'xndgbo1400659291', '3', '0', 'http://jjl.weiwin.cc/tpl/User/default/common/images/photo/plugmenu4.png', '', '1', '0'),
(15, 0, 'rhvbvp1400731169', '产品介绍', '1', 'http://test.weiwinbao.com/tpl/static/attachment/icon/tubiao1/41.png', '/index.php/show/rhvbvp1400731169', '1', '0'),
(16, 0, 'a717713db81322c', '12', '2', 'http://test.weiwinbao.com/tpl/static/attachment/icon/colorful/5.png', 'tel:13888888888', '1', '0'),
(17, 16, 'a717713db81322c', '2', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/cloud-check.png', '2222', '1', '0'),
(18, 0, 'a717713db81322c', '2', '1', 'http://test.weiwinbao.com/tpl/static/attachment/icon/colorful/1.png', '', '1', '0'),
(19, 0, 'a717713db81322c', '33333', '3', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/backpack-2.png', '', '1', '0'),
(20, 19, 'a717713db81322c', '31', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/cloud-up.png', '/index.php?g=Wap&m=Product&a=cats&token=a717713db81322c&wecha_id={wechat_id}', '1', '0'),
(21, 0, 'lylmkx1400730355', '1', '1', 'http://test.weiwinbao.com/tpl/static/attachment/icon/colorful/8.png', '', '1', '0'),
(22, 0, 'lylmkx1400730355', '2', '2', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lanse/111.png', '', '1', '0'),
(23, 0, 'lylmkx1400730355', '3', '3', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lanse/132.png', '/index.php?g=Wap&m=Repast&a=select&token=lylmkx1400730355&wecha_id={wechat_id}', '1', '0'),
(24, 0, '5f787625fc823a2', '链一', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu1.png', '', '1', '0'),
(25, 0, '5f787625fc823a2', '链二', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu2.png', '', '1', '0'),
(26, 0, '5f787625fc823a2', '链三', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu3.png', '', '1', '0'),
(27, 0, '5f787625fc823a2', '链四', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu4.png', '', '1', '0'),
(28, 0, '04cdd8941f09d37', '经典案例', '1', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu7.png', '', '1', '0'),
(29, 0, '04cdd8941f09d37', '优惠活动', '2', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu11.png', '', '1', '0'),
(30, 0, '04cdd8941f09d37', '了解华佑', '3', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu6.png', '', '1', '0'),
(31, 28, '04cdd8941f09d37', '3D样板间', '0', '', '', '1', '0'),
(32, 28, '04cdd8941f09d37', '案例鉴赏', '0', '', '', '1', '0'),
(33, 28, '04cdd8941f09d37', '材料展厅', '0', '', '', '1', '0'),
(35, 30, '04cdd8941f09d37', '集团简介', '0', 'http://test.weiwinbao.com/uploads/0/04cdd8941f09d37/8/c/1/6/thumb_537eff41bcdfd.png', '/index.php?g=Wap&m=Zhuangxiu&a=index&token=04cdd8941f09d37&wecha_id={wechat_id}&id=18', '1', '0'),
(36, 30, '04cdd8941f09d37', '集团文化', '0', '', '', '1', '0'),
(37, 30, '04cdd8941f09d37', '联系我们', '0', '', 'tel:15079626265', '1', '0'),
(38, 0, 'pnxvgh1400856440', '首页', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/line/camera.png', '', '1', '0'),
(39, 0, 'pnxvgh1400856440', '一键拨号', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu1.png', 'tel:18976281182', '1', '0'),
(40, 0, 'pnxvgh1400856440', '一键导航', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu3.png', 'http://api.map.baidu.com/marker?location=20.037504,110.346762&title=%E7%94%B5%E8%AF%9D089865813310&content=海口市大同路华发大厦A80', '1', '0'),
(41, 0, 'pnxvgh1400856440', '微活动', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu15.png', '/index.php?g=Wap&m=Company&a=map&token=pnxvgh1400856440&wecha_id={wechat_id}', '1', '0'),
(42, 0, 'trybtb1400856298', '功能一', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu2.png', '', '1', '0'),
(43, 0, 'trybtb1400856298', '功能二', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu6.png', '', '1', '0'),
(44, 0, 'trybtb1400856298', '功能三', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu16.png', '', '1', '0'),
(45, 0, 'zjxkgy1400897053', '产品销售', '0', 'http://test.weiwinbao.com/uploads/z/zjxkgy1400897053/4/5/1/a/thumb_53800a295883e.png', '', '1', '0'),
(46, 0, 'zjxkgy1400897053', '最新促销', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lvse/20.png', '', '1', '0'),
(47, 0, 'zjxkgy1400897053', '赠品申领', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lvse/249.png', '', '1', '0'),
(48, 0, 'zjxkgy1400897053', '联系我们', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lvse/107.png', '', '1', '0'),
(49, 45, 'zjxkgy1400897053', '古法压榨纯花生油', '0', 'http://test.weiwinbao.com/uploads/z/zjxkgy1400897053/5/8/e/9/thumb_538012b9bf7f4.jpg', '', '1', '0'),
(50, 0, 'dcabgw1400943501', '关于我们', '0', '', '', '1', '0'),
(51, 0, '7b37f944108c95e', '发了放大', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu1.png', '', '1', '0'),
(52, 0, '7b37f944108c95e', '的风格的该死的风', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu6.png', '', '1', '0'),
(53, 0, '7b37f944108c95e', '放大cvcc', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu17.png', '', '1', '0'),
(54, 51, '7b37f944108c95e', '非感染该', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu18.png', '', '1', '0'),
(55, 0, 'jthtom1401004976', 'vdsfgsd ', '0', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/1.png', '', '1', '0'),
(56, 0, '5e8aeeeabe2d84d', '联系我们', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu1.png', '', '1', '0'),
(57, 0, '5e8aeeeabe2d84d', '会员中心', '1', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu2.png', '/index.php?g=Wap&m=Dining&a=index&dining=1&token=5e8aeeeabe2d84d&wecha_id={wechat_id}', '1', '0'),
(58, 0, '5e8aeeeabe2d84d', '主页', '2', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu6.png', '', '1', '0'),
(59, 0, 'jthtom1401004976', 'wdw', '2', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu4.png', 'tel:13888888888', '1', '0'),
(60, 0, 'bcxxiq1401066548', '主页', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu6.png', '/index.php?g=Wap&m=Index&a=index&token=bcxxiq1401066548&wecha_id={wechat_id}', '1', '0'),
(61, 0, 'bcxxiq1401066548', '电话', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu1.png', 'tel:13591310609', '1', '0'),
(62, 0, 'bcxxiq1401066548', '导航', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu3.png', 'http://api.map.baidu.com/marker?location=38.959322,121.591867&title=%E5%A4%A7%E8%BF%9E%E6%A3%92%E6%A3%92%E8%B4%9D%E8%B4%', '1', '0'),
(63, 0, 'bcxxiq1401066548', '互动', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu5.png', '', '1', '0'),
(64, 63, 'bcxxiq1401066548', '微博', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu13.png', 'http://t.qq.com/jinglingbobo715741', '1', '0'),
(65, 63, 'bcxxiq1401066548', '社区', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu4.png', '{siteUrl}/index.php?g=Wap&m=Forum&a=index&token=bcxxiq1401066548&wecha_id={wechat_id}', '1', '0'),
(66, 0, '6d33370a290ec23', '菜单明曾', '1', 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/clock.png', '/index.php?g=Wap&m=Index&a=index&token=6d33370a290ec23&wecha_id={wechat_id}', '1', '0'),
(67, 0, '37ba541feeb5f2a', '1231123', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu4.png', '123', '1', '0'),
(68, 0, '37ba541feeb5f2a', '12312', '0', 'http://test.weiwinbao.com/tpl/User/default/common/images/photo/plugmenu8.png', '', '1', '0');

-- --------------------------------------------------------

--
-- 表的结构 `wy_classify`
--

CREATE TABLE IF NOT EXISTS `wy_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL,
  `info` varchar(90) NOT NULL COMMENT '分类描述',
  `sorts` varchar(6) NOT NULL COMMENT '显示顺序',
  `img` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  `token` varchar(30) NOT NULL,
  `path` varchar(3000) DEFAULT NULL,
  `tpid` int(5) DEFAULT NULL,
  `conttpid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `wy_classify`
--

INSERT INTO `wy_classify` (`id`, `fid`, `name`, `info`, `sorts`, `img`, `url`, `status`, `token`, `path`, `tpid`, `conttpid`) VALUES
(1, 0, '12312', '123', '1', '123', '{siteUrl}/index.php?g=Wap&m=Store&a=cats&token=wtxzkd1402555540&wecha_id={wechat_id}', '1', 'wtxzkd1402555540', NULL, 38, 1),
(2, 0, '123', '123', '1', 'http://jiami.weiwin.cc/tpl/static/attachment/icon/lovely/bookshelf.png', '{siteUrl}/index.php?g=Wap&m=Dining&a=index&dining=1&token=hnebwo1403417647&wecha_id={wechat_id}', '1', 'hnebwo1403417647', NULL, 38, 1),
(3, 0, '万能', '万能', '1', 'http://jiami.weiwin.cc/tpl/static/attachment/icon/lovely/cloud-check.png', '{siteUrl}/index.php?g=Wap&m=Selfform&a=index&token=hnebwo1403417647&wecha_id={wechat_id}&id=9', '1', 'hnebwo1403417647', NULL, 38, 1),
(4, 0, '123', '123', '1', 'http://jiami.weiwin.cc/tpl/static/attachment/icon/lovely/cloud-check.png', '{siteUrl}/index.php?g=Wap&m=Dining&a=index&dining=1&token=bokunv1403419264&wecha_id={wechat_id}', '1', 'bokunv1403419264', NULL, 38, 1),
(5, 0, '酒店', '酒店', '1', 'http://jiami.weiwin.cc/tpl/static/attachment/icon/lovely/cloud-check.png', '{siteUrl}/index.php?g=Wap&m=Hotels&a=index&token=pgafzd1403420356&wecha_id={wechat_id}', '1', 'pgafzd1403420356', NULL, 38, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_company`
--

CREATE TABLE IF NOT EXISTS `wy_company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `shortname` varchar(50) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `intro` text NOT NULL,
  `catid` mediumint(3) NOT NULL DEFAULT '0',
  `taxis` int(10) NOT NULL DEFAULT '0',
  `isbranch` tinyint(1) NOT NULL DEFAULT '0',
  `logourl` varchar(180) NOT NULL DEFAULT '',
  `display` tinyint(1) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL,
  `mark_url` varchar(200) DEFAULT NULL,
  `add_time` char(10) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `partner_id` varchar(100) DEFAULT NULL,
  `apikey` varchar(100) DEFAULT NULL,
  `mkey` varchar(100) DEFAULT NULL,
  `printer_open` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `wy_company`
--

INSERT INTO `wy_company` (`id`, `token`, `name`, `shortname`, `mp`, `tel`, `address`, `email`, `latitude`, `longitude`, `intro`, `catid`, `taxis`, `isbranch`, `logourl`, `display`, `username`, `password`, `area_id`, `cate_id`, `market_id`, `mark_url`, `add_time`, `code`, `partner_id`, `apikey`, `mkey`, `printer_open`) VALUES
(1, 'jzpvbg1397481244', '123', '123', '123', '123', '', '', 0, 0, '3213', 0, 12, 0, 'http://weiwincms.weiwin.cc/tpl/static/attachment/icon/lovely/clock.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'lddrag1397902912', '123', '123', '123', '123', '12312', '', 0, 0, '123', 0, 1, 0, 'http://weiwincms.weiwin.cc/tpl/static/attachment/icon/lovely/cloud-refresh.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'lddrag1397902912', '123123', 'loupan', '18968920219', '12312', '12312312', '', 0, 0, '1231', 0, 0, 0, 'http://weiwincms.weiwin.cc/tpl/static/attachment/icon/lovely/cloud-down.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'bbe6c6ebb14076c', '123', '123', '18968920219', '123', '山东人', '', 0, 0, '12', 0, 12, 0, 'http://weiwincms.weiwin.cc/tpl/static/attachment/icon/lovely/clock.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'jbbjyc1399284024', 'Youni 一席地', '一席地', '13840084622', '15558017771', '辽宁省 沈阳市 皇姑区北站北站北广场 乐天百货负一层B121', '', 41.823241, 123.443318, '同是美乐食中客，相逢何必曾相识！！Youni一席地 你的一席之地。 关注官方微信 惊喜多多礼品多多', 0, 1, 0, 'http://weiwincms.weiwin.cc/uploads/j/jbbjyc1399284024/5/d/3/6/thumb_536766f5bd238.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'speoac1399377486', '123', '12321', '18968920219', '18968920219', '1231231', '', 0, 123, '12', 0, 123, 0, '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'ugmbpt1399525902', '1231212312', '123123312312', '18968920219', '18968920219', '12312', '76020694@qq.com', 0, 0, '1233123121231231231231212', 0, 0, 0, 'http://wx.weiwinbao.com/tpl/static/attachment/icon/lovely/cloud-check.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '0945509e684dcee', '包子大酒店', '包子', '18767103019', '6712367', '黄龙一区', '136545215@qq.com', 27.999019, 120.692016, '', 0, 0, 0, 'http://wx.weiwinbao.com/tpl/static/attachment/background/view/2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'nrohqi1399705084', '1', '1', '1', '1', '1', '1', 23.042534, 113.763134, '', 0, 0, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'umlbah1400600498', '1231', '123', '18968920219', '123', '12312312123', '', 0, 123, '123', 0, 123, 0, '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'mngdjc1400655569', '123', '123', '18968920219', '123', '123', '', 0, 0, '12', 0, 12, 0, 'http://jjl.weiwin.cc/tpl/static/attachment/icon/lovely/cloud-check.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'xndgbo1400659291', '123', '123', '18968920219', '123', '123', '', 0, 0, '123', 0, 123, 0, 'http://jjl.weiwin.cc/tpl/static/attachment/icon/lovely/clock.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'uhsmvp1400670523', '微赢网络', '微赢', '18767103019', '6712367', '黄龙一区6幢702', '', 28.00106, 120.690867, '欢迎来到微赢网络', 0, 0, 0, 'http://jjl.weiwin.cc/uploads/u/uhsmvp1400670523/9/0/0/e/thumb_537c8b64bd358.jpg', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'qcryrk1400673224', '12312123', '123', '18968920219', '123', '12312', 'jinjionglei@126.com', 0, 0, '12312', 0, 0, 0, 'http://jjl.weiwin.cc/tpl/static/attachment/icon/lovely/bus.png', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'iekmgp1400701186', '测试333', '测试333555', '13912345678', '222333444', '3r', '2321@df.com ', 0, 0, '2rfw3eferg', 0, 0, 0, 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/drop.png', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'jvysfw1400718965', '上海酒店', '上海航空大酒店', '13912345678', '2303888', '上海大道1688号', '123@123..com', 31.196075, 104.312098, '测试看看', 0, 1, 0, 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/donut.png', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '5e8aeeeabe2d84d', '北京网上灯具城', '网上灯城', '13112345678', '010-12345678', '北京', '123456789@qq.com', 39.993734, 116.439366, '', 0, 0, 0, 'http://test.weiwinbao.com/uploads/5/5e8aeeeabe2d84d/d/6/7/0/thumb_537d6ed907b3e.jpg', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '5e8aeeeabe2d84d', '网上微灯城', '网上灯城（一分店）', '13112345678', '010-123456789', '北京', '123456789@qq.com', 39.986658, 116.356578, '', 0, 0, 1, 'http://test.weiwinbao.com/uploads/5/5e8aeeeabe2d84d/6/f/9/d/thumb_537d6f3f052a4.jpg', 1, 'wsdc01', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '5e8aeeeabe2d84d', '网上微灯城（二分店）', '网上灯城（二分店）', '13112345678', '010-12345678', '北京', '123456789@qq.com', 39.916302, 116.44914, '', 0, 0, 1, 'http://test.weiwinbao.com/uploads/5/5e8aeeeabe2d84d/b/e/a/8/thumb_537d6f962754c.jpg', 1, 'wsdc02', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'a717713db81322c', 'OVXIN', 'OVXIN微信', '13581239951', '13581239951', '北京市西城区88号', '1311406824@qq.com', 30.371821, 114.467693, '3俄方供货价及家具斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较斤斤计较', 0, 1, 0, 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/pin.png', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'lylmkx1400730355', '是的撒', '十大', '13254632164', '53563', '十大', '53151@12.com', 22.546234, 113.955156, '是的撒', 0, 0, 0, 'http://test.weiwinbao.com/uploads/l/lylmkx1400730355/f/7/e/3/thumb_537d7758e6da4.jpg', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'xvbqxe1400721707', '打算', '的撒旦', '13554738878', '454', '谁打得过', '53151@12.com', 22.536621, 113.962055, '水电费vsf分点', 0, 0, 0, 'http://test.weiwinbao.com/tpl/static/attachment/background/view/2.jpg', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '188146798718486', '大队长火锅', '大队长火锅', '18509297888', '18509297888', '西安市高寻去', '18509297888@qq.com', 0, 0, '的风格的公司对公', 0, 0, 0, 'http://test.weiwinbao.com/tpl/static/attachment/icon/lovely/eye.png', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'hsrrgl1400757175', '1231212312', '12312', '18968920219', '123', '12312', '1231231231', 123, 123, '123', 0, 123, 0, '123', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '9fb09d2547e5425', 'eewr', 'werwerwe', '13211111111', '13211111111', '莲花中路138号', '11@qq.com', 26.047628, 0.098311, '', 0, 0, 0, '12313', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'hlxeby1400747545', '2r432', '32543', '14565456456', '412343243', 'etrewtre', 'adklj@wieywi.co', 37.930745, 102.638088, 'erer', 0, 0, 0, 'http://test.weiwinbao.com/tpl/static/attachment/background/view/11.jpg', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '86df3e5db3c84