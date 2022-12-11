-- phpMyAdmin SQL Dump

-- version 5.1.0

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Generation Time: Oct 07, 2021 at 08:24 AM

-- Server version: 10.4.19-MariaDB

-- PHP Version: 7.3.28

create database if not exists banking__system;

use banking__system;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

--

CREATE TABLE
    `employe` (
        `id` int(11) NOT NULL,
        `employe_id` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL DEFAULT 'employee',
        `name` varchar(255) NOT NULL,
        `gender` varchar(255) NOT NULL,
        `email_id` varchar(255) NOT NULL,
        `birthday` date NOT NULL,
        `phone_no` varchar(15) NOT NULL,
        `district` varchar(255) NOT NULL,
        `city` varchar(255) NOT NULL,
        `designation` varchar(255) NOT NULL,
        `salary` int(50) NOT NULL,
        `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `employe`

--

INSERT INTO
    `employe` (
        `id`,
        `employe_id`,
        `name`,
        `gender`,
        `email_id`,
        `birthday`,
        `phone_no`,
        `district`,
        `city`,
        `designation`,
        `salary`,
        `join_date`
    )
VALUES (
        0,
        'EM00000',
        'Andy Vo',
        'Female',
        'kirtipatil@gmail.com',
        '2000-05-11',
        '1234567890',
        'Jalgaon',
        'Jalgaon',
        'Accountant ',
        50000,
        '2021-10-06 12:29:06'
    ),(
        1,
        'EM00001',
        'Lady Pham',
        'Female',
        'kirtipatil@gmail.com',
        '2000-05-11',
        '1234567890',
        'Jalgaon',
        'Jalgaon',
        'Accountant ',
        50000,
        '2021-10-06 12:29:06'
    );

-- --------------------------------------------------------

--

--

CREATE TABLE
    `users` (
        `id` int(11) NOT NULL,
        `usename` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL DEFAULT 'user',
        `password` varchar(255) NOT NULL,
        `type` tinyint(4) NOT NULL,
        `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `users`

INSERT INTO
    `users` (
        `id`,
        `usename`,
        `password`,
        `role`,
        `type`,
        `last_login`
    )
VALUES (
        1,
        'admin',
        '21232f297a57a5a743894a0e4a801fc3',
        'admin',
        0,
        '2021-10-06 10:52:57'
    ), (
        2,
        'EM00001',
        '21232f297a57a5a743894a0e4a801fc3',
        'employee',
        1,
        '2021-10-06 12:29:06'
    );

-- Table structure for table `notify`

--

CREATE TABLE
    `notify` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `content` varchar(255) NOT NULL,
        `role` enum('admin', 'employee', 'user') NOT NULL DEFAULT 'user',
        `created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

--

INSERT INTO
    `notify` (
        `title`,
        `content`,
        `role`,
        `created_At`
    )
VALUES (
        'Event-Based Architecture',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'user',
        '2021-10-06 13:13:37'
    ), (
        'How This Course Works',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'employee',
        '2021-10-06 13:14:01'
    ), (
        'Event-Based Architecture',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'user',
        '2021-10-06 13:13:37'
    ), (
        'Event-Based Architecture',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'user',
        '2021-10-06 13:13:37'
    ), (
        'How This Course Works',
        'This course doesnt focus on using an off-the-shelf microservices framework. Many exist, but they hide the inner workings and challenges of microservices away from you',
        'employee',
        '2021-10-06 13:14:01'
    ), (
        'How This Course Works',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'employee',
        '2021-10-06 13:14:01'
    ), (
        'How This Course Works',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'employee',
        '2021-10-06 13:14:01'
    ), (
        'How This Course Works',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'employee',
        '2021-10-06 13:14:01'
    ), (
        'What Technology Youll Use',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'admin',
        '2021-10-06 13:17:23'
    );

--

-- Indexes for table `employe`

--

ALTER TABLE `employe` ADD PRIMARY KEY (`id`);

--

ALTER TABLE `users` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT for dumped tables

--

--

-- AUTO_INCREMENT for table `employe`

--

ALTER TABLE
    `employe` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--

-- AUTO_INCREMENT for table `users`

--

ALTER TABLE
    `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

COMMIT;