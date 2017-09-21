/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50509
Source Host           : localhost:3306
Source Database       : project_d00004

Target Server Type    : MYSQL
Target Server Version : 50509
File Encoding         : 65001

Date: 2017-09-20 23:53:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for about
-- ----------------------------
DROP TABLE IF EXISTS `about`;
CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(150) DEFAULT NULL COMMENT '標題',
  `subject` varchar(100) DEFAULT NULL COMMENT '資訊標題',
  `notes` varchar(100) DEFAULT NULL COMMENT '資訊副標題',
  `description` text COMMENT '詳細內容',
  `banner_title` varchar(100) DEFAULT NULL COMMENT 'Banner標題',
  `seo_title` varchar(100) DEFAULT NULL COMMENT 'SEO標題',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `pic` text COMMENT 'Banner圖片',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of about
-- ----------------------------
INSERT INTO `about` VALUES ('1', '1', 'tw', '關於我們', '歡迎來到莫仔桌遊', '關於莫仔桌遊', '<div class=\"dark-text\">享受最純粹『玩』的本質，以人與人的互動，啓動桌遊的魔幻空間。你今天！桌遊了沒</div>\n\n<div class=\"text\">從對桌遊的一無所知開始，ＭＯＺＩ不斷在找尋自己對桌遊的定位，在與孩子玩樂的過程中，不斷開創自己的桌遊觀，轉化成新的遊戲能量與每一個朋友們分享『玩』的喜悅。<br />\nＭＯＺＩＧＡＭＥ的前身是莫仔羊創意工作室，一直以來都是以自娛娛人的設計方式將不同的歡樂帶給有需要的人，直到2011年莫仔羊第一次接觸到桌上遊戲，被那種人與人相聚才能進行的遊戲模式深深吸引，於是決定投身著上遊戲的設計與制作，希望有一天也能做出讓大家都滿意的遊戲，為身邊的朋友帶來歡樂。\n<figure class=\"image\"><img alt=\"\" src=\"/images/MOZI-LOGO-01.jpg\" /></figure>\n</div>\n', '關於我們', '歡迎來到莫仔桌遊', '歡迎來到莫仔桌遊', '歡迎來到莫仔桌遊', '1', '2017-05-17 13:30:38', '1707260157440.jpg,', ' §');
INSERT INTO `about` VALUES ('2', '1', 'en', 'ABOUT US', 'Welcome to MOZI Games', 'About as MOZI Games', '<div class=\"dark-text\">享受最純粹『玩』的本質，以人與人的互動，啓動桌遊的魔幻空間。你今天！桌遊了沒</div>\n\n<div class=\"text\">從對桌遊的一無所知開始，ＭＯＺＩ不斷在找尋自己對桌遊的定位，在與孩子玩樂的過程中，不斷開創自己的桌遊觀，轉化成新的遊戲能量與每一個朋友們分享『玩』的喜悅。<br />\nＭＯＺＩＧＡＭＥ的前身是莫仔羊創意工作室，一直以來都是以自娛娛人的設計方式將不同的歡樂帶給有需要的人，直到2011年莫仔羊第一次接觸到桌上遊戲，被那種人與人相聚才能進行的遊戲模式深深吸引，於是決定投身著上遊戲的設計與制作，希望有一天也能做出讓大家都滿意的遊戲，為身邊的朋友帶來歡樂。\n<figure class=\"image\"><img alt=\"\" src=\"/images/MOZI-LOGO-01.jpg\" /></figure>\n</div>\n', 'ABOUT US', 'Welcome to MOZI Games', 'Welcome to MOZI Games', 'Welcome to MOZI Games', '0', '2017-07-26 01:53:12', '1707260157440.jpg,', ' §');

-- ----------------------------
-- Table structure for admin_account
-- ----------------------------
DROP TABLE IF EXISTS `admin_account`;
CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(100) NOT NULL COMMENT '帳號',
  `passwd` varchar(100) NOT NULL COMMENT '密碼',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `status` char(1) NOT NULL COMMENT '狀態',
  `guid` varchar(64) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lang` varchar(2) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '顯示語系',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_account
-- ----------------------------
INSERT INTO `admin_account` VALUES ('1', 'admin', 'dc483e80a7a0bd9ef71d8cf973673924', '系統管理員', 'Y', '1', null, '2017-06-30 21:40:42');
INSERT INTO `admin_account` VALUES ('4', 'daniel111', 'e99a18c428cb38d5f260853678922e03', 'test', 'Y', '1498837726', 'tw', '2017-06-30 15:48:46');

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `types` varchar(30) DEFAULT NULL,
  `tables` varchar(30) DEFAULT NULL,
  `have_list` char(1) DEFAULT 'Y',
  `open_no` int(11) DEFAULT NULL,
  `use_lang` char(1) DEFAULT 'Y' COMMENT '是否使用語系',
  `link_type` varchar(20) DEFAULT NULL COMMENT '連結方式(列表list、修改edit)',
  `pro` char(1) DEFAULT 'N' COMMENT '是否為進階版使用',
  `category` int(11) DEFAULT NULL COMMENT '分類',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `status` char(1) DEFAULT NULL COMMENT '啟用停用',
  `default_id` varchar(64) DEFAULT NULL COMMENT '預設鍵值',
  `icon` varchar(50) DEFAULT NULL COMMENT '圖標',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', '作品分類', 'productCategorys', 'product_categorys', 'Y', '1', 'Y', 'list', 'Y', '11', '1', 'Y', null, '');
INSERT INTO `admin_menu` VALUES ('2', '作品內容', 'product', 'product', 'Y', '1', 'Y', 'list', 'Y', '11', '2', 'Y', null, null);
INSERT INTO `admin_menu` VALUES ('3', '關於我們', 'about', 'about', 'Y', '0', 'Y', 'edit', 'Y', '10', '1', 'Y', '1', null);
INSERT INTO `admin_menu` VALUES ('4', '網站基本設定', 'webData', 'web_data', 'Y', '3', 'N', 'edit', 'Y', '14', '1', 'Y', '1', null);
INSERT INTO `admin_menu` VALUES ('5', '管理者資訊', 'admin', 'admin_account', 'Y', '3', 'N', 'list', 'Y', '14', '2', 'Y', null, null);
INSERT INTO `admin_menu` VALUES ('6', '首頁上版輪播', 'indexBanner', 'index_banner', 'Y', '0', 'N', 'list', 'Y', '10', '2', 'Y', null, null);
INSERT INTO `admin_menu` VALUES ('8', '線上諮詢管理', 'contact', 'contact', 'Y', '2', 'N', 'list', 'Y', '13', '1', 'Y', null, null);
INSERT INTO `admin_menu` VALUES ('9', '最新消息', 'news', 'news', 'Y', '0', 'Y', 'list', 'Y', '10', '5', 'Y', null, null);
INSERT INTO `admin_menu` VALUES ('10', '訊息管理', null, null, 'Y', null, 'N', null, 'Y', '0', '1', 'Y', null, 'fa-pencil');
INSERT INTO `admin_menu` VALUES ('11', '產品與型錄', null, null, 'Y', null, 'N', null, 'Y', '0', '2', 'Y', null, 'fa-table');
INSERT INTO `admin_menu` VALUES ('13', '線上諮詢', null, null, 'Y', null, 'N', null, 'Y', '0', '4', 'Y', null, 'fa-table');
INSERT INTO `admin_menu` VALUES ('14', '系統資訊', null, null, 'Y', null, 'N', null, 'Y', '0', '5', 'Y', null, 'fa-wrench');
INSERT INTO `admin_menu` VALUES ('20', '型錄', 'Catalog', 'catalog', 'Y', '1', 'N', 'list', 'Y', '11', '3', 'Y', null, null);
INSERT INTO `admin_menu` VALUES ('21', 'SMTP設定', 'smtp', 'smtp_data', 'Y', '3', 'N', 'edit', 'Y', '14', '3', 'Y', '1', null);
INSERT INTO `admin_menu` VALUES ('22', '最新消息分類', 'newsCategorys', 'news_categorys', 'Y', '0', 'Y', 'list', 'Y', '10', '4', 'Y', null, null);

-- ----------------------------
-- Table structure for catalog
-- ----------------------------
DROP TABLE IF EXISTS `catalog`;
CREATE TABLE `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(150) DEFAULT NULL COMMENT '型錄名稱',
  `files` varchar(255) DEFAULT NULL COMMENT '型錄檔案',
  `pic` text COMMENT '型錄圖片',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of catalog
