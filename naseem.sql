/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : nasim

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-11-01 16:12:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ym_admins
-- ----------------------------
DROP TABLE IF EXISTS `ym_admins`;
CREATE TABLE `ym_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'پست الکترونیک',
  `role_id` int(11) unsigned NOT NULL COMMENT 'نقش',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  CONSTRAINT `ym_admins_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ym_admin_roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_admins
-- ----------------------------
INSERT INTO `ym_admins` VALUES ('1', 'rahbod', '$2a$12$92HG95rnUS5MYLFvDjn2cOU4O4p64mpH9QnxFYzVnk9CjQIPrcTBC', 'gharagozlu.masoud@gmial.com', '1');

-- ----------------------------
-- Table structure for ym_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `ym_admin_roles`;
CREATE TABLE `ym_admin_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'عنوان نقش',
  `role` varchar(255) NOT NULL COMMENT 'نقش',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_admin_roles
-- ----------------------------
INSERT INTO `ym_admin_roles` VALUES ('1', 'Super Admin', 'superAdmin');
INSERT INTO `ym_admin_roles` VALUES ('2', 'مدیریت', 'admin');

-- ----------------------------
-- Table structure for ym_admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `ym_admin_role_permissions`;
CREATE TABLE `ym_admin_role_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'شناسه',
  `role_id` int(10) unsigned DEFAULT NULL COMMENT 'نقش',
  `module_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ماژول',
  `controller_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'کنترلر',
  `actions` text CHARACTER SET utf8 COMMENT 'اکشن ها',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `ym_admin_role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ym_admin_roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1081 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_admin_role_permissions
-- ----------------------------
INSERT INTO `ym_admin_role_permissions` VALUES ('1069', '2', 'base', 'TagsController', 'index,create,update,admin,delete,list');
INSERT INTO `ym_admin_role_permissions` VALUES ('1070', '2', 'admins', 'AdminsDashboardController', 'index');
INSERT INTO `ym_admin_role_permissions` VALUES ('1071', '2', 'admins', 'AdminsManageController', 'index,views,create,update,admin,sessions,removeSession,changePass,delete');
INSERT INTO `ym_admin_role_permissions` VALUES ('1072', '2', 'admins', 'AdminsRolesController', 'create,update,admin,delete');
INSERT INTO `ym_admin_role_permissions` VALUES ('1073', '2', 'lists', 'ListsCategoryController', 'index,create,update,admin,delete,view');
INSERT INTO `ym_admin_role_permissions` VALUES ('1074', '2', 'lists', 'ListsManageController', 'index,create,update,admin,delete,upload,deleteUpload,uploadItem,deleteUploadItem,changeStatus');
INSERT INTO `ym_admin_role_permissions` VALUES ('1075', '2', 'pages', 'PageCategoriesManageController', 'index,view,create,update,admin,delete');
INSERT INTO `ym_admin_role_permissions` VALUES ('1076', '2', 'pages', 'PagesManageController', 'index,create,update,admin,delete');
INSERT INTO `ym_admin_role_permissions` VALUES ('1077', '2', 'setting', 'SettingManageController', 'gatewaySetting,changeSetting,socialLinks');
INSERT INTO `ym_admin_role_permissions` VALUES ('1078', '2', 'users', 'UsersManageController', 'index,view,create,update,admin,delete,userTransactions,transactions,dealerships,createDealership,updateDealership,upload,deleteUpload,dealershipRequests,dealershipRequest,deleteDealershipRequest');
INSERT INTO `ym_admin_role_permissions` VALUES ('1079', '2', 'users', 'UsersRolesController', 'create,update,admin,delete');
INSERT INTO `ym_admin_role_permissions` VALUES ('1080', '2', 'comments', 'CommentsCommentController', 'adminBooks,delete,approve');

-- ----------------------------
-- Table structure for ym_contact_department
-- ----------------------------
DROP TABLE IF EXISTS `ym_contact_department`;
CREATE TABLE `ym_contact_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_contact_department
-- ----------------------------
INSERT INTO `ym_contact_department` VALUES ('5', 'مدیریت');
INSERT INTO `ym_contact_department` VALUES ('6', 'پشتیبانی');

-- ----------------------------
-- Table structure for ym_contact_messages
-- ----------------------------
DROP TABLE IF EXISTS `ym_contact_messages`;
CREATE TABLE `ym_contact_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'نام و نام خانوادگی',
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `body` varchar(1000) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  `seen` tinyint(1) unsigned DEFAULT '0',
  `reply` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `ym_contact_messages_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `ym_contact_department` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ym_contact_messages
