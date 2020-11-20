--テーブル構造の構造 `purchase`
--

CREATE TABLE `purchases` (
    `order_number` int(11) AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(order_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------

--
--テーブル構造 `purchase details`
--

CREATE TABLE `purchase_details` (
    `order_number` int(11),
    `item_id` int(11),
    `price` int(11),
    `quantity` int(11),
    PRIMARY KEY(order_number, item_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;