-- ----------------------------

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `phone` varchar(30) DEFAULT NULL COMMENT 'TEL',
  `company` varchar(30) DEFAULT NULL COMMENT '公司名稱',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email',
  `notes` text COMMENT '訊息內容',
  `status` char(1) NOT NULL DEFAULT 'N' COMMENT '處理狀態',
  `date` datetime DEFAULT NULL COMMENT '諮詢日期',
  `lang` varchar(2) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '顯示語系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact
-- ----------------------------

-- ----------------------------
-- Table structure for design
-- ----------------------------
DROP TABLE IF EXISTS `design`;
CREATE TABLE `design` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(50) DEFAULT NULL COMMENT '名稱',
  `notes` text COMMENT '敘述',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `pic` text COMMENT '圖片',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of design
-- ----------------------------
INSERT INTO `design` VALUES ('7', '1497966160', 'tw', '住宅空間設計', '專屬新銳設計師為世紀菁英量身訂做豪宅格局\r\nJD建築的創立始於Join 整合、Just Design專注設計、Job Sharing分工合作，這是我們的精神與理念。', 'Y', '0', '2017-06-20 13:42:40', '1706201342390.jpg,', ' §');
INSERT INTO `design` VALUES ('8', '1497966180', 'tw', '商辦空間設計', '專屬新銳設計師為世紀菁英量身訂做豪宅格局\r\nJD建築的創立始於Join 整合、Just Design專注設計、Job Sharing分工合作，這是我們的精神與理念。', 'Y', '0', '2017-06-20 13:43:00', '1706201342580.jpg,', ' §');
INSERT INTO `design` VALUES ('9', '1497966216', 'tw', '辦公空間設計', '專屬新銳設計師為世紀菁英量身訂做豪宅格局\r\nJD建築的創立始於Join 整合、Just Design專注設計、Job Sharing分工合作，這是我們的精神與理念。', 'Y', '0', '2017-06-20 13:43:36', '1706201343290.jpg,', ' §');

-- ----------------------------
-- Table structure for fare
-- ----------------------------
DROP TABLE IF EXISTS `fare`;
CREATE TABLE `fare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `price` int(30) DEFAULT NULL COMMENT '運費',
  `free` int(30) DEFAULT NULL COMMENT '滿額免運',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of fare
-- ----------------------------
INSERT INTO `fare` VALUES ('1', '1', '', '100', '1200', 'Y');
INSERT INTO `fare` VALUES ('2', '1', 'tw', null, null, 'Y');

-- ----------------------------
-- Table structure for index_banner
-- ----------------------------
DROP TABLE IF EXISTS `index_banner`;
CREATE TABLE `index_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(100) DEFAULT NULL COMMENT '輪播圖標題',
  `pic` varchar(255) DEFAULT NULL COMMENT '輪播圖',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `pic_alt` text,
  `link` varchar(255) DEFAULT NULL COMMENT '相關連結',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of index_banner
-- ----------------------------

-- ----------------------------
-- Table structure for language
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '語系',
  `codes` varchar(10) DEFAULT NULL COMMENT '語系代碼',
  `status` char(1) DEFAULT 'N' COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '日期',
  `guid` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES ('1', 'English', 'en', 'Y', '2', '2016-12-07 09:26:23', '001');
INSERT INTO `language` VALUES ('3', '中文', 'tw', 'Y', '1', '2016-04-11 09:46:38', '002');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '帳號',
  `passwd` varchar(100) DEFAULT NULL COMMENT '密碼',
  `name` varchar(100) DEFAULT NULL COMMENT '真實姓名',
  `company` varchar(100) DEFAULT NULL COMMENT '公司名稱',
  `phone` varchar(50) DEFAULT NULL COMMENT '連絡電話/t/n',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手機號碼/t/n',
  `zip` varchar(10) DEFAULT '' COMMENT '郵遞區號/tn/r',
  `city` varchar(30) DEFAULT '' COMMENT '縣市/city/n/tc_taiwan_city/0/0',
  `district` varchar(30) DEFAULT '' COMMENT '區域/dis/n/tc_taiwan_city/0/0',
  `address` varchar(255) DEFAULT '' COMMENT '地址/tn/n',
  `date` datetime DEFAULT NULL COMMENT '加入日期',
  `login_date` datetime DEFAULT NULL COMMENT '登入時間/d/f',
  `ip` varchar(30) DEFAULT NULL COMMENT 'IP位置/t/n',
  `user_from` varchar(4) DEFAULT 'web' COMMENT '來源',
  `status` char(1) CHARACTER SET utf8mb4 DEFAULT 'N' COMMENT '狀態',
  `bonus` int(11) DEFAULT '0' COMMENT '紅利',
  `mail_key` varchar(255) DEFAULT NULL COMMENT 'mail驗證編碼',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('2', 'ranmas2010@kimo.com', 'dc483e80a7a0bd9ef71d8cf973673924', '121212', null, '1313131', '662457385', '110', '基隆市', '信義區', '1313113', '2017-08-21 03:19:03', '0000-00-00 00:00:00', '', 'web', 'Y', '0', 'cmFubWFzMjAxMEBraW1vLmNvbV8yMDE3LTA4LTIxIDAzOjE5OjAz');
