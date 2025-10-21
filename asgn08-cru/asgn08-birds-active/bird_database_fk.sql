--
-- Create the `bird` database and its tables
--

DROP DATABASE IF EXISTS `bird`;
CREATE DATABASE `bird`;
USE `bird`;

--
-- Table structure for table `birds`
--
DROP TABLE IF EXISTS `birds`;
CREATE TABLE `birds` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `common_name` VARCHAR(100) NOT NULL,
  `habitat` VARCHAR(100) NOT NULL,
  `food` VARCHAR(100) NOT NULL,
  `conservation_id` TINYINT(4) NOT NULL,
  `backyard_tips` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `birds`
--
INSERT INTO `birds` (`id`, `common_name`, `habitat`, `food`, `conservation_id`, `backyard_tips`) VALUES
(8, 'Carolina Wren', 'Open woodlands', 'Insects', 1, 'Carolina Wrens visit suet-filled feeders during winter.'),
(9, 'Tufted Titmouse', 'Forests', 'Insects', 1, 'Tufted Titmouse are regulars at backyard bird feeders, especially in winter. They prefer sunflower seeds but will eat suet, peanuts, and other seeds as well.'),
(10, 'Ruby-Throated Hummingbird', 'Open woodlands', 'Nectar', 1, 'You can attract Ruby-throated Hummingbirds to your backyard by setting up hummingbird feeders or by planting tubular flowers.'),
(11, 'Eastern Towhee', 'Scrub', 'Omnivore', 1, 'Eastern Towhees are likely to visit – or perhaps live in – your yard if you’ve got brushy, shrubby, or overgrown borders.'),
(12, 'Indigo Bunting', 'Open woodlands', 'Insects', 1, 'You can attract Indigo Buntings to your yard with feeders, particularly with small seeds such as thistle or nyjer.');

--
-- Table structure for table `images`
--
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `bird_id_fk` INT(11) NOT NULL,
  `fie_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_images_fie_name` (`fie_name`),
  KEY `idx_images_bird_id_fk` (`bird_id_fk`),
  CONSTRAINT `fk_images_birds`
    FOREIGN KEY (`bird_id_fk`) REFERENCES `birds` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
