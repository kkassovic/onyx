SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `mail_log` (
  `ID` int(11) NOT NULL,
  `zaznamenal` text COLLATE utf8_slovak_ci NOT NULL,
  `smtp_server` text COLLATE utf8_slovak_ci NOT NULL,
  `sender_email` text COLLATE utf8_slovak_ci NOT NULL,
  `script` text COLLATE utf8_slovak_ci NOT NULL,
  `mail_status` text COLLATE utf8_slovak_ci NOT NULL,
  `trn` varchar(32) COLLATE utf8_slovak_ci NOT NULL,
  `recipient` text COLLATE utf8_slovak_ci NOT NULL,
  `stamp_DB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;


ALTER TABLE `mail_log`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `mail_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
