-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0
-- Время создания: Янв 09 2025 г., 00:35
-- Версия сервера: 8.0.35
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hotel_management`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `guest_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `bookings`
--

INSERT INTO `bookings` (`booking_id`, `guest_id`, `room_id`, `start_date`, `end_date`) VALUES
(1, 1, 1, '2023-10-01', '2023-10-05'),
(2, 2, 2, '2023-10-03', '2023-10-07'),
(3, 3, 3, '2023-10-05', '2023-10-10'),
(4, 4, 4, '2023-10-08', '2023-10-12'),
(5, 5, 5, '2023-10-09', '2023-10-14'),
(6, 6, 6, '2023-10-10', '2023-10-15'),
(7, 7, 7, '2023-10-11', '2023-10-16'),
(8, 8, 8, '2023-10-12', '2023-10-17');

-- --------------------------------------------------------

--
-- Структура таблицы `cleaning_records`
--

CREATE TABLE `cleaning_records` (
  `record_id` int NOT NULL,
  `room_id` int DEFAULT NULL,
  `cleaning_date` date DEFAULT NULL,
  `cleaned_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cleaning_records`
--

INSERT INTO `cleaning_records` (`record_id`, `room_id`, `cleaning_date`, `cleaned_by`) VALUES
(1, 1, '2023-10-02', 2),
(2, 2, '2023-10-04', 2),
(3, 3, '2023-10-06', 2),
(4, 4, '2023-10-08', 2),
(5, 5, '2023-10-09', 2),
(6, 6, '2023-10-10', 2),
(7, 7, '2023-10-11', 2),
(8, 8, '2023-10-12', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `employee_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `position`, `phone`) VALUES
(1, 'Иван Иванов', 'Менеджер', '123-456-7890'),
(2, 'Мария Петрова', 'Уборщица', '098-765-4321'),
(3, 'Сергей Сидоров', 'Администратор', '234-567-8901'),
(4, 'Анна Смирнова', 'Ресепшенист', '345-678-9012'),
(5, 'Дмитрий Ковалев', 'Повар', '456-789-0123'),
(6, 'Елена Васильева', 'Клининговый менеджер', '567-890-1234'),
(7, 'Александр Федоров', 'Охранник', '678-901-2345'),
(8, 'Татьяна Романова', 'Менеджер по продажам', '789-012-3456');

-- --------------------------------------------------------

--
-- Структура таблицы `guests`
--

CREATE TABLE `guests` (
  `guest_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `guests`
--

INSERT INTO `guests` (`guest_id`, `name`, `phone`, `email`) VALUES
(1, 'Алексей Смирнов', '321-654-0987', 'alexey@example.com'),
(2, 'Ольга Кузнецова', '456-789-0123', 'olga@example.com'),
(3, 'Ирина Белова', '567-890-1234', 'irina@example.com'),
(4, 'Павел Николаев', '678-901-2345', 'pavel@example.com'),
(5, 'Светлана Орлова', '789-012-3456', 'svetlana@example.com'),
(6, 'Кирилл Михайлов', '890-123-4567', 'kirill@example.com'),
(7, 'Наталья Соколова', '901-234-5678', 'natalia@example.com'),
(8, 'Владимир Петров', '012-345-6789', 'vladimir@example.com');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `description` text,
  `price_per_night` decimal(10,2) NOT NULL,
  `responsible_employee` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `description`, `price_per_night`, `responsible_employee`) VALUES
(1, '101', 'Одноместный номер', 100.00, 1),
(2, '102', 'Двухместный номер', 150.00, 1),
(3, '103', 'Семейный номер', 200.00, 1),
(4, '104', 'Люкс номер', 300.00, 1),
(5, '105', 'Номер для молодоженов', 250.00, 1),
(6, '106', 'Эконом номер', 80.00, 1),
(7, '107', 'Номер с балконом', 180.00, 1),
(8, '108', 'Номер для инвалидов', 120.00, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `guest_id` (`guest_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Индексы таблицы `cleaning_records`
--
ALTER TABLE `cleaning_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `cleaned_by` (`cleaned_by`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Индексы таблицы `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `responsible_employee` (`responsible_employee`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `cleaning_records`
--
ALTER TABLE `cleaning_records`
  MODIFY `record_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Ограничения внешнего ключа таблицы `cleaning_records`
--
ALTER TABLE `cleaning_records`
  ADD CONSTRAINT `cleaning_records_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `cleaning_records_ibfk_2` FOREIGN KEY (`cleaned_by`) REFERENCES `employees` (`employee_id`);

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`responsible_employee`) REFERENCES `employees` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
