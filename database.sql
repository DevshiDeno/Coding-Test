CREATE TABLE loan (
    id INT PRIMARY KEY,
    Borrower_name VARCHAR(255),
    Loan_amount DECIMAL(10, 2),
    Interest_type VARCHAR(50),
    Loan_period INT,
    bank VARCHAR(100),
    Monthly_Installment DECIMAL(10, 2),
    Payment_frequency VARCHAR(50),
    start_date DATE,
    take_home_amount DECIMAL(10, 2)
);
CREATE TABLE admin (
    id INT PRIMARY KEY,
    admin VARCHAR(255),
    password VARCHAR(255)
);