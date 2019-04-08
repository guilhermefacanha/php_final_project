-- Final Project Database

-- Command: mysql -u root -p < FinalProject.sql

SELECT '====CREATE DATABASE====';
-- DROP the database if it exists
DROP DATABASE IF EXISTS LibraryDb;

-- CREATE THE DATABASE
CREATE DATABASE LibraryDb;

-- SHOW DATABASES;

-- Use the database
USE LibraryDb;


SELECT '====CREATE TABLES====';
-- Create the LIBRARY TABLE
CREATE TABLE LIBRARY (
	LibraryId INT(9) AUTO_INCREMENT PRIMARY Key,
	Name VARCHAR(100) NOT NULL,
	Address VARCHAR(200) NOT NULL
) ENGINE = INNODB;
 

-- Create the BOOK TABLE
CREATE TABLE BOOK(
	BookId INT(9) AUTO_INCREMENT PRIMARY Key,
	LibraryId INT(9) NOT NULL,
	Title VARCHAR(100) NOT NULL,
	Author VARCHAR(100) NOT NULL,
	Category VARCHAR(100) NOT NULL,
	Available TINYINT(1) DEFAULT 0,
	FOREIGN KEY (LibraryId) REFERENCES LIBRARY(LibraryId) ON DELETE CASCADE
)  ENGINE = INNODB;

-- Create the BOOK_RENT TABLE
CREATE TABLE BOOK_RENT(
	BookRentId INT(9) AUTO_INCREMENT PRIMARY Key,
	BookId INT(9) NOT NULL,
	UserId VARCHAR(9) NOT NULL,
	RentStart DATE NOT NULL,
	RentEnd DATE,
	FOREIGN KEY (BookId) REFERENCES BOOK(BookId) ON DELETE CASCADE
) ENGINE = INNODB;

SHOW TABLES;


SELECT '====INSERTS====';
-- INSERT Librarys
INSERT INTO LIBRARY 
(Name, Address)  
VALUES 
('New Westminster Public Library', '716 6th Ave, New Westminster, BC V3M 2B3'),
('Typo Burnaby Public Library, Tommy Douglas Library Typo', '7311 Kingsway, Burnaby, BC V5E 1G8'),
('Surrey Libraries - City Centre Library', '10350 University Dr, Surrey, BC V3T 4C3'),
('Burnaby Public Library', '6100 Willingdon Ave, Burnaby, BC V5H 4N5'),
('Surrey Libraries - Guildford Library', '15105 105 Ave, Surrey, BC V3R 7G8')
;

-- INSERT Books
INSERT INTO BOOK 
(LibraryId, Title, Author, Category, Available) 
VALUES
(1, 'Java A Beginner\'s Guide Eighth edition', 'Schildt, Herbert', 'Programming', 1),
(1, 'Understanding Coding With Java','Hillman, Emilee', 'Programming', 1),
(1, 'Core Java Volume I, Fundamentals Eleventh edition', 'Horstmann, Cay S.', 'Programming', 1),
(2, 'Learning PHP A Gentle Introduction to the Web\'s Most Popular Language', 'Sklar, David', 'Programming', 1),
(2, 'PHP 20 Lessons to Successful Web Development', 'Nixon, Robin', 'Programming', 1),
(2, 'PHP, MYSQL & Javascript All-in-one for Dummies', 'Blum, Richard', 'Programming', 1),
(3, 'Python Programming How to Code Python Fast in Just 24 Hours With 7 Simple Steps', 'Scotts, Jason', 'Programming', 1),
(3, 'Beginning Programming With Python for Dummies', 'Mueller, John', 'Programming', 1),
(3, 'Sams Teach Yourself Python Programming for Raspberry Pi in 24 Hours', 'Blum, Richard', 'Programming', 1),
(4, 'C# A Beginner\'s Guide', 'McGee, Pat', 'Programming', 1),
(4, 'Head First C#', 'Stellman, Andrew', 'Programming', 1),
(4, 'C# 7.0 All-in-one for Dummies', 'Mueller, John', 'Programming', 1),
(5, 'JavaScript 20 Lessons to Successful Web Development', 'Nixon, Robin', 'Programming', 1),
(5, 'JavaScript Absolute Beginner\'s Guide', 'Chinnathambi, Kirupa', 'Programming', 1),
(5, 'Coding With JavaScript for Dummies', 'Minnick, Chris', 'Programming', 1)
;

-- INSERT Book Rent
INSERT INTO LibraryDb.BOOK_RENT 
(BookId, UserId, RentStart, RentEnd) 
VALUES
(1, '900123123', '2019-03-15', '2019-03-18'),
(4, '750653287', '2019-03-14', '2019-03-17'),
(5, '300964927', '2019-03-15', '2019-03-18'),
(7, '900123123', '2019-03-15', '2019-03-18'),
(10, '750653287', '2019-03-14', '2019-03-17'),
(13, '300964927', '2019-03-14', '2019-03-17')
;


-- SELECT (READ)
SELECT '====SELECT ALL LIBRARY====';
SELECT * FROM LIBRARY;

SELECT '====CREATE ALL BOOK====';
SELECT * FROM BOOK;

SELECT '====SELECT ALL BOOK RENT====';
SELECT * FROM BOOK_RENT;

-- UPDATE (UPDATE)
SELECT '====UPDATE STRONG ENTITY LIBRARY====';
UPDATE LIBRARY SET Name = 'Burnaby Public Library, Tommy Douglas Library' WHERE LibraryId = 2;
SELECT '====UPDATE BOOK STATE AVAILABLE FOR RENTS====';
UPDATE BOOK SET Available = 0 WHERE BookId IN (1,4,5,7,10,13);

SELECT '====CREATE OUR STATS VIEW====';
-- DROP VIEW vw_book_rent
CREATE VIEW vw_book_rent AS
SELECT l.LibraryId, l.Name as library, b.BookId, b.Title, b.Author, b.Category, 
CASE WHEN b.Available = 1 THEN 'AVAILABLE' ELSE 'NOT AVAILABLE' END as Available,
br.UserId as RentedBy,br.RentStart,br.RentEnd
FROM BOOK b
LEFT JOIN BOOK_RENT br ON br.BookId = b.BookId
INNER JOIN LIBRARY l ON l.LibraryId = b.LibraryId
ORDER BY l.Name, b.Title
;




