

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `contact` text NOT NULL,
  `address` varchar(500) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `role` varchar(11) NOT NULL,
  `bank_name` text NOT NULL,
  `acc_name` text NOT NULL,
  `acc_no` text NOT NULL,
  `amount` float NOT NULL,
  `total_amount` varchar(150) NOT NULL,
  `app_code` int(11) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL,
  `admin_user` int(11) NOT NULL,
  `desig` int(11) NOT NULL,
  `incentive` int(11) NOT NULL,
  `salary` float NOT NULL,
  `leavess` int(30) NOT NULL,
  `jdate` date NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO admin VALUES("1","0","mayurik","mayuri.infospace@gmail.com","aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357","Mayuri","K","Female","","9529230459","India","ddsds.jpg","2018-04-30","admin","Bank","Admin","1111","168276","","27057","2024-11-02 17:44:26","0","1","0","0","0","0","2024-10-02","2024-10-28");
INSERT INTO admin VALUES("62","2","","hitesh@gmail.com","9bbfbd276fe2fde07fd723acdf125d2e2522d8ba3b54720c013125a6087e769b","Hitesh","Bagul","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:08:52","0","0","0","0","14000","5","2024-10-01","2024-10-28");
INSERT INTO admin VALUES("63","3","","sayali@gmail.com","8e4f0c5d632cd69e83ae500d6a2ee33880209c316564631b1c50a5ee161d1a90","Sayali","Patil","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:36:42","0","0","0","0","50000","5","2024-10-10","2024-10-28");
INSERT INTO admin VALUES("64","1","","mayur@gmail.com","cbd1ce220af5ae776ef55aa9b03476eb7f7896a42338d74a67d634bc4e6edc40","Mayur","Mehata","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:10:19","0","0","0","0","15000","5","2024-10-31","2024-10-28");
INSERT INTO admin VALUES("65","3","","nakul@gmail.com","2508a01a5d64d14cac9be9b61bd88ac5861b14714672faa90e4e72b818d83f0a","Nakul","Sharma","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:28:13","0","0","0","0","4000","5","2024-10-24","2024-10-28");
INSERT INTO admin VALUES("66","2","","sneha@gmail.com","7c58dc74cc6c5239201811ec4c974501d27ce8d99a0028990166a8c794325382","Sneha","Patel","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:29:37","0","0","0","0","400","5","2024-11-08","2024-10-28");
INSERT INTO admin VALUES("67","2","","kavya@gmail.com","a298088db584c17791f480107eb2224affbe49510d4d4624cccfe29a35688f04","Kavya","Reddy","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:30:08","0","0","0","0","700","5","2024-11-15","2024-10-28");
INSERT INTO admin VALUES("68","2","","ananya@gmail.com","7248bec25f6e0daba8a2ca0fb92d47f858c56ba54109b4b1ec19e2fcb391eda4","Ananya","Iyer","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:30:35","0","0","0","0","1000","5","2024-11-09","2024-10-28");
INSERT INTO admin VALUES("69","2","","aditya@gmail.com","57213ef958a23178e4270c79fabf26ce4e72d67875c31acf4b3818f226f92ae4","Aditya","Rao","","","","","","0000-00-00","admin","","","","0","","0","2024-10-28 09:31:01","0","0","0","0","2000","6","2024-11-07","2024-10-28");
INSERT INTO admin VALUES("70","2","","sudama@gmail.com","658b4e35370cbcb1e1f6c7131d2c6e3dd90b6280091c35909ffe70979daaf799","Sudama","Dharmadhikari","","","","","","0000-00-00","admin","","","","0","","0","2024-11-02 17:47:33","0","0","0","0","300","8","2024-11-02","2024-11-02");



CREATE TABLE `borrow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp` int(11) NOT NULL,
  `amount` float NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `delete_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO borrow VALUES("1","63","500","October","2024","Personal","2024-10-28","0");
INSERT INTO borrow VALUES("2","63","400","October","2024","Personal
","2024-10-28","0");
INSERT INTO borrow VALUES("3","64","500","October","2024","Personal","2024-10-28","0");
INSERT INTO borrow VALUES("4","69","2000","October","2024","Personal","2024-10-28","0");
INSERT INTO borrow VALUES("5","65","500","October","2024","For coffee","2024-10-28","0");
INSERT INTO borrow VALUES("6","70","500","November","2024","for petrol","2024-11-02","0");



CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `delete_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customer VALUES("1","ttttttttttttttt","tttttt@gmail.com ","3434535 ","ttttttttttpt","1");
INSERT INTO customer VALUES("2","Danish Surana ","","56786545678  ","Nashik  ","0");
INSERT INTO customer VALUES("3","Sujata Hiray","","5656554545","nashik","0");
INSERT INTO customer VALUES("4","Meghraj Dusane","","7894561236","Pune","0");
INSERT INTO customer VALUES("5","Manisha Derore","","7894561236","nashik","0");
INSERT INTO customer VALUES("6","dsfsdfsdfsd","","","","0");
INSERT INTO customer VALUES("7","dsfdsfsdfsdf","","","","0");



CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `delete_status` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO groups VALUES("1","Leave Manager","Manages leaves","0");
INSERT INTO groups VALUES("2","Salary ","Salary Manager","0");
INSERT INTO groups VALUES("3","Borrow Manager","Manages borrowe amount","0");



CREATE TABLE `installement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added_date` date NOT NULL,
  `inv_no` varchar(200) NOT NULL,
  `insta_amt` int(100) NOT NULL,
  `due_total` int(11) NOT NULL,
  `ptype` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) NOT NULL,
  `month` varchar(150) NOT NULL,
  `year` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=paid 2=unpaid',
  `total` int(50) NOT NULL,
  `status` int(11) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO leaves VALUES("1","63","October","2024","2024-10-01","2","5","1","DONE","0");
INSERT INTO leaves VALUES("2","63","October","2024","2024-10-19","1","4","0","","0");
INSERT INTO leaves VALUES("3","62","October","2024","2024-10-03","2","5","1","Approved By Admin","0");
INSERT INTO leaves VALUES("4","62","October","2024","2024-10-31","1","4","0","","0");
INSERT INTO leaves VALUES("5","69","October","2024","2024-12-24","1","6","0","","0");
INSERT INTO leaves VALUES("6","69","October","2024","2025-01-30","2","6","0","","0");
INSERT INTO leaves VALUES("7","67","October","2024","2024-10-02","2","5","0","","0");
INSERT INTO leaves VALUES("8","65","October","2024","2025-01-09","1","5","1","approced","0");
INSERT INTO leaves VALUES("9","65","October","2024","2025-03-05","2","5","1","Approved","0");
INSERT INTO leaves VALUES("10","70","November","2024","2024-11-01","1","8","1","approved by Mayuri","0");
INSERT INTO leaves VALUES("11","70","November","2024","2024-11-03","2","8","0","","0");



CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(600) NOT NULL,
  `short_title` varchar(600) NOT NULL,
  `logo` text NOT NULL,
  `footer` text NOT NULL,
  `currency_code` varchar(600) NOT NULL,
  `currency_symbol` varchar(600) NOT NULL,
  `login_logo` text NOT NULL,
  `invoice_logo` text NOT NULL,
  `background_login_image` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO manage_website VALUES("1","NEXT-EMP BY MAYURI K.","","Lars TRANSPORTS.png","Developer","","Rs.","Lars TRANSPORTS.png","","Untitled6.jpg","0");



CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `month` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO month VALUES("1","January");
INSERT INTO month VALUES("2","February");
INSERT INTO month VALUES("3","March");
INSERT INTO month VALUES("4","April");
INSERT INTO month VALUES("5","May");
INSERT INTO month VALUES("6","June");
INSERT INTO month VALUES("7","July");
INSERT INTO month VALUES("8","August");
INSERT INTO month VALUES("9","September");
INSERT INTO month VALUES("10","October");
INSERT INTO month VALUES("11","November");
INSERT INTO month VALUES("12","December");



CREATE TABLE `permission_role` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `permission_id` int(50) NOT NULL,
  `group_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO permission_role VALUES("1","25","1");
INSERT INTO permission_role VALUES("2","25","2");
INSERT INTO permission_role VALUES("3","31","2");
INSERT INTO permission_role VALUES("4","24","3");



CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `operation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO permissions VALUES("24","Borrow","Borrow","Borrow");
INSERT INTO permissions VALUES("25","Leaves","Leaves","Leaves");
INSERT INTO permissions VALUES("26","Salary","Salary","Salary");
INSERT INTO permissions VALUES("29","User","User","User");
INSERT INTO permissions VALUES("30","Role","Role","Role");
INSERT INTO permissions VALUES("31","Reports","Reports","Reports");
INSERT INTO permissions VALUES("32","Settings","Settings","Settings");
INSERT INTO permissions VALUES("33","Author","Author","Author");
INSERT INTO permissions VALUES("34","Backup Database","Backup Database","Backup Database");



CREATE TABLE `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp` varchar(200) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `leave` int(11) NOT NULL,
  `borrow` float NOT NULL,
  `actual` float NOT NULL,
  `final` float NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO salary VALUES("1","63","October","2024","1","900","50000","1499100","2024-10-28");
INSERT INTO salary VALUES("2","62","October","2024","1","0","14000","420000","2024-10-28");
INSERT INTO salary VALUES("3","69","October","2024","0","2000","2000","60000","2024-10-28");
INSERT INTO salary VALUES("4","67","October","2024","0","0","700","21700","2024-10-28");
INSERT INTO salary VALUES("5","65","October","2024","1","500","4000","119500","2024-10-28");
INSERT INTO salary VALUES("7","70","November","2024","0","500","300","8500","2024-11-02");



