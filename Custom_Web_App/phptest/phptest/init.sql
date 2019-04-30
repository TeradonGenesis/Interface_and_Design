CREATE DATABASE IF NOT EXISTS myDB;

use myDB; 

CREATE TABLE IF NOT EXISTS `Buy` (
	memberID int(11),
	username varchar(255) NOT NULL,
	product VARCHAR(30) NOT NULL,
	price_each INT(5),
	quantity INT(1),
	totalPrice INT(10),
	date TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Sell` (
	sellNo INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) NOT NULL,
	product VARCHAR(30) NOT NULL,
	description VARCHAR(255) NOT NULL,
	price_each INT(5),
	quantity INT(10),
	salespic blob NOT NULL,
	date TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `VIP` (
	member_id INT AUTO_INCREMENT PRIMARY KEY,
	fname VARCHAR(40),
	lname VARCHAR(40),
	gender VARCHAR(1),
	email VARCHAR(40),
	phone VARCHAR(20),
	date TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `members` (
  memberID int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  moderator boolean,
  active varchar(255) NOT NULL,
  resetToken varchar(255) DEFAULT NULL,
  resetComplete varchar(3) DEFAULT 'No',
  money int(11) NOT NULL,
  PRIMARY KEY (memberID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profile` (
  memberID int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  age varchar(11) NOT NULL,
  interest varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  country varchar(255) NOT NULL,
  phone VARCHAR(20),
  about VARCHAR(255) NOT NULL,
  PRIMARY KEY (memberID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `forum` (
  memberID int(11),
  postID int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  post varchar(255) NOT NULL,
  date TIMESTAMP,
  PRIMARY KEY (postID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `transaction` (
  `memberID` int(11) DEFAULT NULL,
  `sellNo` int(11) NOT NULL,
  `usernameBuyer` varchar(255) NOT NULL,
  `usernameSeller` varchar(255) NOT NULL,
  `product` varchar(30) NOT NULL,
  `price_each` int(5) DEFAULT NULL,
  `quantity` int(1) DEFAULT NULL,
  `totalPrice` int(10) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (transID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	




		