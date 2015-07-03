DROP TABLE IF EXISTS doctor,Location;

CREATE TABLE Location(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Longitude float(30) NOT NULL,
Latitude float(30) NOT NULL,
PlaceName VARCHAR(100),
City VARCHAR(50)
);

CREATE TABLE doctor(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(50) NOT NULL,
Gender VARCHAR(10) NOT NULL,
Type VARCHAR(30) NOT NULL,
Contact VARCHAR(50),
LocationId Int(6) UNSIGNED 
);

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.676477, 73.066024,'Shifa International Hospital','Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.702456, 73.053946,'Pakistan Institute of Medical Sciences','Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.652332, 73.015801,'PAEC General Hospital', 'Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.649471, 73.017311,'Nascom Hospital', 'Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.580738, 73.047892,'CMH Hospital', 'Rawalpindi');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.640906, 73.057455,'Holy Family Hospital', 'Rawalpindi');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (24.892298, 67.074796,'Agha Khan Hospital', 'Karachi');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (24.891844, 67.068044,'Liaquat National hospital', 'Karachi');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (31.449211, 74.271526,'Shaukat Khanum Memorial Cancer Hospital and Research Centre', 'Lahore');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.678234, 73.031512,'KRL Hospital', 'Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.710528, 73.042057,'Ali Medical Centre', 'Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.554166, 73.095568,'Fauji Foundation Hospital', 'Rawalpindi');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (33.711385, 73.041675,'Islamabad Diagnostic Center', 'Islamabad');

INSERT INTO Location (Longitude,Latitude,PlaceName,City)
VALUES (34.003330, 71.542214,'CMH Hospital', 'Peshawar');


INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Aamer Nabi Nur', 'M', 'Orthopedics','0301-3838289',1 );


INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Abdul Malik Sheikh', 'M', 'Cardiologist','0345-7676373',4);


INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Aamna Batool Khan', 'F', 'Dermatologist','0312-4473838',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Abdul Wahab Yousafzai', 'M', 'Psychiatrist','0300-3820039',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Ahsan Hameed', 'M', 'Dermatologist','0333-1234567',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Anwar Ali Shah', 'M', 'Dentist','0336-4644738',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Atif Rana', 'M', 'Radiologist','0345-387846',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Nadia Aman', 'F', 'Dentist','0312-9276263',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shazia Fakhar', 'F', 'Gynecologist','0314-9272992',3);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Syed Hamid Ali Nasr', 'M', 'Dentist','0312-6456388',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Uzma Qasim', 'F', 'Allergist','0301-8576343',2);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Mussadiq Khan', 'M', 'Epidemiologist','0300-3938666',3);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Munir Iqbal Malik', 'M', 'Physiologist','0336-3838288',4);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Muhammad Usman', 'M', 'Microbiologist','0332-4839387',3);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Aftab Akhtar', 'M', 'Orthopedics','0315-7638836',4);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Syed Shahid Ahmed Shah', 'M', 'Cardiologist','0344-3764838',5);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Syeda Sobya Owais', 'F', 'ENT Specialist','0345-4385738',6);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Tara Jaffery', 'F', 'ENT Specialist','0321-2782991',5);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Uzma Tahseen', 'F', 'Urologist','0302-1862878',6);


INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Sohail Naseem', 'M', 'Anesthesiologist','0314-8272767',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shehla Chaudhry', 'F', 'Epidemiologist','0300-6266289',8);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shahid Nazir', 'M', 'Psychiatrist','0309-2739278',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Sohail Naseem', 'M', 'Anesthesiologist','0336-8851429',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shehla Chaudhry', 'F', 'Epidemiologist','0312-8299232',8);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shahid Nazir', 'M', 'Psychiatrist','0311-7825524',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Sohail Naseem', 'M', 'Anesthesiologist','0312-5526118',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shehla Chaudhry', 'F', 'Epidemiologist','0310-8929819',8);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shahid Nazir', 'M', 'Psychiatrist','0301-9872333',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Sohail Naseem', 'M', 'Anesthesiologist','0316-8202666',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shehla Chaudhry', 'F', 'Epidemiologist','0333-5548281',8);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shazia Iram', 'F', 'ENT Specialist','0321-4428372',8);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shahid Nazir', 'M', 'Psychiatrist','0300-1825829',7);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Shahid Javaid', 'M', 'Allergist','0334-9286177',9);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Sanam Mustafa Soomro', 'F', 'Physiologist','0332-3566282',10);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Sanam Yasir', 'F', 'ENT Specialist','0300-2373291',9);

INSERT INTO doctor(Name,Gender,Type,Contact,LocationId)
VALUES ('Salman Ahmed Saleem', 'M', 'Psychiatrist','0312-5492973',10);