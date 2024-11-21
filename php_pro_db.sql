CREATE TABLE parks
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    addres VARCHAR(100) NOT NULL
);

CREATE TABLE cars
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    park_id INT          NOT NULL,
    model   VARCHAR(100) NOT NULL,
    price   FLOAT        NOT NULL,

    FOREIGN KEY (park_id) REFERENCES parks (id)
);

CREATE TABLE drivers
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT          NOT NULL,
    name   VARCHAR(100) NOT NULL,
    phone  VARCHAR(20),

    FOREIGN KEY (car_id) REFERENCES cars (id)
);

CREATE TABLE customers
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL,
    phone VARCHAR(20)
);

CREATE TABLE orders
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    driver_id   INT   NOT NULL,
    customer_id INT   NOT NULL,
    start       TEXT  NOT NULL,
    finish      TEXT  NOT NULL,
    total       FLOAT NOT NULL,

    FOREIGN KEY (driver_id) REFERENCES drivers (id),
    FOREIGN KEY (customer_id) REFERENCES customers (id)
);