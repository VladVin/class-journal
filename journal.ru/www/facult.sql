--
-- База данных: `facult`
--

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `StudentID` int(11) unsigned NOT NULL,
  `SubjectID` int(11) unsigned NOT NULL,
  `Mark` tinyint(3) unsigned NOT NULL,
  FOREIGN KEY StudentID REFERENCES students.ID
  ON UPDATE CASCADE
  ON DELETE CASCADE,
  FOREIGN KEY SubjectID REFERENCES subjects.ID
  ON UPDATE CASCADE
  ON DELETE CASCADE
);

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`StudentID`, `SubjectID`, `Mark`) VALUES
(1, 2, 5),
(1, 5, 5),
(2, 3, 4),
(2, 4, 5),
(3, 1, 5),
(3, 2, 3),
(4, 3, 3),
(4, 2, 4),
(5, 3, 3),
(5, 2, 4),
(6, 1, 5),
(6, 4, 5),
(7, 2, 5),
(7, 3, 4),
(8, 1, 3),
(8, 2, 4),
(9, 4, 4),
(9, 1, 5),
(10, 3, 2),
(10, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Surname` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `MiddleName` varchar(30) NOT NULL,
  `Address` text,
  `Phone` bigint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`)
);

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`ID`, `Surname`, `FirstName`, `MiddleName`, `Address`, `Phone`) VALUES
(1, 'Kruchinin', 'Dmitry', 'Andreevich', 'Nizhny Novgorod, Gagarina street, 23, hostel 1, 86', 89506116602),
(2, 'Polikov', 'Vadim', 'Dmitriyevich', 'Nizhny Nodgorod, Kominterna street, 101 a', 89204597827),
(3, 'Kornilov', 'Alexander', 'Sergeevich', 'Arzamas, Pokerskaya street, 38 b', 89526828166),
(4, 'Manilow', 'Vladimir', 'Olegovich', 'Nizhny Novgorod, Artelnaya street, 35', 89200327172),
(5, 'Zhukov', 'Anton', 'Andreevich', 'Nizhniy Novgorod, Pokrovskaya street, 15', 89087385352),
(6, 'Bobrikov', 'Gleb', 'Alekseevich', 'Bor, Simple street, 17', 89451356264),
(7, 'Vinogradov', 'Vladislav', 'Alexandrovich', 'Sokolskoe, Pushkina street, 7', 89526568341),
(8, 'Tarasov', 'Dmitriy', 'Alekseevich', 'Murom, Sobakinskaya street, 78', 89047345652),
(9, 'Supov', 'Andrey', 'Mihaylovich', 'Lyskovo, Empty street, 48', 89541272524),
(10, 'Leskov', 'Uriy', 'Alekseevich', 'Pushkarevo, Pyatnica street, 13', 89057356261),
(11, 'Shurikov', 'Andrey', 'Pavlovich', 'Moscow, Red square', 89738741155);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` char(50) NOT NULL,
  `NumLections` int(11) NOT NULL,
  `NumPractise` int(11) NOT NULL,
  `NumLabs` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
);

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`ID`, `Name`, `NumLections`, `NumPractise`, `NumLabs`) VALUES
(1, 'Numerical methods', 150, 50, 3),
(2, 'Linear algebra', 180, 90, 0),
(3, 'Theory of probability', 100, 50, 5),
(4, 'Philosophy', 50, 50, 0),
(5, 'Topology', 100, 50, 5);