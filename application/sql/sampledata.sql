/*---sample jobseekers---*/
INSERT INTO `Users` VALUES 
('john01@demo.com', MD5('pass1234'), 'john01', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1990-01-01'),
('john02@demo.com', MD5('pass1234'), 'john02', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1990-02-01'),
('john03@demo.com', MD5('pass1234'), 'john03', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1991-03-01'),
('john04@demo.com', MD5('pass1234'), 'john04', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1991-04-01'),
('john05@demo.com', MD5('pass1234'), 'john05', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1992-05-01'),
('john06@demo.com', MD5('pass1234'), 'john06', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1992-06-01'),
('john07@demo.com', MD5('pass1234'), 'john07', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1993-07-01'),
('john08@demo.com', MD5('pass1234'), 'john08', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1993-08-01'),
('john09@demo.com', MD5('pass1234'), 'john09', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1994-09-01'),
('john10@demo.com', MD5('pass1234'), 'john10', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1994-10-01'),
('john11@demo.com', MD5('pass1234'), 'john11', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1995-11-01'),
('john12@demo.com', MD5('pass1234'), 'john12', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1995-12-01'),
('john13@demo.com', MD5('pass1234'), 'john13', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1996-01-01'),
('john14@demo.com', MD5('pass1234'), 'john14', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1996-02-01'),
('john15@demo.com', MD5('pass1234'), 'john15', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1996-03-01'),
('john16@demo.com', MD5('pass1234'), 'john16', 'doe', 'Singaporean', '81234567', 'male', 'jobseeker', '1996-04-01');

/*---sample employers---*/
INSERT INTO `Users` VALUES 
('elaine01@demo.com', MD5('pass1234'), 'elaine01', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1985-01-01'),
('elaine02@demo.com', MD5('pass1234'), 'elaine02', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1985-08-01'),
('elaine03@demo.com', MD5('pass1234'), 'elaine03', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1985-03-01'),
('elaine04@demo.com', MD5('pass1234'), 'elaine04', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1986-04-01'),
('elaine05@demo.com', MD5('pass1234'), 'elaine05', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1986-05-01'),
('elaine06@demo.com', MD5('pass1234'), 'elaine06', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1986-06-01'),
('elaine07@demo.com', MD5('pass1234'), 'elaine07', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1987-07-01'),
('elaine08@demo.com', MD5('pass1234'), 'elaine08', 'teo', 'Singaporean', '87654321', 'female', 'employer', '1987-08-01');

/*---sample companies---*/
INSERT INTO `company`(`company_reg_no`, `company_admin`, `company_name`, `address`, `description`) VALUES 
('c01','elaine01@demo.com','companycat01','1 Changi Rd','company hiring Finance & Account'),
('c02','elaine02@demo.com','companycat02','1 Jurong Rd','company hiring Human Resources'),
('c03','elaine03@demo.com','companycat03','2 Changi Rd','company hiring Purchase & Supply Chain'),
('c04','elaine04@demo.com','companycat04','2 Jurong Rd','company hiring Adminstrations/ Secretarial'),
('c05','elaine05@demo.com','companycat05','3 Changi Rd','company hiring Legal'),
('c06','elaine06@demo.com','companycat06','3 Jurong Rd','company hiring Customer Service/ BPO/ KPO'),
('c07','elaine07@demo.com','companycat07','4 Changi Rd','company hiring Sales'),
('c08','elaine08@demo.com','companycat08','4 Jurong Rd','company hiring Marketing');

/*---sample companies employers---*/
INSERT INTO `company_employer`(`employer`, `company_reg_no`, `accepted`) VALUES 
('elaine01@demo.com','c01',1),
('elaine02@demo.com','c02',1),
('elaine03@demo.com','c03',1),
('elaine04@demo.com','c04',1),
('elaine05@demo.com','c05',1),
('elaine06@demo.com','c06',1),
('elaine07@demo.com','c07',1),
('elaine08@demo.com','c08',1);


/*---possible combinations---
categories: 1-8
title: 'assistant','executive', 'manager', 'director'
experience: 0, 2, 5, 8
skills: 'technical', 'operation management', 'middle management', 'senior management'
*/

/*---sample jobs---*/
INSERT INTO `jobs`(`job_id`, `company_reg_no`, `category_id`, `title`, `description`,`experience`, `skills`) VALUES 
(0,'c01',1,'assistant','Finance & Account',0,'technical'),
(1,'c01',1,'executive','Finance & Account',2,'operation management'),
(2,'c02',2,'manager','Human Resources',5,'middle management'),
(3,'c02',2,'director','Human Resources',8,'senior management'),
(4,'c03',3,'assistant','Purchase & Supply Chain',0,'technical'),
(5,'c03',3,'executive','Purchase & Supply Chain',2,'operation management'),
(6,'c04',4,'manager','Adminstrations/ Secretarial',5,'middle management'),
(7,'c04',4,'director','Adminstrations/ Secretarial',8,'senior management'),
(8,'c05',5,'assistant','Legal',0,'technical'),
(9,'c05',5,'executive','Legal',2,'operation management'),
(10,'c06',6,'manager','Customer Service/ BPO/ KPO',5,'middle management'),
(11,'c06',6,'director','Customer Service/ BPO/ KPO',8,'senior management'),
(12,'c07',7,'assistant','Sales',0,'technical'),
(13,'c07',7,'executive','Sales',2,'operation management'),
(14,'c08',8,'manager','Marketing',5,'middle management'),
(15,'c08',8,'director','Marketing',8,'senior management');


/*---possible combinations---
description: map to category 1 - 8
work_history: map to experience (1,3,6,9) and title
edu_history: 'diploma', 'degree'
*/
 /*---sample resumes---*/
INSERT INTO `resume_profile`(`owner`, `address`, `description`, `work_history`, `edu_history`) VALUES 
('john01@demo.com','Singapore','Finance & Account','1 year as assistant','diploma'),
('john02@demo.com','Singapore','Finance & Account','3 year as executive','degree'),
('john03@demo.com','Singapore','Human Resources','6 year as manager','diploma'),
('john04@demo.com','Singapore','Human Resources','9 year as director','degree'),
('john05@demo.com','Singapore','Purchase & Supply Chain','1 year as assistant','diploma'),
('john06@demo.com','Singapore','Purchase & Supply Chain','3 year as executive','degree'),
('john07@demo.com','Singapore','Adminstrations/ Secretarial','6 year as manager','diploma'),
('john08@demo.com','Singapore','Adminstrations/ Secretarial','9 year as director','degree'),
('john09@demo.com','Singapore','Legal','1 year as assistant','diploma'),
('john10@demo.com','Singapore','Legal','3 year as executive','degree'),
('john11@demo.com','Singapore','Customer Service/ BPO/ KPO','6 year as manager','diploma'),
('john12@demo.com','Singapore','Customer Service/ BPO/ KPO','9 year as director','degree'),
('john13@demo.com','Singapore','Sales','1 year as assistant','diploma'),
('john14@demo.com','Singapore','Sales','3 year as executive','degree'),
('john15@demo.com','Singapore','Marketing','6 year as manager','diploma'),
('john16@demo.com','Singapore','Marketing','9 year as director','degree');
