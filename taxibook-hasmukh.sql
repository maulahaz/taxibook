CREATE TABLE `tbl_order` (
  `uid` int(11) NOT NULL,
  `Booker` varchar(20) NOT NULL,
  `Destination_id` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Taxi_id` int(11) NOT NULL,
  `Passenger` int(11) NOT NULL,
  `Pickup_dt` int(11) NOT NULL,
  `Pickup_tm` int(11) NOT NULL,
  `Note` varchar(255) NOT NULL,
  `Created_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_destination` (
  `uid` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Orig_desti` varchar(100) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_price` (
  `uid` int(11) NOT NULL,
  `Taxi_id` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Orig_desti` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_taxi` (
  `uid` int(11) NOT NULL,
  `Driver` varchar(100) NOT NULL,
  `Phone1` varchar(20) NOT NULL,
  `Phone2` varchar(20) NOT NULL,
  `Car_type` varchar(100) NOT NULL,
  `Seat_num` int(11) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_member` (
  `uid` int(11) NOT NULL,
  `Usr_id` varchar(20) NOT NULL,
  `Usr_pwd` varchar(100) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Nickname` varchar(10) NOT NULL,
  `isActive` int(1) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Phone1` varchar(20) NOT NULL,
  `Phone2` varchar(20) NOT NULL,
  `Updated_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;