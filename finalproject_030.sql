SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `finalproject_030` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `finalproject_030`;

CREATE TABLE `accounts` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `user_age` int(3) DEFAULT NULL,
  `user_gender` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `user_email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `user_pass` varchar(32) CHARACTER SET utf8 NOT NULL,
  `user_tel` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `user_address` varchar(160) CHARACTER SET utf8 DEFAULT NULL,
  `user_avatar` text CHARACTER SET utf8,
  `user_group` int(1) NOT NULL,
  `user_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `accounts` (`user_id`, `user_name`, `user_age`, `user_gender`, `user_email`, `user_pass`, `user_tel`, `user_address`, `user_avatar`, `user_group`, `user_date`) VALUES
(1, 'Admin', 12, 'null', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', 'ไม่ระบุ', 'c4ca4238a0b923820dcc509a6f75849b.png', 1, '2016-12-18'),
(3, 'User', 12, 'null', 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', 'ไม่ระบุ', 'c4ca4238a0b923820dcc509a6f75849b.png', 0, '2016-12-18'),
(4, 'ณัฐวุฒิ กิติวรรณ', NULL, NULL, 'ta.nattawut@icloud.com', '5bdc73e30e20da098eacb52b584a5cd6', NULL, NULL, 'a87ff679a2f3e71d9181a67b7542122c.jpg', 0, '2016-12-25');

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_path` text CHARACTER SET utf8 NOT NULL,
  `img_type` varchar(20) NOT NULL,
  `img_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `images` (`img_id`, `img_path`, `img_type`, `img_date`) VALUES
(1, 'qD7IYAvrLzX4_gGErswkU.jpg', 'product', '2016-12-19 13:11:25'),
(2, 'IaNRZSysDNXO_xUzE1Evb.jpg', 'product', '2016-12-19 13:12:05'),
(5, 'JI8t1TduTijy_EqyS8fwa.jpg', 'content', '2016-12-19 13:23:51'),
(6, 'IdiGdkv60cG_Ug6fxC.jpg', 'product', '2016-12-19 13:26:04'),
(7, 'jEUT6dqKYf8Z_urn4L1YY.jpg', 'product', '2016-12-19 13:28:03'),
(8, 'UPMUczqdKzf_DPgfWN8V.jpg', 'product', '2016-12-19 13:32:18'),
(10, 'fsrHdCQ48Bid_B88zGqe6.jpg', 'product', '2016-12-19 13:35:52'),
(11, 'v5hS1i0UJ1BG_O7OWFm.jpg', 'product', '2016-12-19 13:38:45'),
(12, 'ZcUiBG078AT1_H7nQ0Pu.jpg', 'product', '2016-12-19 13:40:36'),
(13, 'Oachhe0WlPXH_ZuLWDmDs.jpg', 'product', '2016-12-19 13:42:29'),
(29, 'ItrMnQKMLkkw_PxTm3zE6.jpg', 'product', '2016-12-21 18:53:03'),
(31, 'cQx0GqPpwQI6_CFuhDyR4.jpg', 'product', '2016-12-24 22:21:54'),
(32, 'TyXU7k7cz2W_1tjahTa.jpg', 'product', '2016-12-24 22:23:46'),
(33, 'tuJ7SnDTrLVj_iSdpbcxo.jpg', 'product', '2016-12-24 22:25:12');

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `invoices` (`invoice_id`, `order_id`, `invoice_date`) VALUES
(4, 4, '2016-12-25 10:05:51'),
(5, 5, '2016-12-25 10:08:13'),
(6, 6, '2016-12-27 09:58:28'),
(7, 7, '2017-11-01 15:14:54'),
(8, 8, '2018-12-05 14:08:46');

CREATE TABLE `order_details` (
  `order_id` int(6) NOT NULL,
  `user_id` int(5) NOT NULL,
  `ordstatus_id` int(2) NOT NULL,
  `order_description` varchar(255) DEFAULT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order_details` (`order_id`, `user_id`, `ordstatus_id`, `order_description`, `order_date`) VALUES
(4, 3, 6, '', '2016-12-25 10:05:51'),
(5, 4, 3, '', '2016-12-25 10:08:13'),
(6, 4, 7, '', '2016-12-27 09:58:28'),
(7, 3, 5, '', '2017-11-01 15:14:54'),
(8, 3, 1, '', '2018-12-05 14:08:46');

CREATE TABLE `order_items` (
  `order_id` int(6) NOT NULL,
  `ordit_id` int(11) NOT NULL,
  `prod_id` int(5) NOT NULL,
  `ordit_qty` int(11) NOT NULL,
  `ordit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `order_items` (`order_id`, `ordit_id`, `prod_id`, `ordit_qty`, `ordit_price`) VALUES
(4, 1, 16, 1, 17100),
(4, 2, 15, 2, 33600),
(4, 3, 10, 1, 17910),
(4, 4, 8, 1, 10499.7),
(5, 5, 16, 1, 17100),
(5, 6, 9, 1, 17999.1),
(6, 7, 15, 2, 33600),
(7, 8, 16, 3, 51300),
(7, 9, 7, 2, 19193),
(8, 10, 11, 1, 16731);

CREATE TABLE `order_status` (
  `ordstatus_id` int(2) NOT NULL,
  `ordstatus_title` varchar(140) CHARACTER SET utf8 NOT NULL,
  `ordstatus_description` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `order_status` (`ordstatus_id`, `ordstatus_title`, `ordstatus_description`) VALUES
(1, 'ตรวจสอบการชำระ', 'เรากำลังดำเนินการจัดหาสินค้าของคุณ สามารถตรวจสอบระยะเวลาขั้นตอนใบรายการได้ที่ เมนูประวัติการสั่งซื้อ ในบัญชีของคุณ'),
(2, 'รอชำระเงิน', 'โปรดชำระเงินภายใน 24 ชั่วโมง หลังจากการทำรายการ สามารถตรวจสอบระยะเวลาขั้นตอนใบรายการได้ที่ เมนูประวัติการสั่งซื้อ ในบัญชีของคุณ'),
(3, 'ชำระเงินแล้ว', 'ขอบคุณสำหรับการสั่งซื้อสินค้าของเรา สามารถตรวจสอบระยะเวลาขั้นตอนใบรายการได้ที่ เมนูประวัติการสั่งซื้อ ในบัญชีของคุณ'),
(4, 'อยู่ระหว่างการจัดส่ง', 'คุณสามารถตรวจสอบระยะเวลาขั้นตอนใบรายการได้ที่ เมนูประวัติการสั่งซื้อ ในบัญชีของคุณ'),
(5, 'ได้รับสินค้าแล้ว', ''),
(6, 'ยกเลิกโดยผู้ขาย', ''),
(7, 'ยกเลิกโดยลูกค้า', '');

CREATE TABLE `page_content` (
  `cont_id` int(11) NOT NULL,
  `cont_title` varchar(140) NOT NULL,
  `cont_url` text NOT NULL,
  `cont_details` text NOT NULL,
  `cont_published` varchar(3) NOT NULL,
  `cont_showontop` varchar(3) NOT NULL,
  `cont_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `page_content` (`cont_id`, `cont_title`, `cont_url`, `cont_details`, `cont_published`, `cont_showontop`, `cont_date`) VALUES
(1, 'เกี่ยวกับเรา', 'aboutus', '<img width=\"100%\" src=\"uploads/contents/JI8t1TduTijy_EqyS8fwa.jpg\"/>\n<p style=\"padding:10rem;\">\nเว็บไซต์นี้จัดทำเพื่อการศึกษาวิชา 801301 การพัฒนาโปรแกรมคอมพิวเตอร์ประยุกต์สำหรับเทคโนโลยีสารสนเทศ 1 มิได้มีเจตนาละเมิดลิขสิทธิ์ และไม่มีการซื้อขายแลกเปลี่ยนเงินตราจริงในเว็บไซต์นี้\n\nThis website is for educational purpose. There is no intention of copyright infringement and no actual trade activities.\n</p>\n\nขอบคุณเนื้อหาจากเว็บไซต์ www.uniqlo.com/th/', 'on', 'on', '2016-12-24'),
(2, 'ตัวอย่างการใช้งาน', 'demo', '    <label>ตัวอย่างการใช้งานสำหรับ User ทั่วไป</label>\n    <pre><code>Email  : user@user.com\nPassword  : 123456</code></pre>\n    <label>ตัวอย่างการใช้งานสำหรับ Admin</label>\n    <pre><code>Email  : admin@admin.com\nPassword  : 123456</code></pre>', 'on', 'on', '2018-12-05');

CREATE TABLE `page_image` (
  `pimg_id` int(11) NOT NULL,
  `cont_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `page_image` (`pimg_id`, `cont_id`, `img_id`) VALUES
(3, 1, 5);

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `pay_date` datetime NOT NULL,
  `pay_amount` double NOT NULL,
  `paymethod_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `payments` (`pay_id`, `invoice_id`, `pay_date`, `pay_amount`, `paymethod_id`) VALUES
(1, 4, '2016-12-25 10:06:09', 79, 1),
(2, 5, '2016-12-25 10:08:22', 35, 1),
(3, 7, '2017-11-01 15:15:27', 70, 1),
(4, 8, '2018-12-05 14:08:53', 16, 1);

CREATE TABLE `payment_method` (
  `paymethod_id` int(5) NOT NULL,
  `paymethod_name` varchar(140) CHARACTER SET utf8 NOT NULL,
  `paymethod_bank` varchar(140) CHARACTER SET utf8 NOT NULL,
  `paymethod_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `paymethod_type` varchar(40) CHARACTER SET utf8 NOT NULL,
  `paymethod_branch` varchar(140) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `payment_method` (`paymethod_id`, `paymethod_name`, `paymethod_bank`, `paymethod_no`, `paymethod_type`, `paymethod_branch`) VALUES
(1, 'ณัฐวุฒิ กิติวรรณ', 'ธนาคารกรุงเทพ', '123456789', 'ออมทรัพย์', 'เพชรบุรี');

CREATE TABLE `product_category` (
  `cate_id` int(5) NOT NULL,
  `cate_name` varchar(140) CHARACTER SET utf8 NOT NULL,
  `cate_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cate_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_category` (`cate_id`, `cate_name`, `cate_description`, `cate_date`) VALUES
(10, 'เสื้อแจ็คเก็ต', 'ไม่ระบุ', '2016-12-07'),
(15, 'เสื้อแจ็คเก็ตผ้าเดนิม', 'ทดสอบอีกที', '2016-12-07'),
(16, 'เสื้อแจ็คเก็ตคอมฟอร์ท', 'ไม่ระบุ', '2016-12-07'),
(17, 'เสื้อพาร์กา', 'ไม่ระบุ', '2016-12-07'),
(18, 'เสื้อพาร์กาแบบพกพา', 'ไม่ระบุ', '2016-12-07'),
(19, 'เสื้อพาร์กาสองด้าน', 'ไม่ระบุ', '2016-12-07'),
(21, 'เสื้อแจ็คเก็ตผ้าฟลีซ', 'ไม่ระบุ', '2016-12-07'),
(23, 'เสื้อโค้ท', 'ไม่ระบุ', '2016-12-07'),
(24, 'บล็อคเทค', 'ทดสอบ', '2016-12-07');

CREATE TABLE `product_image` (
  `prod_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `img_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_image` (`prod_id`, `img_id`, `img_description`) VALUES
(1, 1, ''),
(2, 2, ''),
(3, 6, ''),
(4, 7, ''),
(5, 8, ''),
(7, 10, ''),
(8, 11, ''),
(9, 12, ''),
(10, 13, ''),
(11, 29, ''),
(13, 31, ''),
(15, 32, ''),
(16, 33, '');

CREATE TABLE `product_list` (
  `prod_id` int(5) NOT NULL,
  `cate_id` int(5) NOT NULL,
  `prod_name` varchar(140) CHARACTER SET utf8 NOT NULL,
  `prod_price` double NOT NULL,
  `prod_discount` varchar(3) NOT NULL,
  `prod_description` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_list` (`prod_id`, `cate_id`, `prod_name`, `prod_price`, `prod_discount`, `prod_description`) VALUES
(1, 17, 'เสื้อพาร์กาผ้าวูลผสม', 14900, '0', 'เสื้อพาร์กาสไตล์ทหารที่ทำจากผ้าวูลผสมอันแสนอบอุ่น  - ผลิตจากผ้าวูลที่มีน้ำหนักเบาและนุ่มสบาย - เนื้อผ้าด้านในถูกบุด้วยวัสดุที่มีความนุ่ม - มาพร้อมกระเป๋าแบบมีที่ปิด และมีหมวกขนาดใหญ่พร้อมกับรายละเอียดสไตล์ทหารที่ดูดีมีสไตล์  - มีดีไซน์แบบเรียบง่ายที่สามารถใส่กับชุดสูทได้'),
(2, 23, 'เสื้อฮู้ดพาร์กาใส่ได้สองด้าน', 11290, '7', 'ใส่ได้สองแบบ กับเสื้อฮู้ดพาร์กาพกพาสะดวกสำหรับใส่เล่นกีฬาหรือเพื่อลุคลำลองในทุกๆวัน -ด้านนอกทำจากเส้นใยไนลอนเนื้อด้านและในด้านในทำจากผ้าเจอร์ซี่อันแสนนุ่ม -ดีไซน์ที่สามารถใส่กลับด้านได้จึงให้สองสไตล์ที่แตกต่างกัน -ทรงปลวทำให้สวมใส่และถอดออกได้ง่าย -ปกสูงแบบมีฮู้ดพร้อมสายที่สามารถปรับได้ มียางยืดที่แขนและชายเสื้อเพื่อป้องกันร่างกายจากความหนาวเย็น เกราะด้านนอกมีการเคลือบเพื่อกันน้ำ'),
(3, 18, 'เสื้อพาร์กาแบบพกพา', 11290, '15', 'เสื้อพาร์กาบางเบา ที่จัดเก็บได้สะดวกเหมาะแก่การพกพา สามารถนำมาใช้ได้ทุกเมื่อที่ต้องการ ซิปด้านหน้าเป็นแบบสะท้อนแสงเพื่อความปลอดภัยในยามค่ำคืน การออกแบบที่เรียบง่ายทำให้เหมาะแก่การใส่ออกกำลังกายหรือสวมใส่แบบลำลองได้ในทุกๆ วัน'),
(4, 23, 'เสื้อแจ็คเก็ตผ้าฟลีซมีลายมีซิปแขนยาว', 12900, '5', 'เสื้อแจ็คเก็ตผ้าฟลีซที่ทั้งนุ่ม น้ำหนักเบา และให้ความอบอุ่นอย่างดีเยี่ยม เป็นเสื้อลำลองที่สวมใส่ง่ายเพื่อเพิ่มความอบอุ่นให้กับเดือนที่มีอากาศหนาวเย็น มาในลายตารางหมากรุก สามารถเป็นได้ทั้งเสื้อตัวนอกน้ำหนักเบาหรือจะใส่แบบสวมทับหลายชั้นก็ได้'),
(5, 10, 'เสื้อแจ็คเก็ตดาวน์น้ำหนักเบาพิเศษ', 14900, '10', 'เสื้อแจ็คเก็ตขนดาวน์น้ำหนักเบาพิเศษ ที่มีความบางเบาและอบอุ่นเคลือบผิวด้วยวัสดุสะท้อนน้ำและด้ายกันน้ำ ซึ่งสามารถกันละอองฝนได้ มีการตัดเย็บแบบไล่ระดับ บุด้วยผ้าสองชั้นทำให้มีช่วงเอวที่สวยงาม ปกเสื้อดีไซน์มาให้ห่างจากใบหน้า สามารถพับเก็บใส่กระเป๋าที่มาพร้อมกับ เพื่อให้ง่ายต่อการพกพาและสะดวกต่อการหยิบใช้'),
(7, 23, 'เสื้อแจ็คเก็ตผ้าฟลีซมีลาย', 11290, '15', 'เหมาะกับฤดูกาลอย่างยิ่ง! กับเสื้อแจ็คเก็ตผ้าฟลีซลายเกล็ดหิมะของยูนิโคล่ -ทำจากผ้าฟลีซที่ทั้งอบอุ่น นุ่มและสวมใส่สบาย - เหมาะสำหรับช่วง Fall and Winter -สามารถสวมใส่เป็นเสื้อตัวนอกแบบสบายๆหรือใช้สวมทับหลายชั้นก็ยังได้ -ลายเกล็ดหิมะตลอดทั้งตัวเพิ่มสีสันและลูกเล่นให้กับการแต่งตัว'),
(8, 17, 'เสื้อพาร์กาดาวน์แบบเบาพิเศษ', 11290, '7', 'เสื้อฮู้ดน้ำหนักเบาพิเศษ ที่มาพร้อมกับซับในแถบอะลูมินัมออกเพื่อความอุ่นขึ้นอีกขั้น - มอบความเบาบางและสวมใส่สบายอย่างไม่น่าเชื่อ - ขนดาวน์คุณภาพเยี่ยมเป็นฉนวนกันความร้อนที่ทำให้อบอุ่นดีเยี่ยม - เพิ่มซับในแถบอลูมินัมเพื่อสะท้อนความร้อนในอากาศและกักเก็บเอาไว้ภายใน - ออกแบบมาใหม่ให้พกพาได้สะดวก มีรูปทรงที่ทันสมัยดูไม่เทอะทะ - มีดีไซน์สปอร์ตและมีซิปที่สามารถรูดเปิดปิดง่าย รวมทั้งมีซิปที่กระเป๋าเสื้อ - เนื้อผ้ามีความมันวาวช่วยเพิ่มลุคสปอร์ตให้กับคุณ'),
(9, 23, 'เชสเตอร์ฟิลผ้าวูลแคชเมียร์', 19999, '10', 'เสื้อโค้ทคุณภาพดีเป็นพิเศษที่ผสมผสานระหว่างผ้าวูลและผ้าแคชเมียร์อันหรูหรา มาพร้อมกับความเรียบหรูของผ้าแคชเมียร์บวกกับความอบอุ่นอย่างอ่อนโยนของผ้าวูล ดีไซน์สไตล์เชสเตอร์ฟีลด์แบบย้อนยุคแต่ยังดูทันสมัยทำให้ง่ายต่อการมิกซ์แอนด์แมทช์ สามารถแต่งได้ทั้งลุคทางการไปจนถึงลุคลำลอง'),
(10, 23, 'เสื้อโค้ทดัฟเฟิลผ้าวูลผสม', 19900, '10', 'เสื้อโค้ทดัฟเฟิลตัวจริง ความคลาสสิคที่ใช้งานได้ดีในหน้าหนาว -ทำจากผ้าวูลน้ำหนักเบาที่กันความร้อนได้ดีเป็นพิเศษมาพร้อมกับสัมผัสที่เบาสบาย -มีความอบอุ่นอันเป็นเอกลักษณ์และดูดีด้วยผ้าวูลที่เหมาะกับการสวมใส่ในเดือนที่หนาวเย็น -ออกแบบตัดเย็บมาให้เหมาะกับการสวมทับเสื้อแจ็คเก็ต -มาในโทนสีเทาอ่อนและสีน้ำตาลอ่อนแสนทันสมัย'),
(11, 10, 'เสื้อแจ็คเก็ตบล็อคเทคผ้าฟลีซแขนยาว 2', 16900, '1', 'ป้องกันลมในฤดูหนาวด้วยผ้าฟลีซกันลมแสนอบอุ่น -เสื้อแจ็คเก็ตบล็อคเทคที่มาพร้อมชั้นกันลม -ผ้าฟลีซขนปุยที่ให้ความนุ่มและอบอุ่นสบาย -เนื้อผ้ายืดได้ทำให้เคลื่อนไหวได้สะดวกและสวมใส่สบายพอดีตัว -ออกแบบมาให้สามารถใส่ออกนอกบ้านมาพร้อมกระเป๋าอเนกประสงค์แบบมีซิป -มีการตัดเย็บที่สวยงามแม้ว่าจะมีเนื้อผ้านุ่มฟูก็ตาม'),
(13, 18, 'สเวตเตอร์ผ้าแคชเมียร์คอกลมแขนยาว', 16990, '10', 'เสื้อผ้าถักที่ทำจากผ้าแคชเมียร์ 100% อันหรูหรา ให้ความนุ่มและอบอุ่นอ่อนโยนอย่างไม่มีใครเทียบได้ ดีไซน์คอกลมเพื่อเผยคุณภาพของเนื้อผ้า จับคู่กับเสื้อเชิ้ตมีกระดุมเพื่อให้ได้ลุคลำลองที่ดูเป็นทางการ'),
(15, 10, 'เสื้อแจ็คเก็ตดาวน์', 21000, '20', 'ปกป้องร่างกายคุณจากความหนาวได้อย่างดีเยี่ยม ด้วยเสื้อแจ็คเก็ตดาวน์คุณภาพเยี่ยมที่คุณสามารถสวมใส่ได้ดีในหน้าหนาวนี้  - ผลิตจากเส้นใยขนดาวน์คุณภาพเยี่ยมสุดหรูหราซึ่งเป็นฉนวนกันความร้อน  - ขนดาวน์แสนยืดหยุ่นช่วยให้คุณรู้สึกสบายและสดชื่นขณะที่สวมใส่  - มาพร้อมกับช่องที่ให้ความอบอุ่นมือด้านหลังกระเป๋าข้าง  - กระเป๋าหน้าอกและกระเป๋าด้านในตัวเสื้อช่วยให้มีหลากหลายคุณประโยชน์  - มี-ขอเฟอที่สามารถถอดได้เพื่อสไตล์อันหลากหลาย  - เนื้อผ้าด้านนอกมีความทนทาน มีการเคลือบเพื่อป้องกันละอองน้ำ'),
(16, 17, 'เสื้อฮู้ดพาร์กา', 19000, '10', 'เสื้อผ้าสำหรับกิจกรรมกลางแจ้งตัวจริง เสื้อพาร์กาที่ออกแบบมาเพื่อกิจกรรมกลางแจ้งจากผ้าคุณภาพ -เสื้อพาร์กาเมาน์เทนที่ทำจากผ้าที่ผสมในสัดส่วน 60 40 -ผ้าคอตตอน60% ไนลอน40%ผสมกันจนได้ผ้าที่ระบายอากาศได้ดี มีความแข็งแรงคงทน และเหมาะอย่างยิ่งกับกิจกรรมกลางแจ้ง -การออกแบบอย่างพิถีพิถันอันประกอบไปด้วยกระเป๋าขนาดใหญ่ มีสาบปิดซิปเพื่อกันฝนและการเปียก และมีฮู้ดแบบลึก -ช่วงเอวสามารถปรับให้พอดีตัวได้ด้วยเชือกผูกพร้อมหัวโลหะ -มีการเคลือบเพื่อกันน้ำ');


ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `userEmail` (`user_email`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `orditID` (`order_id`);

ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `ordstatusID` (`ordstatus_id`),
  ADD KEY `userID` (`user_id`,`ordstatus_id`);

ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ordit_id`),
  ADD KEY `prodID` (`prod_id`),
  ADD KEY `order_id` (`order_id`);

ALTER TABLE `order_status`
  ADD PRIMARY KEY (`ordstatus_id`);

ALTER TABLE `page_content`
  ADD PRIMARY KEY (`cont_id`),
  ADD UNIQUE KEY `cont_title` (`cont_title`);

ALTER TABLE `page_image`
  ADD PRIMARY KEY (`pimg_id`),
  ADD KEY `cont_id` (`cont_id`),
  ADD KEY `img_id` (`img_id`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `invoiceID` (`invoice_id`,`paymethod_id`),
  ADD KEY `paymethodID` (`paymethod_id`);

ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymethod_id`),
  ADD UNIQUE KEY `paymethodAccountNum` (`paymethod_no`);

ALTER TABLE `product_category`
  ADD PRIMARY KEY (`cate_id`),
  ADD UNIQUE KEY `cateName` (`cate_name`);

ALTER TABLE `product_image`
  ADD PRIMARY KEY (`prod_id`,`img_id`),
  ADD KEY `img_id` (`img_id`);

ALTER TABLE `product_list`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prodName` (`prod_name`),
  ADD KEY `cateID` (`cate_id`);


ALTER TABLE `accounts`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `order_details`
  MODIFY `order_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `order_items`
  MODIFY `ordit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `order_status`
  MODIFY `ordstatus_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `page_content`
  MODIFY `cont_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `page_image`
  MODIFY `pimg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `payment_method`
  MODIFY `paymethod_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `product_category`
  MODIFY `cate_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `product_list`
  MODIFY `prod_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`ordstatus_id`) REFERENCES `order_status` (`ordstatus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product_list` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `page_image`
  ADD CONSTRAINT `page_image_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_image_ibfk_2` FOREIGN KEY (`cont_id`) REFERENCES `page_content` (`cont_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`paymethod_id`) REFERENCES `payment_method` (`paymethod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_image_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product_list` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `product_category` (`cate_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
