CREATE DATABASE exeat;
USE exeat;

CREATE TABLE Student_guardian_1 (
	guardian_1_id INT AUTO_INCREMENT PRIMARY KEY,
    guardian_1_name VARCHAR(50),
    guardian_1_relationship ENUM('FATHER','MOTHER','GUARDIAN'),
    guardian_1_contact_number INT,
    guardian_1_email VARCHAR(50)
);

CREATE TABLE Student_guardian_2 (
	guardian_2_id INT AUTO_INCREMENT PRIMARY KEY,
    guardian_2_name VARCHAR(50),
    guardian_2_relationship ENUM('FATHER','MOTHER','GUARDIAN'),
    guardian_2_contact_number INT,
    guardian_2_email VARCHAR(50)
);

CREATE TABLE students (
	std_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    full_name VARCHAR(50),
    passwords INT,
    contact_number INT,
    house ENUM('Garnet','Topaz','Diamond','Sapphire') NULL,
    email VARCHAR(50),
    guardian_1_id INT,
    guardian_2_id INT,
	FOREIGN KEY (guardian_1_id) REFERENCES Student_guardian_1(guardian_1_id),
    FOREIGN KEY (guardian_2_id) REFERENCES Student_guardian_2(guardian_2_id)
);

CREATE TABLE students_blocks (
	std_id INT AUTO_INCREMENT PRIMARY KEY,
    block_1_tchr_id INT NULL,
    block_2_tchr_id INT NULL,
    block_3_tchr_id INT NULL,
    block_4_tchr_id INT NULL,
    block_5_tchr_id INT NULL,
    block_6_tchr_id INT NULL
);

CREATE TABLE Teachers (
	tcr_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    full_name VARCHAR(50),
    passwords INT,
    contact_number INT,
    house ENUM('Garnet','Topaz','Diamond','Sapphire') NULL,
    email VARCHAR(50)
);

CREATE TABLE teachers_blocks (
	tchr_id INT AUTO_INCREMENT PRIMARY KEY,
    block_1 BOOL,
    block_2 BOOL,
    block_3 BOOL,
    block_4 BOOL,
    block_5 BOOL,
    block_6 BOOL
);

CREATE TABLE guards (
	guard_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    full_name VARCHAR(50),
    passwords INT,
    contact_number INT,
    passkey INT
);

CREATE TABLE houseparents (
	houseparent_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50),
    house ENUM('Garnet','Topaz','Diamond','Sapphire')
);

CREATE TABLE teacher_approval (
	teacher_approval_id INT PRIMARY KEY,
    student_id INT,
    teacher_approval_status BOOL,
    FOREIGN KEY (student_id) REFERENCES students_blocks(student_id)
);

CREATE TABLE houseparent_approval (
	houseparent_approval_id INT PRIMARY KEY,
    houseparent_id INT,
    houseparent_approval_status BOOL,
    FOREIGN KEY (houseparent_id) REFERENCES houseparents(houseparent_id)
);

CREATE TABLE outing (
	outing_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    exeat BOOL,
    outing_reason VARCHAR(50),
    outing_destination VARCHAR(50),
    outing_duration VARCHAR (50),
    outing_transport VARCHAR (50),
    teacher_approval_id INT,
    houseparent_approval_id INT,
    outing_approval_outcome BOOL,
    FOREIGN KEY (student_id) REFERENCES students (student_id),
    FOREIGN KEY (teacher_approval_id) REFERENCES teacher_approval (teacher_approval_id),
    FOREIGN KEY (houseparent_approval_id) REFERENCES houseparent_approval (houseparent_approval_id)
);
    
CREATE TABLE student_status (
	student_id INT,
	outing_time_out TIMESTAMP,
	outing_time_in TIMESTAMP,
	guard_out_id INT,
	guard_in_id INT,
	on_campus BOOL,
    FOREIGN KEY (guard_out_id) REFERENCES guards (guard_id),
    FOREIGN KEY (guard_in_id) REFERENCES guards (guard_id)
);