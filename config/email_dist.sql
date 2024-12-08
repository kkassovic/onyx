SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `email_dist` (
  `ID` int(11) NOT NULL,
  `trn` varchar(32) COLLATE utf8_slovak_ci NOT NULL,
  `email` text COLLATE utf8_slovak_ci NOT NULL,
  `to_cc_bcc` varchar(32) COLLATE utf8_slovak_ci NOT NULL,
  `stampDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

ALTER TABLE `email_dist`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `email_dist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
