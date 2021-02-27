CREATE DATABASE MobileStore;

use MobileStore;

CREATE TABLE MobileStoreDetails ( 
    mobileid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    mobilename varchar(50),
    company varchar(40),
    manufactureryear INT,
    quantitystock INT,
    price DECIMAL(10,2)

);

CREATE TABLE MobileStoreDetailsOrder ( 
mobileid INT,
orderid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
quantityorder INT,
customer_firstname varchar(100),
customer_lastname varchar(100),
CONSTRAINT mo_fk FOREIGN KEY (mobileid) REFERENCES MobileStoreDetails(mobileid)
 );

