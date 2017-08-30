-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-30 11:39:54
-- 服务器版本： 5.5.56-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eat_buy`
--

-- --------------------------------------------------------

--
-- 表的结构 `buy_address`
--

CREATE TABLE `buy_address` (
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `adname` char(30) NOT NULL,
  `adphone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `buy_adver`
--

CREATE TABLE `buy_adver` (
  `adid` int(11) NOT NULL,
  `adurl` varchar(255) DEFAULT NULL,
  `adpicture` varchar(255) NOT NULL,
  `classify` char(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0允许1不允许',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_adver`
--

INSERT INTO `buy_adver` (`adid`, `adurl`, `adpicture`, `classify`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(6, '/index/detail/goods', './upload/klj_59a623a9df99e.jpg', '广告类', 0, '2017-08-30 02:32:09', NULL, NULL),
(7, '/index/detail/goods', './upload/klj_59a623cdb199d.jpg', '广告类', 0, '2017-08-30 02:32:45', NULL, NULL),
(8, '/index/detail/goods', './upload/klj_59a623d9878f8.jpg', '广告类', 0, '2017-08-30 02:32:57', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_assecc`
--

CREATE TABLE `buy_assecc` (
  `aid` int(11) NOT NULL,
  `aname` char(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `detele_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_assecc`
--

INSERT INTO `buy_assecc` (`aid`, `aname`, `status`, `create_time`, `update_time`, `detele_time`) VALUES
(1, '添加', 1, NULL, NULL, NULL),
(2, '修改', 1, NULL, NULL, NULL),
(3, '删除', 1, NULL, NULL, NULL),
(4, '查看', 1, NULL, NULL, NULL),
(5, '审核', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_car`
--

CREATE TABLE `buy_car` (
  `cid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `buy_collect`
--

CREATE TABLE `buy_collect` (
  `lcid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `buy_goods`
--

CREATE TABLE `buy_goods` (
  `gid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `gname` varchar(30) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `path_id` char(30) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delate_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_goods`
--

INSERT INTO `buy_goods` (`gid`, `pid`, `gname`, `status`, `path_id`, `create_time`, `update_time`, `delate_time`) VALUES
(1, 0, '洗涮刷', 0, '1', '2017-08-23 01:13:33', NULL, NULL),
(2, 0, '面食', 0, '2', '2017-08-24 07:36:00', NULL, NULL),
(3, 1, '刷羊肉', 0, '1，1', '2017-08-23 00:46:12', NULL, NULL),
(4, 3, '火锅', 0, '3,3,1', '2017-08-22 23:29:14', NULL, NULL),
(5, 2, '拉面', 0, '2,2', '2017-08-24 04:20:35', NULL, NULL),
(6, 5, '牛肉拉面', 0, '5,5，2', '2017-08-23 02:00:31', NULL, NULL),
(7, 0, '小菜馆', 0, '7', '2017-08-23 08:21:00', '2017-08-25 09:14:25', NULL),
(8, 7, '黄焖鸡', 0, '7,7', '2017-08-24 02:00:00', NULL, NULL),
(9, 8, '米饭', 0, '8,8,7', '2017-08-29 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_link`
--

CREATE TABLE `buy_link` (
  `lid` int(11) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `licon` varchar(255) DEFAULT NULL,
  `url` char(60) NOT NULL,
  `descp` varchar(255) DEFAULT NULL,
  `mege` char(60) DEFAULT NULL,
  `mark` char(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_link`
--

INSERT INTO `buy_link` (`lid`, `lname`, `licon`, `url`, `descp`, `mege`, `mark`, `status`) VALUES
(1, '诗意人生', '诗意', 'blog.shiyirensheng.cn', '想拥有一个不一样的人生', '', '皖ICP备17006694号-1', 0);

-- --------------------------------------------------------

--
-- 表的结构 `buy_order`
--

CREATE TABLE `buy_order` (
  `oid` int(11) NOT NULL,
  `onums` int(11) NOT NULL COMMENT '订单号',
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `buy_reply`
--

CREATE TABLE `buy_reply` (
  `reid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `buy_role`
--

CREATE TABLE `buy_role` (
  `rid` int(11) NOT NULL,
  `uname` char(30) NOT NULL COMMENT '对应名称',
  `contents` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_role`
--

INSERT INTO `buy_role` (`rid`, `uname`, `contents`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '超级管理员', '最牛逼的存在，哈哈哈。。', 1, '2017-08-21 08:34:34', NULL, NULL),
(2, '广告管理员', '专门发广告的', 1, '2017-08-21 08:34:34', NULL, NULL),
(3, '店铺审核员', '店铺管理', 1, '2017-08-21 08:34:34', NULL, NULL),
(4, '会员管理', '管理用户的管理员', 1, '2017-08-22 07:00:16', NULL, NULL),
(5, '交易管理', '好有钱的一个管理', 1, '2017-08-22 11:20:44', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_role_access`
--

CREATE TABLE `buy_role_access` (
  `raid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_role_access`
--

INSERT INTO `buy_role_access` (`raid`, `rid`, `aid`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 2, 1, 1, NULL, NULL, NULL),
(2, 2, 2, 1, NULL, NULL, NULL),
(3, 2, 3, 1, NULL, NULL, NULL),
(4, 2, 4, 1, NULL, NULL, NULL),
(5, 2, 5, 1, NULL, NULL, NULL),
(6, 4, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_sadmin`
--

CREATE TABLE `buy_sadmin` (
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(32) NOT NULL,
  `phone` char(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '2' COMMENT '1男2女',
  `age` int(11) DEFAULT NULL,
  `picture` varchar(55) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1允许0不允许登录',
  `type` int(11) NOT NULL DEFAULT '2' COMMENT '1是超级管理员2是普通管理员',
  `login_ip` int(13) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_sadmin`
--

INSERT INTO `buy_sadmin` (`uid`, `rid`, `username`, `password`, `phone`, `email`, `sex`, `age`, `picture`, `status`, `type`, `login_ip`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 1, 'admin', 'dc483e80a7a0bd9ef71d8cf973673924', '13877940691', '898027568@qq.com', 1, 25, NULL, 1, 1, 2130706433, '2017-08-19 04:57:50', NULL, NULL),
(2, 2, 'home', 'dc483e80a7a0bd9ef71d8cf973673924', '13877940691', '898027568@qq.com', 1, 23, NULL, 1, 2, 2130706433, '2017-08-21 07:57:56', NULL, NULL),
(3, 3, 'add2', 'dc483e80a7a0bd9ef71d8cf973673924', '13877940691', '898027568@qq.com', 2, 21, NULL, 1, 2, 2130706433, '2017-08-21 07:58:10', NULL, NULL),
(4, 4, 'supervip', 'dc483e80a7a0bd9ef71d8cf973673924', '13877940691', '898027568@qq.com', 1, 22, NULL, 1, 2, 2130706433, '2017-08-21 07:58:31', NULL, NULL),
(5, 5, 'aaaa', 'dc483e80a7a0bd9ef71d8cf973673924', '18175356910', '17767@qq.com', 1, 25, NULL, 1, 2, 2130706433, '2017-08-21 13:15:00', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_shop`
--

CREATE TABLE `buy_shop` (
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sname` char(30) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '店铺介绍',
  `address` varchar(255) NOT NULL COMMENT '店铺地址',
  `photo` varchar(255) NOT NULL COMMENT '店铺头像',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_shop`
--

INSERT INTO `buy_shop` (`sid`, `uid`, `sname`, `description`, `address`, `photo`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 1, '缘来是你', '有缘的千里来相会，无缘的我们把酒碰杯。', '北京市——海淀区——东升镇', '', 1, '2017-08-23 06:14:00', NULL, NULL),
(2, 1, '我和你', '有缘的千里来相会，无缘的我们把酒碰杯。', '北京市——海淀区——东升镇', '', 1, '2017-08-23 06:14:00', NULL, NULL),
(3, 1, '七夕_气息', '有缘的千里来相会，无缘的我们把酒碰杯。', '北京市——海淀区', '', 1, '2017-08-23 06:14:00', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_show`
--

CREATE TABLE `buy_show` (
  `id` int(11) NOT NULL,
  `shname` varchar(50) DEFAULT NULL,
  `shid` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '现价',
  `rprice` int(11) NOT NULL DEFAULT '0' COMMENT '原价',
  `strong` int(11) NOT NULL,
  `tents` varchar(50) DEFAULT NULL COMMENT '关键字',
  `picture` varchar(255) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `nums` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_show`
--

INSERT INTO `buy_show` (`id`, `shname`, `shid`, `price`, `rprice`, `strong`, `tents`, `picture`, `place`, `nums`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '火锅', 1, 12, 15, 30, '火锅', './upload/klj_59a0d5680bab0.jpg', '北京', 30, 0, '2017-08-25 05:21:45', NULL, NULL),
(16, '糯米', 9, 21, 23, 122, '米饭', './upload/klj_59a0d5ea11d86.jpg', '安徽', 34, 0, '2017-08-26 01:59:06', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_user`
--

CREATE TABLE `buy_user` (
  `id` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `pwd` char(32) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '2',
  `picture` varchar(255) NOT NULL,
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT '0' COMMENT '0是普通用户1是超级管理员',
  `opid` varchar(255) DEFAULT NULL,
  `regip` int(11) DEFAULT NULL,
  `loginip` int(13) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `buy_user`
--

INSERT INTO `buy_user` (`id`, `uname`, `pwd`, `phone`, `email`, `sex`, `picture`, `grade`, `address`, `status`, `type`, `opid`, `regip`, `loginip`, `create_time`, `update_time`, `delete_time`) VALUES
(1, 'admin', 'dc483e80a7a0bd9ef71d8cf973673924', '17681276600', '123@qq.com', 2, '/upload/sf_59a3fdf197cf6.png', 10, '中国-北京-海淀', 0, 2, NULL, NULL, 1325479864, '2017-08-28 04:14:26', NULL, NULL),
(2, 'kelijun', 'dc483e80a7a0bd9ef71d8cf973673924', '18175356910', '123@qq.com', 2, '/upload/klj_59a0d5680bab0.jpg', 10, '中国-北京-海淀', 0, 0, NULL, NULL, 1325479864, '2017-08-28 04:14:26', NULL, NULL),
(3, '＆路途', '202cb962ac59075b964b07152d234b70', NULL, NULL, 2, 'http://q.qlogo.cn/qqapp/101406763/A1B2F5E9C297EFC56670F8695084FF4C/40', 0, '安庆', 0, 0, 'A1B2F5E9C297EFC56670F8695084FF4C', NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `buy_user_role`
--

CREATE TABLE `buy_user_role` (
  `urid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_address`
--
ALTER TABLE `buy_address`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `buy_adver`
--
ALTER TABLE `buy_adver`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `buy_assecc`
--
ALTER TABLE `buy_assecc`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `buy_car`
--
ALTER TABLE `buy_car`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `buy_collect`
--
ALTER TABLE `buy_collect`
  ADD PRIMARY KEY (`lcid`);

--
-- Indexes for table `buy_goods`
--
ALTER TABLE `buy_goods`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `buy_link`
--
ALTER TABLE `buy_link`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `buy_order`
--
ALTER TABLE `buy_order`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `buy_reply`
--
ALTER TABLE `buy_reply`
  ADD PRIMARY KEY (`reid`);

--
-- Indexes for table `buy_role`
--
ALTER TABLE `buy_role`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `buy_role_access`
--
ALTER TABLE `buy_role_access`
  ADD PRIMARY KEY (`raid`);

--
-- Indexes for table `buy_sadmin`
--
ALTER TABLE `buy_sadmin`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `buy_shop`
--
ALTER TABLE `buy_shop`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `buy_show`
--
ALTER TABLE `buy_show`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_user`
--
ALTER TABLE `buy_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_user_role`
--
ALTER TABLE `buy_user_role`
  ADD PRIMARY KEY (`urid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `buy_address`
--
ALTER TABLE `buy_address`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `buy_adver`
--
ALTER TABLE `buy_adver`
  MODIFY `adid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `buy_assecc`
--
ALTER TABLE `buy_assecc`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `buy_car`
--
ALTER TABLE `buy_car`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `buy_collect`
--
ALTER TABLE `buy_collect`
  MODIFY `lcid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `buy_goods`
--
ALTER TABLE `buy_goods`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `buy_link`
--
ALTER TABLE `buy_link`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `buy_order`
--
ALTER TABLE `buy_order`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `buy_reply`
--
ALTER TABLE `buy_reply`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `buy_role`
--
ALTER TABLE `buy_role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `buy_role_access`
--
ALTER TABLE `buy_role_access`
  MODIFY `raid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `buy_sadmin`
--
ALTER TABLE `buy_sadmin`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `buy_shop`
--
ALTER TABLE `buy_shop`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `buy_show`
--
ALTER TABLE `buy_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `buy_user`
--
ALTER TABLE `buy_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `buy_user_role`
--
ALTER TABLE `buy_user_role`
  MODIFY `urid` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