-- ----------------------------

-- ----------------------------
-- Table structure for ym_contact_receivers
-- ----------------------------
DROP TABLE IF EXISTS `ym_contact_receivers`;
CREATE TABLE `ym_contact_receivers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_persian_ci DEFAULT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `ym_contact_receivers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `ym_contact_department` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_contact_receivers
-- ----------------------------
INSERT INTO `ym_contact_receivers` VALUES ('1', 'یوسف مبشری', 'yusef.mobasheri@gmail.com', '5');

-- ----------------------------
-- Table structure for ym_contact_replies
-- ----------------------------
DROP TABLE IF EXISTS `ym_contact_replies`;
CREATE TABLE `ym_contact_replies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8_persian_ci NOT NULL COMMENT 'متن پاسخ',
  `date` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  CONSTRAINT `ym_contact_replies_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `ym_contact_messages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_contact_replies
-- ----------------------------

-- ----------------------------
-- Table structure for ym_counter_save
-- ----------------------------
DROP TABLE IF EXISTS `ym_counter_save`;
CREATE TABLE `ym_counter_save` (
  `save_name` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `save_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`save_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_counter_save
-- ----------------------------
INSERT INTO `ym_counter_save` VALUES ('day_time', '2458421');
INSERT INTO `ym_counter_save` VALUES ('counter', '2');
INSERT INTO `ym_counter_save` VALUES ('yesterday', '1');
INSERT INTO `ym_counter_save` VALUES ('max_count', '1');
INSERT INTO `ym_counter_save` VALUES ('max_time', '1540629000');

-- ----------------------------
-- Table structure for ym_counter_users
-- ----------------------------
DROP TABLE IF EXISTS `ym_counter_users`;
CREATE TABLE `ym_counter_users` (
  `user_ip` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `user_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_counter_users
-- ----------------------------
INSERT INTO `ym_counter_users` VALUES ('837ec5754f503cfaaee0929fd48974e7', '1540813463');

