INSERT INTO MobileStoreDetails (DEFAULT, "Galaxy S10", "Samsung", 2019, 5, 1965.00 );
INSERT INTO MobileStoreDetails (DEFAULT, "Galaxy S21", "Samsung", 2019, 4, 1845.00 );
INSERT INTO MobileStoreDetails (DEFAULT, "One Plus 9", "BBK Electronics", 2020, 9, 1345.00 );
INSERT INTO MobileStoreDetails (DEFAULT, "One Plus 8t", "BK Electronics", 2018, 7, 1165.00 );
INSERT INTO MobileStoreDetails (DEFAULT, "Iphone 11 pro", "Apple", 2018, 9, 1865.00 );
INSERT INTO MobileStoreDetails (DEFAULT, "Iphone 10", "Apple", 2017, 4, 1865.00 );




CREATE TABLE MobileStoreDetails ( 
    mobileid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    mobilename varchar(50),
    company varchar(40),
    manufactureryear INT,
    quantitystock INT,
    price DECIMAL(10,2)

);
