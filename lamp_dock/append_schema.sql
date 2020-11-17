--テーブル構造の構造 `purchase history`
--

CREATE TABLE `purchases` (
    `order_number` int(11) AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------

--
--テーブル構造 `purchase detailsP¥`
--

CREATE TABLE `purchase_details` (
    `order_number` int(11),
    `item_id` int(11),
    `price` int(11),
    `quantity` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;