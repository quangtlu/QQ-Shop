-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 04:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qqshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_lv1`
--

CREATE TABLE `category_lv1` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_lv1`
--

INSERT INTO `category_lv1` (`id`, `name`, `description`) VALUES
(1, 'Thời trang', 'Quần áo, giầy dép, phụ kiện......\r\n\r\n'),
(3, 'Nội thất', 'nội thất nhà cửa\r\n'),
(4, 'Điện tử', 'Đồ điện tử');

-- --------------------------------------------------------

--
-- Table structure for table `category_lv2`
--

CREATE TABLE `category_lv2` (
  `id` int(11) NOT NULL,
  `category_lv1ID` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_lv2`
--

INSERT INTO `category_lv2` (`id`, `category_lv1ID`, `name`, `description`) VALUES
(6, 1, 'Nữ', 'Quần áo, phụ kiện dành cho nữ'),
(7, 1, 'Trẻ em', 'Quần áo, phụ kiện dành cho trẻ em'),
(8, 3, 'Nhà ở', 'Đồ nội thất dành cho nhà ở'),
(9, 3, 'Văn phòng', 'Nội thất dành cho văn phòng, công ty'),
(10, 3, 'Trang trí', 'Đồ nội thất để trang trí nhà cửa, văn phòng,xe hơi,...'),
(11, 1, 'Nam', 'Quần áo, phụ kiện dành cho nam'),
(12, 4, 'Điện thoại', ''),
(13, 4, 'Máy tính', ''),
(15, 4, 'Đồ gia dụng', '');

-- --------------------------------------------------------

--
-- Table structure for table `category_lv3`
--

CREATE TABLE `category_lv3` (
  `id` int(11) NOT NULL,
  `category_lv2ID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_lv3`
--

INSERT INTO `category_lv3` (`id`, `category_lv2ID`, `name`, `description`) VALUES
(4, 11, 'Quần áo', ''),
(5, 11, 'Ví', ''),
(6, 11, 'Giày', ''),
(7, 11, 'Đồng hồ', ''),
(8, 11, 'Phụ kiện', ''),
(9, 6, 'Quần áo', ''),
(10, 6, 'Túi xách, ví', ''),
(11, 6, 'Giày dép', ''),
(12, 6, 'Đồng hồ', ''),
(13, 6, 'Phụ kiện', ''),
(14, 6, 'Làm đẹp', ''),
(15, 8, 'Sofa', ''),
(16, 9, 'Trang trí', ''),
(17, 8, 'Tủ đồ', ''),
(18, 12, 'Điện thoại thông minh', ''),
(19, 15, 'Tivi', ''),
(20, 7, 'Bé trai', 'Thời trang cho bé trai'),
(21, 7, 'Bé gái', '<p>Thời trang cho bé gái</p>');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_lv3ID` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_lv3ID`, `title`, `price`, `discount`, `thumbnail`, `gallery`, `description`, `created_at`, `updated_at`) VALUES
(13, 4, 'Áo khoác Nam, Áo Blazer Nam Form Rộng phong cách Hàn Quốc BZ01 MrHero', 269000, 16, 'assets/img/e386975174e916f9f9775d6a0d3102cb.jpeg', 'assets/img/3d1602016e04443aebda7efdddbaf67d.jpeg,assets/img/5b006f0a182b40465b02b96bb6b71007.jpeg,assets/img/10ba81891dba89fb8464351cd6db750c.jpeg,assets/img/63de10cd8d4a2461a25ce9bda120e1dd.jpeg,assets/img/326fea59747acaf2c8528f1a5ca9c24a.jpeg,assets/img/709dae65253e44ad1d5f31b5822bea80.jpeg,assets/img/b4af2ecd80c4b4cc3c4720c51c4f5d81.jpeg,assets/img/c4f841e5d291a6c7584bc6847955120f.jpeg', '<p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">Blazer hiểu đơn giản nhất là những chiếc áo khoác với form chung của vest, nhưng đường cắt và màu sắc lại hoàn toàn phá cách. Blazer cũng không cần lúc nào cũng phải đi kèm theo cả một bộ đồ như khi bạn diện suit, thực ra, chẳng ai đóng thùng trong sơ mi hồ cứng cổ với blazer đâu. \n\n1. Thông tin sản phẩm áo blazer nam form rộng Hàn Quốc Bz01\nÁo khoác blazer nam là mẫu áo khoác vải tuyết mưa  mềm mịn thoáng mát , nhẹ dáng ngắn với  thiết kế đơn giản, form rộng, thích hợp với nhiều dáng người. \nMột chiếc blazer mang lại cho bạn nhiều sự lựa chọn phong cách khác nhau. Bởi blazer sinh ra không chỉ phục vụ cho họp hành công việc mà còn cho cả khi ra ngoài dạo phố hoặc tham gia những cuộc hội hè, nơi mà những chiếc áo phông với quần bò thì chưa đủ lịch sự, nhưng vận cả một bộ suit thì lại là quá cứng nhắc. \n\nVậy nên khi quyết định mặc lên người một chiếc blazer, bạn luôn thoải mái mà vẫn giữ được vẻ ngoài lịch thiệp. Mặc bên trong là một chiếc áo sợi bông hay linen, hay một bộ gồm áo khoác màu navy kết hợp với quần khaki màu nâu, hay thậm chí là mặc kèm cùng quần jeans và một đôi sneaker trắng, một chiếc blazer sẽ không ngại ngần gắn kết cả bộ trang phục của bạn.\n\n2. Mô tả size, màu sắc áo khoác blazer nam BZ01\n Thiết kế: Áo Khoác Blazer cổ bẻ\nSize : M, L, XL, XXL\nSize M: Dài74  cm, Rộng 106 cm, Rộng Vai 51 cm, Tay Áo 53 cm\nSizeL: Dài 75 Cm, Rộng 108 cm, Rộng Vai 53 cm, Tay áo 54 cm\nSize XL: Dài 76cm, Rộng 110 cm, Rộng vai 54 cm, Tay áo 55 cm\nSize XXL: Dài 77 cm, Rộng 112 cm, Rộng vai 55 cm, Tay áo 56 cm\n* Size áo có chênh lệch từ 1-2 cm do kĩ thuật đo. \n\nIB cho shop để được tư vấn size chính xác nha !\nChất Liệu: Vải Tuyết Mưa\nPhong cách: Năng động, Trẻ Trung\nTư Vấn: Chọn Size Miễn Phí Ngay Khi Đặt Hàng\nMàu áo chênh lệch 5-10% do điều kiện ánh sáng và kĩ thuật chụp\n\n3 QUY ĐỊNH ĐỔI TRẢ HÀNG KHI MUA SẢN PHẨM TẠI SHOP\nHiểu được việc mua hàng online khách hàng không được tiếp xúc trực tiếp với sản phẩm , chúng mình luôn cố gắng hỗ trợ khách hàng tốt nhất trong mỗi lần mua hàng. \n- Hỗ trợ đổi hàng trong vòng 7 ngày nếu có lỗi sản phẩm/ đổi size / màu . \nĐối với trường hợp lỗi từ phía shop, khách hàng không phải thanh toán bất kì khoản phí phát sinh nào\nTrường hợp đổi do khách hàng, các bạn thanh toán phí ship đổi hàng giúp shop nha.\n- KHÔNG HỖ TRỢ TRẢ HÀNG NẾU KHÔNG VỪA Ý, HÀI LÒNG, KHÔNG ƯNG MẪU\n- THEO QUY ĐỊNH CỦA SHOPEE KHÔNG HỖ TRỢ XEM HÀNG KHI THANH TOÁN. \nMONG CÁC BẠN CÂN  NHẮC KĨ TRƯỚC KHI ĐẶT, TRÁNH MẤT THỜI GIAN CỦA 2 BÊN NHA\n \n4. PHẢN HỒI VỀ TRẢI NGHIỆM SẢN PHẨM\nShop rất mong nhận được sự góp ý của các bạn về trải nghiệm mua hàng để chúng mình ngày càng nâng cấp phục vụ tốt hơn.</span><br></p>', '2021-10-29 14:21:15', '2021-10-30 15:53:28'),
(14, 4, 'Áo Sweater , áo 1988 form rộng,thụng uniex phong cách Ulzzang', 160000, 40, 'assets/img/649d7869311421d3f594ebf3987b1feb.jpeg', 'assets/img/0bb1c1c8d831cc0f8d546bf87deeedca.jpeg,assets/img/06e395f5a5e454225843f2796f5a839f.jpeg,assets/img/89e27820b2d5412e9217f24b46f1d78e.jpeg,assets/img/892bcff449f17c8b6a1df09c2a9361f8.jpeg,assets/img/f6811b004b1febaaf7109f2b27c37136.jpeg', '<p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">TÊN SẢN PHẨM :Áo Sweater , Áo Nỉ 1988 Form Rộng Uniex Phong Cách Ulzzang\r\n\r\nHOMEUNISEX chuyên sỉ lẻ các mặc hàng của shop là những mẫu các bạn trẻ ưa chuộng ,các mẫu tự thiết kế lên form mẫu nên không lo cạnh tranh về giá và mẫu mã\r\n???? Quy trình lấy sỉ và cách thức tính sỉ :\r\n - Lần đầu lấy hàng đủ 10 sản phẩm ( lẫn lộn ) được tính sỉ, sau lấy DÙ CHỈ 1 SẢN PHẨM cũng được tính giá sỉ\r\n - Các mức sỉ thay đổi theo số lượng : 10, 30, 50, 100, 200, 500 sản phẩm\r\nZalo sỉ 0842048886( Lê Đức Huy)\r\n\r\nCHẤT VẢI :vải nỉ bông giày\r\nKIỂU DÁNG; form to và rộng tay thụng\r\nHÌNH IN ; sắc nét \r\nMẫu do shop lên mẫu và thiết kế form dáng và chất vải\r\nHOMEUNISEX xin cam kết:\r\n- Tất cả các sản phẩm bên HOMEUNISEX  đều đảm bảo như hình \r\n- Chất lượng sản phẩm tốt 100%\r\n- Hoàn tiền ngay nếu như sản phẩm không giống mô tả\r\n- Giao hàng toàn quốc, nhận hàng rồi mới thanh toán\r\n- Sản phẩm luôn luôn có sẳn \r\nTất cả đều có 3 size ( inbox shop để được tư vấn cụ thể hơn)\r\n-Size M: Dưới 55kg ~ Cao dưới 1m60\r\n-Size L: từ 56-65kg ~ Cao 1m61-1m70\r\n-Size XL: từ 66kg-77kg ~ Cao 1m71-1m8\r\n[*Lưu ý: Bảng size mang tính chất tham khảo tương đối, phù hợp với 90% khách hàng khi mua hàng tại shop\r\nI\r\nĐịa chỉ: xóm 14 - HOÀNH SƠN - GIAO THỦY - NAM ĐỊNH \r\nCS2 ; KHU 1 TT YÊN ĐỊNH HẢI HẬU NAM ĐỊNH \r\nCS3 SỐ NHÀ 16 ĐƯỜNG TRẦN HƯNG ĐẠO TP NAM ĐỊNH </span><br></p>', '2021-10-29 14:23:50', '2021-10-29 14:23:50'),
(15, 4, 'Áo Bomber G Thêu Chữ Chất Dù Siêu Hot - 2 Lớp Thoáng Khí Mịn Trẻ Trung Năng Động - Áo Bomber bóng chày hot F', 209000, 26, 'assets/img/96d032c779cf3647cf97422936e6c5ee.jpeg', 'assets/img/1c19634311c1ab30408aa0101290acd9.jpeg,assets/img/63a3ee94b22317d598615b1a5f6f3577.jpeg,assets/img/7055c9a209a82ee710b075df60e4b7a1.jpeg,assets/img/b6250f6c4369e3322a1ac6af9212f6b1.jpeg,assets/img/c897cee8d124d463aec58b825744be76.jpeg', 'Thông Tin Sản Phẩm: Áo Bomber G Thêu Chữ Chất Dù Siêu Hot - 2 Lớp Thoáng Khí Mịn Trẻ Trung Năng Độngtiện dụng .\r\n-Chất liệu dù 2 lớp dày dặn, không hầm,không xù lông\r\n-Hình in sắc nét, mực in cao cấp không bị lem, bong.\r\n-Thiết kế hiện đại, trẻ trung, năng động. Dễ phối đồ\r\n------------------------------------------------\r\nĐiều kiện đổi trả;\r\nSản phẩm còn mới chưa qua sử dụng\r\n-Lỗi do nhà sản xuất, đơn vị vận chuyển.\r\n-Lỗi do Shop thiếu số lượng, mẫu mã\r\nTrường hợp không được đổi trả:\r\n- Quá 2 ngày kể từ khi Quý khách nhận hàng \r\n- Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của Garem\r\n- Không thích, không hợp, đặt nhầm mã, nhầm màu,... \r\n???? CAM KẾT CỦA GAREM STORE ĐẢM BẢO QUYỀN LỢI CHO KHÁCH YÊU:\r\n\r\n✅ Hàng đẹp giống hình ???? Có hình thật + video nên mọi người yên tâm nhé\r\n✅ Đường may kĩ càng, hình in chuẩn không bong tróc\r\n???? ĐẶC BIỆT: Hoàn tiền 100% nếu khách không ưng ý. Khách không tốn bất kỳ đồng phí trả hàng nào\r\n????Quà tặng kèm cho đơn trị giá 99k</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">Thông Tin Sản Phẩm: Áo Bomber G Thêu Chữ Chất Dù Siêu Hot - 2 Lớp Thoáng Khí Mịn Trẻ Trung Năng Độngtiện dụng .\r\n-Chất liệu dù 2 lớp dày dặn, không hầm,không xù lông\r\n-Hình in sắc nét, mực in cao cấp không bị lem, bong.\r\n-Thiết kế hiện đại, trẻ trung, năng động. Dễ phối đồ\r\n------------------------------------------------\r\nĐiều kiện đổi trả;\r\nSản phẩm còn mới chưa qua sử dụng\r\n-Lỗi do nhà sản xuất, đơn vị vận chuyển.\r\n-Lỗi do Shop thiếu số lượng, mẫu mã\r\nTrường hợp không được đổi trả:\r\n- Quá 2 ngày kể từ khi Quý khách nhận hàng \r\n- Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của Garem\r\n- Không thích, không hợp, đặt nhầm mã, nhầm màu,... \r\n???? CAM KẾT CỦA GAREM STORE ĐẢM BẢO QUYỀN LỢI CHO KHÁCH YÊU:\r\n\r\n✅ Hàng đẹp giống hình ???? Có hình thật + video nên mọi người yên tâm nhé\r\n✅ Đường may kĩ càng, hình in chuẩn không bong tróc\r\n???? ĐẶC BIỆT: Hoàn tiền 100% nếu khách không ưng ý. Khách không tốn bất kỳ đồng phí trả hàng nào\r\n????Quà tặng kèm cho đơn trị giá 99k</span><br></p>', '2021-10-29 14:26:15', '2021-10-29 14:26:26'),
(16, 4, 'ÁO BOMBER NY BÓNG CHÀY DA THÊU DASKI PHONG CÁCH ULZZANG', 280000, 45, 'assets/img/318ac0f735c1b8f7d346301a5cc4ddd0.jpeg', 'assets/img/01b7a740e4c417a7ab4ea60645f494c9.jpeg,assets/img/96cdf706cbd8c247460f4267da3b1301.jpeg,assets/img/98bb0f5f02a23a3e466214c4caeaa359.jpeg,assets/img/5372daff410d0f3d6d542c503e5d51fb.jpeg,assets/img/76717f59b85bd984592fc4278f0b464a.jpeg', '<p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">TÊN SẢN PHẨM :Áo Hoodie Nỉ Bông Siêu Dày Form Rộng Unisex In Họa Tiết Bar \r\n\r\nHOMEUNISEX chuyên sỉ lẻ các mặc hàng của shop là những mẫu các bạn trẻ ưa chuộng ,các mẫu tự thiết kế lên form mẫu nên không lo cạnh tranh về giá và mẫu mã\r\n???? Quy trình lấy sỉ và cách thức tính sỉ :\r\n - Lần đầu lấy hàng đủ 10 sản phẩm ( lẫn lộn ) được tính sỉ, sau lấy DÙ CHỈ 1 SẢN PHẨM cũng được tính giá sỉ\r\n - Các mức sỉ thay đổi theo số lượng : 10, 30, 50, 100, 200, 500 sản phẩm\r\nZalo sỉ 0842048886( Lê Đức Huy)\r\n\r\nÁo hoodie nỉ bông vải dày form siêu rộng và to có 2 màu : ghi và đen \r\nKiểu dáng : form to và thụng mũ 2 lớp dày và rộng\r\nChất vải; vải nỉ trần bông cực dày siu ấm \r\nÁO hoodie bar phù hợp mặc đôi mặc đi chơi rất phù hợp \r\nHOMEUNISEX xin cam kết:\r\n- Tất cả các sản phẩm bên HOMEUNISEX đều đảm bảo như hình \r\n- Chất lượng sản phẩm tốt 100%\r\n- Hoàn tiền ngay nếu như sản phẩm không giống mô tả\r\n- Giao hàng toàn quốc, nhận hàng rồi mới thanh toán\r\n- Sản phẩm luôn luôn có sẳn \r\n\r\nTất cả đều có 3 size ( inbox shop để được tư vấn cụ thể hơn)\r\n-Size M: Dưới 55kg ~ Cao dưới 1m60\r\n-Size L: từ 56-65kg ~ Cao 1m61-1m70\r\n-Size XL: từ 66kg-77kg ~ Cao 1m71-1m8\r\n[*Lưu ý: Bảng size mang tính chất tham khảo tương đối, phù hợp với 90% khách hàng khi mua hàng tại shop]\r\n\r\nĐịa chỉ: xóm 14 - HOÀNH SƠN - GIAO THỦY - NAM ĐỊNH \r\nCS2 ; KHU 1 TT YÊN ĐỊNH HẢI HẬU NAM ĐỊNH \r\nCS3 SỐ NHÀ 16 ĐƯỜNG TRẦN HƯNG ĐẠO TP NAM ĐỊNH \r\nHOTLINE: 0842048886 (GẶP MR HUY)</span><br></p>', '2021-10-29 14:29:18', '2021-10-29 14:29:18'),
(17, 9, 'Áo Sweater Tay Dài Dáng Rộng In Chữ Phong Cách Hàn Quốc Dễ Thương Cho Nữ', 200000, 38, 'assets/img/cd55916b5efec71351778fbb2b7da8ee.jpeg', 'assets/img/3fbf7911342dd3573c9930baefd24d6d.jpeg,assets/img/92deebd0661d3e1d68e934d70c9a5c56.jpeg,assets/img/5334e3a176b28d0355e3c6a610514dd7.jpeg,assets/img/78446b1b7d9416acaf18428b5bbaf4b5.jpeg,assets/img/eed8faf7b26d61a412f79b0b3e676c7d.jpeg,assets/img/fdef134033b4f74da4a0366ea6c09c5b.png', 'Thời gian giao hàng dự kiến cho sản phẩm này là từ 7-9 ngày\r\n  \r\n  Chào mừng bạn đến cửa hàng !! ❤❤\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  * Lưu ý dành cho khách hàng：\r\n  \r\n  \r\n  \r\n  1. Nếu có bất kỳ câu hỏi nào trước khi đặt hàng chẳng hạn như về kích thước và mọi thứ khác mà bạn quan tâm, bạn có thể liên hệ với chúng tôi. Chúng tôi rất hân hạnh được giải đáp thắc mắc của bạn.\r\n  \r\n  \r\n  \r\n  2. Quần áo trong cửa hàng đều có sẵn. Sau khi đặt hàng, chúng tôi sẽ vận chuyển gói hàng cho bạn trong thời gian sớm nhất có thể.\r\n  \r\n  \r\n  \r\n  3. Sau khi nhận được sản phẩm nếu có vấn đề gì, giao hàng số lượng ít, hậu cần chậm, chất lượng kém, sản phẩm bị lỗi, trước hết hãy liên hệ ngay với chún tôi. Xin đừng để lại bình luận tiêu cực. Chúng tôi sẽ cố gắng hết sức để giải quyết vấn đề cho bạn.\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  Kích thước:\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  M: Chiều dài 68 Ngực 122 Chiều rộng vai 61 Chiều dài tay áo 50\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  L: Chiều dài 70 Ngực 126 Chiều rộng vai 63 Chiều dài tay áo 51\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  XL: Chiều dài 72 Ngực 130 Chiều rộng vai 65 Chiều dài tay áo 52\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  ● Đơn vị: cm 【1 cm = 0.3937 inch】\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  Đây là kích thước theo size Châu Á, nhỏ hơn một chút so với kích thước theo chuẩn US / AU / EU! Xin vui lòng đảm bảo các phép đo thực tế sẽ phù hợp với bạn\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  *Lưu ý: \r\n  \r\n  \r\n  \r\n  ● Do chênh lệch cài đặt ánh sáng và màn hình, màu sắc sản phẩm có thể hơi khác so với hình ảnh. Vui lòng lấy sản phẩm thật làm chuẩn!\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  ● Kích thước chỉ mang tính tham khảo, vui lòng cho phép sai số khoảng 2-3 cm, vui lòng kiểm tra xem có phù hợp với kích thước của bạn trước khi mua hay không.</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">Thời gian giao hàng dự kiến cho sản phẩm này là từ 7-9 ngày\r\n  \r\n  Chào mừng bạn đến cửa hàng !! ❤❤\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  * Lưu ý dành cho khách hàng：\r\n  \r\n  \r\n  \r\n  1. Nếu có bất kỳ câu hỏi nào trước khi đặt hàng chẳng hạn như về kích thước và mọi thứ khác mà bạn quan tâm, bạn có thể liên hệ với chúng tôi. Chúng tôi rất hân hạnh được giải đáp thắc mắc của bạn.\r\n  \r\n  \r\n  \r\n  2. Quần áo trong cửa hàng đều có sẵn. Sau khi đặt hàng, chúng tôi sẽ vận chuyển gói hàng cho bạn trong thời gian sớm nhất có thể.\r\n  \r\n  \r\n  \r\n  3. Sau khi nhận được sản phẩm nếu có vấn đề gì, giao hàng số lượng ít, hậu cần chậm, chất lượng kém, sản phẩm bị lỗi, trước hết hãy liên hệ ngay với chún tôi. Xin đừng để lại bình luận tiêu cực. Chúng tôi sẽ cố gắng hết sức để giải quyết vấn đề cho bạn.\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  Kích thước:\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  M: Chiều dài 68 Ngực 122 Chiều rộng vai 61 Chiều dài tay áo 50\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  L: Chiều dài 70 Ngực 126 Chiều rộng vai 63 Chiều dài tay áo 51\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  XL: Chiều dài 72 Ngực 130 Chiều rộng vai 65 Chiều dài tay áo 52\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  ● Đơn vị: cm 【1 cm = 0.3937 inch】\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  Đây là kích thước theo size Châu Á, nhỏ hơn một chút so với kích thước theo chuẩn US / AU / EU! Xin vui lòng đảm bảo các phép đo thực tế sẽ phù hợp với bạn\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  \r\n  *Lưu ý: \r\n  \r\n  \r\n  \r\n  ● Do chênh lệch cài đặt ánh sáng và màn hình, màu sắc sản phẩm có thể hơi khác so với hình ảnh. Vui lòng lấy sản phẩm thật làm chuẩn!\r\n  \r\n  \r\n  \r\n  \r\n  \r\n  ● Kích thước chỉ mang tính tham khảo, vui lòng cho phép sai số khoảng 2-3 cm, vui lòng kiểm tra xem có phù hợp với kích thước của bạn trước khi mua hay không.</span><br></p>', '2021-10-29 14:31:44', '2021-11-02 10:43:22'),
(18, 9, 'Áo Khoác Phao Béo 5 MÀU [ hàng sẵn] ⚡️HÀNG SIÊU SALE ⚡️ áo khoác đại hàn cho nữ dáng rộng', 209000, 0, 'assets/img/10a7721ee2fd4b9d552181604280b137.jpeg', 'assets/img/6ab35a69b2746ad5f270befddb77fa69.jpeg,assets/img/302b63c8c2f3ba6d7ab929350274bd53.jpeg,assets/img/3008be755fbf08de61b843c344c7c5f3.jpeg,assets/img/564454028f0df3ba523bca46d0d1863b.jpeg,assets/img/a5de9b52ae0764969c20c848780d9127.jpeg,assets/img/cef61427d8f67e45d0b0b4b0dcdeebcc.jpeg,assets/img/daa1dd396ff7542d4fb90378e44e2e2b.jpeg', '<p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" >SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">SHOP CÓ SẴN -GIAO NGAY Áo phao béo Quảng Châu giá tại xưởng sản xuất Trung Quốc\r\n\r\n⚠️ CAM KẾT 1 ĐỔI 1 TRONG 7 NGÀY NẾU CÓ LỖI CỦA SHOP ⚠️\r\n                                \r\nGiao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n\r\n======================\r\n\r\n⭐️ Thông tin sản phẩm:\r\nbảng màu  đen be vàng tím xanh \r\nthông số s m l xl xxl có thể mặc cho nam giới\r\nlưu ý áo to và rộng khách lấy đúng kích cỡ\r\n⭐️ Hướng dẫn sử dụng:\r\n\r\nLần đầu sử dụng chỉ nên xả nước lạnh, phơi khô để đảm bảo chất lượng sản phẩm\r\nKhi giặt lộn trái sản phẩm, cũng như khi phơi.\r\nKhông giặt máy trong 2 tuần đầu tiên.\r\nKhông sử dụng thuốc tẩy cho sản phẩm\r\n\r\n⭐️ CHÚNG TÔI CAM KẾT BÁN HÀNG\r\n\r\n✅ Tất cả các mặt hàng đều qua kiểm định và thử chất lượng, không bán hàng trôi nổi, phương châm của chúng tôi là mang những điều tốt đẹp nhất đến với khách hàng!\r\n✅ Sản phẩm luôn kèm ảnh thật và video shop tự quay\r\n✅ Đổi trả trong vòng 7 ngày nếu hàng hỏng lỗi\r\n✅ Tất cả các thông tin về Shop đều được công khai \r\n✅ Luôn tư vấn tận tình để mang sản phẩm phù hợp nhất đến với bạn\r\n✅ Hỗ trợ online 24/24\r\n\r\n✅ Tiếp nhận phản ảnh và xử lí tích cực\r\n✅ Đặt hàng Bình luận trực tiếp vào sản phẩm hoặc inbox cho shop, sẽ có nhân viên trả lời ngay!</span><br></p>', '2021-10-29 14:48:42', '2021-11-02 10:43:46');
INSERT INTO `product` (`id`, `category_lv3ID`, `title`, `price`, `discount`, `thumbnail`, `gallery`, `description`, `created_at`, `updated_at`) VALUES
(19, 9, 'Áo khoác len cadigan Forgirl mùa thu đông dày dặn', 190000, 52, 'assets/img/93dfbfac90681767ce2ce9838c604177.jpeg', 'assets/img/18fef4eda59b495775e7991846c6fffd.jpeg,assets/img/25b303c2ebbadd56e28d87510c135954.jpeg,assets/img/78f586ef5ab9c57e229b98fd760a0c76.jpeg,assets/img/19421aa04f8ee847080c6031979a4011.jpeg,assets/img/aed1f81cb7c0be25074fefec4fae16c8.jpeg,assets/img/e2677be5864adac04691bfc257a25726.jpeg,assets/img/e2797d40a6cc6e77a9ad836a1f4ab46e.jpeg', 'trong tủ quần áo ít nhất một em áo khoác mỏng này nhé. Forgirl_vn cam kết đem đến cho các bạn sự tự tin, thoải mái và an toàn khi sử dụng sản phẩm.\r\n\r\nThông tin sản phẩm\r\n- Xuất xứ: Trung Quốc\r\n- Chất liệu: len sợi\r\n- Màu sắc: be, đen, xanh than\r\n- Số liệu: SP chỉ phù hợp cho bạn dưới 50kg.\r\n Chiều dài áo: 58 cm\r\n Tay áo: 51 cm\r\n\r\nĐặc điểm nổi bật:\r\n- Len sợi mỏng dệt móc thích hợp mặc cho mua thu đông trong năm với form áo rộng rãi thoải mái, chất liệu dày ấm\r\n- Len ít dão nên các bạn có thể giặt máy, tuy nhiên nên vắt kiệt nước trước khi phơi.\r\n\r\n• LƯU Ý: Khách lẻ chỉ cần THEO DÕI (Follow) Shop là có thể mua lẻ với giá sỉ. Giá ĐANG GIẢM của tất cả sản phẩm là GIÁ SỈ. Shop sẽ từ chối đơn hàng nếu khách mua lẻ nhưng chưa chọn THEO DÕI shop\r\n- SHOP KHÔNG NHẬN ĐẶT HÀNG QUA TIN NHẮN và GHI CHÚ. Sản phẩm của shop đã được phân loại hàng rất rõ ràng. Phân loại hàng nào không chọn được có nghĩa là hết hàng. Sản phẩm nào không có phân loại thì sẽ giao ngẫu nhiên như thông báo trong mô tả. Quý khách hãy đọc mô tả sản phẩm trước khi mua, trong mô tả có đầy đủ thông tin cần thiết.\r\n- HƯỚNG DẪN Đặt Mua Nhiều SP, Màu, Mẫu, Kích Thước trong 1 đơn hàng: Bạn phải chọn từng màu, mẫu hoặc kích thước bạn muốn rồi cho vào giỏ hàng. Sau khi chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Có thể điều chỉnh số lượng mua trong giỏ hàng nếu muốn.\r\n- Shop KHÔNG ĐỒNG Ý HỦY đơn hàng đã xác nhận và có mã vận đơn của nhà vận chuyển. Nếu đơn hàng chưa có mã vận đơn thì quý khách có thể TỰ DO HỦY rồi đặt lại mà không cần shop đồng ý. </span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">trong tủ quần áo ít nhất một em áo khoác mỏng này nhé. Forgirl_vn cam kết đem đến cho các bạn sự tự tin, thoải mái và an toàn khi sử dụng sản phẩm.\r\n\r\nThông tin sản phẩm\r\n- Xuất xứ: Trung Quốc\r\n- Chất liệu: len sợi\r\n- Màu sắc: be, đen, xanh than\r\n- Số liệu: SP chỉ phù hợp cho bạn dưới 50kg.\r\n Chiều dài áo: 58 cm\r\n Tay áo: 51 cm\r\n\r\nĐặc điểm nổi bật:\r\n- Len sợi mỏng dệt móc thích hợp mặc cho mua thu đông trong năm với form áo rộng rãi thoải mái, chất liệu dày ấm\r\n- Len ít dão nên các bạn có thể giặt máy, tuy nhiên nên vắt kiệt nước trước khi phơi.\r\n\r\n• LƯU Ý: Khách lẻ chỉ cần THEO DÕI (Follow) Shop là có thể mua lẻ với giá sỉ. Giá ĐANG GIẢM của tất cả sản phẩm là GIÁ SỈ. Shop sẽ từ chối đơn hàng nếu khách mua lẻ nhưng chưa chọn THEO DÕI shop\r\n- SHOP KHÔNG NHẬN ĐẶT HÀNG QUA TIN NHẮN và GHI CHÚ. Sản phẩm của shop đã được phân loại hàng rất rõ ràng. Phân loại hàng nào không chọn được có nghĩa là hết hàng. Sản phẩm nào không có phân loại thì sẽ giao ngẫu nhiên như thông báo trong mô tả. Quý khách hãy đọc mô tả sản phẩm trước khi mua, trong mô tả có đầy đủ thông tin cần thiết.\r\n- HƯỚNG DẪN Đặt Mua Nhiều SP, Màu, Mẫu, Kích Thước trong 1 đơn hàng: Bạn phải chọn từng màu, mẫu hoặc kích thước bạn muốn rồi cho vào giỏ hàng. Sau khi chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Có thể điều chỉnh số lượng mua trong giỏ hàng nếu muốn.\r\n- Shop KHÔNG ĐỒNG Ý HỦY đơn hàng đã xác nhận và có mã vận đơn của nhà vận chuyển. Nếu đơn hàng chưa có mã vận đơn thì quý khách có thể TỰ DO HỦY rồi đặt lại mà không cần shop đồng ý. </span><br></p>', '2021-10-29 14:50:24', '2021-11-02 10:43:54'),
(20, 9, 'Áo Khoác Nỉ Khóa Zip Oversize Kẻ Viền Túi - Hoodie dáng thụng form rộng dài tay, kiểu dáng basic, thiết kế trẻ trung', 79000, 0, 'assets/img/6e016698ff3d6f09ce99dc04f303feeb.jpeg', 'assets/img/1d28bae77d483da0b3f7c3dd87327f0c.jpeg,assets/img/2e531443580fbdb33f5d76d48e6fe473.jpeg,assets/img/641cf26c9bb9e96fcb43b8904896d5b2.jpeg,assets/img/dacc428590b979ecb851daee7371d112.jpeg', 'Áo hoodie kẻ viền túi nhà em sẵn kho sll nha các bác \r\n???? Chất liệu cao cấp, thiết kế đơn giản, trẻ trung, thoáng mát\r\n???? Freesize dưới 60kg vừa đẹp cho cả nhà mình ạ \r\n???? Màu sắc : màu như hình\r\n#vaynu #damnu #thoitrangnu #vay #damsuong #vaysuong #vaycotron #vaytaylo #dammidi #vaymidi #banhbeo #tieuthu #buon #si #sll\r\n\r\n  ???????????? Peonyboutique ????????????\r\n???? Chuyên sỉ lẻ các loại quần áo 4 mùa\r\n???? Giá tại xưởng không qua trung gian\r\n???? Mẫu mã đa dạng ,hợp thời trang\r\n???? Các loại sản phẩm từ chất cotton, thun, umi hàn....\r\nLưu ý: Các bạn chú ý đọc thông tin sản phẩm trước khi đặt hàng, shop chỉ chuyển đơn theo đúng phân loại khách chọn trong đơn..</span><br></p>\" ><p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: \"Helvetica Neue\", Helvetica, Arial, 文泉驛正黑, \"WenQuanYi Zen Hei\", \"Hiragino Sans GB\", \"儷黑 Pro\", \"LiHei Pro\", \"Heiti TC\", 微軟正黑體, \"Microsoft JhengHei UI\", \"Microsoft JhengHei\", sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">Áo hoodie kẻ viền túi nhà em sẵn kho sll nha các bác \r\n???? Chất liệu cao cấp, thiết kế đơn giản, trẻ trung, thoáng mát\r\n???? Freesize dưới 60kg vừa đẹp cho cả nhà mình ạ \r\n???? Màu sắc : màu như hình\r\n#vaynu #damnu #thoitrangnu #vay #damsuong #vaysuong #vaycotron #vaytaylo #dammidi #vaymidi #banhbeo #tieuthu #buon #si #sll\r\n\r\n  ???????????? Peonyboutique ????????????\r\n???? Chuyên sỉ lẻ các loại quần áo 4 mùa\r\n???? Giá tại xưởng không qua trung gian\r\n???? Mẫu mã đa dạng ,hợp thời trang\r\n???? Các loại sản phẩm từ chất cotton, thun, umi hàn....\r\nLưu ý: Các bạn chú ý đọc thông tin sản phẩm trước khi đặt hàng, shop chỉ chuyển đơn theo đúng phân loại khách chọn trong đơn..</span><br></p>', '2021-10-29 15:41:55', '2021-11-02 10:44:03'),
(21, 4, 'Áo nỉ Hoodie Drew house mặt cười Hogoto shop , áo nỉ bông hoodie unisex nam nữ', 480000, 33, 'assets/img/e15c748683a316b4099cc3fb1de47b1a.jpeg', 'assets/img/01ce80ac05191cf0b3b328da0635b357.jpeg,assets/img/67f057d7d0d6d65e61645d7ce8e32328.jpeg,assets/img/99c531c276590be0567aed44088d6779.jpeg,assets/img/719b9a8ff5e199a89e4d94aa6e1de247.jpeg,assets/img/a3c7d94d351d0417cf2cea91ad75b626.jpeg,assets/img/a4e3c5293d96596e70e47dd9b748d6eb.jpeg,assets/img/d482e2a58436d93514df7cb783fbbed8.jpeg', '<p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">THÔNG TIN SẢN PHẨM: Áo nỉ Hoodie\r\n- Chất liệu nỉ Bông   Cotton 100%  mềm mại dày dặn  , thoáng mát\r\n- Đường may được gia công tỉ mỉ, chắc chắn.\r\n- Hình in sắc nét, chân thực\r\n\r\n              M : Ngang 56cm - Dài 70cm ( 45kg - 60kg )\r\n               L : Ngang 58cm - Dài 72cm  ( 60kg - 70kg )\r\n              XL: ngang 60cm - Dài 74cm   ( 70kg - 85kg )\r\n* Bảng size chỉ mang tính chất tham khảo và phù hợp với phần đông khách hàng, Khách hoàn toàn có thể chọn lên hoặc xuống size tuỳ thuộc vào sở thích và form dáng của mình \r\nHOGOTO SHOP CAM KẾT:\r\n- Sản phẩm 100% giống mô tả. Hình ảnh sản phẩm chân thật ,đầy đủ tem, mác, bao bì cao cấp.\r\n- Hình ảnh sản phẩm là ảnh thật do shop tự chụp và giữ bản quyền hình ảnh\r\n- Đảm bảo vải chất lượng 100% cotton chuẩn xuất khẩu.\r\n- Áo được kiểm tra kĩ càng, cẩn thận và tư vấn nhiệt tình trước khi gói hàng giao cho Quý Khách\r\n- Hàng có sẵn, giao hàng ngay khi nhận được đơn \r\n- Hoàn tiền nếu sản phẩm không giống với mô tả\r\n- Chấp nhận đổi hàng khi size không vừa (vui lòng nhắn tin riêng cho shop)\r\n- Giao hàng trên toàn quốc, nhận hàng trả tiền \r\n- Hỗ trợ đổi trả theo quy định của Shopee\r\n\r\n- Quý khách nhận được sản phẩm, vui lòng đánh giá giúp Shop để hưởng thêm nhiều ưu đãi hơn nhé.\r\nLưu ý: Khi bạn gặp bất kì vấn đề gì đừng vội đánh giá Sản Phẩm mà hãy liên hệ Shop để đc hỗ trợ 1 cách tốt nhất  nhé.\r\n\r\n1. Điều kiện áp dụng (trong vòng 07 ngày kể từ khi nhận sản phẩm) \r\n- Hàng hoá vẫn còn mới, chưa qua sử dụng \r\n- Hàng hoá bị lỗi hoặc hư hỏng do vận chuyển hoặc do nhà sản xuất \r\n2. Trường hợp được chấp nhận: \r\n- Hàng không đúng size, kiểu dáng như quý khách đặt hàng \r\n- Không đủ số lượng, không đủ bộ như trong đơn hàng \r\n3. Trường hợp không đủ điều kiện áp dụng chính sách: \r\n- Quá 07 ngày kể từ khi Quý khách nhận hàng \r\n- Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của HOGOTO\r\n- Không thích, không hợp, đặt nhầm mã, nhầm màu,... \r\nDo màn hình và điều kiện ánh sáng khác nhau, màu sắc thực tế của sản phẩm có thể chênh lệch khoảng 3-5%</span><br></p>', '2021-11-02 12:26:57', '2021-11-02 12:26:57'),
(22, 4, 'Áo Len Nam cổ lọ dài tay đẹp thời trang nam cao cấp FAVITI AL59', 200000, 45, 'assets/img/1cd3edab1620f58956785cbc742c6031.jpeg', 'assets/img/1b964a88be5eb1e9dbd41e84d079f4a3.jpeg,assets/img/7f160561e2f588ddd73f76a1f87353f3.jpeg,assets/img/8eb06a09fff6af941b613e3ec8bf2a35.jpeg,assets/img/9a148e25c5423fb42a95234f4e4a92f9.jpeg,assets/img/2359d2677f6239097da6fcbfcf66418d.jpeg,assets/img/b7f59e8d240b46aec722556be45bcf7a.png,assets/img/df80c6a198d2f26247604b2f23269d5a.jpeg', '<p><span style=\"color: rgba(0, 0, 0, 0.8); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">Khách yêu lưu ý: FAVITI không nhận đặt hàng qua ghi chú, nên khách yêu kiểm tra màu size, địa chỉ với số điện thoại chuẩn trước khi đặt hàng nhé.\r\nThêm nữa do chính sách toàn sàn shopee không cho kiểm hàng trước khi thanh toán, nhưng nhà FAVITI hỗ trợ đổi trả trong vòng 7 ngày cho các sản phẩm không vừa size không giống mô tả hoặc lỗi từ nhà sản xuất\r\nKhách yêu yên tâm khi đặt hàng tại nhà FAVITI nha!!!\r\n\r\n???? THÔNG TIN SẢN PHẨM: Áo Len Nam cổ lọ dài tay đẹp thời trang nam cao cấp FAVITI AL59\r\n♥️ Chất liệu áo len nam: vải len cotton thiên nhiên mềm mại có bề mặt mềm mịn, thoát mồ hôi giữ ấm, nhanh tạo cảm giác vô cùng thoải mái cho người mặc và đặc biệt là không bị Xù Lông, Không phai màu, Giặt máy tốt. \r\n♥️ Màu sắc áo len cổ lọ nam : 12 màu\r\n♥️ Size áo len tay dài : L, XL\r\n\r\nHƯỚNG DẪN CHỌN SIZE ÁO LEN NAM\r\nSize L: Cân nặng 45-65kg, cao dưới 1m70\r\nSize XL: Cân nặng 65-78kg, cao dưới 1m80.\r\nBụng to thì tăng thêm 1 size nhé\r\nLưu ý: thông số các số đo có thể bị chênh lệch 1-2cm\r\n\r\n♥️ Áo len nam cổ lọ là món phụ kiện thời trang đơn giản nhưng không kém phần đẹp, thời trang. Các anh có thể mặc đi làm, đi chơi hay đi dự tiệc lại rất dễ phối đồ dù là với quần vải, quần jean, quần kaki hay với các sản phẩm áo măng tô, áo vest.\r\n\r\nHãy chọn cho mình 1 màu phù hợp nhé...\r\n\r\n????Trong thế giới thời trang của phái mạnh chiếc áo len nam cổ cao luôn chiếm một vị trí quan trọng.\r\n\r\nTừ những anh chàng bình thường nhất cho tới những ngôi sao hàng đầu, tất cả đều chia sẻ một tình yêu vĩ đại với áo len cổ trụ của mình\r\n\r\nÁo len nam có cổ hợp dáng người, hợp màu sắc làm tăng vẻ đẹp của trang phục bạn mặc và khẳng định ấn tượng của bạn trong mắt người đối diện.\r\n\r\nTuy nhiên, không phải ai cũng biết chọn một chiếc áo len ấm áp thực sự phù hợp với phom cơ thể của mình.\r\n\r\nMang tới cho các anh chàng sự thoải mái khi đi dạo phố hoặc hẹn hò bè bạn , chiếc áo len nam cao cấp đã trở thành người bạn không thể thiếu các chàng.\r\n\r\nVà nếu bạn cũng đang đi tìm một chiếc áo len nam đẹp thời trang thể thể hiện được cá tính của bản thân một cách rõ nét nhất và đang... lạc lối, thì hãy cùng khám phá và cảm nhận trên sản phẩm của FAVITI chúng mình nhé\r\n????  Mẹo Nhỏ Giúp Bạn Bảo Quản Quần áo nam : \r\n-  Đối với sản phẩm quần áo mới mua về, nên giặt tay lần đâu tiên để tránh phai màu sang quần áo khác\r\n-  Khi giặt nên lộn mặt trái ra để đảm bảo độ bền \r\n-  Sản phẩm phù hợp cho giặt máy/giặt tay\r\n - Không giặt chung đồ Trắng và đồ Tối màu \r\n\r\n???? FAVITI CAM KẾT\r\nSản phẩm 100% giống mô tả. Kiểu dáng hoàn toàn giống ảnh mẫu\r\nÁo được kiểm tra kĩ càng, cẩn thận và tư vấn nhiệt tình trước khi gói hàng giao cho Quý Khách\r\nHàng có sẵn, giao hàng ngay khi nhận được đơn \r\nHoàn tiền nếu sản phẩm không giống với mô tả\r\nChấp nhận đổi hàng khi size không vừa\r\nGiao hàng trên toàn quốc \r\nHỗ trợ đổi trả theo quy định của Shopee\r\nDo màn hình và điều kiện ánh sáng khác nhau, màu sắc thực tế của sản phẩm có thể chênh lệch khoảng 3-5%</span><br></p>', '2021-11-02 12:38:57', '2021-11-02 12:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(2, 'Admin', 'Quản trị hệ thống'),
(3, 'Nhân viên bán hàng', 'Quản lý đơn hàng'),
(6, 'Người dùng', 'Người dùng');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `address`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(9, 'Dương Văn Quang', 'quangbk10@gmail.com', '0365832107', 'Thanh Trí, Minh Phú, Sóc Sơn, Hà Nội', '2407', 2, '2021-10-25 14:59:44', '2021-10-25 22:10:04'),
(10, 'Nguyễn Trọng Quyết', 'quyet@gmail.com', '123456', '- Phường Lộc Phát - Thành Phố Bảo Lộc - Lâm Đồng', '2407', NULL, '2021-10-29 07:24:23', '2021-10-29 14:24:23'),
(11, 'Trần Thị Thu Hằng', 'hang@gmail.com', '01234567890', 'Thanh Trí, Minh Phú, Sóc Sơn, Hà Nội', '2407', NULL, '2021-11-03 06:49:32', '2021-11-03 13:49:32'),
(12, 'quangtlu', 'jakbc@gmail.com', '1', 'Thanh Trí, Minh Phú, Sóc Sơn, Hà Nội', '2407', NULL, '2021-11-03 10:05:28', '2021-11-03 17:05:28'),
(13, 'Nguyễn Trọng Quyết A', 'jkbavdjsb@gmail.com', '12345', 'Thanh Trí, Minh Phú, Sóc Sơn, Hà Nội', '2407', NULL, '2021-11-03 14:52:33', '2021-11-03 21:52:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_lv1`
--
ALTER TABLE `category_lv1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_lv2`
--
ALTER TABLE `category_lv2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_category` (`category_lv1ID`);

--
-- Indexes for table `category_lv3`
--
ALTER TABLE `category_lv3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_category_lv3` (`category_lv2ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_3` (`category_lv3ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_role_user` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_lv1`
--
ALTER TABLE `category_lv1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_lv2`
--
ALTER TABLE `category_lv2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category_lv3`
--
ALTER TABLE `category_lv3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_lv2`
--
ALTER TABLE `category_lv2`
  ADD CONSTRAINT `FK_category` FOREIGN KEY (`category_lv1ID`) REFERENCES `category_lv1` (`id`);

--
-- Constraints for table `category_lv3`
--
ALTER TABLE `category_lv3`
  ADD CONSTRAINT `FK_category_lv3` FOREIGN KEY (`category_lv2ID`) REFERENCES `category_lv2` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`category_lv3ID`) REFERENCES `category_lv3` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_role_user` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
