<meta charset="utf-8">
<?php
error_reporting(-1);
require_once 'config.php';

$host = DB_HOSTNAME;
$user = DB_USERNAME;
$pass = DB_PASSWORD;
$dbname = DB_DATABASE;
$pr = DB_PREFIX;

try {
    $dbh = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $pass);
    $dbh->exec('SET NAMES utf8');
} catch (PDOException $e) {
    echo $e->getMessage();
}

$stmt = $dbh->prepare('CREATE TABLE IF NOT EXISTS `oc_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `symbol_rus` varchar(20) DEFAULT NULL,
  `symbol_ukr` varchar(20) DEFAULT NULL,
  `symbol_intl` varchar(20) DEFAULT NULL,
  `symbol_letter_intl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8;');
$stmt->execute();

$stmt = $dbh->prepare('INSERT IGNORE INTO `oc_unit` (`unit_id`, `code`, `title`, `symbol_rus`, `symbol_ukr`, `symbol_intl`, `symbol_letter_intl`) VALUES
(1, 796, \'Штука\', \'шт\', \'шт\', \'pc. 1\', \'PCE\'),
(2, 6, \'Метр\', \'м\', \'м\', \'m\', \'MTR\'),
(3, 55, \'Квадратный метр\', \'м2\', \'м2\', \'m2\', \'MTK\'),
(4, 113, \'Кубический метр\', \'м3\', \'м3\', \'m3\', \'MTQ\'),
(5, 18, \'Погонный метр\', \'пог. м\', \'пог. м\', \'rm\', \'RMTR\'),
(9, 715, \'Пара (2 шт.)\', \'пар\', \'пар\', \'pr. 2\', \'NPR\'),
(10, 778, \'Упаковка\', \'упак\', \'упак\', \'npm\', \'NMP\'),
(11, 166, \'Килограмм\', \'кг\', \'кг\', \'kg\', \'KGM\'),
(12, 168, \'Тонна\', \'т\', \'т\', \'t\', \'TNE\'),
(13, 112, \'Литр\', \'л\', \'л\', \'l\', \'LTR\'),
(14, 736, \'Рулон\', \'рул\', \'рул\', \'roll\', \'NPL\'),
(15, 704, \'Набор\', \'набор\', \'набiр\', \'set\', \'SET\'),
(16, 839, \'Комплект\', \'компл\', \'компл\', \'kit\', \'KIT\'),
(17, 163, \'Грамм\', \'г\', \'г\', \'g\', \'GRM\');'
);
$stmt->execute();

$stmt = $dbh->prepare("SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . DB_PREFIX . "product' AND COLUMN_NAME = 'unit_id'");
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($res);
//if (!$res->num_rows) {
//    $stmt = $dbh->prepare("ALTER TABLE `". DB_PREFIX. "product` ADD  `unit_id` INT( 11 ) NOT NULL AFTER `date_available`");
//    $stmt->execute();
//}

$php_v = phpversion();
if ((float)$php_v < 5.6) {
    echo '<strong style="color: #FF0000;">Attention !</strong> module Units of measurement works with <strong style="color: #008000;">PHP 5.6</strong> or later <strong style="color: #FF0000;">PHP ' . $php_v . '</strong> For work you need PHP 5.6 or later.';
} else {
    echo 'Module Units of measurement installed!';
}

?>