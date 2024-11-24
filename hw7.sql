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
    phone  VARCHAR(30),

    FOREIGN KEY (car_id) REFERENCES cars (id)
);

CREATE TABLE customers
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL,
    phone VARCHAR(30)
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


#####################1########################
CREATE TABLE test
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    test TEXT NOT NULL
);


DROP TABLE test;

#####################2#######################
CREATE TABLE test
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    test TEXT NOT NULL
);

ALTER TABLE test
    MODIFY test VARCHAR(100);
ALTER TABLE test
    CHANGE test colum1 INT;
#####################3#######################
DROP TABLE test;
#####################3#######################

INSERT INTO parks (addres) VALUE
    ('Parking Garage A: 15 Independence Avenue'),
    ('Parking Garage B: 22 Freedom Street'),
    ('Parking Garage C: 5 Unity Lane'),
    ('Parking Garage D: 10 Victory Boulevard'),
    ('Parking Garage E: 3 Liberty Road');



INSERT INTO cars (model, price, park_id)
VALUES ('Tesla Model S', 120.5, 1),
       ('BMW X5', 100.3, 2),
       ('Audi A6', 85.7, 3),
       ('Mercedes-Benz C-Class', 90.9, 3),
       ('Toyota Camry', 55, 5);



INSERT INTO drivers (car_id, name, phone) VALUE
    (1, 'John Smith', '+1-555-123-4567'),
    (2, 'Jane Doe', '+1-555-234-5678'),
    (3, 'Michael Johnson', '+1-555-345-6789'),
    (4, 'Emily Davis', '+1-555-456-7890'),
    (5, 'Sarah Wilson', '+1-555-567-8901');



INSERT INTO customers (name, phone) VALUE
    ('John Smith', '+1-555-123-4567'),
    ('Jane Doe', '+1-555-234-5678'),
    ('Michael Johnson', '+1-555-345-6789'),
    ('Emily Davis', '+1-555-456-7890'),
    ('Sarah Wilson', ' +1-555-567-8901');



INSERT INTO orders (driver_id, customer_id, start, finish, total) VALUE
    (1, 5, '2024-11-01 08:00', '2024-11-01 16:00', 8),
    (3, 2, '2024-11-01 08:00', '2024-11-01 16:00', 8.5),
    (2, 4, '2024-11-01 08:00', '2024-11-01 16:00', 7),
    (5, 1, '2024-11-01 08:00', '2024-11-01 16:00', 9),
    (4, 3, '2024-11-01 08:00', '2024-11-01 16:00', 6);

#####################4#######################

UPDATE customers
SET phone = '+1-999-999-999'
WHERE id = 1;

#####################5#######################

CREATE TABLE test
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    tests TEXT NOT NULL
);
INSERT INTO test (tests) VALUE ('test text');
DELETE
FROM test
WHERE id = 1;

#####################6#######################

SELECT *
FROM customers;
SELECT *
FROM cars
WHERE price > 90;
SELECT *
FROM drivers
WHERE name = 'John Smith';

#####################7#######################

SELECT c.model AS name, d.phone, d.name
FROM cars c
         LEFT JOIN drivers d ON c.id = d.car_id;

#####################8#######################

ALTER TABLE test
    ADD value INT;
ALTER TABLE test
    MODIFY value FLOAT;
ALTER TABLE test
    CHANGE value text VARCHAR(10);
ALTER TABLE test
    DROP text;