CREATE TABLE `tbl_alerts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tbl_alerts VALUES("1","001","Invalid email or password","warning");
INSERT INTO tbl_alerts VALUES("2","002","Settings are updated","success");
INSERT INTO tbl_alerts VALUES("3","003","Record Added Successfully","success");
INSERT INTO tbl_alerts VALUES("4","004","Record Successfully Updated","success");
INSERT INTO tbl_alerts VALUES("5","005","Record Sudccessfully Deleted","success");
INSERT INTO tbl_alerts VALUES("6","006","Class has been registered","success");
INSERT INTO tbl_alerts VALUES("7","007","Class has been deleted","success");
INSERT INTO tbl_alerts VALUES("8","008","Class has been updated","success");
INSERT INTO tbl_alerts VALUES("9","009","Subject has been registered","success");
INSERT INTO tbl_alerts VALUES("10","010","Subject have been deleted","success");
INSERT INTO tbl_alerts VALUES("11","011","Subject has been updated","success");
INSERT INTO tbl_alerts VALUES("12","012","Email address is already registered","warning");
INSERT INTO tbl_alerts VALUES("13","013","Student have been registered","success");
INSERT INTO tbl_alerts VALUES("14","014","Student have been deleted","success");
INSERT INTO tbl_alerts VALUES("15","015","Student have been updated","success");
INSERT INTO tbl_alerts VALUES("16","016","School info has been updated","success");
INSERT INTO tbl_alerts VALUES("17","017","Logo image must be 400 X 400 Pixels","warning");
INSERT INTO tbl_alerts VALUES("18","018","Exam have been registered","success");
INSERT INTO tbl_alerts VALUES("19","019","Enroll number has been deleted","success");
INSERT INTO tbl_alerts VALUES("20","020","Exam has been updated","success");
INSERT INTO tbl_alerts VALUES("21","021","Question has been added","success");
INSERT INTO tbl_alerts VALUES("22","022","Profile have been updated","success");
INSERT INTO tbl_alerts VALUES("23","023","Password has been updated","success");
INSERT INTO tbl_alerts VALUES("24","024","Account was not found","danger");
INSERT INTO tbl_alerts VALUES("25","025","Open your email to continue","info");
INSERT INTO tbl_alerts VALUES("26","026","An error occurred while sending e-mail","warning");
INSERT INTO tbl_alerts VALUES("27","027","Assessment have been re-activated","success");
INSERT INTO tbl_alerts VALUES("28","028","All assessments have been re-acativate","success");
INSERT INTO tbl_alerts VALUES("29","029","Exam have been deleted","success");
INSERT INTO tbl_alerts VALUES("30","030","Notice have been pinned","success");
INSERT INTO tbl_alerts VALUES("31","031","Notice have been deleted","success");
INSERT INTO tbl_alerts VALUES("32","032","Please add some question before activating the exam","warning");
INSERT INTO tbl_alerts VALUES("33","033","Exam has been set active","success");
INSERT INTO tbl_alerts VALUES("34","034","Exam has been set inactive","success");
INSERT INTO tbl_alerts VALUES("35","035","Question has been deleted","success");
INSERT INTO tbl_alerts VALUES("36","036","Question has been updated","success");



CREATE TABLE `tbl_deduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `deduct_quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_deduct VALUES("1","30","1","2024-09-30","2024-09-30 15:17:37");



CREATE TABLE `tbl_email_config` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `mail_driver_host` varchar(5000) NOT NULL,
  `mail_port` int(50) NOT NULL,
  `mail_username` varchar(50) NOT NULL,
  `mail_password` varchar(30) NOT NULL,
  `mail_encrypt` varchar(300) NOT NULL,
  `approvestatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO unit VALUES("1","ttttttttt","Deactive","1");
INSERT INTO unit VALUES("2","test","Active","1");
INSERT INTO unit VALUES("3","Set","Active","0");
INSERT INTO unit VALUES("4","Pair","Active","0");
INSERT INTO unit VALUES("5","Piece","Active","0");
INSERT INTO unit VALUES("6","Meter","Active","0");
INSERT INTO unit VALUES("7","1 Meter","Active","1");
INSERT INTO unit VALUES("8","10 Meter","Active","1");
INSERT INTO unit VALUES("9","XL","Active","1");



CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO year VALUES("1","2020");
INSERT INTO year VALUES("2","2021");
INSERT INTO year VALUES("3","2022");
INSERT INTO year VALUES("4","2023");
INSERT INTO year VALUES("5","2024");
INSERT INTO year VALUES("6","2025");
INSERT INTO year VALUES("7","2026");
INSERT INTO year VALUES("8","2027");
INSERT INTO year VALUES("9","2028");
INSERT INTO year VALUES("10","2029");
INSERT INTO year VALUES("11","2030");
INSERT INTO year VALUES("12","2031");
INSERT INTO year VALUES("13","2032");
INSERT INTO year VALUES("14","2033");
INSERT INTO year VALUES("15","2034");
INSERT INTO year VALUES("16","2035");
INSERT INTO year VALUES("17","2036");
INSERT INTO year VALUES("18","2037");
INSERT INTO year VALUES("19","2038");
INSERT INTO year VALUES("20","2039");
INSERT INTO year VALUES("21","2040");

