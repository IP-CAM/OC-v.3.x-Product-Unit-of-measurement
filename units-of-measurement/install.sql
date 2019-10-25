CREATE TABLE IF NOT EXISTS `oc_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `symbol_rus` varchar(20) DEFAULT NULL,
  `symbol_ukr` varchar(20) DEFAULT NULL,
  `symbol_intl` varchar(20) DEFAULT NULL,
  `symbol_letter_intl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `oc_unit` (`unit_id`, `code`, `title`, `symbol_rus`, `symbol_ukr`, `symbol_intl`, `symbol_letter_intl`) VALUES
(1, 796, 'Штука', 'шт', 'шт', 'pc. 1', 'PCE'),
(2, 6, 'Метр', 'м', 'м', 'm', 'MTR'),
(3, 55, 'Квадратный метр', 'м2', 'м2', 'm2', 'MTK'),
(4, 113, 'Кубический метр', 'м3', 'м3', 'm3', 'MTQ'),
(5, 18, 'Погонный метр', 'пог. м', 'пог. м', 'rm', 'RMTR'),
(9, 715, 'Пара (2 шт.)', 'пар', 'пар', 'pr. 2', 'NPR'),
(10, 778, 'Упаковка', 'упак', 'упак', 'npm', 'NMP'),
(11, 166, 'Килограмм', 'кг', 'кг', 'kg', 'KGM'),
(12, 168, 'Тонна', 'т', 'т', 't', 'TNE'),
(13, 112, 'Литр', 'л', 'л', 'l', 'LTR'),
(14, 736, 'Рулон', 'рул', 'рул', 'roll', 'NPL'),
(15, 704, 'Набор', 'набор', 'набiр', 'set', 'SET'),
(16, 839, 'Комплект', 'компл', 'компл', 'kit', 'KIT'),
(17, 163, 'Грамм', 'г', 'г', 'g', 'GRM');