INSERT INTO `member` VALUES ('3', '', '', '', '', '', '', '', '', '', '', '2017-09-20 15:25:42', '0000-00-00 00:00:00', '', 'web', 'N', '0', '');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(150) DEFAULT NULL COMMENT '標題',
  `category` varchar(50) DEFAULT NULL COMMENT '所屬分類',
  `notes` text COMMENT '摘要',
  `description` text COMMENT '詳細內容',
  `pic` text COMMENT '圖片',
  `seo_title` varchar(100) DEFAULT NULL COMMENT 'SEO標題',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `index_view` char(1) DEFAULT 'N' COMMENT '首頁顯示',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `date` datetime DEFAULT NULL COMMENT '日期',
  `pic_alt` text,
  `views` int(11) DEFAULT '0' COMMENT '觀看數量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('5', '1501678406', 'tw', '美味漢堡', '1501677911', '有一間遠近馳名的漢堡店，漢堡的美味擄獲了男女老少的味蕾。不僅有五花八門的口味，還可以根據客人喜好，搭配出有個人特色的美味漢堡。', '有一間遠近馳名的漢堡店，漢堡的美味擄獲了男女老少的味蕾。不僅有五花八門的口味，還可以根據客人喜好，搭配出有個人特色的美味漢堡。<br />\n<br />\n但是，好吃的漢堡店總是大排長龍，如果想要快點買到美味漢堡，就必須早點排隊點餐或是選擇今日主廚推薦的特餐，才有機會早點把美味漢堡帶回家，跟親朋好友一起享用。<iframe allowfullscreen=\"\" frameborder=\"0\" src=\"https://www.youtube.com/embed/D4z3nXY_crs\" width=\"100%\" height=\"450px\"></iframe>', '1708021253140.jpg,', '美味漢堡', '', '', 'Y', 'Y', '2017-08-02 00:00:00', ' §', '0');

-- ----------------------------
-- Table structure for news_categorys
-- ----------------------------
DROP TABLE IF EXISTS `news_categorys`;
CREATE TABLE `news_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(50) DEFAULT NULL COMMENT '分類名稱',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `seo_title` varchar(100) DEFAULT NULL COMMENT 'SEO標題',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `pic` text COMMENT 'Banner圖片',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of news_categorys
-- ----------------------------
INSERT INTO `news_categorys` VALUES ('11', '1501677911', 'tw', '最新消息', 'Y', '1', '2017-08-02 12:45:11', '最新消息', '', '', '', '');
INSERT INTO `news_categorys` VALUES ('12', '1501677911', 'en', 'News', 'Y', '1', '2017-08-02 12:45:11', 'News', '', '', '', '');
INSERT INTO `news_categorys` VALUES ('13', '1501677931', 'tw', '活動公告', 'Y', '2', '2017-08-02 12:45:31', '活動公告', '', '', '', '');
INSERT INTO `news_categorys` VALUES ('14', '1501677931', 'en', 'Events', 'Y', '2', '2017-08-02 12:45:31', 'Events', '', '', '', '');

-- ----------------------------
-- Table structure for order_data
-- ----------------------------
DROP TABLE IF EXISTS `order_data`;
CREATE TABLE `order_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) DEFAULT 'tw' COMMENT '語系',
  `or_no` varchar(20) DEFAULT NULL COMMENT '訂單編號',
  `company` varchar(30) DEFAULT NULL COMMENT '公司名',
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `zip` varchar(10) DEFAULT '' COMMENT '郵遞區號',
  `city` varchar(30) DEFAULT '' COMMENT '縣市',
  `district` varchar(30) DEFAULT '' COMMENT '區域',
  `address` varchar(255) DEFAULT '' COMMENT '地址/tn/n',
  `guid` varchar(64) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL COMMENT 'E-mail',
  `phone` varchar(50) DEFAULT NULL COMMENT '聯絡電話',
  `mobile` varchar(50) DEFAULT NULL COMMENT '行動電話',
  `notes` text COMMENT '備註說明',
  `member_id` int(11) DEFAULT NULL COMMENT '會員訂單',
  `date` datetime DEFAULT NULL COMMENT '訂單日期',
  `status` char(1) CHARACTER SET utf8mb4 DEFAULT 'N' COMMENT '訂單狀態',
  `product_price` varchar(20) DEFAULT NULL COMMENT '商品金額',
  `fare_price` varchar(20) DEFAULT NULL COMMENT '運費',
  `total_price` varchar(20) DEFAULT NULL COMMENT '總金額',
  `total_qty` varchar(20) DEFAULT NULL COMMENT '訂購總數量',
  `payType` varchar(10) DEFAULT NULL COMMENT '付款方式',
  `shopList` varchar(255) DEFAULT NULL COMMENT '購買商品列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_data
-- ----------------------------

