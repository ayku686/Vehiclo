
CREATE TABLE `buyer` (
  `bid` int(100) NOT NULL AUTO_INCREMENT,
  `bname` varchar(100) NOT NULL,
  `busername` varchar(100) NOT NULL,
  `bpassword` varchar(100) NOT NULL,
  `bhash` varchar(100) NOT NULL,
  `bemail` varchar(100) NOT NULL,
  `bmobile` varchar(100) NOT NULL,
  `baddress` text NOT NULL,
  `bactive` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Seller` (
  `sid` int(255) NOT NULL ,
  `sname` varchar(255) NOT NULL,
  `susername` varchar(255) NOT NULL,
  `spassword` varchar(255) NOT NULL,
  `shash` varchar(255) NOT NULL,
  `semail` varchar(255) NOT NULL,
  `smobile` varchar(255) NOT NULL,
  `saddress` text NOT NULL,
  `sactive` int(255) NOT NULL DEFAULT '0',
  `srating` int(11) NOT NULL DEFAULT '0',
  `sicExt` varchar(255) NOT NULL DEFAULT 'png',
  `picStatus` int(10) NOT NULL DEFAULT '0',
   PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sproduct` (
  `sid` int(255) NOT NULL ,
  `pid` int(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `pcat` varchar(255) NOT NULL,
  `pinfo` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `pimage` varchar(255) NOT NULL DEFAULT 'blank.png',
  `picStatus` int(10) NOT NULL DEFAULT '0',
    PRIMARY KEY (`pid`),
    FOREIGN KEY (`sid`) REFERENCES `Seller` (`sid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `favourites` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  FOREIGN KEY (`bid`) REFERENCES `buyer` (`bid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `review` (
  `pid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text NOT NULL,
  FOREIGN KEY (`pid`) REFERENCES `sproduct` (`pid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `transaction` (
  `tid` int(10) NOT NULL ,
  `bid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
   PRIMARY KEY (`tid`),
   FOREIGN KEY (`bid`) REFERENCES `buyer` (`bid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Seller`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `sproduct`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `transaction`
  MODIFY `tid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

DELIMITER //
CREATE TRIGGER check_favorites_limit
BEFORE INSERT ON favourites
FOR EACH ROW
BEGIN
    DECLARE fav_count INT;
    
    -- Get the count of favorites for the user
    SELECT COUNT(*) INTO fav_count
    FROM favourites
    WHERE user_id = NEW.user_id;
    
    -- If the count exceeds 3, prevent the insertion and raise an error
    IF fav_count >= 3 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'You can only have a maximum of 3 favorites.';
    END IF;
END//
DELIMITER ;

Create view fav as
SELECT count(pid) from favourites;
