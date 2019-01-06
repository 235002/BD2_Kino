-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Sty 2019, 04:17
-- Wersja serwera: 10.1.35-MariaDB
-- Wersja PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kino2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bilet`
--

CREATE TABLE `bilet` (
  `ID_bilet` int(10) NOT NULL,
  `ID_zamowienie` int(10) NOT NULL,
  `ID_repertuar` int(10) NOT NULL,
  `ID_sala` int(10) NOT NULL,
  `ID_rodzajbiletu` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film`
--

CREATE TABLE `film` (
  `ID_film` int(10) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `rezyser` varchar(255) NOT NULL,
  `scenariusz` varchar(255) DEFAULT NULL,
  `gatunek` varchar(255) NOT NULL,
  `premiera` date DEFAULT NULL,
  `kraj_pochodzenia` varchar(255) DEFAULT NULL,
  `czas_trwania` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `film`
--

INSERT INTO `film` (`ID_film`, `tytul`, `rezyser`, `scenariusz`, `gatunek`, `premiera`, `kraj_pochodzenia`, `czas_trwania`) VALUES
(1, 'Crockdale', 'Olivero Cuschieri', 'Baron Arlow', 'Drama', '1988-01-26', 'Palestinian Territory', 196),
(2, 'Our Summer in Provence', 'Raine Hobben', 'Milton Bailiss', 'Comedy|Drama', '1985-10-29', 'Germany', 85),
(3, 'American Nightmare, The', 'Ric Ruperti', 'Piotr Creggan', 'Documentary', '1999-08-11', 'China', 116),
(4, 'Pokemon 4 Ever (a.k.a. Pokémon 4: The Movie)', 'Beauregard Pococke', 'Desi Staggs', 'Adventure|Animation|Children|Fantasy', '2003-09-25', 'Brazil', 102),
(5, 'Fahrenhype 9/11', 'Patrick Tregona', 'Kelsey L\'Episcopi', 'Documentary', '1985-04-10', 'United States', 180),
(6, 'Frankenstein Must Be Destroyed', 'Dorree O\'Neal', 'Nealon Fromant', 'Drama|Horror|Sci-Fi', '1990-09-01', 'Philippines', 199),
(7, 'Bachelor Party', 'Benedetto Quimby', 'Jimmie Salomon', 'Comedy', '2018-05-22', 'Syria', 123),
(8, 'Wanda Nevada', 'Trudie Masterman', 'Marilyn Thurgood', 'Comedy|Mystery|Romance|Western', '2002-03-31', 'French Polynesia', 125),
(9, 'Last Stand, The', 'Cacilie Balle', 'Elayne MacCafferky', 'Action|Crime|Thriller', '2008-01-19', 'Russia', 71),
(10, 'Anne Frank Remembered', 'Yorgo Moyles', 'Shelton Sember', 'Documentary', '2011-02-16', 'Germany', 137),
(11, 'Dragon Ball: Sleeping Princess in Devil\'s Castle (Doragon bôru: Majinjô no nemuri hime)', 'Ema Barsby', 'Stace Discombe', 'Action|Adventure|Animation|Children', '2000-10-01', 'Indonesia', 149),
(12, 'Ringu (Ring)', 'Selig Sandeland', 'Kiersten Say', 'Horror|Mystery|Thriller', '2005-03-06', 'Sweden', 110),
(13, 'Love Is the Devil', 'Sidney Dovidian', 'Alford Sellek', 'Drama', '1997-08-12', 'China', 151),
(14, 'My Own Man', 'Aleen Daveran', 'Pryce Polgreen', '(no genres listed)', '1990-09-21', 'Brazil', 90),
(15, 'Print the Legend', 'Ilene Goldspink', 'Ariel Sunnex', 'Documentary', '2000-02-21', 'China', 104),
(16, 'Knights of Bloodsteel', 'Land Darkott', 'Kayley Braitling', 'Fantasy', '1988-10-04', 'Indonesia', 90),
(17, 'Heavyweights (Heavy Weights)', 'Amandi Gaukroger', 'Berk Broadberry', 'Children|Comedy', '2012-08-22', 'Lithuania', 146),
(18, 'Soo (Art of Revenge)', 'Wylma Dunne', 'Lorene Etherton', 'Action|Crime|Drama|Thriller', '1998-07-27', 'Poland', 76),
(19, 'Mimino', 'Illa Pattenden', 'Debra Quartly', 'Comedy', '2012-08-04', 'Suriname', 132),
(20, 'Sexy Baby', 'Darnall Sellar', 'Andeee Balchen', 'Documentary', '1997-05-31', 'Brazil', 197),
(21, 'Dead Fish', 'Vladimir Pilkington', 'Tallie Verity', 'Action|Comedy|Drama|Thriller', '1998-09-12', 'Russia', 69),
(22, 'Alan Partridge: Alpha Papa', 'Blinni Ayton', 'Padriac O\'Spellissey', 'Comedy', '1986-09-27', 'Democratic Republic of the Congo', 112),
(23, 'Border Feud', 'Malvin Lemmer', 'Denys Botger', 'Action|Comedy|Western', '2000-04-14', 'Philippines', 195),
(24, 'Kilometre Zero (Kilomètre zéro)', 'Zackariah Vala', 'Tucky Saiz', 'Drama|War', '1984-08-08', 'Indonesia', 178),
(25, 'Frequently Asked Questions About Time Travel', 'Rickie Razzell', 'Jammal Alliban', 'Comedy|Sci-Fi', '2016-09-30', 'Brazil', 73),
(26, 'Pan\'s Labyrinth (Laberinto del fauno, El)', 'Keely Dorin', 'Kizzee Cowin', 'Drama|Fantasy|Thriller', '1989-09-17', 'Mexico', 160),
(27, 'Gray\'s Anatomy', 'Griffy Nund', 'Myrtle Cordall', 'Comedy|Drama', '2013-01-22', 'Philippines', 67),
(28, 'Zatoichi\'s Cane Sword (Zatôichi tekka tabi) (Zatôichi 15)', 'Tonya Keogh', 'Wesley Winteringham', 'Action|Adventure|Drama', '2001-07-30', 'Brazil', 134),
(29, 'Nurse Betty', 'Lark Mangam', 'Lucius Fee', 'Comedy|Crime|Drama|Romance|Thriller', '2018-05-19', 'France', 173),
(30, 'Bang the Drum Slowly', 'Harli Kunkler', 'Philippine Deshon', 'Drama', '2005-04-20', 'United States', 138);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoba`
--

CREATE TABLE `osoba` (
  `ID_osoba` int(11) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `haslo` varchar(20) NOT NULL,
  `e-mail` varchar(30) NOT NULL,
  `nr_telefonu` int(11) NOT NULL,
  `ID_rodzajkonta` int(11) NOT NULL,
  `liczba_punktow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `osoba`
--

INSERT INTO `osoba` (`ID_osoba`, `imie`, `nazwisko`, `login`, `haslo`, `e-mail`, `nr_telefonu`, `ID_rodzajkonta`, `liczba_punktow`) VALUES
(1, 'Jan', 'Nowak', 'JanNow', '1234', 'jannow@gmail.com', 803871825, 1, 10000),
(2, 'Adam', 'Adamski', 'AdaAda', '1234', 'adaada@gmail.com', 920992873, 2, 10000),
(3, 'Jakub', 'Pawlowski', 'JakPaw', 'jakpaw', 'jakpaw@gmail.com', 867089876, 2, 10000),
(4, 'Grzegorz', 'Tomasik', 'GrzTom', 'grztom', 'grztom@gmail.com', 396233971, 2, 10000),
(5, 'Prisca', 'Buxey', 'Prisca Buxey', '1234', 'pbuxey4@salon.com', 309734989, 2, 10000),
(6, 'Berkly', 'Awcock', 'Berkly Awcock', '1234', 'bawcock5@cnet.com', 961967077, 2, 10000),
(7, 'Terry', 'Cowton', 'Terry Cowton', '3gM3lzGq', 'tcowton6@desdev.cn', 732552790, 3, 74),
(8, 'Wald', 'Maxwaile', 'Wald Maxwaile', 'Rh5EQ73LThWV', 'wmaxwaile7@apple.com', 685461355, 3, 77),
(9, 'Cathrin', 'Nockalls', 'Cathrin Nockalls', 'D5N8N4CL', 'cnockalls8@dion.ne.jp', 516160155, 3, 25),
(10, 'Perry', 'Claypoole', 'Perry Claypoole', 'rgEuerUGm0', 'pclaypoole9@cisco.com', 725340221, 3, 0),
(11, 'Brandon', 'Cockshot', 'Brandon Cockshot', '4HOkNLqaNky', 'bcockshota@ning.com', 674041696, 3, 0),
(12, 'Rogers', 'Free', 'Rogers Free', 'Yo1Zemx', 'rfreeb@foxnews.com', 807026161, 3, 54),
(13, 'Silvester', 'Inglis', 'Silvester Inglis', 'az6KhV7ED', 'singlisc@theglobeandmail.com', 631390905, 3, 82),
(14, 'Wayne', 'Gerin', 'Wayne Gerin', 'dvKWbIV', 'wgerind@scribd.com', 803027421, 3, 44),
(15, 'Elinore', 'Wyant', 'Elinore Wyant', 'OcX63ieo6C0', 'ewyante@techcrunch.com', 655755974, 3, 0),
(16, 'Tonia', 'Swanston', 'Tonia Swanston', 'Oi1I6adxKpA', 'tswanstonf@google.com.au', 776805676, 3, 0),
(17, 'Drew', 'Makeswell', 'Drew Makeswell', 'KN5me2Jg', 'dmakeswellg@hibu.com', 720616779, 3, 11),
(18, 'Goddart', 'Bettleson', 'Goddart Bettleson', '18lAfa', 'gbettlesonh@com.com', 507986496, 3, 94),
(19, 'Yard', 'Spofford', 'Yard Spofford', 'C9iS3sC', 'yspoffordi@yelp.com', 865705860, 3, 0),
(20, 'Kane', 'Bannon', 'Kane Bannon', 'FKkzbY', 'kbannonj@amazon.com', 648828203, 3, 62),
(21, 'Rickie', 'Caizley', 'Rickie Caizley', '6HFAIk', 'rcaizleyk@huffingtonpost.com', 675259538, 3, 0),
(22, 'Anatola', 'Slott', 'Anatola Slott', 'syIw5SlD', 'aslottl@shutterfly.com', 839660677, 3, 4),
(23, 'Nicol', 'Houchin', 'Nicol Houchin', '3ErUXdA', 'nhouchinm@1und1.de', 658560207, 3, 91),
(24, 'Obadiah', 'Westrip', 'Obadiah Westrip', 'ZwrA7Q9qz', 'owestripn@icq.com', 796658338, 3, 81),
(25, 'Peg', 'Sutworth', 'Peg Sutworth', 'Y8eDMceKA', 'psutwortho@typepad.com', 876550864, 3, 60),
(26, 'Lorenza', 'Zanolli', 'Lorenza Zanolli', 'H2SgkpDe', 'lzanollip@hatena.ne.jp', 674994895, 3, 29),
(27, 'Austin', 'Hovell', 'Austin Hovell', 'w8rJF1L', 'ahovellq@networksolutions.com', 543977515, 3, 41),
(28, 'Cecilla', 'Simmon', 'Cecilla Simmon', 'fViCBhWnQE', 'csimmonr@oaic.gov.au', 747806880, 3, 46),
(29, 'Ediva', 'Clue', 'Ediva Clue', '8roFdFIyR', 'eclues@businessinsider.com', 834618978, 3, 59),
(30, 'Elayne', 'Dimnage', 'Elayne Dimnage', '7di05lTPFvg', 'edimnaget@so-net.ne.jp', 704558657, 3, 43),
(31, 'Mortie', 'Dionisio', 'Mortie Dionisio', 'WjeMJj', 'mdionisiou@oakley.com', 552101904, 3, 75),
(32, 'Byram', 'Crush', 'Byram Crush', 'DcEafz09PFo', 'bcrushv@twitpic.com', 665045060, 3, 17),
(33, 'Thornie', 'Hammill', 'Thornie Hammill', 'GFAFsEps', 'thammillw@newsvine.com', 554254066, 3, 65),
(34, 'Suellen', 'Camerana', 'Suellen Camerana', 'd7oXzp', 'scameranax@chicagotribune.com', 604252862, 3, 9),
(35, 'Clarette', 'Mardoll', 'Clarette Mardoll', 'JFf1dTe', 'cmardolly@cam.ac.uk', 741823750, 3, 33),
(36, 'Bernetta', 'Vasyuchov', 'Bernetta Vasyuchov', 'IqLPvt83', 'bvasyuchovz@cornell.edu', 566748063, 3, 63),
(37, 'Perla', 'Simoens', 'Perla Simoens', 'TZVRhYTweF', 'psimoens10@amazon.de', 612797408, 3, 7),
(38, 'Nickie', 'Skakunas', 'Nickie Skakunas', 'ROZNQAD5CAuR', 'nskakunas11@dmoz.org', 539291628, 3, 29),
(39, 'Esmeralda', 'Bradburne', 'Esmeralda Bradburne', 'mZbkxDP2l', 'ebradburne12@berkeley.edu', 714831444, 3, 56),
(40, 'Alvan', 'Fairweather', 'Alvan Fairweather', 'gd86Yy', 'afairweather13@telegraph.co.uk', 536838789, 3, 0),
(41, 'Brose', 'Lebond', 'Brose Lebond', 'JfTLRfjF', 'blebond14@phoca.cz', 798422444, 3, 25),
(42, 'Miguela', 'Ryle', 'Miguela Ryle', 'iF1Pev', 'mryle15@arstechnica.com', 765876074, 3, 0),
(43, 'Craig', 'Clyburn', 'Craig Clyburn', 'iIKxrPQWlt', 'cclyburn16@mashable.com', 665329844, 3, 0),
(44, 'Alaster', 'Gypson', 'Alaster Gypson', 'yyQrvfGu1sdS', 'agypson17@jiathis.com', 608192097, 3, 23),
(45, 'Ansley', 'Merrywether', 'Ansley Merrywether', 'OGVXR6v', 'amerrywether18@foxnews.com', 715446305, 3, 69),
(46, 'Darnall', 'O\'Haire', 'Darnall O\'Haire', 'gOk6dQ76IDrP', 'dohaire19@merriam-webster.com', 768019249, 3, 62),
(47, 'Dee', 'Viegas', 'Dee Viegas', 'E9d5LCfPBve', 'dviegas1a@digg.com', 616132814, 3, 0),
(48, 'Cairistiona', 'Normadell', 'Cairistiona Normadel', 'gsuPmeMtr', 'cnormadell1b@naver.com', 665512125, 3, 63),
(49, 'Dorian', 'Mattson', 'Dorian Mattson', 'Kdyn3A4N1Wrt', 'dmattson1c@jimdo.com', 700877566, 3, 25),
(50, 'Lyndell', 'Antoniewicz', 'Lyndell Antoniewicz', '9j5r0teBazm', 'lantoniewicz1d@dedecms.com', 594189139, 3, 0),
(51, 'Seth', 'Berkley', 'Seth Berkley', '6O37aQq', 'sberkley1e@istockphoto.com', 779036602, 3, 0),
(52, 'Thatch', 'Miell', 'Thatch Miell', '9a0Yyry', 'tmiell1f@cbslocal.com', 776659445, 3, 78),
(53, 'Ronny', 'Hasling', 'Ronny Hasling', 'h1kdpDflwh', 'rhasling1g@irs.gov', 758138650, 3, 81),
(54, 'Sibley', 'Amber', 'Sibley Amber', 'PzqkSC', 'samber1h@europa.eu', 702415295, 3, 37),
(55, 'Imogen', 'Ethridge', 'Imogen Ethridge', '0k7VXsMD', 'iethridge1i@ifeng.com', 754040093, 3, 19),
(56, 'Brigham', 'O\'Sheilds', 'Brigham O\'Sheilds', 'OVaOl1d7u', 'bosheilds1j@eepurl.com', 713100426, 3, 63),
(57, 'Odilia', 'Wickliffe', 'Odilia Wickliffe', 'ji5Se63xtEC', 'owickliffe1k@nymag.com', 506768133, 3, 0),
(58, 'Fonzie', 'Tenant', 'Fonzie Tenant', '0LAmksIl9Io', 'ftenant1l@economist.com', 576647431, 3, 34),
(59, 'Felic', 'Pretorius', 'Felic Pretorius', '4SzCnSN6tL9U', 'fpretorius1m@jugem.jp', 526758519, 3, 34),
(60, 'Jaynell', 'Kilbride', 'Jaynell Kilbride', '4vZ3s8HTvD', 'jkilbride1n@redcross.org', 731369683, 3, 64),
(61, 'Tuckie', 'Rewcassell', 'Tuckie Rewcassell', 'W3AxBtpfW', 'trewcassell1o@addtoany.com', 622877038, 3, 52),
(62, 'Currey', 'Leile', 'Currey Leile', 'VydaeP95', 'cleile1p@theglobeandmail.com', 653438314, 3, 14),
(63, 'Gwenore', 'Peregrine', 'Gwenore Peregrine', '3UNapHh48w', 'gperegrine1q@psu.edu', 567901320, 3, 71),
(64, 'Isidoro', 'Canner', 'Isidoro Canner', 'Ygk7ecgize4', 'icanner1r@wikimedia.org', 889096217, 3, 77),
(65, 'Inness', 'Evensden', 'Inness Evensden', '7y6hNY', 'ievensden1s@hatena.ne.jp', 740445265, 3, 20),
(66, 'Haley', 'Carress', 'Haley Carress', '21Vq07HN', 'hcarress1t@twitter.com', 585529881, 3, 14),
(67, 'Ly', 'Gonin', 'Ly Gonin', 'mb9bVxp', 'lgonin1u@mysql.com', 590149251, 3, 5),
(68, 'Neill', 'Ballard', 'Neill Ballard', 'mn5hOa8wdN', 'nballard1v@cyberchimps.com', 737273987, 3, 0),
(69, 'Alick', 'Parr', 'Alick Parr', 'Ss9e8dgQuES8', 'aparr1w@google.es', 591585418, 3, 0),
(70, 'Isis', 'Ebhardt', 'Isis Ebhardt', 'mep7wOpxt', 'iebhardt1x@prlog.org', 833815099, 3, 0),
(71, 'Izabel', 'Astling', 'Izabel Astling', 'Evd2Ih', 'iastling1y@nature.com', 876636641, 3, 14),
(72, 'Amby', 'Sackey', 'Amby Sackey', 'CCo31s', 'asackey1z@dedecms.com', 524003389, 3, 9),
(73, 'Fax', 'Dilrew', 'Fax Dilrew', 'Exhkpb', 'fdilrew20@bloomberg.com', 859455290, 3, 49),
(74, 'Mycah', 'Sammonds', 'Mycah Sammonds', 'h2YVfRn', 'msammonds21@mail.ru', 701496987, 3, 0),
(75, 'Ruperto', 'Soonhouse', 'Ruperto Soonhouse', '01Q3zVgOv', 'rsoonhouse22@go.com', 743691980, 3, 68),
(76, 'Giffie', 'Raffels', 'Giffie Raffels', 'mAqLGl5x', 'graffels23@cnn.com', 760533816, 3, 75),
(77, 'Nikolaus', 'Steffans', 'Nikolaus Steffans', 'HFBxJNuSYDWM', 'nsteffans24@berkeley.edu', 681632748, 3, 38),
(78, 'Kelbee', 'Olner', 'Kelbee Olner', 'mTIYIfMoP', 'kolner25@dedecms.com', 642156817, 3, 0),
(79, 'Tally', 'Ankers', 'Tally Ankers', 'swJkbtH', 'tankers26@furl.net', 594945757, 3, 62),
(80, 'Shari', 'Iacomo', 'Shari Iacomo', 'VIEdsJNEUdUI', 'siacomo27@reuters.com', 803258097, 3, 0),
(81, 'Mattie', 'O\'Dreain', 'Mattie O\'Dreain', 'QGbhohU7BQVK', 'modreain28@engadget.com', 880206342, 3, 44),
(82, 'Linc', 'Anglin', 'Linc Anglin', 'G9phXTzN', 'langlin29@ameblo.jp', 797853236, 3, 0),
(83, 'Jerrilee', 'Cowndley', 'Jerrilee Cowndley', '4e8MYkFA', 'jcowndley2a@weather.com', 579959642, 3, 80),
(84, 'Davy', 'Lamden', 'Davy Lamden', 'RzHkAGqBSx', 'dlamden2b@marriott.com', 627844698, 3, 19),
(85, 'Katina', 'Jindrich', 'Katina Jindrich', 'UNq0nxj', 'kjindrich2c@goodreads.com', 637292941, 3, 41),
(86, 'Gayelord', 'Gallifont', 'Gayelord Gallifont', '4Hj35M', 'ggallifont2d@pcworld.com', 646101836, 3, 72),
(87, 'Mechelle', 'Jaquest', 'Mechelle Jaquest', 'Vs7hP2RwMh', 'mjaquest2e@biglobe.ne.jp', 586619494, 3, 27),
(88, 'Lek', 'Pickard', 'Lek Pickard', 'yNs3TSMLltFW', 'lpickard2f@infoseek.co.jp', 789263174, 3, 24),
(89, 'Sheelagh', 'Bilsland', 'Sheelagh Bilsland', 'g2VRxDQQlvY', 'sbilsland2g@senate.gov', 863386826, 3, 99),
(90, 'Ynes', 'Spadari', 'Ynes Spadari', 'YY9Xh1PxW9r', 'yspadari2h@china.com.cn', 866193069, 3, 74),
(91, 'Cullin', 'Limrick', 'Cullin Limrick', '2QSEzQ', 'climrick2i@amazon.co.uk', 685621087, 3, 83),
(92, 'Louisette', 'Iggo', 'Louisette Iggo', 'F3Z8y3tA1Z4', 'liggo2j@marketwatch.com', 526316280, 3, 0),
(93, 'Eydie', 'Sherwin', 'Eydie Sherwin', 'gyTjsPZzJn', 'esherwin2k@cbslocal.com', 761638698, 3, 5),
(94, 'Kylen', 'Gladdifh', 'Kylen Gladdifh', 'ZapjRM36n', 'kgladdifh2l@house.gov', 842616995, 3, 82),
(95, 'Kanya', 'Yosselevitch', 'Kanya Yosselevitch', 'tcGe17O0kYoy', 'kyosselevitch2m@dot.gov', 617743132, 3, 3),
(96, 'Tillie', 'Charlson', 'Tillie Charlson', 'gkXTWclOnm9s', 'tcharlson2n@myspace.com', 781526020, 3, 100),
(97, 'Myriam', 'Ambrosi', 'Myriam Ambrosi', 'E1naCvZ', 'mambrosi2o@youku.com', 502825303, 3, 68),
(98, 'Ambur', 'Mc Gee', 'Ambur Mc Gee', 'J3WUVIjIL2', 'amc2p@google.pl', 703988812, 3, 100),
(99, 'Leonanie', 'Dunnett', 'Leonanie Dunnett', 'lh6byiZVV', 'ldunnett2q@blogger.com', 855294574, 3, 13),
(100, 'Cordelie', 'McQueen', 'Cordelie McQueen', 'aSq2n2', 'cmcqueen2r@unc.edu', 863692804, 3, 30),
(101, 'Hyacinthia', 'Baskett', 'Hyacinthia Baskett', 'CdTglNuV', 'hbaskett2s@pen.io', 765339056, 3, 39),
(102, 'Robbie', 'Geerits', 'Robbie Geerits', 'jAQRxPiaLJ', 'rgeerits2t@google.es', 734419896, 3, 86),
(103, 'Domenic', 'Feeham', 'Domenic Feeham', 'rhaTQ6qolaB', 'dfeeham2u@nymag.com', 701028363, 3, 26),
(104, 'Tedra', 'Oglesbee', 'Tedra Oglesbee', 'UPq5ky', 'toglesbee2v@ftc.gov', 837556095, 3, 40),
(105, 'Daniela', 'Lammert', 'Daniela Lammert', 'Ogsbxu', 'dlammert2w@lulu.com', 663003850, 3, 54),
(106, 'Deane', 'Bowller', 'Deane Bowller', 'BU6gkg1', 'dbowller2x@reuters.com', 783276836, 3, 40),
(107, 'Frayda', 'Statefield', 'Frayda Statefield', 'M00BKEP', 'fstatefield2y@moonfruit.com', 639633389, 3, 5),
(108, 'Samson', 'Jessett', 'Samson Jessett', 'pjWbE90Nmlcz', 'sjessett2z@theglobeandmail.com', 898433827, 3, 61),
(109, 'Jarvis', 'Pease', 'Jarvis Pease', '8S0bVL9', 'jpease30@godaddy.com', 748485957, 3, 97),
(110, 'Samuele', 'Rennolds', 'Samuele Rennolds', 'RqNn9W', 'srennolds31@harvard.edu', 512989236, 3, 90),
(111, 'Benedict', 'Raulston', 'Benedict Raulston', 'kKbMXGlR', 'braulston32@360.cn', 695562953, 3, 0),
(112, 'Tessy', 'MacGettigen', 'Tessy MacGettigen', 'UgUnNKkL', 'tmacgettigen33@vimeo.com', 570212688, 3, 0),
(113, 'Shep', 'Geillier', 'Shep Geillier', '9ejmSm', 'sgeillier34@posterous.com', 679294202, 3, 38),
(114, 'Oralle', 'Speaks', 'Oralle Speaks', 'ftCvZ7NG', 'ospeaks35@barnesandnoble.com', 738728756, 3, 74),
(115, 'Ferne', 'Halson', 'Ferne Halson', 'LDGNGWG7rPE', 'fhalson36@amazonaws.com', 698915932, 3, 99),
(116, 'Dun', 'Duffil', 'Dun Duffil', 'zA36HJ4W', 'dduffil37@cnn.com', 715670404, 3, 1),
(117, 'Thain', 'Dilleston', 'Thain Dilleston', 'F4OTXu', 'tdilleston38@deviantart.com', 696259081, 3, 44),
(118, 'Kendall', 'Cossar', 'Kendall Cossar', 'kecs9Idzof', 'kcossar39@addthis.com', 626464713, 3, 0),
(119, 'Kaye', 'Arniz', 'Kaye Arniz', '3x6cBl85Z', 'karniz3a@hc360.com', 666379378, 3, 63),
(120, 'Cullie', 'Leaburn', 'Cullie Leaburn', 'bwTRwlnJgXt', 'cleaburn3b@indiatimes.com', 501871493, 3, 89),
(121, 'Aguie', 'Bointon', 'Aguie Bointon', 'wxcs1mKDT8sF', 'abointon3c@cyberchimps.com', 660710421, 3, 72),
(122, 'Cathie', 'Tring', 'Cathie Tring', 'qbPMkx47E', 'ctring3d@ovh.net', 547847614, 3, 68),
(123, 'Elli', 'Weerdenburg', 'Elli Weerdenburg', 'vrbtMSrB', 'eweerdenburg3e@wordpress.com', 697209358, 3, 0),
(124, 'Arielle', 'Southerns', 'Arielle Southerns', 'fMRQFnrZg', 'asoutherns3f@pcworld.com', 840442031, 3, 11),
(125, 'Isac', 'Sperrett', 'Isac Sperrett', 'o7x1DDatVYoj', 'isperrett3g@about.me', 646785036, 3, 77),
(126, 'Haily', 'Devenny', 'Haily Devenny', 'UlBCTt', 'hdevenny3h@nps.gov', 694708202, 3, 91),
(127, 'Valentin', 'Camber', 'Valentin Camber', 'Lu3o3iU5un', 'vcamber3i@wiley.com', 864250460, 3, 85),
(128, 'Gabriele', 'Brastead', 'Gabriele Brastead', 'Kyoy2Z', 'gbrastead3j@businessinsider.co', 881926848, 3, 18),
(129, 'Margot', 'Lehrahan', 'Margot Lehrahan', 'oSQ9w8DpoF6b', 'mlehrahan3k@sogou.com', 597843312, 3, 47),
(130, 'Zitella', 'Dowears', 'Zitella Dowears', 'uNBJTA2', 'zdowears3l@bluehost.com', 846892097, 3, 70),
(131, 'Ellery', 'Hawthorn', 'Ellery Hawthorn', 'AXgAmJVvepS', 'ehawthorn3m@cbslocal.com', 656860530, 3, 77),
(132, 'Roma', 'Filipov', 'Roma Filipov', 'SlDuDfXANv9y', 'rfilipov3n@blinklist.com', 545852099, 3, 45),
(133, 'Quincey', 'Darington', 'Quincey Darington', 'kSsnS0', 'qdarington3o@narod.ru', 830630668, 3, 43),
(134, 'Sheryl', 'Manuely', 'Sheryl Manuely', 'zSQXmo07cz', 'smanuely3p@foxnews.com', 522532593, 3, 0),
(135, 'Garrott', 'Greydon', 'Garrott Greydon', 'rpOsDG', 'ggreydon3q@alibaba.com', 591987761, 3, 36),
(136, 'Kacey', 'Laurent', 'Kacey Laurent', '2y1OSYu', 'klaurent3r@mtv.com', 522738964, 3, 0),
(137, 'Dunc', 'Doelle', 'Dunc Doelle', 'gEdIPiLkg', 'ddoelle3s@time.com', 757224319, 3, 5),
(138, 'Betsey', 'Fallanche', 'Betsey Fallanche', 'yVmQ04', 'bfallanche3t@europa.eu', 805303787, 3, 0),
(139, 'Horacio', 'Brettell', 'Horacio Brettell', 'TGefbW72Cp9Y', 'hbrettell3u@ftc.gov', 593465124, 3, 42),
(140, 'Huberto', 'Bentinck', 'Huberto Bentinck', 'yUkofFbKnX', 'hbentinck3v@stumbleupon.com', 539229280, 3, 68),
(141, 'Golda', 'Bault', 'Golda Bault', 'zKHP2G9ungU', 'gbault3w@ehow.com', 684870880, 3, 0),
(142, 'Margery', 'Bergeon', 'Margery Bergeon', 'wTruN6uKB', 'mbergeon3x@de.vu', 621864997, 3, 0),
(143, 'Addy', 'Lordon', 'Addy Lordon', 'LmdzAD', 'alordon3y@slideshare.net', 648392288, 3, 0),
(144, 'Agna', 'Roscrigg', 'Agna Roscrigg', 'zxkSk7f1P5Nr', 'aroscrigg3z@so-net.ne.jp', 772123722, 3, 78),
(145, 'Raviv', 'Joint', 'Raviv Joint', 'bydyqOZO7bG', 'rjoint40@drupal.org', 619479431, 3, 84),
(146, 'Oberon', 'Danigel', 'Oberon Danigel', '96H4gkSwCXD', 'odanigel41@cbslocal.com', 689241712, 3, 95),
(147, 'Gualterio', 'Debrick', 'Gualterio Debrick', 'xiRP5W', 'gdebrick42@bloglines.com', 510478754, 3, 89),
(148, 'Berkie', 'Bonin', 'Berkie Bonin', 'tGoHanx', 'bbonin43@netscape.com', 864209613, 3, 7),
(149, 'Sher', 'Crowth', 'Sher Crowth', 'BQvHUSRNYEY', 'scrowth44@ted.com', 693388017, 3, 52),
(150, 'Fan', 'Dabourne', 'Fan Dabourne', 'qMYODItld3', 'fdabourne45@ocn.ne.jp', 686498033, 3, 8),
(151, 'Hortense', 'Shippard', 'Hortense Shippard', 'zJ7IRMeO', 'hshippard46@is.gd', 871064329, 3, 13),
(152, 'Pierette', 'Zanelli', 'Pierette Zanelli', 'sUjMkw0', 'pzanelli47@indiatimes.com', 786860935, 3, 32),
(153, 'Gradey', 'McLeoid', 'Gradey McLeoid', 'krphsMDR', 'gmcleoid48@thetimes.co.uk', 722243441, 3, 30),
(154, 'Lanita', 'Asbury', 'Lanita Asbury', 'DRWY5G7f', 'lasbury49@pbs.org', 708767512, 3, 32),
(155, 'Maximilien', 'Nucciotti', 'Maximilien Nucciotti', 'F5Qj9MPZuAcS', 'mnucciotti4a@unicef.org', 619925910, 3, 58),
(156, 'Lorry', 'Grenfell', 'Lorry Grenfell', 'pjVtlMaML', 'lgrenfell4b@diigo.com', 870121066, 3, 43),
(157, 'Mayor', 'Rudgley', 'Mayor Rudgley', 'nQnIDDWst9', 'mrudgley4c@sitemeter.com', 842503385, 3, 58),
(158, 'Tisha', 'Ortell', 'Tisha Ortell', 'Yo6QJ7HDb8', 'tortell4d@china.com.cn', 631301564, 3, 72),
(159, 'Zorana', 'Flippelli', 'Zorana Flippelli', 's8fI4H4GO', 'zflippelli4e@time.com', 860562246, 3, 9),
(160, 'Shayne', 'Winterbotham', 'Shayne Winterbotham', '5At55e', 'swinterbotham4f@kickstarter.co', 627173588, 3, 56),
(161, 'Libbey', 'Leedes', 'Libbey Leedes', 'xYo85EpJD1', 'lleedes4g@liveinternet.ru', 819824167, 3, 74),
(162, 'Thomasa', 'Wickliffe', 'Thomasa Wickliffe', 'Emxbw8M', 'twickliffe4h@gizmodo.com', 840200459, 3, 35),
(163, 'Henriette', 'Tritton', 'Henriette Tritton', 'dByGzmfT5', 'htritton4i@apple.com', 663274587, 3, 88),
(164, 'Tibold', 'Rennison', 'Tibold Rennison', 'sZ7v5uQiMmj', 'trennison4j@rediff.com', 598301972, 3, 14),
(165, 'Annora', 'Horlick', 'Annora Horlick', 'kUXpnCQvdVZ', 'ahorlick4k@imdb.com', 521330045, 3, 93),
(166, 'Remington', 'O\'Dreain', 'Remington O\'Dreain', 'fmPdTHSaDa6B', 'rodreain4l@bizjournals.com', 813640892, 3, 0),
(167, 'Vaughan', 'Lorinez', 'Vaughan Lorinez', 'H97q0Nj9', 'vlorinez4m@dailymail.co.uk', 652260142, 3, 91),
(168, 'Frederich', 'Pinckard', 'Frederich Pinckard', '8l3w6eSEmY0', 'fpinckard4n@woothemes.com', 616352041, 3, 80),
(169, 'Christoffer', 'Borne', 'Christoffer Borne', 'dxfGnJ', 'cborne4o@pen.io', 842006284, 3, 9),
(170, 'Abbye', 'Jakel', 'Abbye Jakel', 'jZ5kkQJOmU2N', 'ajakel4p@cam.ac.uk', 833775513, 3, 74),
(171, 'Axe', 'Conwell', 'Axe Conwell', '9yCQvPwcaGv', 'aconwell4q@quantcast.com', 635777750, 3, 59),
(172, 'Sloan', 'Goodger', 'Sloan Goodger', '8zeX66E', 'sgoodger4r@virginia.edu', 710901189, 3, 54),
(173, 'Natty', 'Heak', 'Natty Heak', 'iI2n6jG', 'nheak4s@foxnews.com', 824734704, 3, 22),
(174, 'Sloane', 'Kealy', 'Sloane Kealy', 'oCQFR3ImH', 'skealy4t@ameblo.jp', 882915034, 3, 71),
(175, 'Danie', 'Scoble', 'Danie Scoble', '7MeEXfrSqFhO', 'dscoble4u@dell.com', 671363058, 3, 68),
(176, 'Javier', 'Kerton', 'Javier Kerton', 'm2DjCc7', 'jkerton4v@ifeng.com', 532162778, 3, 94),
(177, 'Diahann', 'Suermeiers', 'Diahann Suermeiers', 'wCbjXmmf8CsZ', 'dsuermeiers4w@hhs.gov', 831377017, 3, 62),
(178, 'Tandi', 'Rotchell', 'Tandi Rotchell', '3mzDedT0xa0', 'trotchell4x@stanford.edu', 862578594, 3, 26),
(179, 'Lulita', 'Castanie', 'Lulita Castanie', 'vzjb7FO5akpc', 'lcastanie4y@de.vu', 749372500, 3, 32),
(180, 'Sheila', 'Stedman', 'Sheila Stedman', '3lA1UmOcEf1', 'sstedman4z@posterous.com', 692004441, 3, 0),
(181, 'Ailee', 'Brickell', 'Ailee Brickell', 'xm0mqNsk6hJ', 'abrickell50@google.ru', 669727007, 3, 68),
(182, 'Vivian', 'Rosingdall', 'Vivian Rosingdall', 'YWxLl9s', 'vrosingdall51@wired.com', 801566541, 3, 0),
(183, 'Murray', 'Joost', 'Murray Joost', 'jQsr4Lx', 'mjoost52@wp.com', 709956977, 3, 44),
(184, 'Gaston', 'Baal', 'Gaston Baal', 'FHhzvUwMYDH', 'gbaal53@vistaprint.com', 735271890, 3, 34),
(185, 'Orland', 'Kezourec', 'Orland Kezourec', '4pKDV8jru', 'okezourec54@accuweather.com', 632966447, 3, 27),
(186, 'Kial', 'Rosario', 'Kial Rosario', 's6dTeOTRsb', 'krosario55@360.cn', 871491521, 3, 29),
(187, 'Delcina', 'Hairyes', 'Delcina Hairyes', 'IxSKxMOO', 'dhairyes56@vk.com', 716966375, 3, 35),
(188, 'Vincent', 'Lazonby', 'Vincent Lazonby', 'tKkw3uGdT1o', 'vlazonby57@weather.com', 823461628, 3, 59),
(189, 'Kile', 'Feldstern', 'Kile Feldstern', 'KXRSVSAkki', 'kfeldstern58@aboutads.info', 750198021, 3, 0),
(190, 'Millard', 'O\' Byrne', 'Millard O\' Byrne', '3bX9VNDC', 'mo59@stumbleupon.com', 774844170, 3, 81),
(191, 'Abbie', 'Stockman', 'Abbie Stockman', 'xX2yFNzBIOL', 'astockman5a@e-recht24.de', 541925215, 3, 85),
(192, 'Lorenzo', 'Weetch', 'Lorenzo Weetch', 'eSKEaS', 'lweetch5b@creativecommons.org', 523100277, 3, 87),
(193, 'Jenine', 'Alpine', 'Jenine Alpine', 'pA6iCjKtf', 'jalpine5c@wordpress.org', 888357661, 3, 7),
(194, 'Cam', 'Audenis', 'Cam Audenis', 'nyUBJj0g0rDW', 'caudenis5d@ebay.co.uk', 656570259, 3, 73),
(195, 'Ruthy', 'Gilfether', 'Ruthy Gilfether', 'ReQ7KkEw', 'rgilfether5e@studiopress.com', 853802461, 3, 0),
(196, 'Jeffie', 'Emanuele', 'Jeffie Emanuele', 'JM0a8cg', 'jemanuele5f@engadget.com', 895149562, 3, 4),
(197, 'Juline', 'Bambridge', 'Juline Bambridge', 'Cyxxscj', 'jbambridge5g@irs.gov', 527240476, 3, 56),
(198, 'Miltie', 'Pendrey', 'Miltie Pendrey', 'JP4z4QZhqg', 'mpendrey5h@infoseek.co.jp', 708361674, 3, 0),
(199, 'Cal', 'Wackley', 'Cal Wackley', 'PyaaSliCq', 'cwackley5i@mashable.com', 519211330, 3, 62),
(200, 'Deanne', 'Gottschalk', 'Deanne Gottschalk', 'U2OkxFPLaLE', 'dgottschalk5j@weibo.com', 640487016, 3, 1),
(201, 'Ileane', 'Aulsford', 'Ileane Aulsford', 'kRoR6E', 'iaulsford5k@fotki.com', 598337850, 3, 86),
(202, 'Augie', 'Tesdale', 'Augie Tesdale', '13J8AsWpf', 'atesdale5l@webnode.com', 649996163, 3, 36),
(203, 'Cecelia', 'Eggers', 'Cecelia Eggers', '8QqYghWCZ', 'ceggers5m@bloomberg.com', 688693693, 3, 97),
(204, 'Lee', 'Skures', 'Lee Skures', 'ri51buEcZmrJ', 'lskures5n@fc2.com', 787771076, 3, 51),
(205, 'Shayna', 'Olivas', 'Shayna Olivas', 'CkQl6uug', 'solivas5o@cargocollective.com', 669126124, 3, 11),
(206, 'Abbot', 'Shewon', 'Abbot Shewon', 'MVfTmQJ', 'ashewon5p@shareasale.com', 759530535, 3, 80),
(207, 'York', 'Raycroft', 'York Raycroft', 'iNLOLLVRjhU', 'yraycroft5q@csmonitor.com', 880007641, 3, 84),
(208, 'Ali', 'Yosevitz', 'Ali Yosevitz', '27oFz5', 'ayosevitz5r@geocities.jp', 535465469, 3, 68),
(209, 'Washington', 'Gildersleaves', 'Washington Gildersle', 'qegvnuvI', 'wgildersleaves5s@wired.com', 794406814, 3, 29),
(210, 'Erek', 'Birkhead', 'Erek Birkhead', 'YEabXkfQsv', 'ebirkhead5t@etsy.com', 562584633, 3, 73),
(211, 'Prentiss', 'de Werk', 'Prentiss de Werk', 'KZLsWanTag', 'pde5u@reddit.com', 616457701, 3, 47),
(212, 'Byram', 'Cumbes', 'Byram Cumbes', 'KimH9I', 'bcumbes5v@wsj.com', 648206682, 3, 53),
(213, 'Eloisa', 'Sackey', 'Eloisa Sackey', 'OHjoTJQC', 'esackey5w@feedburner.com', 505527407, 3, 35),
(214, 'Dorrie', 'Labbati', 'Dorrie Labbati', 'JjZCJWNnw', 'dlabbati5x@goodreads.com', 802347022, 3, 0),
(215, 'Zorah', 'Eard', 'Zorah Eard', 'jJQTgHHo', 'zeard5y@purevolume.com', 628622678, 3, 29),
(216, 'Antons', 'Damrel', 'Antons Damrel', 'vrMRgbHVLF', 'adamrel5z@sourceforge.net', 791918214, 3, 0),
(217, 'Melosa', 'Jackman', 'Melosa Jackman', 'Z93CZYvXeJ', 'mjackman60@earthlink.net', 752194585, 3, 31),
(218, 'Savina', 'Knotte', 'Savina Knotte', '9A40fAzfE', 'sknotte61@yahoo.co.jp', 639429522, 3, 6),
(219, 'Bentley', 'Loney', 'Bentley Loney', 'NiGuaEt', 'bloney62@geocities.jp', 758807354, 3, 0),
(220, 'Kyle', 'De Goey', 'Kyle De Goey', '4x6VuBpFoG4N', 'kde63@1688.com', 613648842, 3, 0),
(221, 'Brendin', 'Stubbs', 'Brendin Stubbs', 'UB9TNXAWZNZ', 'bstubbs64@xinhuanet.com', 881501413, 3, 7),
(222, 'Avie', 'Clemmitt', 'Avie Clemmitt', 'nUHrgAY7icmZ', 'aclemmitt65@springer.com', 750131538, 3, 0),
(223, 'Jarvis', 'Maccrie', 'Jarvis Maccrie', 'UFKD21', 'jmaccrie66@addthis.com', 614302690, 3, 68),
(224, 'Tabor', 'Kimblin', 'Tabor Kimblin', 'CePzh1WZ9aVI', 'tkimblin67@skyrock.com', 871347557, 3, 62),
(225, 'Leeanne', 'Simononsky', 'Leeanne Simononsky', 'EBHjsATpiBm', 'lsimononsky68@mlb.com', 678885073, 3, 48),
(226, 'Casey', 'Stubbington', 'Casey Stubbington', 'Aj1LYe', 'cstubbington69@amazon.co.uk', 699996104, 3, 44),
(227, 'Cordie', 'Kyme', 'Cordie Kyme', 'xJqA9PDw', 'ckyme6a@webs.com', 682410570, 3, 87),
(228, 'Boone', 'Treagus', 'Boone Treagus', '2ctlIuJh', 'btreagus6b@addtoany.com', 777032930, 3, 0),
(229, 'Scot', 'Lorentzen', 'Scot Lorentzen', 'TQffvXJlh', 'slorentzen6c@tripadvisor.com', 726137829, 3, 88),
(230, 'Huntley', 'Peplay', 'Huntley Peplay', 'f1tzI2eUB', 'hpeplay6d@hibu.com', 716298349, 3, 9),
(231, 'Darbee', 'Birrane', 'Darbee Birrane', 'q5E8Elq', 'dbirrane6e@reverbnation.com', 542021830, 3, 0),
(232, 'Wren', 'Domino', 'Wren Domino', 'DZ1kDzOCTH4', 'wdomino6f@soup.io', 611872176, 3, 19),
(233, 'Arnuad', 'Jarry', 'Arnuad Jarry', 'oQ1qN2', 'ajarry6g@weebly.com', 706356127, 3, 84),
(234, 'Fedora', 'Drissell', 'Fedora Drissell', 'tFgo3rkx', 'fdrissell6h@amazon.co.uk', 629238205, 3, 97),
(235, 'Leonie', 'Arpe', 'Leonie Arpe', 'zAueubyTpu', 'larpe6i@domainmarket.com', 561895937, 3, 97),
(236, 'Camellia', 'Duchart', 'Camellia Duchart', 'rxs7JrcHBRoJ', 'cduchart6j@mit.edu', 723787547, 3, 38),
(237, 'Meggi', 'Charlewood', 'Meggi Charlewood', 'OtXEzkN', 'mcharlewood6k@oakley.com', 672703388, 3, 0),
(238, 'Dyan', 'Rochester', 'Dyan Rochester', 'Bwn1Uk', 'drochester6l@yale.edu', 874613636, 3, 98),
(239, 'Brynne', 'Karolovsky', 'Brynne Karolovsky', '2hFvMi', 'bkarolovsky6m@diigo.com', 765351669, 3, 47),
(240, 'Gareth', 'Mawd', 'Gareth Mawd', '1VNXRxjS', 'gmawd6n@amazon.co.uk', 854396535, 3, 4),
(241, 'Sandra', 'Starbuck', 'Sandra Starbuck', 'c337dligKn', 'sstarbuck6o@free.fr', 754292846, 3, 55),
(242, 'Humfried', 'Lewsy', 'Humfried Lewsy', 'VYdiABksDeG', 'hlewsy6p@slate.com', 504230049, 3, 74),
(243, 'Marji', 'Jeanneau', 'Marji Jeanneau', 'T3fYHznGqlnE', 'mjeanneau6q@nps.gov', 685076569, 3, 73),
(244, 'Doris', 'Kolczynski', 'Doris Kolczynski', 'P7uLuOpE', 'dkolczynski6r@blogger.com', 533353136, 3, 26),
(245, 'Viviyan', 'Burlingame', 'Viviyan Burlingame', 'DjhYBD3h', 'vburlingame6s@amazon.de', 897837664, 3, 32),
(246, 'Dwight', 'Cressy', 'Dwight Cressy', 'VUX1zVzLvToU', 'dcressy6t@chicagotribune.com', 889448899, 3, 86),
(247, 'Ramon', 'Ivanishev', 'Ramon Ivanishev', 'Kka8CU9vDp', 'rivanishev6u@scribd.com', 509547122, 3, 0),
(248, 'Olav', 'Oswell', 'Olav Oswell', 'BamV2Gd', 'ooswell6v@dot.gov', 710429136, 3, 3),
(249, 'Pattin', 'Skyrm', 'Pattin Skyrm', 'JX9FIdXE', 'pskyrm6w@reverbnation.com', 737330167, 3, 29),
(250, 'Jami', 'Giovannini', 'Jami Giovannini', '6b4dgjcs5', 'jgiovannini6x@hao123.com', 873309770, 3, 93),
(251, 'Clementia', 'Spieght', 'Clementia Spieght', 'iK9u6MnY', 'cspieght6y@yelp.com', 505535538, 3, 0),
(252, 'Holt', 'Beadles', 'Holt Beadles', 'KfDjjlxPDL', 'hbeadles6z@stanford.edu', 770081283, 3, 37),
(253, 'Wilton', 'Drewery', 'Wilton Drewery', 'CWsLB1B8XFYh', 'wdrewery70@ebay.com', 526299966, 3, 75),
(254, 'Jacquelynn', 'Muckloe', 'Jacquelynn Muckloe', 'rRvsHDv', 'jmuckloe71@amazon.co.uk', 790035879, 3, 76),
(255, 'Noby', 'Bartosiak', 'Noby Bartosiak', 'wybDcl', 'nbartosiak72@addthis.com', 865369956, 3, 5),
(256, 'Carny', 'Gallyhaock', 'Carny Gallyhaock', 'xN9ecP7I', 'cgallyhaock73@nydailynews.com', 621401420, 3, 0),
(257, 'Jelene', 'Handrik', 'Jelene Handrik', 'ISFJh9Z5d7', 'jhandrik74@mozilla.com', 863325163, 3, 87),
(258, 'Kerri', 'Estcot', 'Kerri Estcot', 'TrEynlS', 'kestcot75@multiply.com', 595717299, 3, 0),
(259, 'Erroll', 'Lisciandri', 'Erroll Lisciandri', 'IvsOTG0', 'elisciandri76@buzzfeed.com', 745116505, 3, 74),
(260, 'Patsy', 'Trobe', 'Patsy Trobe', '2f19MWcsKGV', 'ptrobe77@mtv.com', 837014476, 3, 28),
(261, 'Charyl', 'Morit', 'Charyl Morit', 'VtfPeEpt91Ah', 'cmorit78@a8.net', 538540578, 3, 85),
(262, 'Trstram', 'Faier', 'Trstram Faier', 'dxqzzQZ4', 'tfaier79@nasa.gov', 532410582, 3, 20),
(263, 'Rhona', 'Davy', 'Rhona Davy', 'cCq5FgqNnVWM', 'rdavy7a@yahoo.co.jp', 552881926, 3, 0),
(264, 'Mendel', 'Silver', 'Mendel Silver', 'LwjUajmQm', 'msilver7b@google.com.au', 677480359, 3, 0),
(265, 'Arri', 'Bhar', 'Arri Bhar', 'ETDx7JV0', 'abhar7c@geocities.jp', 677749587, 3, 94),
(266, 'Wylie', 'Kenwood', 'Wylie Kenwood', '9Iz8R2iiif', 'wkenwood7d@slashdot.org', 868342318, 3, 48),
(267, 'Herc', 'Fierro', 'Herc Fierro', 'LiVc57mIi29', 'hfierro7e@hao123.com', 775684876, 3, 3),
(268, 'Lorraine', 'Waterfall', 'Lorraine Waterfall', '5U9mVuFLs', 'lwaterfall7f@apache.org', 836275314, 3, 0),
(269, 'Remington', 'Hodcroft', 'Remington Hodcroft', 'Cyn0JINT', 'rhodcroft7g@utexas.edu', 519489329, 3, 33),
(270, 'Marje', 'Dearth', 'Marje Dearth', 'q93x2hoq', 'mdearth7h@zdnet.com', 635789551, 3, 48),
(271, 'Karylin', 'Nesbitt', 'Karylin Nesbitt', 'na0EaEK', 'knesbitt7i@youtu.be', 746942472, 3, 33),
(272, 'Maighdiln', 'Van der Merwe', 'Maighdiln Van der Me', 'oPERHAKtbgg', 'mvan7j@yahoo.co.jp', 618746455, 3, 21),
(273, 'Vonny', 'Barbie', 'Vonny Barbie', 'VJa3Ayr1q3U', 'vbarbie7k@stumbleupon.com', 871486579, 3, 24),
(274, 'Terrie', 'Keerl', 'Terrie Keerl', 'AlnESPE', 'tkeerl7l@gravatar.com', 882378053, 3, 99),
(275, 'Adriaens', 'Mozzi', 'Adriaens Mozzi', 'ZOTxQls2S', 'amozzi7m@fema.gov', 739701309, 3, 59),
(276, 'Avrit', 'Tschirschky', 'Avrit Tschirschky', 'laEDMHrrca', 'atschirschky7n@slate.com', 589685344, 3, 82),
(277, 'Dore', 'Skedgell', 'Dore Skedgell', 'aqanCHENVg', 'dskedgell7o@tinypic.com', 894277182, 3, 29),
(278, 'Sibley', 'Drakeley', 'Sibley Drakeley', '3EkixJvc', 'sdrakeley7p@home.pl', 899679669, 3, 18),
(279, 'Joelie', 'Greenmon', 'Joelie Greenmon', 'D1NYLA', 'jgreenmon7q@timesonline.co.uk', 673780591, 3, 64),
(280, 'Nils', 'Dovidian', 'Nils Dovidian', 'FpI5mh', 'ndovidian7r@wired.com', 683103656, 3, 8),
(281, 'Gerta', 'Kubacki', 'Gerta Kubacki', 'e5oyjJ', 'gkubacki7s@google.com', 504493220, 3, 76),
(282, 'Will', 'McGucken', 'Will McGucken', 'RUcJJJNetjF7', 'wmcgucken7t@bbb.org', 682618658, 3, 67),
(283, 'Nonie', 'Pledger', 'Nonie Pledger', 'AyQzjopoff9', 'npledger7u@google.cn', 680138893, 3, 49),
(284, 'Raye', 'McClunaghan', 'Raye McClunaghan', 'v5eFepWT4sDN', 'rmcclunaghan7v@cornell.edu', 793020541, 3, 4),
(285, 'Darius', 'Gethouse', 'Darius Gethouse', 'ppoZ7ow', 'dgethouse7w@telegraph.co.uk', 877031136, 3, 92),
(286, 'Thibaut', 'Freeland', 'Thibaut Freeland', 'cLROuuRRY', 'tfreeland7x@domainmarket.com', 828375827, 3, 0),
(287, 'Clarabelle', 'Tessier', 'Clarabelle Tessier', 'RH3s21NZvdG', 'ctessier7y@ucoz.com', 570980896, 3, 74),
(288, 'Peta', 'Offield', 'Peta Offield', 'PgN4oLP', 'poffield7z@newyorker.com', 589208506, 3, 59),
(289, 'Janetta', 'Saunder', 'Janetta Saunder', 'Yj4n0OL', 'jsaunder80@chicagotribune.com', 638779890, 3, 98),
(290, 'Nonie', 'Amor', 'Nonie Amor', 'R2Olipe', 'namor81@admin.ch', 540012093, 3, 0),
(291, 'Eldredge', 'Gatherer', 'Eldredge Gatherer', 'DQBscBK', 'egatherer82@sogou.com', 824780864, 3, 20),
(292, 'Maurizia', 'Nairne', 'Maurizia Nairne', 'Gf4r1p2', 'mnairne83@mashable.com', 731817132, 3, 47),
(293, 'Ardella', 'Plowman', 'Ardella Plowman', 'RgW0ms', 'aplowman84@addtoany.com', 891409605, 3, 53),
(294, 'Raf', 'Fodden', 'Raf Fodden', '0BSixJmkvr', 'rfodden85@cyberchimps.com', 676342056, 3, 31),
(295, 'Venita', 'Sabates', 'Venita Sabates', 'Tpr6Iv9WvMU', 'vsabates86@smugmug.com', 836540146, 3, 86),
(296, 'Erin', 'Meconi', 'Erin Meconi', 'MLquJORwBR', 'emeconi87@cdbaby.com', 579873678, 3, 90),
(297, 'Denver', 'Vettore', 'Denver Vettore', 'WcdXcCo6Gv', 'dvettore88@multiply.com', 863572010, 3, 0),
(298, 'Barbey', 'Janisson', 'Barbey Janisson', 'UfYcB2Ji', 'bjanisson89@independent.co.uk', 830803745, 3, 0),
(299, 'Shaun', 'Halms', 'Shaun Halms', 'LOu7Ml', 'shalms8a@list-manage.com', 588957547, 3, 21),
(300, 'Chauncey', 'Ayling', 'Chauncey Ayling', 'q9bAhhFX', 'cayling8b@mac.com', 796232818, 3, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `repertuar`
--

CREATE TABLE `repertuar` (
  `ID_repertuar` int(10) NOT NULL,
  `ID_film` int(10) NOT NULL,
  `godzina` time NOT NULL,
  `data` date NOT NULL,
  `liczba_wolnych_miejsc` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `repertuar`
--

INSERT INTO `repertuar` (`ID_repertuar`, `ID_film`, `godzina`, `data`, `liczba_wolnych_miejsc`) VALUES
(1, 16, '18:01:00', '2019-01-17', 300),
(2, 22, '15:43:00', '2019-01-30', 300),
(3, 10, '22:46:00', '2019-02-04', 300),
(4, 6, '18:36:00', '2019-02-25', 300),
(5, 3, '20:51:00', '2019-01-07', 300),
(6, 20, '13:09:00', '2018-12-01', 300),
(7, 20, '12:09:00', '2019-01-08', 300),
(8, 5, '12:41:00', '2019-02-24', 300),
(9, 12, '14:45:00', '2019-01-15', 300),
(10, 25, '14:46:00', '2018-12-17', 300),
(11, 25, '16:54:00', '2019-01-25', 300),
(12, 11, '17:50:00', '2019-01-10', 300),
(13, 6, '12:17:00', '2019-02-03', 300),
(14, 4, '13:53:00', '2018-12-21', 300),
(15, 19, '21:40:00', '2019-02-08', 300),
(16, 25, '21:20:00', '2019-01-19', 300),
(17, 21, '18:14:00', '2019-02-24', 300),
(18, 18, '10:01:00', '2018-12-18', 300),
(19, 23, '13:03:00', '2019-02-20', 300),
(20, 18, '09:10:00', '2019-02-16', 300),
(21, 14, '17:25:00', '2019-01-06', 300),
(22, 19, '21:49:00', '2018-12-10', 300),
(23, 5, '12:13:00', '2019-01-26', 300),
(24, 6, '20:58:00', '2019-02-11', 300),
(25, 7, '12:16:00', '2019-01-28', 300),
(26, 6, '14:02:00', '2019-01-18', 300),
(27, 10, '22:20:00', '2019-01-02', 300),
(28, 14, '15:40:00', '2018-12-13', 300),
(29, 14, '19:46:00', '2019-01-28', 300),
(30, 13, '14:12:00', '2019-01-24', 300),
(31, 20, '20:03:00', '2019-02-02', 300),
(32, 11, '22:19:00', '2018-12-30', 300),
(33, 12, '21:38:00', '2018-12-08', 300),
(34, 5, '10:19:00', '2018-12-09', 300),
(35, 22, '16:40:00', '2018-12-29', 300),
(36, 7, '15:53:00', '2018-12-14', 300),
(37, 21, '21:37:00', '2019-02-26', 300),
(38, 2, '09:23:00', '2018-12-28', 300),
(39, 30, '13:10:00', '2019-01-25', 300),
(40, 16, '14:24:00', '2019-02-13', 300),
(41, 7, '13:46:00', '2019-01-12', 300),
(42, 11, '10:14:00', '2019-02-15', 300),
(43, 14, '21:39:00', '2018-12-06', 300),
(44, 4, '20:39:00', '2018-12-10', 300),
(45, 18, '17:08:00', '2019-02-14', 300),
(46, 8, '19:00:00', '2019-02-15', 300),
(47, 29, '18:38:00', '2019-02-22', 300),
(48, 24, '09:35:00', '2018-12-18', 300),
(49, 2, '11:03:00', '2018-12-16', 300),
(50, 26, '14:26:00', '2019-02-27', 300),
(51, 29, '22:17:00', '2018-12-20', 300),
(52, 26, '14:05:00', '2019-01-07', 300),
(53, 29, '18:39:00', '2018-12-04', 300),
(54, 1, '12:13:00', '2019-01-08', 300),
(55, 3, '18:47:00', '2019-01-31', 300),
(56, 6, '22:42:00', '2019-02-27', 300),
(57, 15, '09:08:00', '2019-02-10', 300),
(58, 24, '17:18:00', '2019-02-27', 300),
(59, 26, '17:28:00', '2019-01-27', 300),
(60, 10, '10:47:00', '2019-02-14', 300),
(61, 28, '09:29:00', '2019-02-12', 300),
(62, 7, '12:59:00', '2018-12-06', 300),
(63, 26, '18:44:00', '2019-01-30', 300),
(64, 13, '17:32:00', '2019-02-10', 300),
(65, 18, '09:43:00', '2019-01-09', 300),
(66, 3, '14:06:00', '2019-02-24', 300),
(67, 6, '18:16:00', '2018-12-23', 300),
(68, 12, '21:54:00', '2018-12-08', 300),
(69, 17, '15:59:00', '2019-01-06', 300),
(70, 20, '18:03:00', '2019-01-16', 300),
(71, 2, '15:21:00', '2019-01-29', 300),
(72, 5, '13:36:00', '2019-01-03', 300),
(73, 23, '15:32:00', '2018-12-17', 300),
(74, 30, '19:39:00', '2019-01-28', 300),
(75, 15, '21:17:00', '2019-01-26', 300),
(76, 13, '10:31:00', '2019-02-10', 300),
(77, 1, '10:47:00', '2019-01-23', 300),
(78, 2, '10:46:00', '2018-12-04', 300),
(79, 4, '11:23:00', '2019-01-22', 300),
(80, 21, '09:19:00', '2019-02-06', 300),
(81, 17, '17:13:00', '2019-01-07', 300),
(82, 2, '18:21:00', '2019-01-08', 300),
(83, 7, '17:20:00', '2019-01-27', 300),
(84, 27, '14:50:00', '2018-12-25', 300),
(85, 7, '16:25:00', '2019-02-27', 300),
(86, 11, '14:25:00', '2018-12-26', 300),
(87, 24, '16:43:00', '2019-02-26', 300),
(88, 22, '20:20:00', '2018-12-21', 300),
(89, 3, '13:30:00', '2019-01-11', 300),
(90, 15, '20:41:00', '2019-01-09', 300),
(91, 9, '14:40:00', '2019-01-18', 300),
(92, 27, '19:31:00', '2019-01-16', 300),
(93, 28, '21:11:00', '2018-12-21', 300),
(94, 27, '19:18:00', '2018-12-02', 300),
(95, 29, '10:52:00', '2018-12-26', 300),
(96, 2, '09:30:00', '2018-12-10', 300),
(97, 3, '20:42:00', '2019-01-24', 300),
(98, 11, '21:59:00', '2019-01-31', 300),
(99, 19, '15:37:00', '2018-12-12', 300),
(100, 17, '10:17:00', '2019-02-03', 300);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_biletu`
--

CREATE TABLE `rodzaj_biletu` (
  `ID_rodzajbiletu` int(10) NOT NULL,
  `nazwa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rodzaj_biletu`
--

INSERT INTO `rodzaj_biletu` (`ID_rodzajbiletu`, `nazwa`) VALUES
(1, 'normalny'),
(2, 'ulgowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_konta`
--

CREATE TABLE `rodzaj_konta` (
  `ID_rodzajkonta` int(10) NOT NULL,
  `nazwa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rodzaj_konta`
--

INSERT INTO `rodzaj_konta` (`ID_rodzajkonta`, `nazwa`) VALUES
(1, 'dyrektor'),
(2, 'kasjer'),
(3, 'klient');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_stanu`
--

CREATE TABLE `rodzaj_stanu` (
  `ID_rodzajstanu` int(10) NOT NULL,
  `nazwa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rodzaj_stanu`
--

INSERT INTO `rodzaj_stanu` (`ID_rodzajstanu`, `nazwa`) VALUES
(1, 'wolne'),
(2, 'zajete');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sala`
--

CREATE TABLE `sala` (
  `ID_sala` int(10) NOT NULL,
  `ID_repertuar` int(10) NOT NULL,
  `rzad` int(2) NOT NULL,
  `miejsce` int(2) NOT NULL,
  `ID_rodzajstanu` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `ID_zamowienie` int(11) NOT NULL,
  `ID_osoba` int(11) NOT NULL,
  `status_zamowienia` varchar(20) NOT NULL,
  `liczba_biletow` int(3) NOT NULL,
  `cena_zamowienia` int(4) NOT NULL,
  `data_zamowienia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bilet`
--
ALTER TABLE `bilet`
  ADD PRIMARY KEY (`ID_bilet`),
  ADD KEY `ID_zamowienie` (`ID_zamowienie`),
  ADD KEY `ID_repertuar` (`ID_repertuar`),
  ADD KEY `ID_sala` (`ID_sala`),
  ADD KEY `ID_rodzajbiletu` (`ID_rodzajbiletu`);

--
-- Indeksy dla tabeli `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_film`);

--
-- Indeksy dla tabeli `osoba`
--
ALTER TABLE `osoba`
  ADD PRIMARY KEY (`ID_osoba`),
  ADD KEY `ID_rodzajkonta` (`ID_rodzajkonta`);

--
-- Indeksy dla tabeli `repertuar`
--
ALTER TABLE `repertuar`
  ADD PRIMARY KEY (`ID_repertuar`),
  ADD KEY `ID_film` (`ID_film`);

--
-- Indeksy dla tabeli `rodzaj_biletu`
--
ALTER TABLE `rodzaj_biletu`
  ADD PRIMARY KEY (`ID_rodzajbiletu`);

--
-- Indeksy dla tabeli `rodzaj_konta`
--
ALTER TABLE `rodzaj_konta`
  ADD PRIMARY KEY (`ID_rodzajkonta`);

--
-- Indeksy dla tabeli `rodzaj_stanu`
--
ALTER TABLE `rodzaj_stanu`
  ADD PRIMARY KEY (`ID_rodzajstanu`);

--
-- Indeksy dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`ID_sala`),
  ADD KEY `ID_repertuar` (`ID_repertuar`),
  ADD KEY `ID_rodzajstanu` (`ID_rodzajstanu`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`ID_zamowienie`),
  ADD KEY `ID_osoba` (`ID_osoba`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `bilet`
--
ALTER TABLE `bilet`
  MODIFY `ID_bilet` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `film`
--
ALTER TABLE `film`
  MODIFY `ID_film` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `osoba`
--
ALTER TABLE `osoba`
  MODIFY `ID_osoba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT dla tabeli `repertuar`
--
ALTER TABLE `repertuar`
  MODIFY `ID_repertuar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT dla tabeli `rodzaj_biletu`
--
ALTER TABLE `rodzaj_biletu`
  MODIFY `ID_rodzajbiletu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `rodzaj_konta`
--
ALTER TABLE `rodzaj_konta`
  MODIFY `ID_rodzajkonta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `rodzaj_stanu`
--
ALTER TABLE `rodzaj_stanu`
  MODIFY `ID_rodzajstanu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `sala`
--
ALTER TABLE `sala`
  MODIFY `ID_sala` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `ID_zamowienie` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `bilet`
--
ALTER TABLE `bilet`
  ADD CONSTRAINT `bilet_ibfk_1` FOREIGN KEY (`ID_zamowienie`) REFERENCES `zamowienie` (`ID_zamowienie`),
  ADD CONSTRAINT `bilet_ibfk_2` FOREIGN KEY (`ID_repertuar`) REFERENCES `repertuar` (`ID_repertuar`),
  ADD CONSTRAINT `bilet_ibfk_3` FOREIGN KEY (`ID_sala`) REFERENCES `sala` (`ID_sala`),
  ADD CONSTRAINT `bilet_ibfk_4` FOREIGN KEY (`ID_rodzajbiletu`) REFERENCES `rodzaj_biletu` (`ID_rodzajbiletu`);

--
-- Ograniczenia dla tabeli `osoba`
--
ALTER TABLE `osoba`
  ADD CONSTRAINT `osoba_ibfk_1` FOREIGN KEY (`ID_rodzajkonta`) REFERENCES `rodzaj_konta` (`ID_rodzajkonta`);

--
-- Ograniczenia dla tabeli `repertuar`
--
ALTER TABLE `repertuar`
  ADD CONSTRAINT `repertuar_ibfk_1` FOREIGN KEY (`ID_film`) REFERENCES `film` (`ID_film`);

--
-- Ograniczenia dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`ID_repertuar`) REFERENCES `repertuar` (`ID_repertuar`),
  ADD CONSTRAINT `sala_ibfk_2` FOREIGN KEY (`ID_rodzajstanu`) REFERENCES `rodzaj_stanu` (`ID_rodzajstanu`);

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `zamowienie_ibfk_1` FOREIGN KEY (`ID_osoba`) REFERENCES `osoba` (`ID_osoba`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
