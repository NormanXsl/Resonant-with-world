INSERT INTO `client` (`client_id`, `client_fname`, `client_lname`, `client_address`, `client_phone`, `client_email`, `client_subscribed`, `client_other_information`) VALUES
(1, 'Pansy', 'Rodriquez', '893 Ultricies St.', '(08) 8697 1489', 'pansy43@gmail.com', 0, 'dont check email regularly '),
(2, 'Desmond', 'Millers', '979-7239 Donec Rd.', '(06) 1247 9875', 'desmond12@gmail.com', 0, 'prefer contact via phone call'),
(3, 'Ezio', 'Auditore', '2165 Proin St.', '(03) 3078 6348', 'ezio41@gmail.com', 0, 'prefers contact via email'),
(4, 'Barrack', 'Obama', '3750 Interdum. Rd.', '(07) 6110 5242', 'bobama2@gmail.com', 1, ''),
(5, 'Bob', 'Muyskens', 'P.O. Box 512, 4316 Nibh Ave', '(06) 0212 5971', '"bobm221@gmail.com', 0, ''),
(6, 'Wade', 'Barnes', '795-9308 Egestas. Av.', '(01) 8580 7419', 'wba213@gmail.com', 0, ''),
(7, 'Mark', 'Fischbach', '243 Woodland Avenue', '(06) 6565 1725', 'mfish214@gmail.com', 0, ''),
(8, 'Ellen', 'Fox', 'P.O. Box 542, 4256 Sollicitudin Street', '(05) 4047 9934', 'elefox214@gmail.com', 0, ''),
(9, 'James', 'Dean', '2658 Henery Street', '(02) 0476 1253', 'jdea214@gmail.com', 1, ''),
(10, 'Garrett', 'Joseph', 'Ap #543-7256 Nibh. Rd.', '(08) 1212 2123', 'gjseph56@gmail.com', 0, ''),
(11, 'Gareth', 'Hughes', 'Ap #777-5285 Duis Ave', '(07) 8657 6249', 'ghughs850@gmail.com', 1, 'Have budget under $500'),
(12, 'Barry', 'Polar', 'P.O. Box 164, 3805 Nisl. Ave', '(02) 5560 5902', 'bpolar3891@gmail.com', 0, ''),
(13, 'Jay', 'Nathansfield', 'P.O. Box 495, 2508 Phasellus St.', '(03) 0419 1166', 'jnathan1235@gmail.com', 0, ''),
(14, 'Anita', 'Sweet', '1889 Reeves Street', '(07) 6761 1156', 'aniswee1872@gmail.com', 1, ''),
(15, 'Gerald', 'Danpark', 'Ap #876-1382 Eu, Rd.', '(03) 7134 7616', 'gdanp1245@gmail.com', 0, ''),
(16, 'Edward', 'Elric', 'P.O. Box 794, 2379 Sed St.', '(05) 3328 8703', 'eeric12895@gmail.com', 0, 'lives far from our store'),
(17, 'Kuroko', 'Tetsuya', '2433 McVaney Road', '(05) 0157 4647', 'ktet1290@gmail.com', 0, ''),
(18, 'Aomine', 'Daiki', 'Ap #247-9319 Lober, Street', '(02) 5686 0491', 'adai1849@gmail.com', 0, ''),
(19, 'Jim', 'Carrey', '2629 Hamilton Drive', '(05) 7901 1523', 'jcare125@gmail.com', 0, ''),
(20, 'Rosie', 'Odonnell', '4676 Geraldine Lane', '(07) 9631 7338', 'rdonel1782@gmail.com', 1, 'passionate client, requires things to be perfect');


INSERT INTO `product` (`product_id`, `product_UPC`, `product_name`, `product_price`) VALUES
(1, '540289875492', 'SonyA7S3', 4570.00),
(2, '863419479376', 'SonyA7S3_bundle', 5380.00),
(3, '108328284709', 'S28-75mm', 950.00),

(4, '142773977994', 'SonyA7M3', 3120.00),
(5, '607717113149', 'SonyA7M3_bundle', 3580.00),
(6, '637673554053', 'FE28-70mm', 620.00),

(7, '937026209142', 'NikonZ6ii', 3620.00),
(8, '357427430300', 'NikonZ6ii_bundle', 4100.00),
(9, '327810725141', 'Z24-200mm', 730.00),

(10, '626094279877', 'CanonR6', 3640.00),
(11, '966717715162', 'CanonR6_bundle', 4215.00),
(12, '312777760236', 'RF24-105mm', 720.00),

(13, '743098316255', 'PanasonicS5', 2860.00),
(14, '951181629346', 'PanasonicsS5_bundle', 3420.00),
(15, '194264958607', '20-60mm', 750.00),

(16, '104555281081', 'FujifilmXT4', 2880.00),
(17, '189905219640', 'FujifilmXT4_bundle', 3480.00),
(18, '784459205314', '18-135mm', 750.00),