-- ----------------------------
-- Table structure for order_pay_data
-- ----------------------------
DROP TABLE IF EXISTS `order_pay_data`;
CREATE TABLE `order_pay_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MerchantID` varchar(10) DEFAULT NULL,
  `MerchantTradeNo` varchar(20) DEFAULT NULL,
  `PaymentDate` varchar(20) DEFAULT NULL,
  `PaymentType` varchar(30) DEFAULT NULL,
  `PaymentTypeChargeFee` varchar(30) DEFAULT NULL,
  `RtnCode` varchar(20) DEFAULT NULL,
  `RtnMsg` varchar(200) DEFAULT NULL,
  `SimulatePaid` varchar(50) DEFAULT NULL,
  `TradeAmt` varchar(50) DEFAULT NULL,
  `TradeDate` varchar(20) DEFAULT NULL,
  `TradeNo` varchar(20) DEFAULT NULL,
  `PeriodType` varchar(1) DEFAULT NULL,
  `Frequency` varchar(20) DEFAULT NULL,
  `ExecTimes` varchar(20) DEFAULT NULL,
  `Amount` varchar(20) DEFAULT NULL,
  `Gwsr` varchar(20) DEFAULT NULL,
  `ProcessDate` varchar(20) DEFAULT NULL,
  `AuthCode` varchar(6) DEFAULT NULL,
  `FirstAuthAmount` varchar(20) DEFAULT NULL,
  `TotalSuccessTimes` varchar(20) DEFAULT NULL,
  `CheckMacValue` text COMMENT '檢查碼',
  `codeView` text COMMENT '顯示結果用',
  `BankCode` varchar(10) DEFAULT NULL,
  `vAccount` varchar(20) DEFAULT NULL,
  `ExpireDate` varchar(20) DEFAULT NULL,
  `PaymentNo` varchar(20) DEFAULT NULL,
  `Barcode1` varchar(30) DEFAULT NULL,
  `Barcode2` varchar(30) DEFAULT NULL,
  `Barcode3` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_pay_data
