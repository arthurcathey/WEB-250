-- --------------------------------------------------------
-- Table structure for table `birds`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `birds`;

CREATE TABLE `birds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `common_name` varchar(100) NOT NULL,
  `habitat` varchar(100) NOT NULL,
  `food` varchar(100) NOT NULL,
  `conservation_id` tinyint(4) NOT NULL,
  `backyard_tips` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Data for table `birds`
-- --------------------------------------------------------
INSERT INTO `birds` (`id`, `common_name`, `habitat`, `food`, `conservation_id`, `backyard_tips`) VALUES
(1, 'Northern Cardinal', 'Woodlands and gardens', 'Seeds, fruits, insects', 2, 'Provide seed feeders and shrubs.'),
(2, 'Blue Jay', 'Forests and suburban areas', 'Nuts, seeds, insects', 3, 'Offer suet and peanut feeders.'),
(3, 'American Robin', 'Lawns and gardens', 'Worms, fruits, insects', 2, 'Keep lawns moist for worms.');
