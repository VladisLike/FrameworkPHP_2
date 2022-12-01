CREATE TABLE products
(
    id        int      NOT NULL,
    prod_name char(20) NOT NULL,
    cost      int      NULL,
    discount  int      NULL,
    in_stock  boolean  NULL
);


#  ОПределим главные ключи (изменение стуктуры таблиц)------------
ALTER TABLE products ADD PRIMARY KEY (id);

# Заполняем данными таблицу Products 

INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (1, 'Iphone 12 mini', 400, 5.99, true);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (2, 'Iphone 13 Pro Max', 398, 8.99, false);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (3, 'Macbook 15 pro 2012', 800, 11.99, true);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (4, 'Airpods 3', 70, 3.49, false);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (5, 'Iphone XR', 290, 3.49, false);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (6, 'Airpods 3', 220, 8, true);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (7, 'Macbook Air M1', 1999, 4.99, true);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (8, 'Iphone 11', 470, 9.49, false);
INSERT INTO products(id, prod_name, cost, discount, in_stock) VALUES (9, 'Macbook Air', 2500, 9.49, false);