(19, '333754531881', 'white frame', 60.00),
(20, '271849622208', 'white wide frame', 50.00),
(21, '136556470330', 'black frame', 65.00),
(22, '206125334431', 'wooden fram', 65.00);

 
INSERT INTO `photo_shoot` (`photo_shoot_id`, `photo_shoot_name`, `photo_shoot_description`, `photo_shoot_date', 'photo_shoot_time`, `photo_shoot_quote`, `photo_shoot_other_information`, `client_fk`) VALUES
(1, 'Highschool Graduation photoshoot', 'Graduation photoshoot that consists of two individuals, the sons of the client', 'Oct 2, 2021', '9:15', '83585551617', '', 1),
(2, 'Vacation photoshoot', '', 'Feb 15, 2022', '13:00', '74282448472', '', 2),
(3, 'Wedding photoshoot', '', 'Jun 25, 2022', '9:00','93390536576' ,'' , 3),
(4, 'Music video photoshoot', '', 'Oct 31, 2021', '10:00', '47854461697' ,'client available only in October' , 4),
(5, 'Family trip photoshoot', '', 'May 7, 2022', '11:10', '79471002317' ,'' , 5),
(6, 'Anniversary photoshoot', '', 'Apr 24, 2022', '9:30','93718149110', '', 6),
(7, 'Reunion photoshoot', '', 'Jan 17, 2022', '11:00', '15777140084', '', 7),
(8, 'Celebration Party photoshoot', '', 'Jan 28, 2022', '10:30', '21700403572', '', 8),
(9, 'Birthday photoshoot', '', 'Dec 26, 2021', '15:00', '639189385', '', 9),
(10, 'Beach photoshoot', '', 'Dec 6, 2021', '14:00', '21993643527', '' , 10),
(11, 'Fashion photoshoot', '', 'Jul 26, 2022', '9:00', '75744130479', '' , 11),
(12, 'Promotion photoshoot', '', 'Dec 20, 2021', '14:00', '48487806906' ,'' , 12),
(13, 'Event photoshoot', '', 'Oct 26, 2021','15:00', '65037576214' , '', 13),
(14, 'University Gradutation photoshoot', '', 'Nov 18, 2021','17:00', '39759532524' ,'' , 14),
(15, 'Anniversary photoshoot', '', 'Apr 5, 2022','12:30', '83742795396', '' , 15),
(16, 'Birthday photoshoot', '', 'Sep 13, 2022','14:00', '48899035437', '' , 16),
(17, 'Wedding photoshoot', '', 'Apr 20, 2022','13:05', '34575001384' ,'' , 17),
(18, 'Promotion photoshoot', '', 'Jan 19, 2022','15:00', '50898164697', '' , 18),
(19, 'Single-Product photoshoot', '', 'Jan 2, 2022','9:00', '29923015136', '' , 19),
(20, 'Event photoshoot', '', 'Mar 18, 2022','14:00', '24579580878', '' , 20),
(21, 'Beach Party photoshoot', '', 'Dec 3, 2021','13:30', '57612649620', '' , 20),
(22, 'Anniversary photoshoot', '', 'May 23, 2022','9:45', '18107073583', '' , 11),
(23, 'Creative photoshoot', '', 'Sep 2, 2022','7:30', '92126573918', '' , 12),
(24, 'Creative photoshoot', '', 'Feb 6, 2022','14:30', '53668866777', '' , 5),
(25, 'Single-Product photoshoot', '', 'Mar 29, 2022','15:45', '64248237568', '' , 9),
(26, 'Fashion photoshoot', '', 'Jul 25, 2022','11:45', '88876027304', '' , 6),
(27, 'Creative photoshoot', '', 'Jul 16, 2022','11:30', '14042506860', '' , 20);

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Camera'),
(2, 'Camera Lens'),
(3, 'Picture frames');

INSERT INTO `product_category` (`category_fk`, `product_fk`) VALUES
(1, 1),
(1, 4),
(1, 7),
(1, 10),
(1, 13),
(1, 16),
(1, 2),
(2, 2),
(1, 5),
(2, 5),
(1, 8),
(2, 8),
(1, 11),
(2, 11),
(1, 14),
(2, 14),
(1, 17),
(2, 17),
(2, 3),
(2, 6),
(2, 9),
(2, 12),
(2, 15),
(2, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22);

INSERT INTO `product_image` (`image_id`, `product_image_filename`, `product_fk`) VALUES
(1, '11.png', 1),
(2, '12.png', 1),
(3, '21.png', 2),
(4, '22.png', 2),
(5, '31.png', 3),
(6, '32.png', 3),
(7, '41.png', 4),
(8, '42.png', 4),
(9, '51.png', 5),
(10, '52.png', 5),
(11, '61.png', 6),
(12, '62.png', 6),
(13, '71.png', 7),
(14, '72.png', 7),
(15, '81.png', 8),
(16, '82.png', 8),
(17, '91.png', 9),
(18, '92.png', 9),
(19, '101.png', 10),
(20, '102.png', 10),
(21, '111.png', 11),
(22, '112.png', 11),
(23, '121.png', 12),
(24, '122.png', 12),
(25, '131.png', 13),
(26, '132.png', 13),
(27, '141.png', 14),
(28, '142.png', 14),
(29, '151.png', 15),
(30, '152.png', 15),
(31, '161.png', 16),
(32, '162.png', 16),
(33, '171.png', 17),
(34, '172.png', 17),
(35, '181.png', 18),
(36, '182.png', 18),
(37, '191.png', 19),
(38, '192.png', 19),
(39, '201.png', 20),
(40, '202.png', 20),
(41, '211.png', 21),
(42, '212.png', 21),
(43, '221.png', 22),
(44, '222.png', 22);

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'Kim', '', 'odio.phasellus@metusurna.edu'),
(2, 'Kyrie', '+8x.X8{,5p^!rB!m', 'velit.justo@phasellus.org'),
(3, 'Norton', 'HtR>gmb4%=MTKZ2Z', 'aenean@risus.com'),
(4, 'Marius', 'Vx=)cjj>72QvxEQ2', 'purus@integerinmagna.net');
