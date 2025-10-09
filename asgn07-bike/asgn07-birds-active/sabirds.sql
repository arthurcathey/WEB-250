
-- --------------- FOR LOCALHOST ONLY -----------------------------------------
-- Use this database and user creation for your local database
-- You will need to create a database and user manually on your webhost

DROP DATABASE IF EXISTS sabirds;
CREATE DATABASE IF NOT EXISTS sabirds;
USE sabirds;

DROP USER 'sabirdsUser'@'localhost';
CREATE USER 'sabirdsUser'@'localhost' IDENTIFIED BY 'cassowary';
GRANT ALL ON *.* TO 'sabirdsUser'@'localhost';
FLUSH PRIVILEGES;
-- ------------------------------------------------------------------------------

--
-- Table structure for table `birds`
--


CREATE TABLE `birds` (
  `id` int(11) NOT NULL,
  `common_name` varchar(100) NOT NULL,
  `habitat` varchar(100) NOT NULL,
  `food` varchar(100) NOT NULL,
  `conservation_id` tinyint(4) NOT NULL,
  `backyard_tips` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `birds`
--

INSERT INTO `birds` (`id`, `common_name`, `habitat`, `food`, `conservation_id`, `backyard_tips`) VALUES
(1, 'Carolina Wren', 'Open woodlands', 'Insects', 1, 'Carolina Wrens visit suet-filled feeders during winter.'),
(2, 'Tufted Titmouse', 'Forests', 'Insects', 1, 'Tufted Titmouse are regulars at backyard bird feeders, especially in winter. They prefer sunflower seeds but will eat suet, peanuts, and other seeds as well.'),
(3, 'Ruby-Throated Hummingbird', 'Open woodlands', 'Nectar', 1, 'You can attract Ruby-throated Hummingbirds to your backyard by setting up hummingbird feeders or by planting tubular flowers.'),
(4, 'Eastern Towhee', 'Scrub', 'Omnivore', 1, 'Eastern Towhees are likely to visit – or perhaps live in – your yard if you’ve got brushy, shrubby, or overgrown borders.'),
(5, 'Indigo Bunting', 'Open woodlands', 'Insects', 1, 'You can attract Indigo Buntings to your yard with feeders, particularly with small seeds such as thistle or nyjer.');

-- --------------------------------------------------------

--
-- Table structure for table `bird_images`
--

CREATE TABLE `bird_images` (
  `id` int(11) NOT NULL,
  `bird_id_fk` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bird_images`
--

INSERT INTO `bird_images` (`id`, `bird_id_fk`, `image_name`) VALUES
(2, 1, 'carolina-wren-01.jpg'),
(3, 2, 'tufted-titmouse-01.jpg'),
(4, 3, 'ruby-throated-hummingbird-01.jpg'),
(5, 4, 'eastern-towhee-01.jpg'),
(6, 5, 'indigo-bunting-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_level` char(1) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `user_level`, `hashed_password`) VALUES
(2, 'Billy', 'Baloney', 'billy@playhouse.com', 'billybaloney', '', '$2y$10$LEFWp0b1Su8DlNHyuXHJ6.pf1XZBUYTRZtDVfHsexOAsV9qPb370O'),
(3, 'Cowboy', 'Curtis', 'cowboy@playhouse.com', 'cowboycurtis', '', '$2y$10$RF7bjUyuF.0xbFCE2ZERmuTtxiPcBnSvtf4/U.jekSER9nbu1QHFq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birds`
--
ALTER TABLE `birds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bird_images`
--
ALTER TABLE `bird_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bird_id_fk` (`bird_id_fk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birds`
--
ALTER TABLE `birds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bird_images`
--
ALTER TABLE `bird_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bird_images`
--
ALTER TABLE `bird_images`
  ADD CONSTRAINT `bird_images_ibfk_1` FOREIGN KEY (`bird_id_fk`) REFERENCES `birds` (`id`);

