-- Drop Tables
DROP TABLE IF EXISTS Job_Application;
DROP TABLE IF EXISTS Jobs;
DROP TABLE IF EXISTS Job_Category;
DROP TABLE IF EXISTS Company_Employer;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS Resume_Profile;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Roles;

-- Roles
CREATE TABLE IF NOT EXISTS Roles (
    role CHAR(9) PRIMARY KEY
);

-- Users
CREATE TABLE IF NOT EXISTS Users (
    email VARCHAR(255) PRIMARY KEY,
    password CHAR(32) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    nationality VARCHAR(32) NOT NULL,
    contact INT UNSIGNED NOT NULL,
    gender CHAR(6) NOT NULL,
    role CHAR(9) NOT NULL REFERENCES Roles(role),
    dob DATE NOT NULL,
	FULLTEXT (first_name, last_name),
    CONSTRAINT Check_Gender CHECK (gender ='female' OR gender='male')
);


-- Resume_Profile
CREATE TABLE Resume_Profile (
    owner VARCHAR(255) PRIMARY KEY,
    address VARCHAR(65535) NOT NULL,
    description TEXT NOT NULL,
    work_history TEXT,
    edu_history TEXT,    
	skills TEXT,
    location_pref TEXT NOT NULL,
    interest_area TEXT NOT NULL,
	FULLTEXT (owner, address, description, work_history, edu_history, skills, interest_area),
    FOREIGN KEY (owner) REFERENCES Users(email)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    CONSTRAINT Owner_Not_Jobseeker CHECK (
        owner IN (SELECT u.email FROM Users u WHERE u.role = 'jobseeker')
    )
);

-- Company
CREATE TABLE Company (
    company_reg_no VARCHAR(255) PRIMARY KEY,
    company_admin VARCHAR(255) unique NOT NULL,
    company_name VARCHAR(255) UNIQUE NOT NULL,
    address TEXT NOT NULL,
    description TEXT NOT NULL,
    FULLTEXT (company_name, address),
	FOREIGN KEY (company_admin) REFERENCES Users(email)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    CONSTRAINT Company_Admin_Not_Employer CHECK (
        company_admin IN (SELECT u.email FROM Users u WHERE u.role = 'employer')
    )
);

-- Company_Employers
CREATE TABLE Company_Employer (
    employer VARCHAR(255) PRIMARY KEY,
    company_reg_no VARCHAR(255) NOT NULL,
    accepted BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (employer) REFERENCES Users(email)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    FOREIGN KEY (company_reg_no) REFERENCES Company(company_reg_no)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    CONSTRAINT Company_Only_Employer CHECK (
        employer IN (SELECT u.email FROM Users u WHERE u.role = 'employer')
    )
);

-- Job_Category
CREATE TABLE Job_Category (
    category_id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (category_id),
	FULLTEXT (name)
);


-- Jobs
CREATE TABLE Jobs (
    job_id INT UNSIGNED AUTO_INCREMENT,
    company_reg_no VARCHAR(255),
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    published BOOLEAN NOT NULL DEFAULT TRUE,
    category_id INT NOT NULL,
    title VARCHAR(65535) NOT NULL,
    description TEXT NOT NULL,
    experience INT UNSIGNED DEFAULT 0,
    skills TEXT,
	location TEXT NOT NULL,
	FULLTEXT (title, description, skills),
    PRIMARY KEY (job_id, company_reg_no),
    FOREIGN KEY (company_reg_no) REFERENCES Company(company_reg_no)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES Job_Category(category_id)
);

-- Job_Applications
CREATE TABLE Job_Application (
    applicant VARCHAR(255),
    job_id INT UNSIGNED,
    date_submitted DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (applicant, job_id),
    FOREIGN KEY (applicant) REFERENCES Users(email)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    FOREIGN KEY (job_id) REFERENCES Jobs(job_id)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    CONSTRAINT Appliciant_Only_Jobseekers CHECK (
        applicant IN (SELECT u.email FROM Users u WHERE u.role = 'jobseeker')
    )
);

-- Company_Employer_Detailed View
CREATE OR REPLACE VIEW company_employer_detailed AS
SELECT c.*, u.first_name, u.last_name, u.contact, u.gender
FROM company_employer c, users u
WHERE c.employer = u.email;