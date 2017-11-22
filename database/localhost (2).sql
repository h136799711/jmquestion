-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2014 年 06 月 29 日 13:21
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `question`
-- 
CREATE DATABASE `question` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `question`;

-- --------------------------------------------------------

-- 
-- 表的结构 `admin`
-- 

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL auto_increment,
  `Admin_UserName` varchar(50) NOT NULL,
  `Admin_PassWord` varchar(100) NOT NULL,
  `Admin_Level` varchar(10) NOT NULL,
  `Admin_Major` varchar(20) NOT NULL,
  PRIMARY KEY  (`Admin_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- 导出表中的数据 `admin`
-- 

INSERT INTO `admin` VALUES (1, 'admin', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '管理员', '');
INSERT INTO `admin` VALUES (2, 'department', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '系部', '');
INSERT INTO `admin` VALUES (3, 'rjjs', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '教研室', '软件技术');
INSERT INTO `admin` VALUES (4, 'dzsw', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840 ', '教研室', '电子商务');
INSERT INTO `admin` VALUES (5, 'jsjyy', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '教研室', '计算机应用技术');
INSERT INTO `admin` VALUES (6, 'jsjwl', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '教研室', ' 计算机网络技术');
INSERT INTO `admin` VALUES (7, 'dmsj', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840 ', '教研室', ' 动漫设计与制作');

-- --------------------------------------------------------

-- 
-- 表的结构 `answer`
-- 

CREATE TABLE `answer` (
  `Answer_ID` int(11) NOT NULL auto_increment,
  `Student_ID` varchar(20) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `Answer_Content` varchar(500) NOT NULL,
  `Basic_ID` int(11) NOT NULL,
  PRIMARY KEY  (`Answer_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=220 ;

-- 
-- 导出表中的数据 `answer`
-- 

INSERT INTO `answer` VALUES (201, '20122030213', 83, 'D', 62);
INSERT INTO `answer` VALUES (202, '20122030213', 84, 'B', 62);
INSERT INTO `answer` VALUES (203, '20122030213', 85, 'A', 62);
INSERT INTO `answer` VALUES (204, '20122030213', 86, 'B', 62);
INSERT INTO `answer` VALUES (205, '20122030213', 87, 'B', 62);
INSERT INTO `answer` VALUES (206, '20122030213', 88, 'B', 62);
INSERT INTO `answer` VALUES (207, '20122030213', 89, 'C', 62);
INSERT INTO `answer` VALUES (208, '20122030213', 90, 'B', 62);
INSERT INTO `answer` VALUES (209, '20122030213', 91, 'B', 62);
INSERT INTO `answer` VALUES (210, '20122030213', 92, 'E', 62);
INSERT INTO `answer` VALUES (211, '20122030213', 93, 'B', 62);
INSERT INTO `answer` VALUES (212, '20122030213', 94, 'B', 62);
INSERT INTO `answer` VALUES (213, '20122030213', 95, 'D', 62);
INSERT INTO `answer` VALUES (214, '20122030213', 96, 'B', 62);
INSERT INTO `answer` VALUES (215, '20122030213', 97, 'C', 62);
INSERT INTO `answer` VALUES (216, '20122030213', 98, 'C', 62);
INSERT INTO `answer` VALUES (217, '20122030213', 99, 'B', 62);
INSERT INTO `answer` VALUES (218, '20122030213', 100, 'B', 62);
INSERT INTO `answer` VALUES (219, '20122030213', 101, 'D', 62);

-- --------------------------------------------------------

-- 
-- 表的结构 `basicinfo`
-- 

CREATE TABLE `basicinfo` (
  `Basic_ID` int(11) NOT NULL auto_increment,
  `Basic_Title` varchar(200) NOT NULL,
  `Basic_Abstract` varchar(500) NOT NULL,
  `Basic_Object` varchar(50) NOT NULL,
  `Basic_Number` varchar(50) NOT NULL,
  `Basic_StartTime` datetime NOT NULL,
  `Basic_EndTime` datetime NOT NULL,
  `Basic_Power` int(11) NOT NULL,
  `Basic_Major` varchar(200) NOT NULL,
  `Basic_DateTime` datetime NOT NULL,
  PRIMARY KEY  (`Basic_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

-- 
-- 导出表中的数据 `basicinfo`
-- 

INSERT INTO `basicinfo` VALUES (62, '软件技术专业人才需求调研表', '时光荏苒，岁月如梭，经贸菁菁校园仍然留存您们的印记。在此，软件技术教研室全体教师向您表示亲切的问候，并带去母校对您工作、家庭、生活的祝福。为进一步了解校友们的工作情况，我们正在通过网络、电话访谈、走访等形式对校友进行跟踪调查。希望您在百忙之中抽出时间，完成这份问卷。感谢您对母校和电子商务专业工作的支持！\r\n本次调查没有其他任何商业用途。您所填写的问卷中的所有内容，我们将对其严格保密。', '2013届毕业生', '全部调查', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1, '软件技术', '2014-06-25 18:51:23');
INSERT INTO `basicinfo` VALUES (63, '网络技术专业历届毕业生调查表', '时光荏苒，岁月如梭，经贸菁菁校园仍然留存您们的印记。在此，网络技术教研室全体教师向您表示亲切的问候，并带去母校对您工作、家庭、生活的祝福。为进一步了解校友们的工作情况，我们正在通过网络、电话访谈、走访等形式对校友进行跟踪调查。希望您在百忙之中抽出时间，完成这份问卷。感谢您对母校和网络技术专业工作的支持！本次调查没有其他任何商业用途。您所填写的问卷中的所有内容，我们将对其严格保密。', '2013届毕业生', '全部调查', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ' 计算机网络技术', '2014-06-25 19:38:58');
INSERT INTO `basicinfo` VALUES (64, '计算机应用技术专业历届毕业生调查表', '时光荏苒，岁月如梭，经贸菁菁校园仍然留存您们的印记。在此，计算机应用技术教研室全体教师向您表示亲切的问候，并带去母校对您工作、家庭、生活的祝福。为进一步了解校友们的工作情况，我们正在通过网络、电话访谈、走访等形式对校友进行跟踪调查。希望您在百忙之中抽出时间，完成这份问卷。感谢您对母校和计算机应用技术专业工作的支持！本次调查没有其他任何商业用途。您所填写的问卷中的所有内容，我们将对其严格保密。', '2013届毕业生', '全部调查', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '计算机应用技术', '2014-06-25 19:56:31');
INSERT INTO `basicinfo` VALUES (65, '2014毕业生调查问卷', '12121', '2014届毕业生', '全部调查', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '软件技术', '2014-06-29 16:10:23');
INSERT INTO `basicinfo` VALUES (66, '2012毕业生调查问卷', '212121', '2012届毕业生', '全部调查', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '软件技术', '2014-06-29 16:10:37');
INSERT INTO `basicinfo` VALUES (68, '2011毕业生问卷调查', 'wdwdwq', '2011届毕业生', '全部调查', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '软件技术', '2014-06-29 16:31:25');

-- --------------------------------------------------------

-- 
-- 表的结构 `class`
-- 

CREATE TABLE `class` (
  `Class_ID` int(11) NOT NULL auto_increment,
  `Class_Name` varchar(20) NOT NULL,
  `Major_ID` int(11) NOT NULL,
  PRIMARY KEY  (`Class_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- 导出表中的数据 `class`
-- 

INSERT INTO `class` VALUES (12, '网络技术112', 1);
INSERT INTO `class` VALUES (13, '计算机应用112', 4);

-- --------------------------------------------------------

-- 
-- 表的结构 `major`
-- 

CREATE TABLE `major` (
  `Major_ID` int(11) NOT NULL auto_increment,
  `Major_Name` varchar(200) NOT NULL,
  PRIMARY KEY  (`Major_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- 导出表中的数据 `major`
-- 

INSERT INTO `major` VALUES (1, ' 计算机网络技术');
INSERT INTO `major` VALUES (2, ' 动漫设计与制作');
INSERT INTO `major` VALUES (6, '软件技术');
INSERT INTO `major` VALUES (4, '计算机应用技术');
INSERT INTO `major` VALUES (5, '电子商务');

-- --------------------------------------------------------

-- 
-- 表的结构 `new`
-- 

CREATE TABLE `new` (
  `New_ID` int(11) NOT NULL auto_increment,
  `New_Content` varchar(5000) NOT NULL,
  `New_DateTime` datetime NOT NULL,
  PRIMARY KEY  (`New_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `new`
-- 

INSERT INTO `new` VALUES (1, '<p><span style="color: rgb(102, 102, 102); font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">开展此</span><font color="#0647a5" style="margin: 0px; padding: 0px; font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">调查</font><span style="color: rgb(102, 102, 102); font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">是为了加强我系毕业生与母校之间的</span><font color="#0647a5" style="margin: 0px; padding: 0px; font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">相互联系</font><span style="color: rgb(102, 102, 102); font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">，为了解</span><font color="#0647a5" style="margin: 0px; padding: 0px; font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">毕业后的工作情况</font><span style="color: rgb(102, 102, 102); font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">级对我系在学生培养、教育管理和就业工作的</span><font color="#0647a5" style="margin: 0px; padding: 0px; font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">建议</font><span style="color: rgb(102, 102, 102); font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">和</span><font color="#0647a5" style="margin: 0px; padding: 0px; font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">看法</font><span style="color: rgb(102, 102, 102); font-family: Simsun; font-size: medium; font-weight: bold; line-height: 24px;">，更好地改进我系工作。本调查仅用于统计分析，不会给你个人带来任何不利影响，请如实回答。</span></p>\r\n<p>&nbsp;</p>', '2014-06-05 15:23:46');

-- --------------------------------------------------------

-- 
-- 表的结构 `object`
-- 

CREATE TABLE `object` (
  `Object_ID` int(11) NOT NULL auto_increment,
  `Object_Name` varchar(100) NOT NULL,
  `Object_DateTime` datetime NOT NULL,
  PRIMARY KEY  (`Object_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `object`
-- 

INSERT INTO `object` VALUES (1, '2014届毕业生', '2014-06-16 18:21:18');
INSERT INTO `object` VALUES (2, '2013届毕业生', '2014-06-16 18:21:17');
INSERT INTO `object` VALUES (3, '2012届毕业生', '2014-06-16 18:21:16');
INSERT INTO `object` VALUES (4, '2011届毕业生', '2014-06-16 18:21:15');

-- --------------------------------------------------------

-- 
-- 表的结构 `question`
-- 

CREATE TABLE `question` (
  `Question_ID` int(11) NOT NULL auto_increment,
  `Basic_ID` int(11) NOT NULL,
  `Question_Title` varchar(200) NOT NULL,
  `Question_Type` varchar(20) NOT NULL,
  `Question_DateTime` datetime NOT NULL,
  `Question_A` varchar(200) NOT NULL,
  `Question_B` varchar(200) NOT NULL,
  `Question_C` varchar(200) NOT NULL,
  `Question_D` varchar(200) NOT NULL,
  `Question_E` varchar(200) NOT NULL,
  `Question_F` varchar(200) NOT NULL,
  `Question_Major` varchar(200) NOT NULL,
  PRIMARY KEY  (`Question_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=139 ;

-- 
-- 导出表中的数据 `question`
-- 

INSERT INTO `question` VALUES (83, 62, '您在我院的毕业时间是', '单选题', '2014-06-25 19:07:59', '2011年前', '2011年', '2012年', '2013年', '', '', '软件技术');
INSERT INTO `question` VALUES (84, 62, '您现在的职业发展类型是', '单选题', '2014-06-25 19:08:55', '受雇工作', '自主创业', '自由职业(指以个体劳动获取劳动报酬但又没领取营业执照的职业状态)', '待业', '', '', '软件技术');
INSERT INTO `question` VALUES (85, 62, '您目前工作地区是', '单选题', '2014-06-25 19:09:25', '省会城市或发达的地级市', '普通地级市', '县级市、县城', '乡镇', '农村', '', '软件技术');
INSERT INTO `question` VALUES (86, 62, '您目前的平均月收入在以下哪个区间', '单选题', '2014-06-25 19:10:24', '2000元以下', '2001-3000元', '3001-4000元', '4001-5000元', '5001-6000元', '6000元以上', '软件技术');
INSERT INTO `question` VALUES (87, 62, '您目前的工作与您大学时所学专业是否相关', '单选题', '2014-06-25 19:11:05', '完全相关', '相关', '基本相关', '不太相关', '完全不相关', '', '软件技术');
INSERT INTO `question` VALUES (88, 62, '从学校毕业到现在，您一共从事过多少份全职工作', '单选题', '2014-06-25 19:11:26', '1份', '2份', '3份', '4 份及以上', '', '', '软件技术');
INSERT INTO `question` VALUES (89, 62, '您当前所在工作单位属于', '单选题', '2014-06-25 19:13:41', '政府机构', '国有企业', '非营利性社会团体（如协会等）', '民营（私营）企业', '外资/合资', '其它', '软件技术');
INSERT INTO `question` VALUES (90, 62, '您当前所在工作单位的员工数为', '单选题', '2014-06-25 19:14:11', '30人以下', '30-100人', '100-300人', '300-500人', '500-1000人', '1000人以上', '软件技术');
INSERT INTO `question` VALUES (91, 62, '您目前的职位是', '单选题', '2014-06-25 19:14:28', '总监、总经理、单位负责人级', '项目主管、经理级', '普通员工', '', '', '', '软件技术');
INSERT INTO `question` VALUES (92, 62, '您对自身当前工作前途如何看待？', '单选题', '2014-06-25 19:14:50', '有前途，希望多从工作实践中学习', '有前途，但有时也觉得迷茫', '不清楚，持观望态度', '自费培训', '前途无望', '', '软件技术');
INSERT INTO `question` VALUES (93, 62, '在参加了相关专业培训过的学生当中,您对参加过哪方面的培训的人更感兴趣？', '单选题', '2014-06-25 19:15:10', 'Java程序员', 'C/C++语言程序员', '网络工程师', '平面设计师', 'UI设计', '', '软件技术');
INSERT INTO `question` VALUES (94, 62, '如果您从事与软件技术有关的工作，您目前的工作主要相关的是', '单选题', '2014-06-25 19:15:30', '软件服务外包', '移动软件开发（跨境电子商务）', 'UI开发', '后台开发', '数据库开发和维护', '', '软件技术');
INSERT INTO `question` VALUES (95, 62, '您认为软件开发公司主要看中软件开发专业的大学生哪些素质？', '单选题', '2014-06-25 19:15:55', '专业理论知识', '实践能力', '人际沟通能力', '团队意识', '创新思维', '个人品质', '软件技术');
INSERT INTO `question` VALUES (96, 62, '您对自己未来的职业发展信心如何', '单选题', '2014-06-25 19:16:17', '非常有信心', '比较有信心', ' 一般', '不太有信心', '非常没信心', '', '软件技术');
INSERT INTO `question` VALUES (97, 62, '您现在会常想念或与之保持联系的母校教师有几位', '单选题', '2014-06-25 19:16:39', '1位', '2 位', '3 位', '4位及以上', '没有', '', '软件技术');
INSERT INTO `question` VALUES (98, 62, '您是否愿意将母校推荐给自己的亲戚朋友就读', '单选题', '2014-06-25 19:17:06', '非常愿意', '愿意', '可以考虑', '不太愿意', '非常不愿意', '', '软件技术');
INSERT INTO `question` VALUES (99, 62, '您认为软件开发专业毕业生在求职前除专业技能外，欠缺的职业素养有那些？', '单选题', '2014-06-25 19:17:24', '对自身职业生涯的规划', '职业道德', '职业礼仪', '行业背景知识，岗位要求的了解', '', '', '软件技术');
INSERT INTO `question` VALUES (100, 62, '您认为软件开发公司目前最紧缺的软件人才是？', '单选题', '2014-06-25 19:18:10', '软件测试工程师', '系统分析师', '高级程序员', '软件实施工程师', '程序员', '其他', '软件技术');
INSERT INTO `question` VALUES (101, 62, '您认为软件开发公司解决软件人才需求的方法有哪些？', '单选题', '2014-06-25 19:18:34', '通过工作进行培养', '企业培训', '依托社会人才招聘', '接受高校或培训中心的软件专业毕业生', '', '', '软件技术');
INSERT INTO `question` VALUES (102, 63, '您在我院的毕业时间是', '单选题', '2014-06-25 19:39:23', '2011年前', '2011年', '2012年', '2013年', '', '', '计算机网络技术');
INSERT INTO `question` VALUES (103, 63, '您现在的职业发展类型是', '单选题', '2014-06-25 19:39:41', '受雇工作', '自主创业', '自由职业（指以个体劳动获取劳动报酬但又没领取营业执照的职业状态）', '待业', '', '', '计算机网络技术');
INSERT INTO `question` VALUES (104, 63, '您目前工作地区是', '单选题', '2014-06-25 19:40:04', '省会城市或发达的地级市', '普通地级市', '县级市、县城', '乡镇', '农村', '', '计算机网络技术');
INSERT INTO `question` VALUES (105, 63, '您目前的平均月收入在以下哪个区间', '单选题', '2014-06-25 19:40:35', '2000元以下', '2001-3000元', '3001-4000元', '4001-5000元', '5001-6000元', '6000元以上', '计算机网络技术');
INSERT INTO `question` VALUES (106, 63, '您目前的工作与您大学时所学专业是否相关', '单选题', '2014-06-25 19:40:55', '完全相关', '相关', '基本相关', '不太相关', '完全不相关', '', '计算机网络技术');
INSERT INTO `question` VALUES (107, 63, '从学校毕业到现在，您一共从事过多少份全职工作', '单选题', '2014-06-25 19:41:16', '1份', '2份', '3份', '4份及以上', '', '', '计算机网络技术');
INSERT INTO `question` VALUES (108, 63, '您当前所在工作单位属于', '单选题', '2014-06-25 19:51:57', '政府机构', '国有企业', '非营利性社会团体（如协会等）', '民营（私营）企业', '外资/合资', '其它', '计算机网络技术');
INSERT INTO `question` VALUES (109, 63, '您当前所在工作单位的员工数为', '单选题', '2014-06-25 19:52:28', '30人以下', '30-100人', '100-300人', '300-500人', '500-1000人', '1000人以上', '计算机网络技术');
INSERT INTO `question` VALUES (110, 63, '您目前的职位是', '单选题', '2014-06-25 19:52:42', '总监、总经理、单位负责人级 ', '主管、经理级', '普通员工', '', '', '', '计算机网络技术');
INSERT INTO `question` VALUES (111, 63, '如果您从事与网络技术有关的工作，您的第一份工作岗位最相关的是', '单选题', '2014-06-25 19:53:13', '美工设计', '网络维护', '技术支持', '安全管理', '程序开发', '其它岗位', '计算机网络技术');
INSERT INTO `question` VALUES (112, 63, '如果您从事与网络技术有关的工作，您目前的岗位最相关的是', '单选题', '2014-06-25 19:53:44', '美工设计', '网络维护', '技术支持', '安全管理', '程序开发', '其它岗位', '计算机网络技术');
INSERT INTO `question` VALUES (113, 63, '如果您从事与网络技术有关的工作，您目前的工作主要相关的是', '单选题', '2014-06-25 19:54:03', '服务器管理', '网络与安全技术', '两者均涉及', '未从事网络技术相关工作', '', '', '计算机网络技术');
INSERT INTO `question` VALUES (114, 63, '您对现在的工作满意吗', '单选题', '2014-06-25 19:54:21', '非常满意', '满意', '不太满意', '非常不满意', '', '', '计算机网络技术');
INSERT INTO `question` VALUES (115, 63, '您对自己未来的职业发展信心如何', '单选题', '2014-06-25 19:54:41', '非常有信心', '比较有信心', '一般', '不太有信心', '非常没信心', '', '计算机网络技术');
INSERT INTO `question` VALUES (116, 63, '您现在会常想念或与之保持联系的母校教师有几位', '单选题', '2014-06-25 19:55:01', '1位', '2 位', '3位', '4位及以上', '没有', '', '计算机网络技术');
INSERT INTO `question` VALUES (117, 63, '您是否愿意将母校推荐给自己的亲戚朋友就读', '单选题', '2014-06-25 19:55:22', '非常愿意', '愿意', '可以考虑', '不太愿意', '非常不愿意', '', '计算机网络技术');
INSERT INTO `question` VALUES (118, 64, '您在我院的毕业时间是', '单选题', '2014-06-25 19:56:53', '2011年前', '2011年', '2012年', '2013年', '', '', '计算机应用技术');
INSERT INTO `question` VALUES (119, 64, '您现在的职业发展类型是', '单选题', '2014-06-25 19:57:10', '受雇工作', '自主创业', '自由职业（指以个体劳动获取劳动报酬但又没领取营业执照的职业状态）', '待业', '', '', '计算机应用技术');
INSERT INTO `question` VALUES (120, 64, '您目前工作地区是', '单选题', '2014-06-25 19:57:33', '省会城市或发达的地级市', '普通地级市', '县级市、县城', '乡镇', '农村', '', '计算机应用技术');
INSERT INTO `question` VALUES (121, 64, '您目前的平均月收入在以下哪个区间', '单选题', '2014-06-25 19:57:58', '2000元以下', '2001-3000元', '3001-4000元', '4001-5000元', '5001-6000元', '6000元以上', '计算机应用技术');
INSERT INTO `question` VALUES (122, 64, '您目前的工作与您大学时所学专业是否相关', '单选题', '2014-06-25 19:58:24', '完全相关', '相关', '基本相关', '不太相关', '完全不相关', '', '计算机应用技术');
INSERT INTO `question` VALUES (123, 64, '从学校毕业到现在，您一共从事过多少份全职工作', '单选题', '2014-06-25 19:58:44', '1份', '2份', '3份', '4份及以上', '', '', '计算机应用技术');
INSERT INTO `question` VALUES (124, 64, '您当前所在工作单位属于', '单选题', '2014-06-25 19:59:09', '政府机构', '国有企业', '非营利性社会团体（如协会等）', '民营（私营）企业', '外资/合资', '其它', '计算机应用技术');
INSERT INTO `question` VALUES (125, 64, '您当前所在工作单位的员工数为', '单选题', '2014-06-25 19:59:32', '30人以下', '30-100人', '100-300人', '300-500人', '500-1000人', '1000人以上', '计算机应用技术');
INSERT INTO `question` VALUES (126, 64, '您目前的职位是', '单选题', '2014-06-25 19:59:45', '总监、总经理、单位负责人级', '主管、经理级', '普通员工', '', '', '', '计算机应用技术');
INSERT INTO `question` VALUES (127, 64, '如果您现在未从事与计算机应用技术有关的工作，那您的第一份工作岗位最相关的是', '单选题', '2014-06-25 20:00:10', '美工/前端设计', '营销策划', '运营推广', '数据分析', '程序设计', '其它岗位', '计算机应用技术');
INSERT INTO `question` VALUES (128, 64, '如果您从事与计算机应用技术有关的工作，您目前的岗位最相关的是', '单选题', '2014-06-25 20:00:34', '美工/前端设计', '营销策划', '运营推广', '数据分析', '程序设计', '其它岗位', '计算机应用技术');
INSERT INTO `question` VALUES (129, 64, '如果您从事与计算机应用技术有关的工作，您目前工作的企业所属行业类型是', '单选题', '2014-06-25 20:00:56', '信息技术类', '电子商务类', '移动互联网类', '传统企业类', '涉及企业类', '其它类', '计算机应用技术');
INSERT INTO `question` VALUES (130, 64, '您对现在的工作满意吗', '单选题', '2014-06-25 20:01:13', '非常满意', '满意', '不太满意', '非常不满意', '', '', '计算机应用技术');
INSERT INTO `question` VALUES (131, 64, '您对自己未来的职业发展信心如何', '单选题', '2014-06-25 20:01:33', '非常有信心', '比较有信心', '一般', '不太有信心', '非常没信心', '', '计算机应用技术');
INSERT INTO `question` VALUES (132, 64, '您现在会常想念或与之保持联系的母校教师有几位', '单选题', '2014-06-25 20:01:56', '1位', '2位', '3位', '4位及以上', '没有', '', '计算机应用技术');
INSERT INTO `question` VALUES (133, 64, '您是否愿意将母校推荐给自己的亲戚朋友就读', '单选题', '2014-06-25 20:02:21', '非常愿意', '愿意', '可以考虑', '不太愿意', '非常不愿意', '', '计算机应用技术');
INSERT INTO `question` VALUES (134, 64, '请留下您对母校计算机应用技术专业的建设的宝贵建议，我们非常感激', '简答题', '2014-06-25 20:02:27', '', '', '', '', '', '', '计算机应用技术');
INSERT INTO `question` VALUES (135, 65, '你几岁了？', '单选题', '2014-06-29 16:10:55', '20', '21', '', '', '', '', '软件技术');
INSERT INTO `question` VALUES (136, 66, '你几岁了？', '单选题', '2014-06-29 16:11:06', '20', '21', '', '', '', '', '软件技术');
INSERT INTO `question` VALUES (138, 68, '你几岁了？', '单选题', '2014-06-29 16:31:39', '20', '21', '', '', '', '', '软件技术');

-- --------------------------------------------------------

-- 
-- 表的结构 `student`
-- 

CREATE TABLE `student` (
  `Student_SID` int(11) NOT NULL auto_increment,
  `Student_ID` varchar(20) NOT NULL,
  `Student_Name` varchar(20) NOT NULL,
  `Student_Sex` varchar(10) NOT NULL,
  `Student_Major` varchar(20) NOT NULL,
  `Student_Class` varchar(20) NOT NULL,
  `Student_Work` varchar(20) NOT NULL,
  `Student_Phone` varchar(20) NOT NULL,
  `Student_Email` varchar(50) NOT NULL,
  `Student_Object` varchar(20) NOT NULL,
  `Student_Card` varchar(50) NOT NULL,
  PRIMARY KEY  (`Student_SID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

-- 
-- 导出表中的数据 `student`
-- 

INSERT INTO `student` VALUES (47, '20122030213', '陶新华', '男', '软件技术', '软件技术122', '打工', '15757185531', '739731324@qq.com', '2013届毕业生', '331081199409246310');
INSERT INTO `student` VALUES (48, '20122030214', '张三', '男', '软件技术', '软件技术112', '打工', '15757185531', '1240082030@qq.com', '2013届毕业生', '331081199409246310');

-- --------------------------------------------------------

-- 
-- 表的结构 `submit`
-- 

CREATE TABLE `submit` (
  `Submit_ID` int(11) NOT NULL auto_increment,
  `Student_ID` varchar(20) NOT NULL,
  `Basic_ID` int(11) NOT NULL,
  `Student_Object` varchar(20) NOT NULL,
  `Submit_DateTime` datetime NOT NULL,
  `Submit_Major` varchar(20) NOT NULL,
  PRIMARY KEY  (`Submit_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- 
-- 导出表中的数据 `submit`
-- 

INSERT INTO `submit` VALUES (29, '20122030213', 62, '2013届毕业生', '2014-06-25 19:19:10', '软件技术');