-- ----------------------------
-- Table structure for ym_google_maps
-- ----------------------------
DROP TABLE IF EXISTS `ym_google_maps`;
CREATE TABLE `ym_google_maps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `map_lat` varchar(30) NOT NULL DEFAULT '34.6327505',
  `map_lng` varchar(30) NOT NULL DEFAULT '50.8644157',
  `map_zoom` varchar(5) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ym_google_maps
-- ----------------------------
INSERT INTO `ym_google_maps` VALUES ('1', '', '34.64061525591295', '50.876765132646824', '15');

-- ----------------------------
-- Table structure for ym_pages
-- ----------------------------
DROP TABLE IF EXISTS `ym_pages`;
CREATE TABLE `ym_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT 'عنوان',
  `summary` text COMMENT 'متن',
  `category_id` int(11) unsigned DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `en_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_pages
-- ----------------------------
INSERT INTO `ym_pages` VALUES ('1', 'درباره ما', 'گروه صرافی نسیم با چهار شعبه صرافی در شهرهای ملبورن ،سیدنی ،تهران و نوشهر مدت 17 سال است که در زمینه انتقال پول به تمام نقاط دنیا زیر نظر بانک مرکزی ایران فعالیت می کند.\r\n            این گروه فعالیت خود را زیر نظر اداره پول شویی کشور استرالیا (AUSTRAC) با کسب مجوزهای لازم از سال 2015 در شهر ملبورن آغاز نموده و در سال 2018 با توجه به نیاز جامعه ایرانیان استرالیا، چهارمین صرافی را در شهر سیدنی برای خدمت به شما عزیزان تاسیس کرده است.\r\n            گروه صرافی نسیم جهت رفع نیازهای ارزی هموطنان ایرانی در زمینه های مختلف از جمله انتقال سرمایه، حواله های دانشجویی، پرداخت های بیمه و آنلاین و مشاوره استراتژیک بزینس و … خدمات ارایه می دهد.\r\n            <br>\r\n            <br>\r\n            <b>چرا صرافی نسیم؟</b>\r\n            <br>\r\n            <br>\r\n            بهترین نرخ تبدیل ارز:\r\n            صرافی نسیم بهترین نرخ تبدیل ارز را با توجه به داشتن یک شعبه در بورس صرافی های تهران (خیابان منوچهری) ارایه می کند.\r\n            تبدیل و انتقال ارز در کمترین زمان:\r\n            صرافی نسیم با کادری مجرب و کار آزموده، داشتن چهار شعبه صرافی زمان خدماتی ارزی را به حداقل رسانیده است.\r\n            ایمن و قانونی:\r\n            صرافی نسیم دارای مجوزهای مربوط به انتقال ارز در کشور استرالیا و ایران و متعهد به قوانین پول شویی است. خیال شما را از داشتن پول قانونی و سفید در حساب بانکی مقصد آسوده می سازد.', '1', 'about-bg.jpg', 'about us');
INSERT INTO `ym_pages` VALUES ('2', 'ارسال حواله', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.', '1', 'transfer-bg.jpg', 'transfer form');
INSERT INTO `ym_pages` VALUES ('3', 'شرایط و مقررات', '<p style=\"direction: ltr\">\r\n        <b>Refunds and cancellation</b><br>\r\n        REFUNDS OF PRINCIPAL AMOUNT and cancellation of the money transfer will be made upon Your written request if payment to the Receiver has not yet been made or credited at the time the request is processed\r\n        <br>\r\n        <br>\r\n        <b>Money transfer services</b><br>\r\n        Javadi Pty ltd provides money transfer services whereby you authorize us to transfer funds to a person overseas; and/or receive Funds from a person overseas\r\n        <br>\r\n        <br>\r\n        <b>Anti-Money Laundering</b><br>\r\n        Javadi Pty ltd are required by the Anti-Money Laundering and Counter-Terrorism Financing Act 2006 to verify your identity before we can provide you with financial products and services. Electronic verification allows us to verify your identity by using electronic tools and external data sources\r\n        <br>\r\n        <br>\r\n        <b>Customers privacy</b><br>\r\n        Due to Privacy Act, we are subjected to protect your privacy. It is our company’s Code Of Conduct to respect customers privacy\r\n        <br>\r\n        <br>\r\n        By sending information to us, you consent to your information being checked with the document issuer or official record holder. Javadi Pty ltd may ask for more information regarding your money transfer\r\n        Information\r\n        Javadi Pty ltd charges 15$ for under 1000$ transaction\r\n        Minimum charges\r\n        Javadi Pty ltd may refuse the payment order, if we cannot match the user’s name and address as provided to Javadi to your bank account or credit card details. In this case you may be liable for an administration charge, which will be deducted from your deposit\r\n        Refusing a payment order\r\n        You are responsible for ensuring the payment details you provide are accurate. Once payment instructions have been executed by Javadi Pty ltd transactions cannot be reversed and Javadi Pty ltd will not be liable in any way for any loss you suffer as a result of a transaction being carried out in accordance with your instructions\r\n        Responsibility\r\n        The offered rate is fixed for 1 hour until we receive a photo of your receipt\r\n        Rate Validity\r\n        After sending the receipt to us the rate is fixed and we will transfer the fund in destination with our agreed price in the day of deal. Please note that incase of market fluctuations the rate will not change in any circumstances\r\n        Fixed Rate Guarantee\r\n        In case of request for cancellation of the transfer 3% will be deducted from your fund, If we have not processed the transaction in destination country\r\n        Cancelation Fee\r\n        In case of deficiency of your documents we may refuse to provide you service without any penalty\r\n        Required Documents\r\n        Any mistake in providing information regarding the transaction from your side will not make Javadi Pty Ltd liable\r\n        Liability Policy\r\n        Funds less than 1,000 Australian Dollars subjected to $15 transfer fee\r\n        Transfer Fee\r\n        Your information – Your privacy\r\n        Your personal information is protected by the law\r\n        Privacy & Security\r\n        By sending information you consent to your information being checked with the document issuer or official record holder\r\n        Document Verification\r\n    </p>', '1', 'terms-bg.jpg', 'terms conditions');
INSERT INTO `ym_pages` VALUES ('4', 'تماس با ما', ' ', '1', 'contact-bg.jpg', 'contact us');
INSERT INTO `ym_pages` VALUES ('6', 'ایمن و قانونی', 'ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', '2', null, null);
INSERT INTO `ym_pages` VALUES ('7', 'بهترین نرخ تبدیل ارز', 'ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', '2', null, null);
INSERT INTO `ym_pages` VALUES ('8', 'تبدیل و انتقال ارز در کمترین زمان', 'ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', '2', null, null);

-- ----------------------------
-- Table structure for ym_page_categories
-- ----------------------------
DROP TABLE IF EXISTS `ym_page_categories`;
CREATE TABLE `ym_page_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'عنوان',
  `slug` varchar(255) DEFAULT NULL COMMENT 'آدرس',
  `multiple` tinyint(1) unsigned DEFAULT '1' COMMENT 'چند صحفه ای',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_page_categories