-- ----------------------------
INSERT INTO `order_pay_data` VALUES ('2', '2000132', 'A170920151307', '2017/09/20 23:13:48', 'Credit_CreditCard', '1', '1', 'Succeeded', '', '9990', '2017/09/20 23:13:07', '1709202313074601', '', '', '', '', '', '', '', '', '', '821C6E187545E8B826F482459D5470A1', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for order_spec
-- ----------------------------
DROP TABLE IF EXISTS `order_spec`;
CREATE TABLE `order_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `ouid` varchar(64) DEFAULT NULL COMMENT '主檔ID',
  `puid` varchar(64) DEFAULT NULL COMMENT '商品ID',
  `suid` varchar(64) DEFAULT NULL COMMENT '規格ID',
  `qty` varchar(20) DEFAULT NULL COMMENT '訂購數量',
  `title` varchar(150) DEFAULT NULL COMMENT '商品名',
  `spec_title` varchar(150) DEFAULT NULL COMMENT '規格名',
  `price` varchar(20) DEFAULT NULL COMMENT '商品單價',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_spec
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(150) DEFAULT NULL COMMENT '作品名稱',
  `category` int(255) DEFAULT NULL COMMENT '所屬分類',
  `notes` text COMMENT '簡述',
  `description` text COMMENT '詳細說明',
  `price` varchar(20) DEFAULT NULL COMMENT '建議售價',
  `pic` text COMMENT '作品圖片',
  `seo_title` varchar(100) DEFAULT NULL COMMENT 'SEO標題',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `pic_alt` text,
  `inventory` int(11) DEFAULT NULL COMMENT '庫存量',
  `safe_inventory` int(11) DEFAULT NULL COMMENT '安全庫存量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '1501045835', 'tw', '黑羊與白羊', '1501041963', '黑羊與白羊', '黑羊與白羊', '999', '1707261515400.jpg,1707261515405.jpg,1707261515404.jpg,1707261515402.jpg,1707261515401.jpg,1707261515406.jpg,', '黑羊與白羊', '', '', 'Y', '0', '2017-07-26 05:10:35', ' § § § § § §', '100', '90');

-- ----------------------------
-- Table structure for product_categorys
-- ----------------------------
DROP TABLE IF EXISTS `product_categorys`;
CREATE TABLE `product_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(50) DEFAULT NULL COMMENT '分類名稱',
  `category` int(11) DEFAULT '0' COMMENT '所屬分類',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `seo_title` varchar(100) DEFAULT NULL COMMENT 'SEO標題',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `pic` text COMMENT 'Banner圖片',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of product_categorys
-- ----------------------------
INSERT INTO `product_categorys` VALUES ('1', '1501035590', 'tw', '寶島桌遊作品', '0', 'Y', '1', '2017-07-26 02:19:50', '寶島桌遊作品', '', '', '1707260457350.jpg,', ' §');
INSERT INTO `product_categorys` VALUES ('2', '1501035590', 'en', '寶島桌遊作品', '0', 'Y', '1', '2017-07-26 02:19:50', '寶島桌遊作品', '', '', '1707260457350.jpg,', ' §');
INSERT INTO `product_categorys` VALUES ('3', '1501035767', 'tw', '莫仔桌遊作品', '0', 'Y', '2', '2017-07-26 02:22:47', '莫仔桌遊作品', '莫仔桌遊作品', '莫仔桌遊作品', null, null);
INSERT INTO `product_categorys` VALUES ('5', '1501041911', 'tw', '益智類', '1501035590', 'Y', '0', '2017-07-26 04:05:11', '益智類', '益智類', '益智類', null, null);
INSERT INTO `product_categorys` VALUES ('6', '1501041926', 'tw', '搞笑類', '1501035590', 'Y', '0', '2017-07-26 04:05:26', '搞笑類', '搞笑類', '搞笑類', null, null);
INSERT INTO `product_categorys` VALUES ('7', '1501041949', 'tw', '多人遊戲', '1501035767', 'Y', '0', '2017-07-26 04:05:49', '多人遊戲', '多人遊戲', '多人遊戲', null, null);
INSERT INTO `product_categorys` VALUES ('8', '1501041963', 'tw', '雙人PK', '1501035767', 'Y', '0', '2017-07-26 04:06:03', '雙人PK', '雙人PK', '雙人PK', null, null);
INSERT INTO `product_categorys` VALUES ('9', '1501079427', 'tw', 'PK類', '1501035590', 'Y', '0', '2017-07-26 14:30:27', 'PK類', '', '', '', '');
INSERT INTO `product_categorys` VALUES ('10', '1501079523', 'tw', '探險類', '1501035590', 'Y', '0', '2017-07-26 14:32:03', '探險類', '探險類', '探險類', '', '');

-- ----------------------------
-- Table structure for recruit
-- ----------------------------
DROP TABLE IF EXISTS `recruit`;
CREATE TABLE `recruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(50) DEFAULT NULL COMMENT '工作職稱',
  `notes` text COMMENT '工作條件',
  `pay` varchar(50) DEFAULT NULL COMMENT '工作待遇',
  `welfare` varchar(255) DEFAULT NULL COMMENT '福利制度',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of recruit
-- ----------------------------
INSERT INTO `recruit` VALUES ('1', '1497927589', 'tw', '執行業務', '(1)3年以上熟CAD作業\r\n(2)手繪透視或3D能力\r\n(3)能獨立作業\r\n(4)應徵人員：請先電話預約，攜完整履歷、自傳、証照、作品集(本公司將對應徵人員保密處理)', '面議', '享三節禮金、年終獎金、個案獎金、生日禮金、國內外旅遊等。', 'Y', '3', '2017-06-20 02:59:49');
INSERT INTO `recruit` VALUES ('2', '1497927611', 'tw', '設計助理', '(1)3年以上熟CAD作業\r\n(2)手繪透視或3D能力\r\n(3)能獨立作業\r\n(4)應徵人員：請先電話預約，攜完整履歷、自傳、証照、作品集(本公司將對應徵人員保密處理)', '面議', '享三節禮金、年終獎金、個案獎金、生日禮金、國內外旅遊等。', 'Y', '2', '2017-06-20 03:00:11');
INSERT INTO `recruit` VALUES ('3', '1497927634', 'tw', '設計師', '(1)3年以上熟CAD作業\r\n(2)手繪透視或3D能力\r\n(3)能獨立作業\r\n(4)應徵人員：請先電話預約，攜完整履歷、自傳、証照、作品集(本公司將對應徵人員保密處理)', '面議', '享三節禮金、年終獎金、個案獎金、生日禮金、國內外旅遊等。', 'Y', '1', '2017-06-20 03:00:34');

-- ----------------------------
-- Table structure for recruit_banner
-- ----------------------------
DROP TABLE IF EXISTS `recruit_banner`;
CREATE TABLE `recruit_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  `pic` text COMMENT '圖片',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of recruit_banner
-- ----------------------------
INSERT INTO `recruit_banner` VALUES ('1', '1', 'tw', '人才招募', '人才招募', '2017-06-20 03:10:17', '1706200309571.jpg,1706200309570.jpg,1706200309572.jpg,', ' § § §');

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(50) DEFAULT NULL COMMENT '流程名稱',
  `notes` text COMMENT '敘述',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of service
-- ----------------------------
INSERT INTO `service` VALUES ('1', '1497923948', 'tw', '初步溝通', '了解空間現況、業主需求及裝修預算、公司作品簡介、解說設計服務流程及收費方式、預約現場勘察討論。', 'Y', '1', '2017-06-20 01:59:08');
INSERT INTO `service` VALUES ('2', '1497923961', 'tw', '現場丈量', '現場實際丈量、拍照紀錄、現況分析。', 'Y', '2', '2017-06-20 01:59:21');
INSERT INTO `service` VALUES ('3', '1497923974', 'tw', '設計提案', '平面規劃配置討論及確認、設計風格提案討論簡報、簽定設計合約書。', 'Y', '3', '2017-06-20 01:59:34');
INSERT INTO `service` VALUES ('4', '1497923986', 'tw', '空間立面討論', '細部設計討論、色彩計畫、表材挑選定案。', 'Y', '4', '2017-06-20 01:59:46');
INSERT INTO `service` VALUES ('5', '1497923996', 'tw', '施工圖繪製', '施工細部討論、細部尺寸標註、圖面材質標示、空白估價標單。完成圖面完成交付業主。', 'Y', '5', '2017-06-20 01:59:56');
INSERT INTO `service` VALUES ('6', '1497924006', 'tw', ' 工程', '工程委託、工程施作、完工驗收、工程結案驗收交屋、客戶定期追蹤問候及修繕保固。', 'Y', '6', '2017-06-20 02:00:06');

-- ----------------------------
-- Table structure for smtp_data
-- ----------------------------
DROP TABLE IF EXISTS `smtp_data`;
CREATE TABLE `smtp_data` (
  `id` int(11) NOT NULL,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) CHARACTER SET utf8mb4 DEFAULT 'tw' COMMENT '顯示語系',
  `host` varchar(20) DEFAULT NULL COMMENT '主機HOST',
  `port` varchar(20) DEFAULT NULL COMMENT '發信PORT',
  `smtp_auth` char(1) DEFAULT NULL COMMENT '是否有smtp SLL認證',
  `username` varchar(20) DEFAULT NULL COMMENT '信件帳號',
  `password` varchar(20) DEFAULT NULL COMMENT '信件密碼',
  `form_email` varchar(255) DEFAULT NULL COMMENT '來源Email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of smtp_data
-- ----------------------------
INSERT INTO `smtp_data` VALUES ('1', '1', 'tw', 'smtp.gmail.com', '465', 'Y', 'dnaile0520@gmail.com', 'tupehpeanrclqqhy', 'dnaile0520@gmail.com');

-- ----------------------------
-- Table structure for taiwan_city
-- ----------------------------
DROP TABLE IF EXISTS `taiwan_city`;
CREATE TABLE `taiwan_city` (
  `zip` varchar(10) DEFAULT '0',
  `city` varchar(20) DEFAULT '',
  `district` varchar(20) DEFAULT '',
  `id` varchar(4) DEFAULT NULL,
  `other` char(1) DEFAULT '0',
  `sortIndex` int(11) DEFAULT '0',
  `lay` char(1) DEFAULT NULL COMMENT '區域',
  `cls` int(1) DEFAULT NULL COMMENT '台灣省1/中國大陸2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taiwan_city
-- ----------------------------
INSERT INTO `taiwan_city` VALUES ('100', '台北市', '中正區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('103', '台北市', '大同區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('104', '台北市', '中山區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('105', '台北市', '松山區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('106', '台北市', '大安區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('108', '台北市', '萬華區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('110', '台北市', '信義區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('111', '台北市', '士林區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('112', '台北市', '北投區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('114', '台北市', '內湖區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('115', '台北市', '南港區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('116', '台北市', '文山區', '02', '0', '1', '1', '1');
INSERT INTO `taiwan_city` VALUES ('200', '基隆市', '仁愛區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('201', '基隆市', '信義區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('202', '基隆市', '中正區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('203', '基隆市', '中山區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('204', '基隆市', '安樂區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('205', '基隆市', '暖暖區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('206', '基隆市', '七堵區', '01', '0', '0', '1', '1');
INSERT INTO `taiwan_city` VALUES ('207', '新北市', '萬里區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('208', '新北市', '金山區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('209', '連江縣', '南竿鄉', '25', '1', '21', '5', '1');
INSERT INTO `taiwan_city` VALUES ('210', '連江縣', '北竿鄉', '25', '1', '21', '5', '1');
INSERT INTO `taiwan_city` VALUES ('211', '連江縣', '莒光鄉', '25', '1', '21', '5', '1');
INSERT INTO `taiwan_city` VALUES ('212', '連江縣', '東引鄉', '25', '1', '21', '5', '1');
INSERT INTO `taiwan_city` VALUES ('220', '新北市', '板橋區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('221', '新北市', '汐止區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('222', '新北市', '深坑區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('223', '新北市', '石碇區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('224', '新北市', '瑞芳區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('226', '新北市', '平溪區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('227', '新北市', '雙溪區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('228', '新北市', '貢寮區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('231', '新北市', '新店區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('232', '新北市', '坪林區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('233', '新北市', '烏來區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('234', '新北市', '永和區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('235', '新北市', '中和區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('236', '新北市', '土城區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('237', '新北市', '三峽區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('238', '新北市', '樹林區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('239', '新北市', '鶯歌區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('241', '新北市', '三重區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('242', '新北市', '新莊區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('243', '新北市', '泰山區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('244', '新北市', '林口區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('247', '新北市', '蘆洲區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('248', '新北市', '五股區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('249', '新北市', '八里區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('251', '新北市', '淡水區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('252', '新北市', '三芝區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('253', '新北市', '石門區', '03', '0', '2', '1', '1');
INSERT INTO `taiwan_city` VALUES ('260', '宜蘭縣', '宜蘭市', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('261', '宜蘭縣', '頭城鎮', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('262', '宜蘭縣', '礁溪鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('263', '宜蘭縣', '壯圍鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('264', '宜蘭縣', '員山鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('265', '宜蘭縣', '羅東鎮', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('266', '宜蘭縣', '三星鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('267', '宜蘭縣', '大同鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('268', '宜蘭縣', '五結鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('269', '宜蘭縣', '冬山鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('270', '宜蘭縣', '蘇澳鎮', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('272', '宜蘭縣', '南澳鄉', '22', '0', '18', '4', '1');
INSERT INTO `taiwan_city` VALUES ('300', '新竹市', '北區', '05', '0', '4', '1', '1');
INSERT INTO `taiwan_city` VALUES ('300', '新竹市', '東區', '05', '0', '4', '1', '1');
INSERT INTO `taiwan_city` VALUES ('300', '新竹市', '香山區', '05', '0', '4', '1', '1');
INSERT INTO `taiwan_city` VALUES ('302', '新竹縣', '竹北市', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('303', '新竹縣', '湖口鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('304', '新竹縣', '新豐鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('305', '新竹縣', '新埔鎮', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('306', '新竹縣', '關西鎮', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('307', '新竹縣', '芎林鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('308', '新竹縣', '寶山鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('310', '新竹縣', '竹東鎮', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('311', '新竹縣', '五峰鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('312', '新竹縣', '橫山鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('313', '新竹縣', '尖石鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('314', '新竹縣', '北埔鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('315', '新竹縣', '峨眉鄉', '06', '0', '5', '1', '1');
INSERT INTO `taiwan_city` VALUES ('320', '桃園市', '中壢區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('324', '桃園市', '平鎮區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('325', '桃園市', '龍潭區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('326', '桃園市', '楊梅區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('327', '桃園市', '新屋區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('328', '桃園市', '觀音區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('330', '桃園市', '桃園區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('333', '桃園市', '龜山區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('334', '桃園市', '八德區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('335', '桃園市', '大溪區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('336', '桃園市', '復興區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('337', '桃園市', '大園區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('338', '桃園市', '蘆竹區', '04', '0', '3', '1', '1');
INSERT INTO `taiwan_city` VALUES ('350', '苗栗縣', '竹南鎮', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('351', '苗栗縣', '頭份鎮', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('352', '苗栗縣', '三灣鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('353', '苗栗縣', '南庄鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('354', '苗栗縣', '獅潭鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('356', '苗栗縣', '後龍鎮', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('357', '苗栗縣', '通霄鎮', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('358', '苗栗縣', '苑裡鎮', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('360', '苗栗縣', '苗栗市', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('361', '苗栗縣', '造橋鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('362', '苗栗縣', '頭屋鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('363', '苗栗縣', '公館鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('364', '苗栗縣', '大湖鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('365', '苗栗縣', '泰安鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('366', '苗栗縣', '銅鑼鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('367', '苗栗縣', '三義鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('368', '苗栗縣', '西湖鄉', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('369', '苗栗縣', '卓蘭鎮', '07', '0', '6', '1', '1');
INSERT INTO `taiwan_city` VALUES ('400', '台中市', '中區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('401', '台中市', '東區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('402', '台中市', '南區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('403', '台中市', '西區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('404', '台中市', '北區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('406', '台中市', '北屯區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('407', '台中市', '西屯區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('408', '台中市', '南屯區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('411', '台中市', '太平區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('412', '台中市', '大里區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('413', '台中市', '霧峰區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('414', '台中市', '烏日區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('420', '台中市', '豐原區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('421', '台中市', '后里區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('422', '台中市', '石岡區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('423', '台中市', '東勢區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('424', '台中市', '和平區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('426', '台中市', '新社區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('427', '台中市', '潭子區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('428', '台中市', '大雅區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('429', '台中市', '神岡區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('432', '台中市', '大肚區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('433', '台中市', '沙鹿區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('434', '台中市', '龍井區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('435', '台中市', '梧棲區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('436', '台中市', '清水區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('437', '台中市', '大甲區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('438', '台中市', '外埔區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('439', '台中市', '大安區', '08', '0', '7', '2', '1');
INSERT INTO `taiwan_city` VALUES ('500', '彰化縣', '彰化市', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('502', '彰化縣', '芬園鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('503', '彰化縣', '花壇鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('504', '彰化縣', '秀水鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('505', '彰化縣', '鹿港鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('506', '彰化縣', '福興鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('507', '彰化縣', '線西鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('508', '彰化縣', '和美鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('509', '彰化縣', '伸港鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('510', '彰化縣', '員林鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('511', '彰化縣', '社頭鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('512', '彰化縣', '永靖鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('513', '彰化縣', '埔心鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('514', '彰化縣', '溪湖鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('515', '彰化縣', '大村鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('516', '彰化縣', '埔鹽鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('520', '彰化縣', '田中鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('521', '彰化縣', '北斗鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('522', '彰化縣', '田尾鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('523', '彰化縣', '埤頭鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('524', '彰化縣', '溪州鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('525', '彰化縣', '竹塘鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('526', '彰化縣', '二林鎮', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('527', '彰化縣', '大城鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('528', '彰化縣', '芳苑鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('530', '彰化縣', '二水鄉', '10', '0', '8', '2', '1');
INSERT INTO `taiwan_city` VALUES ('540', '南投縣', '南投市', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('541', '南投縣', '中寮鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('542', '南投縣', '草屯鎮', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('544', '南投縣', '國姓鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('545', '南投縣', '埔里鎮', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('546', '南投縣', '仁愛鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('551', '南投縣', '名間鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('552', '南投縣', '集集鎮', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('553', '南投縣', '水里鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('555', '南投縣', '魚池鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('556', '南投縣', '信義鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('557', '南投縣', '竹山鎮', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('558', '南投縣', '鹿谷鄉', '11', '0', '9', '2', '1');
INSERT INTO `taiwan_city` VALUES ('600', '嘉義市', '東區', '13', '0', '11', '2', '1');
INSERT INTO `taiwan_city` VALUES ('600', '嘉義市', '西區', '13', '0', '11', '2', '1');
INSERT INTO `taiwan_city` VALUES ('602', '嘉義縣', '番路鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('603', '嘉義縣', '梅山鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('604', '嘉義縣', '竹崎鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('605', '嘉義縣', '阿里山鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('606', '嘉義縣', '中埔鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('607', '嘉義縣', '大埔鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('608', '嘉義縣', '水上鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('611', '嘉義縣', '鹿草鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('612', '嘉義縣', '太保市', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('613', '嘉義縣', '朴子市', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('614', '嘉義縣', '東石鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('615', '嘉義縣', '六腳鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('616', '嘉義縣', '新港鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('621', '嘉義縣', '民雄鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('622', '嘉義縣', '大林鎮', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('623', '嘉義縣', '溪口鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('624', '嘉義縣', '義竹鄉', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('625', '嘉義縣', '布袋鎮', '14', '0', '12', '2', '1');
INSERT INTO `taiwan_city` VALUES ('630', '雲林縣', '斗南鎮', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('631', '雲林縣', '大埤鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('632', '雲林縣', '虎尾鎮', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('633', '雲林縣', '土庫鎮', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('634', '雲林縣', '褒忠鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('635', '雲林縣', '東勢鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('636', '雲林縣', '台西鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('637', '雲林縣', '崙背鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('638', '雲林縣', '麥寮鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('640', '雲林縣', '斗六市', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('643', '雲林縣', '林內鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('646', '雲林縣', '古坑鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('647', '雲林縣', '莿桐鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('648', '雲林縣', '西螺鎮', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('649', '雲林縣', '二崙鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('651', '雲林縣', '北港鎮', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('652', '雲林縣', '水林鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('653', '雲林縣', '口湖鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('654', '雲林縣', '四湖鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('655', '雲林縣', '元長鄉', '12', '0', '10', '2', '1');
INSERT INTO `taiwan_city` VALUES ('700', '台南市', '中西區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('701', '台南市', '東區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('702', '台南市', '南區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('704', '台南市', '北區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('708', '台南市', '安平區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('709', '台南市', '安南區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('710', '台南市', '永康區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('711', '台南市', '歸仁區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('712', '台南市', '新化區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('713', '台南市', '左鎮區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('714', '台南市', '玉井區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('715', '台南市', '楠西區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('716', '台南市', '南化區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('717', '台南市', '仁德區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('718', '台南市', '關廟區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('719', '台南市', '龍崎區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('720', '台南市', '官田區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('721', '台南市', '麻豆區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('722', '台南市', '佳里區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('723', '台南市', '西港區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('724', '台南市', '七股區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('725', '台南市', '將軍區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('726', '台南市', '學甲區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('727', '台南市', '北門區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('730', '台南市', '新營區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('731', '台南市', '後壁區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('732', '台南市', '白河區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('733', '台南市', '東山區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('734', '台南市', '六甲區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('735', '台南市', '下營區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('736', '台南市', '柳營區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('737', '台南市', '鹽水區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('741', '台南市', '善化區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('742', '台南市', '大內區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('743', '台南市', '山上區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('744', '台南市', '新市區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('745', '台南市', '安定區', '15', '0', '13', '3', '1');
INSERT INTO `taiwan_city` VALUES ('800', '高雄市', '新興區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('801', '高雄市', '前金區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('802', '高雄市', '苓雅區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('803', '高雄市', '鹽埕區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('804', '高雄市', '鼓山區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('805', '高雄市', '旗津區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('806', '高雄市', '前鎮區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('807', '高雄市', '三民區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('811', '高雄市', '楠梓區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('812', '高雄市', '小港區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('813', '高雄市', '左營區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('814', '高雄市', '仁武區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('815', '高雄市', '大社區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('820', '高雄市', '岡山區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('821', '高雄市', '路竹區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('822', '高雄市', '阿蓮區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('823', '高雄市', '田寮區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('824', '高雄市', '燕巢區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('825', '高雄市', '橋頭區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('826', '高雄市', '梓官區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('827', '高雄市', '彌陀區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('828', '高雄市', '永安區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('829', '高雄市', '湖內區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('830', '高雄市', '鳳山區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('831', '高雄市', '大寮區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('832', '高雄市', '林園區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('833', '高雄市', '鳥松區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('840', '高雄市', '大樹區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('842', '高雄市', '旗山區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('843', '高雄市', '美濃區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('844', '高雄市', '六龜區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('845', '高雄市', '內門區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('846', '高雄市', '杉林區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('847', '高雄市', '甲仙區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('848', '高雄市', '桃源區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('849', '高雄市', '那瑪夏區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('851', '高雄市', '茂林區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('852', '高雄市', '茄萣區', '17', '0', '14', '3', '1');
INSERT INTO `taiwan_city` VALUES ('880', '澎湖縣', '馬公市', '23', '1', '19', '5', '1');
INSERT INTO `taiwan_city` VALUES ('881', '澎湖縣', '西嶼鄉', '23', '1', '19', '5', '1');
INSERT INTO `taiwan_city` VALUES ('884', '澎湖縣', '白沙鄉', '23', '1', '19', '5', '1');
INSERT INTO `taiwan_city` VALUES ('885', '澎湖縣', '湖西鄉', '23', '1', '19', '5', '1');
INSERT INTO `taiwan_city` VALUES ('890', '金門縣', '金沙鎮', '24', '1', '20', '5', '1');
INSERT INTO `taiwan_city` VALUES ('891', '金門縣', '金湖鎮', '24', '1', '20', '5', '1');
INSERT INTO `taiwan_city` VALUES ('892', '金門縣', '金寧鄉', '24', '1', '20', '5', '1');
INSERT INTO `taiwan_city` VALUES ('893', '金門縣', '金城鎮', '24', '1', '20', '5', '1');
INSERT INTO `taiwan_city` VALUES ('894', '金門縣', '烈嶼鄉', '24', '1', '20', '5', '1');
INSERT INTO `taiwan_city` VALUES ('900', '屏東縣', '屏東市', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('901', '屏東縣', '三地門鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('902', '屏東縣', '霧台鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('903', '屏東縣', '瑪家鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('904', '屏東縣', '九如鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('905', '屏東縣', '里港鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('906', '屏東縣', '高樹鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('907', '屏東縣', '鹽埔鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('908', '屏東縣', '長治鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('909', '屏東縣', '麟洛鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('911', '屏東縣', '竹田鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('912', '屏東縣', '內埔鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('913', '屏東縣', '萬丹鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('920', '屏東縣', '潮州鎮', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('921', '屏東縣', '泰武鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('922', '屏東縣', '來義鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('923', '屏東縣', '萬巒鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('924', '屏東縣', '崁頂鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('925', '屏東縣', '新埤鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('926', '屏東縣', '南州鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('927', '屏東縣', '林邊鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('928', '屏東縣', '東港鎮', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('929', '屏東縣', '琉球鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('931', '屏東縣', '佳冬鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('932', '屏東縣', '新園鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('940', '屏東縣', '枋寮鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('941', '屏東縣', '枋山鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('942', '屏東縣', '春日鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('943', '屏東縣', '獅子鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('944', '屏東縣', '車城鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('945', '屏東縣', '牡丹鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('946', '屏東縣', '恆春鎮', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('947', '屏東縣', '滿州鄉', '19', '0', '15', '3', '1');
INSERT INTO `taiwan_city` VALUES ('950', '台東縣', '台東市', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('951', '台東縣', '綠島鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('953', '台東縣', '延平鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('954', '台東縣', '卑南鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('955', '台東縣', '鹿野鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('956', '台東縣', '關山鎮', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('957', '台東縣', '海端鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('958', '台東縣', '池上鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('959', '台東縣', '東河鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('961', '台東縣', '成功鎮', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('962', '台東縣', '長濱鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('963', '台東縣', '太麻里鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('964', '台東縣', '金峰鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('965', '台東縣', '大武鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('966', '台東縣', '達仁鄉', '20', '0', '16', '4', '1');
INSERT INTO `taiwan_city` VALUES ('970', '花蓮縣', '花蓮市', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('971', '花蓮縣', '新城鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('972', '花蓮縣', '秀林鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('973', '花蓮縣', '吉安鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('974', '花蓮縣', '壽豐鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('975', '花蓮縣', '鳳林鎮', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('976', '花蓮縣', '光復鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('977', '花蓮縣', '豐濱鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('978', '花蓮縣', '瑞穗鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('979', '花蓮縣', '萬榮鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('981', '花蓮縣', '玉里鎮', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('982', '花蓮縣', '卓溪鄉', '21', '0', '17', '4', '1');
INSERT INTO `taiwan_city` VALUES ('983', '花蓮縣', '富里鄉', '21', '0', '17', '4', '1');

-- ----------------------------
-- Table structure for team
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(50) DEFAULT NULL COMMENT '姓名',
  `job` varchar(50) DEFAULT NULL COMMENT '工作職稱',
  `notes` text COMMENT '敘述',
  `status` char(1) DEFAULT NULL COMMENT '狀態',
  `sortIndex` int(11) DEFAULT '0' COMMENT '排序',
  `date` datetime DEFAULT NULL COMMENT '建檔日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of team
-- ----------------------------
INSERT INTO `team` VALUES ('1', '1497926090', 'tw', '紀怡安An', '設計總監・監工・專案設計', 'Fashion Institute of Design & Merchandising(FIDM)\r\n三本空間編輯 3年', 'Y', '1', '2017-06-20 02:34:50');
INSERT INTO `team` VALUES ('2', '1497926102', 'tw', '鐘雅淳', '設計助理・監工', '中台科技大學護理系旭程龍設計工作室 7個月', 'Y', '2', '2017-06-20 02:35:02');
INSERT INTO `team` VALUES ('3', '1497926130', 'tw', '王芊文', '設計總監・人資管理', '淡江大徐建築學系\r\n大雄設計 5年', 'Y', '3', '2017-06-20 02:35:30');
INSERT INTO `team` VALUES ('4', '1497926142', 'tw', '陳麗婷', '設計總監・財務', '樹德科技大學室內設計\r\n立本設計 8年', 'Y', '4', '2017-06-20 02:35:42');

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES ('1', 'aaaaa');

-- ----------------------------
-- Table structure for web_data
-- ----------------------------
DROP TABLE IF EXISTS `web_data`;
CREATE TABLE `web_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(64) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL COMMENT '顯示語系',
  `title` varchar(100) DEFAULT NULL COMMENT '網站名稱',
  `phone` varchar(50) DEFAULT NULL COMMENT '連絡電話',
  `fax` varchar(50) DEFAULT NULL COMMENT '傳真電話',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `email` varchar(255) DEFAULT NULL COMMENT '客服信箱',
  `get_email` varchar(255) DEFAULT NULL COMMENT '收件信箱',
  `seo_title` varchar(100) DEFAULT NULL COMMENT 'SEO標題',
  `seo_keywords` text COMMENT 'SEO關鍵字',
  `seo_description` text COMMENT 'SEO敘述',
  `footer_info` text COMMENT '頁底資訊',
  `contact_info` text COMMENT '聯絡我們資訊',
  `ga_code` varchar(20) DEFAULT NULL COMMENT 'Google Analytics ID',
  `pic` text COMMENT '頁底QRCODE',
  `pic_alt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of web_data
-- ----------------------------
INSERT INTO `web_data` VALUES ('1', '1', 'tw', '莫仔桌遊|MOZI Games', '0933 566 944', '', '台中市霧峰區信義路19-4號', 'mozigame@gmail.com', 'mozigame@gmail.com', '莫仔桌遊|MOZI Games', '桌遊,創作', 'ＭＯＺＩＧＡＭＥ的前身是莫仔羊創意工作室，一直以來都是以自娛娛人的設計方式將不同的歡樂帶給有需要的人，直到2011年莫仔羊第一次接觸到桌上遊戲，被那種人與人相聚才能進行的遊戲模式深深吸引，於是決定投身著上遊戲的設計與制作，希望有一天也能做出讓大家都滿意的遊戲，為身邊的朋友帶來歡樂。', '', '', '', '', '');
