USE GP25;

DROP TABLE IF EXISTS MANAGER_GP1 CASCADE;
DROP TABLE IF EXISTS PRODUCT_GP1 CASCADE;
DROP TABLE IF EXISTS BALANCE_GP1 CASCADE;
DROP TABLE IF EXISTS TRANSACTION_GP1 CASCADE;
DROP TABLE IF EXISTS EMPLOYEE_GP1 CASCADE;

CREATE TABLE EMPLOYEE_GP1(
    UserID VARCHAR(50) NOT NULL,
    EmpName VARCHAR(50) NOT NULL,
    GroupNO INT NOT NULL,
    Password VARCHAR(20) NOT NULL,
    PRIMARY KEY (UserID)
);

CREATE TABLE MANAGER_GP1(
    MgrName VARCHAR(50) NOT NULL,
    UserID VARCHAR(50) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    PRIMARY KEY (UserID)
);

CREATE TABLE PRODUCT_GP1(
    ProductName VARCHAR(50) NOT NULL,
    PointsRequired INT NOT NULL,
    Quantity INT Default 0,
    PRIMARY KEY (ProductName)
);

CREATE TABLE BALANCE_GP1(
    UserID VARCHAR(50) NOT NULL,
    InitialBalance INT NOT NULL,
    Balance INT NOT NULL,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserID) REFERENCES EMPLOYEE_GP1(UserID)
);

CREATE TABLE TRANSACTION_GP1(
    TransactionID INT AUTO_INCREMENT,
    UserID VARCHAR(50) NOT NULL,
    TransactionDate DATE NOT NULL,
    TransactionType VARCHAR(50) NOT NULL,
    TransactionItem VARCHAR(50),
    TransactionPoints INT NOT NULL,
    PRIMARY KEY (TransactionID),
    FOREIGN KEY (UserID) REFERENCES EMPLOYEE_GP1(UserID)
);

-- Insert employees
INSERT INTO EMPLOYEE_GP1 (UserID, EmpName, GroupNO, Password) VALUES
('Joyce', 'Joyce English', 5, 'English'),
('Ahmad', 'Ahmad Jabbar', 5, 'Jabbar'),
('Andy', 'Andy Vile', 7, 'Vile'),
('Jill', 'Jill Jarvis', 8, 'Jarvis'),
('Billie', 'Billie King', 8, 'King');

-- Insert manager
INSERT INTO MANAGER_GP1 (MgrName, UserID, Password) VALUES
('Evan Wallis', 'Evan', 'Wallis');

-- Insert products
INSERT INTO PRODUCT_GP1 (ProductName, PointsRequired, Quantity) VALUES
('Mug', 100, 3),
('T-shirt (one size)', 650, 1),
('Backpack', 250, 1);

-- Insert balance records
INSERT INTO BALANCE_GP1 (UserID, InitialBalance, Balance) VALUES
('Joyce', 0, 0),
('Ahmad', 500, 500),
('Andy', 100, 100),
('Jill', 1000, 1000),
('Billie', 300, 300);

