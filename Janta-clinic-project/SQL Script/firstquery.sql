USE JantaClinic;

-- Table of doctor
CREATE TABLE Doctor(
  Doctor_ID INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  middle_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  qualification VARCHAR(100) NOT NULL,
  year_of_exp INT NOT NULL,
  specialization VARCHAR(100) NOT NULL,
  joining_data DATE NOT NULL,
  phone_number VARCHAR(12) NOT NULL UNIQUE
);

-- Table of patient
CREATE TABLE Patient(
 Patient_ID INT PRIMARY KEY AUTO_INCREMENT,
 first_name VARCHAR(50) NOT NULL,
 middle_name VARCHAR(50),
 last_name VARCHAR(50) NOT NULL,
 age INT NOT NULL,
 gender VARCHAR(10) NOT NULL,
 weight INT NOT NULL,
 bmi FLOAT NOT NULL,
 blood_group VARCHAR(3) NOT NULL,
 medical_history TEXT NOT NULL
);

-- Modify bmi datatype
ALTER TABLE Patient
MODIFY COLUMN bmi FLOAT;


-- Address Table linked to Patient
CREATE TABLE Address(
  Address_ID INT PRIMARY KEY AUTO_INCREMENT,
  street VARCHAR(50) NOT NULL,
  city VARCHAR(50) NOT NULL,
  state VARCHAR(30) NOT NULL,
  zipcode VARCHAR(10) NOT NULL,
  Patient_ID_FK INT NOT NULL,
  FOREIGN KEY(Patient_ID_FK) REFERENCES Patient(Patient_ID),
  INDEX(Patient_ID_FK)
);

-- Appointment table
CREATE TABLE Appointment(
   Appointment_ID INT AUTO_INCREMENT PRIMARY KEY,
   status VARCHAR(50) NOT NULL,
   doctor VARCHAR(100) NOT NULL,
   appointment_date DATE NOT NULL,
   reason VARCHAR(255),
   Patient_FK INT NOT NULL,
   FOREIGN KEY (Patient_FK) REFERENCES Patient(Patient_ID)
);

-- Staff table
CREATE TABLE Staff(
  Staff_ID INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(40) NOT NULL,
  middle_name VARCHAR(40),
  last_name VARCHAR(40) NOT NULL,
  role VARCHAR(50) NOT NULL,
  phone_number VARCHAR(12) NOT NULL UNIQUE,
  email VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(250),
  hire_date DATE NOT NULL
);

-- Admin table
CREATE TABLE Admin(
  Admin_ID INT PRIMARY KEY,
  password VARCHAR(50)
); 

-- Insert value in Admin table
INSERT INTO Admin (Admin_ID,password)
VALUES(911,'123');
 

-- Services table
CREATE TABLE Services(
  Service_ID INT AUTO_INCREMENT PRIMARY KEY,
  service_name VARCHAR(100) NOT NULL,
  detail VARCHAR(255),
  charge DECIMAL(10,2) NOT NULL
);

-- Billing table
CREATE TABLE Billing(
  Billing_ID INT AUTO_INCREMENT PRIMARY KEY,
  Appointment_FK INT NOT NULL,
  Patient_FK INT NOT NULL,
  total_amount DECIMAL(10,2),
  billing_date DATE NOT NULL,
  payment_status VARCHAR(50),
  FOREIGN KEY (Appointment_FK) REFERENCES Appointment(Appointment_ID),
  FOREIGN KEY (Patient_FK) REFERENCES Patient(Patient_ID)
);

-- Billing Service table

CREATE TABLE Billing_Service(
  Billing_Service_ID INT AUTO_INCREMENT PRIMARY KEY,
  Billing_id INT,
  Service_id INT,
  FOREIGN KEY (Billing_id) REFERENCES Billing(Billing_ID),
  FOREIGN KEY (Service_id) REFERENCES Services(Service_ID)
);