-- ----------------------------
INSERT INTO `ym_page_categories` VALUES ('1', 'صفحات استاتیک', 'base', '1');
INSERT INTO `ym_page_categories` VALUES ('2', 'صفحه اصلی', 'index', '1');

-- ----------------------------
-- Table structure for ym_site_setting
-- ----------------------------
DROP TABLE IF EXISTS `ym_site_setting`;
CREATE TABLE `ym_site_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_site_setting
-- ----------------------------
INSERT INTO `ym_site_setting` VALUES ('1', 'site_title', 'عنوان سایت', 'Naseem Exchenge');
INSERT INTO `ym_site_setting` VALUES ('2', 'default_title', 'عنوان پیش فرض صفحات', 'Naseem Exchenge');
INSERT INTO `ym_site_setting` VALUES ('3', 'keywords', 'کلمات کلیدی سایت', '[\"\"]');
INSERT INTO `ym_site_setting` VALUES ('4', 'site_description', 'شرح وبسایت', '');
INSERT INTO `ym_site_setting` VALUES ('5', 'social_links', 'شبکه های اجتماعی', '{\"whatsapp\":\"http:\\/\\/https:\\/whatsapp.com\",\"facebook\":\"http:\\/\\/facebook.com\",\"telegram\":\"http:\\/\\/telegram.me\",\"instagram\":\"https:\\/\\/instagram.com\\/naseemexchange\",\"twitter\":\"http:\\/\\/twitter.com\"}');
INSERT INTO `ym_site_setting` VALUES ('6', 'banner', 'تصویر بنر', 'bg.jpg');
INSERT INTO `ym_site_setting` VALUES ('7', 'price', 'مبلغ استرالیا به ایران', '9100');
INSERT INTO `ym_site_setting` VALUES ('12', 'tel', 'شماره تماس', '433 347 481');
INSERT INTO `ym_site_setting` VALUES ('11', 'tel_code', 'کد کشور', '+61');
INSERT INTO `ym_site_setting` VALUES ('8', 'iran_address', 'آدرس ایران', 'تهران: سعدی شمالی، بعد از چهارراه منوچهری، پلاک 528');
INSERT INTO `ym_site_setting` VALUES ('9', 'foreign_address', 'آدرس خارجی', 'shop 9/45 rawson st, auburn 2144');
INSERT INTO `ym_site_setting` VALUES ('13', 'tel2', 'شماره تماس دوم', '298 940 213');
INSERT INTO `ym_site_setting` VALUES ('10', 'foreign_address2', 'آدرس خارجی دوم', 'shop 1A 35-39 aurburn rd, aurburn');
INSERT INTO `ym_site_setting` VALUES ('14', 'master_email', 'پست الکترونیک وبسایت', '');

-- ----------------------------
-- Table structure for ym_tags
-- ----------------------------
DROP TABLE IF EXISTS `ym_tags`;
CREATE TABLE `ym_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'عنوان',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=654 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_tags
-- ----------------------------

-- ----------------------------
-- Table structure for ym_tag_rel
-- ----------------------------
DROP TABLE IF EXISTS `ym_tag_rel`;
CREATE TABLE `ym_tag_rel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_name` varchar(255) NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `ym_tag_rel_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `ym_tags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_tag_rel
-- ----------------------------

-- ----------------------------
-- Table structure for ym_users
-- ----------------------------
DROP TABLE IF EXISTS `ym_users`;
CREATE TABLE `ym_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'پست الکترونیک',
  `role_id` int(10) unsigned DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `status` enum('pending','active','blocked','deleted') DEFAULT 'pending',
  `verification_token` varchar(100) DEFAULT NULL,
  `change_password_request_count` int(1) DEFAULT '0',
  `auth_mode` varchar(50) NOT NULL DEFAULT 'site',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ym_users
-- ----------------------------

-- ----------------------------
-- Table structure for ym_user_details
-- ----------------------------
DROP TABLE IF EXISTS `ym_user_details`;
CREATE TABLE `ym_user_details` (
  `user_id` int(10) unsigned NOT NULL COMMENT 'کاربر',
  `first_name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'نام',
  `last_name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'نام خانوادگی',
  `phone` varchar(11) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'تلفن',
  `zip_code` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'کد پستی',
  `address` varchar(1000) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'نشانی دقیق پستی',
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'آواتار',
  `mobile` varchar(11) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'موبایل',
  `dealership_name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'نام نمایشگاه',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `ym_user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ym_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_user_details
-- ----------------------------

-- ----------------------------
-- Table structure for ym_user_roles
-- ----------------------------
DROP TABLE IF EXISTS `ym_user_roles`;
CREATE TABLE `ym_user_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_user_roles
-- ----------------------------
INSERT INTO `ym_user_roles` VALUES ('1', 'کاربر معمولی', 'user');

