CREATE DATABASE IF NOT EXISTS devel;

USE devel

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
	username varchar(50),
	password varchar(50),
	role varchar(20),
	first_name varchar(32),
	middle_initial char(1),
	last_name varchar(32),
	primary_phone char(12),
	secondary_phone char(12),
	email_address varchar(128),
	education_level_id int unsigned,
	certification date,
	school_id int unsigned,
	average_rating float,
	reviewer_count int unsigned,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS absences;
CREATE TABLE absences (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	absentee_id int unsigned,
	fulfiller_id int unsigned,
	school_id int unsigned,
	room varchar(16),
	start datetime,
	end datetime,
	comment text,
	approval_id int unsigned,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS approvals;
CREATE TABLE approvals (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	approved tinyint(1) DEFAULT 0,
	approver_id int unsigned,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS schools;
CREATE TABLE schools (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	name varchar(256),
	abbreviation varchar(8),
	street_address text
);

DROP TABLE IF EXISTS schools_users;
CREATE TABLE schools_users (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	school_id int,
	user_id int
);

DROP TABLE IF EXISTS education_levels;
CREATE TABLE education_levels (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	name varchar(64)
);

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	author_id int unsigned,
	subject_id int unsigned,
	rating tinyint,
	review text,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS applications;
CREATE TABLE applications (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	user_id int unsigned,
	absence_id int unsigned
);

DROP TABLE IF EXISTS notifications;
CREATE TABLE notifications (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	notification_type varchar(31),
	user_id int unsigned,
	absence_id int unsigned,
	other_id int unsigned,
	new tinyint(1) DEFAULT 1,
	created datetime
);

INSERT INTO education_levels (name) VALUES
	('Some High School'),
	('High School'),
	('Associate\'s Degree'),
	('Bachelor\'s Degree'),
	('Master\'s Degree'),
	('Doctorate');

-- set up the dev environment
INSERT INTO schools (name, abbreviation, street_address) VALUES
	('John Smith High', 'JSH', '1 Blue Devil Way'),
	('Eighth Street Middle', 'ESM', '800 W 8th St'),
	('Matt Wilson Elementary', 'MWE', '123 1st St'),
	('Len Lastinger Primary', 'LLP', '802 Lakeside Dr');

INSERT INTO users (username, password, role, first_name, middle_initial, last_name, email_address, primary_phone, education_level_id, certification, school_id) VALUES
	('ariadne', '0336f0081bc7b681e93679021ae75720e001012f', 'admin', 'Ariadne', 'A', 'Adminis', 'ariadne@example.com', '555-555-6789', null, null, 1),
	('tess', '0336f0081bc7b681e93679021ae75720e001012f', 'teacher', 'Tess', 'T', 'Techa', 'tess@example.com', '555-555-1290', null, null, 1),
	('steph', '0336f0081bc7b681e93679021ae75720e001012f', 'substitute', 'Steph', 'S', 'Subst', 'steph@example.com', '555-555-9934', 2, '2005-03-11', null);

INSERT INTO schools_users (school_id, user_id) VALUES
	(3, 3),
	(4, 3);
