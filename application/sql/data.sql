--
-- clear data
--
-- Drop Tables
DELETE FROM Job_Application;
DELETE FROM Jobs;
DELETE FROM Job_Category;
DELETE FROM Company_Employer;
DELETE FROM Company;
DELETE FROM Resume_Profile;
DELETE FROM Users;
DELETE FROM Roles;

--
-- roles
--
INSERT INTO `Roles` VALUES 
('admin'), ('jobseeker'), ('employer');

--
-- admin
--
INSERT INTO `Users` VALUES 
('admin@admin.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'Admin', 'Admin', 'singaporean', '91234567', 'female', 'admin', '1980-01-01'),
('demo@demo.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'demo', 'demo', 'singaporean', '91234567', 'female', 'admin', '1980-02-01');

--
-- jobseekers 
--
INSERT INTO `Users` VALUES 
('john@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'john', 'doe', 'singaporean', '81234567', 'male', 'jobseeker', '1990-01-01'),
('judy@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'judy', 'teo', 'singaporean', '81234568', 'female', 'jobseeker', '1990-02-01'),
('june@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'june', 'tan', 'singaporean', '81234569', 'female', 'jobseeker', '1990-03-01'),
('james@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'james', 'lim', 'vietnamese', '81234570', 'male', 'jobseeker', '1990-04-01'),
('jamie@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jamie', 'gan', 'singaporean', '81234571', 'female', 'jobseeker', '1990-05-01'),
('jason@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jason', 'doe', 'japanese', '81234572', 'male', 'jobseeker', '1990-06-01'),
('jesse@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jesse', 'teo', 'singaporean', '81234573', 'female', 'jobseeker', '1990-07-01'),
('jimmy@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jimmy', 'tan', 'singaporean', '81234574', 'male', 'jobseeker', '1990-08-01'),
('jackie@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jackie', 'lim', 'malaysian', '81234575', 'male', 'jobseeker', '1990-09-01'),
('janice@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'janice', 'gan', 'british', '81234576', 'female', 'jobseeker', '1990-10-01'),
('jarvis@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jarvis', 'doe', 'singaporean', '81234577', 'male', 'jobseeker', '1990-11-01'),
('jazlyn@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jazlyn', 'teo', 'indonesian', '81234578', 'female', 'jobseeker', '1990-12-01'),
('jeremy@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jeremy', 'tan', 'singaporean', '81234579', 'male', 'jobseeker', '1991-01-01'),
('jerome@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jerome', 'lim', 'japanese', '81234580', 'male', 'jobseeker', '1991-03-01'),
('jonnie@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jonnie', 'gan', 'vietnamese', '81234581', 'male', 'jobseeker', '1991-05-01'),
('joshua@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'joshua', 'doe', 'singaporean', '81234582', 'male', 'jobseeker', '1991-07-01'),
('jasmine@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jasmine', 'teo', 'singaporean', '81234583', 'female', 'jobseeker', '1991-09-01'),
('jericho@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jericho', 'tan', 'singaporean', '81234584', 'male', 'jobseeker', '1991-11-01'),
('jessica@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jessica', 'lim', 'malaysian', '81234585', 'female', 'jobseeker', '1988-01-01'),
('jullian@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jullian', 'gan', 'singaporean', '81234586', 'male', 'jobseeker', '1988-05-01'),
('justice@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'justice', 'bao', 'british', '81234587', 'male', 'jobseeker', '1987-06-01'),
('jennifer@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jennifer', 'teo', 'indonesian', '81234588', 'female', 'jobseeker', '1986-01-01'),
('jonathan@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jonathan', 'tan', 'singaporean', '81234589', 'male', 'jobseeker', '1985-01-01'),
('joycelyn@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'joycelyn', 'lim', 'singaporean', '81234590', 'female', 'jobseeker', '1984-01-01'),
('jeannette@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jeannette', 'gan', 'malaysian', '81234591', 'female', 'jobseeker', '1983-01-01'),
('jefferson@jobseeker.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'jefferson', 'doe', 'singaporean', '81234592', 'male', 'jobseeker', '1982-01-01');

--
-- employers 
--
INSERT INTO `Users` VALUES 
('eva@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'eva', 'chen', 'singaporean', '87654321', 'female', 'employer', '1985-01-01'),
('ella@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'ella', 'chao', 'Singaporean', '87654322', 'female', 'employer', '1985-01-01'),
('emma@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'emma', 'yang', 'Singaporean', '87654323', 'female', 'employer', '1985-08-01'),
('emily@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'emily', 'wang', 'british', '87654324', 'female', 'employer', '1985-03-01'),
('erica@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'erica', 'zhao', 'Singaporean', '87654325', 'female', 'employer', '1986-04-01'),
('elaine@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'elaine', 'chen', 'Singaporean', '87654326', 'female', 'employer', '1986-05-01'),
('evonne@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'evonne', 'chao', 'Singaporean', '87654327', 'female', 'employer', '1986-06-01'),
('eleanor@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'eleanor', 'yang', 'Singaporean', '87654328', 'female', 'employer', '1987-07-01'),
('electra@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'electra', 'wang', 'Singaporean', '87654329', 'female', 'employer', '1987-08-01'),
('evelynn@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'evelynn', 'zhao', 'indonesian', '87654320', 'female', 'employer', '1987-09-01'),
('elizabeth@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'elizabeth', 'chen', 'malaysian', '87654311', 'female', 'employer', '1987-10-01'),
('elizabella@employer.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 'elizabella', 'chao', 'Singaporean', '87654331', 'female', 'employer', '1987-11-01');


-- 
-- Job Categories
-- 
INSERT INTO `job_category` (`category_id`, `name`) VALUES 
('1', 'Finance & Account'),
('2', 'Information Technology (IT)'),
('3', 'Human Resources'),
('4', 'Adminstrations/ Secretarial'),
('5', 'Design'),
('6', 'Customer Service/ BPO/ KPO'),
('7', 'Sales'),
('8', 'Marketing');


--
-- companies
--
INSERT INTO `company`(`company_reg_no`, `company_admin`, `company_name`, `address`, `description`) VALUES 
('c01','eva@employer.com','Faststream Recruitment Pte Ltd','10 Hoe Chiang Road #08-01 Keppel Towers Singapore 089315','The Faststream Recruitment Group is a highly specialist recruitment organization providing bespoke recruitment services to the Shipping, Marine and Oil & Gas sectors worldwide. Our core disciplines include; Commercial Shipping, Technical Shipping, Marine, Offshore and Oil & Gas. Established in 1999 Faststream has a network of offices in Asia, Europe, the Americas and Australia.'),

('c02','ella@employer.com','Singtel','31 Exeter Road, Comcentre Singapore 239732','The Singtel Group is Asia\'s leading communications group. Singtel is the largest listed Singapore company on the Singapore Exchange by market capitalisation. We are also listed on the Australian Securities Exchange following our acquisition of Optus in August 2001. To serve the needs of multinational corporations, Singtel has a vast network of offices in countries and territories throughout Asia Pacific, in Europe and the USA, while Optus has a network of offices around Australia.  The Group employs more than 22,000 staff worldwide.'),

('c03','emma@employer.com','Capita Technology','Collyer Quay, 049318','A dedicated technical Staffing and Search division of Capita ever committed to fulfilling our clients dynamic technical human capital needs across all industries with its Professional, Personalized and Passionate approach'),

('c04','emily@employer.com','Randstad','50 Raffles Pl, #17-02/05 Singapore Land Tower, 048623','An innovative and ever evolving MNC mining firm is seeking for an enthusiastic HR Admin Executive to join their dynamic team. They are one of the leading mining firm in business sectors, the organization\'s increased commitment to its employees and has raised a new role. They offer attractive package salary $3500 per month + attractive benefits.'),

('c05','erica@employer.com','Jobstudio Pte Ltd','5 Anson Rd, 079901','Jobstudio Pte Ltd(EA License No.:10C4754) is a dynamic professional staffing and search service provider in Singapore. We operate across the private and public sectors, dealing with permanent and contract roles across a wide range of specialized industries and professions. We are dedicated to help both employers and employees to navigate in the ever-changing world of work cultures and demands.<br /><br />
Our team is focused to bring innovative and strategic solutions to both clients and candidates and we achieve this by maintaining the highest levels of confidentiality, trust and integrity within the core industries.'),

('c06','elaine@employer.com','Huntsman (Singapore) Pte Ltd','150 Beach Road, #37-00 Singapore 189720','Huntsman is a global manufacturer and marketer of differentiated chemicals.  Its operating companies manufacture products for a variety of global industries, including chemicals, plastics, automotive, aviation, textiles, footwear, paints & coatings, construction, technology, agriculture, healthcare, detergent, personal care, furniture, appliances and packaging.  Huntsman today has 14,000 employees and over 75 operations in 24 countries.  The company had 2007 revenues from all operations of approximately $10 Billion US.'),

('c07','evonne@employer.com','Hays','20 Raffles Pl','We are the experts in recruiting qualified, professional and skilled people across a wide range of specialised industries and professions. We operate across the private and public sectors, dealing in permanent positions, contract roles and temporary assignments.
<br /><br />
At Hays, we believe the right job can transform a person\'s life and the right person can transform a business. We\'re passionate about connecting our candidates with the right job for them.
<br /><br />
That\'s why, for over 33 years, we\'ve powered the world of work.');

--
-- companies employers
--
INSERT INTO `company_employer`(`employer`, `company_reg_no`, `accepted`) VALUES 
('eva@employer.com','c01',1),
('ella@employer.com','c02',1),
('emma@employer.com','c03',1),
('emily@employer.com','c04',1),
('erica@employer.com','c05',1),
('elaine@employer.com','c06',1),
('evonne@employer.com','c07',1);

--
-- jobs
--
INSERT INTO `jobs`(`job_id`, `company_reg_no`, `date_created`, `category_id`, `title`, `description`,`experience`, `skills`,`location`) VALUES 

(1,'c01', '2015-08-23 21:33:31', 1,
'Treasury Accounts Executive (Shipping Industry)',
'Our client is a global shipping conglomerate. Due to business expansion, they are currently looking for a new Treasury Accounts Executive for their Singapore office. 
<br /><br />
As a Treasury Accounts Executive, you will be manage and monitor interest rates, financial reporting, financial loans, as well as company cash-flow. Your responsibilities will call for close working relationships with banks and other related financial bodies. 
<br /><br />
To be considered for this position, the ideal candidate would have at least 2 years of working experience as a Treasury Accounts Executive within the shipping industry.', 2,'accounting', 'central'),

(2,'c01', '2015-08-23 21:33:31', 1,
'Vessel Accountant (Shipping Industry)',
'Our client is a global shipping conglomerate. Due to business expansion, they are currently looking for a new Vessel Accountant for their Singapore office. 
<br /><br />
As a Vessel Accountant, you will be tasked to manage the full sets of vessel accounts on behalf of your clients, which includes financial reporting & analysis, budgeting and forecasting, month-end closing, liaising with auditors, as well as any other ad-hoc duties as assigned. 
<br /><br />
To be considered for this position, the ideal candidate will have had at least 4 years of vessel accountancy working experience in a ship management company.', 4,'accounting', 'central'),

(3,'c01', '2015-08-23 21:33:32', 1,
'Voyage Accounting Executive (Shipping Industry)', 
'Our client is a global shipping conglomerate. Due to business expansion, they are currently looking for an Accounts Executive (Voyage Accounting Team) for their Singapore office.
<br /><br />
In this role, your responsibilities will include but will not be limited to:<br />
- Manage principal related disbursement<br />
- Be responsible for full set of voyage cost accounting <br />
- In-charge of weekly/monthly closing procedures <br />
- Maintenance of AP controls<br />
- Perform Coda Financials <br />
- Manage ad-hoc accounting functions when required
<br /><br />
In order to be considered for this position, the ideal candidate will have at least 3 years of voyage accounting experience with a shipping/ ship agency business', 3,'accounting', 'central'),

(4,'c01', '2015-08-23 21:33:33', 1,
'Vessel Accounts Executive (Shipping Industry)',
'Our client is a global shipping conglomerate. Due to business expansion, they are currently looking for a new Junior Vessel Accountant for their Singapore office. 
<br /><br />
As a Junior Vessel Accountant, you will be in-charge of leading monthly and annual closing accounts activities for the company\'s clients as well as for internal departments. You will also be involved in annual budget management and audit responsibilities. 
<br /><br />
To be considered for this position, the ideal candidate would have had at least 1 year of working experience as a Vessel Accountant at a shipping company.', 1,'accounting', 'central'),

(5,'c01', '2015-08-23 21:33:34', 1,
'Accounts Assistant (Commodity Trading Industry)',
'Our client is a global commodity trading conglomerate. Due to business expansion, they are currently looking for a new Accounts Assistant position for their Singapore office. 
<br /><br />
As an Accounts Assistant, you will be tasked to handle full-sets of accounts (Accounts Receivable/ Accounts Payable/ General Ledger) as well as financial analysis on behalf of the team, as well as assisting your manager with any adhoc duties as assigned. 
<br /><br />
To be considered for this position, the ideal candidate would have at least 1 year of working experience as an Accounts Assistant in a commodity trading business. The ideal candidate would also have had received relevant accounting accreditation (Accounting Diploma/Degree or equivalent). Possessing a working understanding of SAP will be advantageous.', 1, 'accounting', 'central'),

(6,'c02', '2015-08-30 21:33:35', 2,
'Solution Architect (Web Content Technologies)',
'As a Solution Architect, you will be the expert in web content management system technologies, building and delivering in the Online Technology space at Singtel. You will build and migrate from multiple legacy content management systems and consolidate them into a strategic system going forward. You are familiar with the responsive web and many online technologies ranging from the browser to the server side.
<br /><br />
You have previously worked in a large scale environment with many concurrent projects and designing solutions to work with product people, content producers, UX designers and business analysts to understand and flesh out requirements to implementation. You will work with testers and operational people to ensure that solutions are of high quality and can be operated easily. This is a hands-on technical role and mentoring others with your knowledge.
<br /><br />
You have experience with building and deploying with AWS or other cloud type environments and have worked in a fully automated environment. You understand how to deliver a system that can be supported and maintained. You are comfortable discussing what a typical online technology stack looks like, and you can talk about how online applications scale. You know what cloud services are, how they operate and how they are used in an online technology environment.
<br /><br />
You are comfortable having discussions with business people at various levels to negotiate scope, requirements and explain how alternative designs can deliver a better solution. You know how to ask questions in a non-technical forum and translate the answers into technical design.
<br /><br />
You can work in an agile environment, and have done test driven development. You are a stickler for quality and good design, but understand the importance of delivering business value early. You can design an incremental software development plan that can fit into a continuous delivery cycle. You understand the value of test driven development, continuous integration, continuous deployment, and regression test coverage.', 6,'web, html, html5, css, sass, javascript, js', 'central'),

(7,'c02', '2015-08-23 21:33:36', 2,
'Solution Architect (Digital Technologies)',
'As a Digital Solution Architect, you will be responsible for challenging the status quo, and bringing innovative and differentiated thinking to everything we do. You have leading digital and mobile technical competency as well as enterprise implementation experience with contemporary digital tools, offerings and products. With a background in several technologies, from CMS and CRM to ReactJS and Node, a passion for technology and web architecture will be key in keeping up and adapting to the rapidly changing environment and complex client challenges.
<br /><br />
As a Digital Architect, you will be the technical liaison with vendors, product, digital team, our strategy and user experience teams as well as leading the development teams in order to deliver quality digital solutions. You will work with testers and operational people to ensure that solutions are of high quality and can be operated easily. This is a hands-on technical role and mentoring others with your knowledge. To be considered for this position, you will have deep and broad Digital experience and a proven track record of delivering digital projects.
<br /><br />
You have proven success in architecture and technology leadership across a range of digital technologies including but not limited to Mobile/Web frameworks, Portals, Web Content Management and Collaboration platforms.
<br /><br />
You have experience with building and deploying with AWS or cloud type environment and have been worked in a fully automated environment. You have worked in a continuously BAU environment and understand how to deliver a system that can be supported and maintained.
<br /><br />
You can understand and demonstrate experience with leading dev ops practices, including tools and techniques for continuous integration / delivery. You are comfortable discussing what a typical online technology stack looks like, and you can talk about how online applications scale. You know what cloud services are, how they operate and how they are used in an online technology environment.
<br /><br />
You are comfortable having discussions with business people at various levels to negotiate scope, requirements and explain how alternative designs can deliver a better solution. You know how to ask questions in a non-technical forum and translate the answers into technical design.
<br /><br />
You can work in an agile environment, and have done test driven development. You are a stickler for quality and good design, but understand the importance of delivering business value early. You can design an incremental software development plan that can fit into a continuous delivery cycle. You understand the value of test driven development, continuous integration, continuous deployment, and regression test coverage.', 8, 'web, html, html5, css, sass, javascript, js', 'central'),

(8,'c03', '2015-09-02 21:33:37', 2,
'Web Publishing Specialist (US MNC/North)',
'Responsibilities:
<br /><br />
- Use online store content management systems to execute and maintain merchandising, and featured product content on online and mobile app platforms, ensuring accuracy while meeting aggressive deadlines.<br />
- Create and maintain documentation and drive best practices within the publishing organisation.<br />
- Identify and drive ways to improve production processes and quality of assets delivered.<br />
- Support Engineering testing and implementation of new web store features and functionality enhancements.<br />
- Resolve a wide variety of code integrity and tools issues.<br />
- Troubleshoot and resolve website issues, coordinating with internal and external teams, to drive timely resolution of customer facing and internal issues.<br />
<br /><br />
Requirements:
<br /><br />
- Possess a degree in Information Technology/Computer Science<br />
- Min 3 years experience in technology, retail, e-commerce and/or customer support organisation.<br />
- HTML and CSS proficient.<br />
- Understands e-commerce site architecture and maintenance.<br />
- Comfortable with complex database structures and queries.<br />
- Must work well in the face of aggressive deadlines, while maintaining data integrity and accuracy.<br />
- Excellent communication skills.', 1, 'html, css', 'north'),

(9,'c03', '2015-09-02 21:33:38', 2,'Web Developer (PHP/Python)',
'Job Description
<br /><br />
Write server-side Python code that powers the user interface<br />
Build new features and fix bugs<br />
Write high-quality, clean, maintainable code using engineering best practices (unit testing, source control, continuous integration, automation, design patterns, etc.)<br />
Collaborate with other software engineers, product managers, user experience designer, and operations engineers to build new web products<br />
<br />
Job Requirements
<br /><br />
Bachelor degree or higher in Computer Science or related field<br />
In-depth understanding of data structures and algorithms<br />
Familiar with at least one server side scripting language such as Python and PHP<br />
Intermediate-level knowledge of Object Oriented programming<br />
Experience with frontend technologies (HTML, CSS, Javascript)<br />
Proficient in Linux operating system, Apache/Nginx.' , 1,'html, css, php, python, linux, apache', 'west'),

(10,'c03', '2015-09-12 21:33:39', 2,
'Web Application Developer',
'Reporting to the I.T. Program Manager, you will be responsible on developing and maintaining leading edge applications and systems for Dpex Worldwide and its customers. Working effectively with the business users and with the internal IT to ensure efficiency of the solutions implemented to support the business.
<br /><br />
Responsibilities:
<br /><br />
Develop and maintain the company website<br />
Build and implement web based applications and web services that address key business challenges and opportunities<br />
Build applications based on new tools and technologies and propose new options for development and innovation<br />
Assist in support and enhancements of existing applications<br />
Perform application testing, deployment, maintenance and documentation
<br /><br />
Requirements:
<br /><br />
Experience in front-end web development and interaction design of responsive websites<br />
Strong skills in HTML, JavaScript, and CSS<br />
Deep knowledge of the .NET3.5/4.0/4.5 Framework, including C#, VB.NET, ASP.NET<br />
Experience with MS SQL related technologies including T-SQL, Stored Procedures, functions and SQL Profiler.<br />
Experience in working with and manipulating large data sets and/or databases<br />
Strong troubleshooting and debugging skills<br />
Knowledge in Adobe Creative Suite software is advantageous<br />
Team player and able to work independently with positive work attitude<br />
Good communication skills; meticulous and highly independent<br />
Diploma/Degree holder in Information discipline or relevant experience<br />
Examples of websites developed is to be provided in the resume or during interview', 2,'html, css, js, asp, asp.net, c#, vb', 'west'),

(11,'c03', '2015-09-12 21:33:40', 6,'Software Engineer (Java/J2EE)',
'Job Description
<br /><br />
Engage internal stakeholders for discussions and gathers user requirements.<br />
Performs technical solution analysis, impact analysis, application design and development.<br />
Engage in continual improvement to ensure that enhancements are built based on customers requirements.
<br /><br />
Job Requirements<br /><br />
Bachelor degree or higher in Computer Science or related field<br />
3 years experience in software development<br /><br />

Platform<br /><br />
- Java 1.5 & above<br />
- Servlet/JSP<br />
- Javascript<br />
- Struts<br />
- Spring<br />
- Hibernate 2 & above<br />
- WebSphere 7.0 & above<br />
- Oracle 10g & above<br /><br />

Environment<br /><br />
- Load balance<br />
- AIX (include shell script)<br />
- Windows<br />
- Eclipse<br />
- JDK', 3, 'java, javascript, eclipse, hibernate, oracle', 'central'),

(12,'c04', '2015-09-23 21:33:41', 3, 'HR Admin Executive',
'About the Job<br /><br />
This exciting role would require you to report to the HR Director. In this role, you will be the first point-of-contact for day to day HR operation matters. Your responsibilities include full spectrum of HR operation duties such as payroll management, recruitment, employee engagement, streamlining HR processes and involve in HR initiative projects. 
<br /><br />
Skills & Experience Required<br /><br />
To qualify for this attractive role, you must be diploma educated with at least 2 years experience in HR field.  The right candidate should possess excellent communication and interpersonal skill. ',
2,'hr', 'east'),

(13,'c04', '2015-09-23 21:33:42', 3, 
'Assistant HR Manager (Training & Development)', 
'About the job<br />
 $7000 per month + attractive benefits.<br />
 East <br />
 5 days work week<br />
<br />
Reporting to HR Manager, you will be working with the training and operation team to roll out training programs (soft skills, service development and managerial leadership training). You will be in charge of training admin coordination such as workshops & external courses. The role calls for partnering with the top management to identify strategic change opportunities and executing on the deliverables.
<br /><br />
Skills & experience required<br /><br />
The ideal incumbent first must demonstrate the core competencies of being independent, flexible, results driven and be able to work matric reporting structure. Minimum 5 years relevant experience in stand up training and facilitation of training programs .The role offers a great compensation package in return with a good working culture and reporting line to a dynamic results oriented individual. 
To apply online, please click on the appropriate link. Alternatively, please contact Kathy Wong at 65107404, quoting Ref No. 90M0208542.', 5,'hr', 'central'),

(14,'c05', '2015-09-30 21:33:43', 4,'Payroll Officer / Executive', 
'PAYROLL OFFICER / EXECUTIVE
<br /><br />
Process monthly payroll on a timely basis <br />
Prepare & submit statutory contributions such as CPF, FWL, Income Tax processing, etc<br />
Process & prepare Debit / Credit Notes, Tax Invoices & payments<br />
Handle accounts payable / receivable, assist in month end payroll closing, bank reconciliation & payroll schedules<br />
Maintain works productivity in a high pressure environment
 <br /><br />
Requirements<br /><br />
2 - 3 years of experience in processing full spectrum of payroll', 2,'admin', 'central'),

(15,'c05', '2015-09-30 21:33:44', 4,
'Executive Recruiter',
'Opportunity to work in a highly dynamic and fun environment!
 <br />
Training provided for suitable applicants! Join us today!
 <br />
Office location: Raffles Place (Central)
<br />
Attractive basic salary + Commission! 
 <br /><br />

Scope of Work:<br /><br />
Recruitment: Interviewing, screening of candidates in order to understand their job preferences<br />
Matching of talents to suitable jobs based on their individual personalities, preferences and experience<br />
Providing professional advice to candidates on career choices, target employers etc.<br />
Account management / Business Development: Cold calling and developing of key accounts<br />
Recommending recruitment solutions to clients<br />
 <br /><br />
To excel in this job, you would need:<br /><br />
Diploma / Degree in any field<br />
A strong drive to succeed<br />
Strong interpersonal and communication skills<br />
Ability to build rapport with clients', 1, 'admin', 'central'),

(16,'c06', '2015-10-01 21:33:45', 5,
'Creative Designer',
'Responsibilities:
<br /><br />
Interpret the creative brief and develop concepts  to support the business.<br />
Full creation of all divisional marketing communication material (ads, brochures, folders, banners, newsletters, logos, trade fairs etc) from the initial visual concept and creation to completion of the finished product.<br />
Build bridge between technical know how/approach and customer/end-user view/position.<br />
Use innovation to define a concept brief within the constraints of cost and time.<br />
Ensure a consistent, creative, modern, unique visual appearance while considering the different propositions and target groups.<br />
Estimate the time required to complete the work.<br />
Supervise external designers and production, with the assistance of the MarComms lead.<br />
Facilitate the development of mobile Apps for marketing purposes.<br />
Support the development and maintenance of the website.<br /><br />
Requirements:<br /><br />
3 to 5 years working experiences<br />
Excellent command of graphic programs (Illustrator, Photoshop, In-Design)<br />
Interest in both, production and creation<br />
Able to work efficiently under pressure and respect deadlines<br />
Good communication skills and able to liaise with all levels of people in organization', 3,
'photoshop, illustrator, in-design', 'central'),

(17,'c06', '2015-10-01 21:33:45', 5,
'Graphic Designer',
'Design packaging and product development for branding assigned<br />
Design of advertisement page for brands catalogue<br />
Update and maintain files for designs done so as to have a comprehensive product catalogues <br />
Visual merchandising for new stores<br />
Assist to add finishing touch to displays at events<br />
Designing of signage both for stores and major events<br />
Any other duties assigned by Senior Merchandising/ Licensing Manager<br />
 <br />
Requirements:
<br /><br />
Minimum Diploma in Visual Communication or Graphic Design<br />
Min 1 year of relevant experience<br />
Proficient in MS Office applications and design tools (ie: Adobe CS Photoshop, Illustrator, Indesign,etc)<br />
Dynamic, self-motivated with an overwhelming drive to succeed.<br />
Possess high level of creativity, integrity and trust<br />
Excellent interpersonal & communication skills<br />
Ability to work independently as well as be a team player<br />
Able to work under tight deadline<br />
Resourceful & creative with positive working attitude', 3,
'photoshop, illustrator, in-design', 'central'),

(18,'c07', '2015-10-03 21:33:45', 6,
'Customer Service (Banking/Insurance)',
'A leading Insurance firm is seeking an enthusiastic call centre staff. Join a highly motivated team and gain valuable experience and get a chance to attend trainings that will guide you to your full potential.
<br /><br />
Your key responsibilities include attending to incoming and outgoing calls, managing customer queries and supporting administrative or ad hoc duties as required. This is a Monday to Friday role with 8 hours rostered shifts between 8.30am to 8.30pm, no weekend or public holiday work..
<br /><br />
To be successful in this role the candidate should be passionate in customer service, has relevant experience working in a call centre environment and role and is able to multitask well and provide top quality service.', 0,
'photoshop, illustrator, in-design', 'central');


--
-- resumes
--
INSERT INTO `resume_profile`(`owner`, `address`, `description`, `work_history`, `edu_history`, `skills`, `location_pref`, `interest_area`) VALUES 
('john@jobseeker.com', 'Blk 14 Bedok Street 26, #16-45', 
'I love web development. In my free time I explore the various new technologies of web development. I also take some time to browse through the award winning web designs to learn from them improve my design skills.', 
'1 year as a Web Designer at Web Co.<br />Freelance Web Developer.', 'Degree in Computer Science.', 'html, css, js, php, photoshop, illustrator, in-design', 'central', 'volunteering'),

('judy@jobseeker.com', 'Blk 16 Woodlands Street 20, #06-35', 
'I am an enthusiastic team leader who is interested in human anatomy and the recovery and improvement of health. I intend to develop my knowledge and skills in healing patients in my course of study in NTU, as well as raising my management and leadership skills in planning roles in co-curricular activities. Upon graduation, I aspire to work in hospitals and health organisations to practise my technical skills and also my management skills if possible.', 
'Temporary Data Entry Assistant in eBay Singapore Service Pte Ltd ', 'Degree in Biomedical Sciences & Chinese Medicine', 'microsoft office, customer service, management, strategic planning', 'north', 'Joining a nonprofit board. Skills-based volunteering (pro bono consulting). Animal Welfare. Disaster and Humanitarian Relief. Social Services'),

('june@jobseeker.com', '50 Ghim Moh Garden', 
'A highly driven individual, with great passion in building strong teams and serving others. A strong team player with the ability to work well in teams under stressful circumstances. A player that is willing to step out of my comfort zone to achieve what needs to be done. Held several key positions as student leaders for school-wide events and co-curricular activities, with experience leading teams filled with people of diverse backgrounds and skills. ', 
'Administrative Assistant in Borneo Motors Singapore Pte Ltd', 'Bachelor of Science, Information Systems', 'java, javascript, eclipse, hibernate, oracle, Marketing Management', 'central', 'Customer service'),

('james@jobseeker.com', 'Blk 14 Sengkang Street 30, #01-31', 
'Yearns for a career that can make a difference and visible impact to businesses and the society. Eager to learn and develop, not only the technical skills, but also the soft skills of managing relationships and remaining calm and motivated, while embracing new challenges at work.', 
'Admin in City Developments Limited', 'Singapore Management University, Bachelor of Accountancy', 'microsoft office, volunteering, Client relations and communications, accounting ', 'central', 'volunteering'),

('jamie@jobseeker.com', 'Blk 10 Kallang Street 23, #04-04', 
'Firmly believes in having a co-curriculum activity, or a hobby in the midst of our pursuit for excellence in our “work” which, in phase of our life, is our studies. Believes in taking the opportunities to improve myself, be it in communication skills, people management skills, or project management etc. ', 
'Bar Assistant in Marche', 'National University of Singapore Mechanical Engineering,', 'customer services, microsoft excel, mircrosft office, microsoft powerpoint', 'central', 'interest'),

('jason@jobseeker.com', '28 Pasir Panjang Road', 
'Experienced Marketing professional in achieving business goals by translating marketing objectives on strategic product roadmap into marketing demand generation programs. Solid project management with analytical mind with 360 holistic marketing base experiences. ', 
'Business Development and Marketing Director in Emerson Process Management', 'University of Exeter
BA (Hons), Accounting and Finance', 'New Business Development, Marketing Management, accounting', 'south', 'Cycling'),

('jesse@jobseeker.com', 'Blk 498 Sengkang Street 17, #07-43', 
'Well versed in traditional above the line (ATL), below the line (BTL) as well as new age technical marketing digital techniques such as Search and Social Media Marketing (SSMM). Proven track record in optimising business return of investments (ROIs) with data driven decisions for all marketing campaigns and programs. ', 
'Business Development Director in Emerson Industrial Automation', 'Nanyang Techonological University
Bachelor of Science (B.Sc.), Maritime Studies', 'New Business Development, Marketing Management', 'central', 'Cycling'),

('jimmy@jobseeker.com', 'Blk 198 Bukit Merah Street 29, #18-01', 
'Specialise in Marketing Programmes such as: Demand Generation, Lead Generation, B2B Acquisition Marketing, Customer Retention Strategy, Product Marketing & Positioning, Integrated Digital Marketing Strategies, Content Marketing, Channel Marketing and Management, Co-Marketing Partnerships and etc.', 
'Strategic Planner in Emerson Network Power', 'University of Notre Dame - Mendoza College of Business
MBA, Diploma in Visual Communication or Graphic Design', 'six sigma, hr, admin, accounting', 'central', 'cycling, art, music'),

('jackie@jobseeker.com', '78 Seletar Avenue North, #18-07', 
'Possess 8 years of consumer marketing experience in the telecommunications, music, entertainment and FMCG industries and 4 years in business-to-business marketing with proven track records in achieving sales and marketing objectives.', 
'Product Support Engineer in Honeywell Aerospace, Account Manager, Enterprise Business Group
StarHub', 'University of Michigan
BS, Mechanical Engineering', 'Operations Management', 'north', 'social media, photography, travelling'),

('janice@jobseeker.com', 'Blk 317 Tampines Street 13, #10-37', 
'Having years of experience in product development and management, a thinker with mind full of dynamic, creative and stunning ideas, a doer with capabilities to turn innovation ideas into reality to help business achieve its goals, a learner who always has the drive to seek and learn new things. Equipped with good communication and interpersonal skills, always enjoy talking and liaising with customers to maintain a good relationship.', 
'Business Development Director (Strategy & Planning) at Component Technology, Assistant Manager, Marketing (South-East Asia)
Tyco Fire & Security', 'Essec Business School Paris
MBA', 'Marketing Strategy, Marketing Management,photoshop, illustrator, in-design', 'east', 'Marketing, Music, Travel & Discovery, Photography, Technology, Social Media and Cycling'),

('jarvis@jobseeker.com', '7 Farrer Hill, #02-30', 
'Strong interest and academic achievement in the field of Management and Health, Outstanding analytical skills developed through using research knowledge to determine impact of
health policies, identification of key issues, development of robust, well-supported recommendations', 
'Marketing Manager at Advanced Materials Technologies Pte Ltd', 'National University of Singapore Mechanical Engineer Degree', 'product management, Marketing Management, product development, product marketing', 'central', 'Economic Empowerment, Reading, Dancing'),

('jazlyn@jobseeker.com', 'Blk 28 Lorong 7 Geylang East, #07-06', 
'She is a sought-after speaker, and has traveled the world, sharing her personal story and her insights on technology, business, entrepreneurship, and how to make our lives less Dot Complicated.', 
'Solution Architect (Digital Technologies)', 'National University of Ireland, Dublin
Bachelor of Science, Marketing', 'html, css, js, asp, asp.net, c#, vb, Advertising', 'central', 'Social Media'),

('jeremy@jobseeker.com', 'Blk 350 Jurong Central Street 25, #14-03', 
'I have interest in the shipping and vessel industry. I possess high level of creativity, integrity and trust', 
'Associate Marketing Director at StarHub', 'Tunku Abdul Rahman University (UTAR)
Bachelor (Hons), Computer Science', 'Marketing Strategy, photoshop, in-design', 'west', 'Travel, Photography'),

('jerome@jobseeker.com', 'Blk 43 Kallang Street 21, #03-08', 
'Create business strategies and develop existing customer sales, marketing tools and product launching. To achieve high carrier growth through a continuous learning process and keep myself dynamic, visionary and competitive with the changing scenario of the world.', 
'Strategic Account Management, Enterprise Business Group', 'Singapore Management Unviersity MBA', 'Advertising', 'central', 'Social Media, Unified Communication'),

('jonnie@jobseeker.com', '4 Sengkang Crescent', 
'I possess excellent verbal and written communication skills and have an outgoing and pleasant personality. In previous positions, I have dealt with the general public and people from many Ethnic and Social backgrounds. I am accustomed to working in high pressure situations brought about by intense schedule and budget requirements and in on-site working environments. I have proven myself to be a team player who can provide solid and reliable support to team members as well as being able to work independently and unsupervised where the situation requires.', 
'Executive Recruiter', 'Chatsworth Medi@rt Academy, Professional Diploma, Advertising & Design (Major in Advertising)', 'E-commerce, Advertising, Business Development, Staff training & development', 'central', 'Travel, Dancing, Singing'),

('joshua@jobseeker.com', '2 Jurong East Estate', 
'I have enjoyed my work in the various positions I have held to date and have participated in a proactive and enthusiastic manner. By nature I am conscientious, reliable, flexible and co-operative. I possess good analytical and problem solving skills and am able to schedule and prioritize the workload. I have a curious nature and have a passion to learn and enrich my life.', 
'Payroll Officer / Executive', 'Management Development Institute of Singapore, endorsed by University of Bradford, UK', 'Marketing Strategy, Product Marketing, Client relations and communications ', 'west', 'Photography, New Technology, Music'),

('jasmine@jobseeker.com', 'Blk 29 Lorong 6 Jurong West, #10-09', 
'Serial start-up and consumer internet product guy. enjoys putting disruptive technology in the hands of millions. strong bias for upending stodgy old industries.', 
'Software Engineer (Java/J2EE), Web Developer (PHP/Python)', 'Seng Kang Secondary School
GCE N Level, General Studies', 'E-commerce, Product Marketing', 'west', 'Editorial Designing, New Technology, Economic Empowerment, Unified Communication'),

('jericho@jobseeker.com', 'Blk 316 Serangoon North Street 29, #02-27', 
'I was born in Sao Paulo, Brazil and graduated with a degree Economics with honors from Harvard University in 2006. I currently reside in Singapore.', 
'Treasury Accounts Executive (Shipping Industry)', 'Birmingham City University Bachelor of Arts (BA), Business Administration, Management and Operations', 'Digital Marketing, Advertising, python, linux, apache', 'central', 'Social Media, New Technology, Internet technology, Music'),

('jessica@jobseeker.com', 'Blk 17 Yishun Street 86, #11-34', 
'Internet executive with over 19 years of experience, including general management of mid to large size organizations, corporate development, product development, business operations, and strategy. ', 
'Vessel Accountant (Shipping Industry)', 'University of Bradford
Bachelor of Science (B.S.) 2nd class upper honours, Business And Management ', 'illustrator, in-design, Product Marketing, Unified Communications, admin', 'north', 'Editorial Designing, swimming, football, basketball'),

('jullian@jobseeker.com', '70 Admiralty Circle, #14-41', 
'Global management executive with more than 30 years of experience leading multi-cultural teams in complex organizations focused on energy, power, chemical, water, industrial and automotive fields. ', 
'Voyage Accounting Executive (Shipping Industry)', 'Singapore Institute of Management
Bachelors Degree, Business Administration, Management and Operations', 'Digital Marketing, Advertising', 'north', 'Cycling, Photography, New Technology, Dancing'),

('justice@jobseeker.com', 'Blk 126 Lorong 5 Joo Koon, #02-25', 
'Experience in Investment Banking, Private Equity and Project Finance. Prefer to work near Raffles Place (Central)', 
'Vessel Accounts Executive (Shipping Industry)', 'Imperial College London, MSc International Health Management, Management, Distinction', 'E-commerce, Digital Marketing, Staff training & development,Unified Communications', 'west', 'Economic Empowerment, Unified Communication, swimming, football, basketball'),

('jennifer@jobseeker.com', 'Blk 449 Clementi Street 32, #12-22', 
'I am currently trying out many languages and platforms to find out which field I am passionate in. In the present, I am currently leaned towards mobile development. I have an adequate experience in languages such as C++, Java, Python, JavaScript. I have experience in mobile development on Android, and web development as well.
From a behavioral perspective, I am also confident that I am a team player, as I have learned a lot about team dynamics due to my previous experience as leader in organizations.', 
'Solution Architect (Web Content Technologies), Accounts Assistant (Commodity Trading Industry)', 'Universitetet i Oslo / University of Oslo (UiO), Bachelor of Arts (B.A.), Health Economics and Health Management', 'Marketing Strategy, Advertising', 'west', 'Travel'),

('jonathan@jobseeker.com', 'Blk 479 Woodlands Street 39, #14-45', 
'Passionate about any kind of software development and research in computing-related field. I am interest in jobs such as Software designing and solution architect. ', 
'Web Application Developer', 'Baruch College, City University of New York (CUNY), Masters of Science, Industrial & Organizational Psychology', 'Java 1.5,
Servlet/JSP, Javascript, Struts, Spring, Product Marketing, Digital Marketing, hr', 'central', 'Cycling, Social Media'),

('joycelyn@jobseeker.com', '25 Pandan Valley View', 
'Before I began my professional career, I gained a strong 4 years of Java experience while attending Otterbein College to earn my Bachelor of Science in Computer Science. I also took classes here that sparked my passion for mobile and web development.', 
'Assistant HR Manager (Training & Development)', 'Singapore Management University, Bachelor of Business Management (Hons), Finance & Operations Management', 'Marketing Strategy, E-commerce, Staff training & development, Unified Communications', 'central', 'Unified Communication, Internet technology, Management training, public speaking, investing, cross-country skiing, swimming, football, basketball'),

('jeannette@jobseeker.com', '75 Jalan Tekad', 
'Driving international growth of Singapore companies at IE Singapore. Building and strengthening the Cambridge Business School Singapore Alumni network as the key contact in Singapore.', 
'Creative Designer', 'National University of Singapore, B.Comp, Information Systems (1st Class Honours)', 'Marketing Strategy, Client relations and communications ', 'central', 'Editorial Designing, Economic Empowerment, Internet technology, Singing'),

('jefferson@jobseeker.com', '37 Innova Heights', 
'Tie-loathing adventurer and thrill seeker, who believes in turning ideas into reality. Interested in being a creative designer. Possess excellent communication and interpersonal skill', 
'Customer Service (Banking/Insurance)', 'The University of Edinburgh e-Comerce, Conceptualising Scotland, Chemistry, Principles of Finance', 'E-commerce, Advertising, Client relations and communications, hr, admin ', 'central', 'Travel, Photography, New Technology');


--
-- Job Application
--
INSERT INTO `job_application` VALUES 
('john@jobseeker.com', 6, '2015-10-20 15:15:00'),
('janice@jobseeker.com', 16, '2015-10-25 15:15:00'),
('janice@jobseeker.com', 17, '2015-10-25 18:15:00'),
('jeremy@jobseeker.com', 16, '2015-10-26 11:15:00'),
('jeremy@jobseeker.com', 17, '2015-10-26 14:15:00'),
('james@jobseeker.com', 3, '2015-10-15 15:15:00'),
('james@jobseeker.com', 5, '2015-10-15 19:15:00'),
('jason@jobseeker.com', 3, '2015-10-18 19:00:00'),
('jason@jobseeker.com', 5, '2015-10-20 20:15:00'),
('jimmy@jobseeker.com', 3, '2015-10-19 10:30:00'),
('jimmy@jobseeker.com', 5, '2015-10-20 11:15:00');