-- ----------------------------
-- Table structure for ym_user_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `ym_user_role_permissions`;
CREATE TABLE `ym_user_role_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'شناسه',
  `role_id` int(10) unsigned DEFAULT NULL COMMENT 'نقش',
  `module_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ماژول',
  `controller_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'کنترلر',
  `actions` text CHARACTER SET utf8 COMMENT 'اکشن ها',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of ym_user_role_permissions
-- ----------------------------
INSERT INTO `ym_user_role_permissions` VALUES ('195', '2', 'base', 'BookController', 'buy,bookmark,rate,verify,updateVersion');
INSERT INTO `ym_user_role_permissions` VALUES ('196', '2', 'base', 'BookPersonsController', 'list');
INSERT INTO `ym_user_role_permissions` VALUES ('197', '2', 'base', 'TagsController', 'list');
INSERT INTO `ym_user_role_permissions` VALUES ('198', '2', 'comments', 'CommentsCommentController', 'admin,adminBooks,delete,approve');
INSERT INTO `ym_user_role_permissions` VALUES ('199', '2', 'publishers', 'PublishersPanelController', 'manageSettlement,uploadNationalCardImage,uploadRegistrationCertificateImage,update,create,excel,account,index,discount,settlement,sales,documents,signup');
INSERT INTO `ym_user_role_permissions` VALUES ('200', '2', 'publishers', 'PublishersBooksController', 'create,update,delete,uploadImage,deleteImage,upload,deleteUpload,deleteFile,images,savePackage,deletePackage,getPackages,updatePackage,uploadPreview,deleteUploadedPreview');
INSERT INTO `ym_user_role_permissions` VALUES ('201', '2', 'shop', 'ShopAddressesController', 'add,remove,update');
INSERT INTO `ym_user_role_permissions` VALUES ('202', '2', 'shop', 'ShopOrderController', 'getInfo,history');
INSERT INTO `ym_user_role_permissions` VALUES ('203', '2', 'tickets', 'TicketsDepartmentsController', 'create,update');
INSERT INTO `ym_user_role_permissions` VALUES ('204', '2', 'tickets', 'TicketsManageController', 'index,view,create,update,closeTicket,upload,deleteUploaded,send');
INSERT INTO `ym_user_role_permissions` VALUES ('205', '2', 'tickets', 'TicketsMessagesController', 'delete,create');
INSERT INTO `ym_user_role_permissions` VALUES ('206', '2', 'users', 'UsersCreditController', 'buy,bill,captcha,verify');
INSERT INTO `ym_user_role_permissions` VALUES ('207', '2', 'users', 'UsersPublicController', 'dashboard,logout,setting,notifications,changePassword,bookmarked,downloaded,transactions,library,sessions,removeSession');
INSERT INTO `ym_user_role_permissions` VALUES ('223', '1', 'lists', 'ListsCategoryController', 'index,create,update,admin,delete,view');
INSERT INTO `ym_user_role_permissions` VALUES ('224', '1', 'lists', 'ListsManageController', 'index,create,update,admin,delete,upload,deleteUpload,uploadItem,deleteUploadItem,changeStatus');
INSERT INTO `ym_user_role_permissions` VALUES ('225', '1', 'lists', 'ListsPublicController', 'view,new,update,upload,uploadItem,deleteUpload,deleteUploadItem,rows,json,authJson');
INSERT INTO `ym_user_role_permissions` VALUES ('226', '1', 'users', 'UsersManageController', 'index,view,create,update,admin,delete,userTransactions,transactions,dealerships,createDealership,updateDealership,upload,deleteUpload,dealershipRequests,dealershipRequest,deleteDealershipRequest');
INSERT INTO `ym_user_role_permissions` VALUES ('227', '1', 'users', 'UsersRolesController', 'create,update,admin,delete');
INSERT INTO `ym_user_role_permissions` VALUES ('228', '1', 'users', 'UsersPublicController', 'dashboard,logout,changePassword,verify,forgetPassword,recoverPassword,authCallback,transactions,index,ResendVerification,profile,upload,deleteUpload,viewProfile,login,captcha');
