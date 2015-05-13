USE abbordersdb;

DROP TABLE IF EXISTS customers, products, orders, order_products;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS customers (
  customer_id INT(4) NOT NULL AUTO_INCREMENT,
  first VARCHAR(20) NOT NULL,
  last VARCHAR(30) NOT NULL,
  state ENUM('CT','MA','ME','NJ','NY','RI','VT') NOT NULL,
  dob DATE NOT NULL,
  created DATE NOT NULL,
  PRIMARY KEY (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS products (
  product_id INT(8) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS orders (
  order_id INT (10) NOT NULL AUTO_INCREMENT,
  order_date DATE NOT NULL, 
  customer_id INT(4) NOT NULL,
  PRIMARY KEY (order_id)  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS order_products (
  transaction_id INT(12) NOT NULL AUTO_INCREMENT,
  order_id INT (10) NOT NULL,
  product_id INT(8) NOT NULL,
  PRIMARY KEY (transaction_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO customers (first, last, state, dob, created) values ('James', 'Smith', 'NY', '1955-12-04',DATE_SUB(NOW(), INTERVAL 62 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Sally', 'Jones', 'MA', '1947-01-06',DATE_SUB(NOW(), INTERVAL 55 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Debra', 'Green', 'CT', '1939-10-09',DATE_SUB(NOW(), INTERVAL 51 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Daniel', 'Brown', 'NY', '1940-02-26',DATE_SUB(NOW(), INTERVAL 36 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Doris', 'Black', 'ME', '1951-01-24',DATE_SUB(NOW(), INTERVAL 34 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Teri', 'Davis', 'VT', '1960-08-14',DATE_SUB(NOW(), INTERVAL 33 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Alfred', 'White', 'NJ', '1946-04-13',DATE_SUB(NOW(), INTERVAL 31 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Arn', 'Anderson', 'CT', '1944-03-24',DATE_SUB(NOW(), INTERVAL 24 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Brett', 'Albers', 'NY', '1967-11-10',DATE_SUB(NOW(), INTERVAL 22 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Jeffrey', 'McBride', 'ME', '1924-09-09',DATE_SUB(NOW(), INTERVAL 21 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Minnie', 'Bailey', 'RI', '1971-06-27',DATE_SUB(NOW(), INTERVAL 16 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Jack', 'Pratt', 'RI', '1958-11-29',DATE_SUB(NOW(), INTERVAL 16 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Joanne', 'Windsor', 'CT', '1949-03-04',DATE_SUB(NOW(), INTERVAL 15 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Kelly', 'Wells', 'MA', '1952-08-19',DATE_SUB(NOW(), INTERVAL 12 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Marcus', 'Jones', 'NJ', '1938-05-28',DATE_SUB(NOW(), INTERVAL 11 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Fred', 'Schwartz', 'NY', '1940-07-06',DATE_SUB(NOW(), INTERVAL 5 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Rachel', 'Clark', 'NY', '1956-08-16',DATE_SUB(NOW(), INTERVAL 5 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Henry', 'Adams', 'MA', '1931-12-19',DATE_SUB(NOW(), INTERVAL 4 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Rebecca', 'Stewart', 'ME', '1926-01-14',DATE_SUB(NOW(), INTERVAL 2 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Jean', 'Evans', 'ME', '1948-06-16',DATE_SUB(NOW(), INTERVAL 1 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Tim', 'Morgan', 'ME', '1953-05-16',DATE_SUB(NOW(), INTERVAL 1 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Kathy', 'Long', 'ME', '1970-03-26',NOW());
INSERT INTO customers (first, last, state, dob, created) values ('Phillip', 'King', 'CT', '1965-12-17',NOW());
INSERT INTO customers (first, last, state, dob, created) values ('Gary', 'Ross', 'VT', '1943-10-24',NOW());

INSERT INTO products (name, price) values ('Monster Mask','16.49');
INSERT INTO products (name, price) values ('Dough Roller (Wood)','9.97');
INSERT INTO products (name, price) values ('Puzzle Book','2.99');
INSERT INTO products (name, price) values ('Half Eaten Box of Crayons','.99');
INSERT INTO products (name, price) values ('Ugly Hat','26.42');
INSERT INTO products (name, price) values ('Pair of Brown Shoes, Both Left','39.95');
INSERT INTO products (name, price) values ('Red Scarf with holes','12.99');
INSERT INTO products (name, price) values ('Real Karate Green Belt','13.26');
INSERT INTO products (name, price) values ('Yellow Exploding Yo-yo','3.99');
INSERT INTO products (name, price) values ('Furry Bulletproof Vest','1945.24');
INSERT INTO products (name, price) values ('Bad Country Music CD','11.99');
INSERT INTO products (name, price) values ('Broken Cordless Phone','29.99');
INSERT INTO products (name, price) values ('Dough Roller (Metal)','14.95');
INSERT INTO products (name, price) values ('How to Beat Pac-Man Book','3.99');
INSERT INTO products (name, price) values ('Partially Eaten Glazed Donut','.97');
INSERT INTO products (name, price) values ('Roller Skates (Size 11.5)','52.97');
INSERT INTO products (name, price) values ('Windows 98','956.87');
INSERT INTO products (name, price) values ('Apple II-C','29349.87');
INSERT INTO products (name, price) values ('Stuffed Dog','11.96');
INSERT INTO products (name, price) values ('Windowless Microwave [Still Works Great]','311.92');
INSERT INTO products (name, price) values ('Globe (Half Scale)','36.47');
INSERT INTO products (name, price) values ('Busted Guitar (Acoustic)','229.14');
INSERT INTO products (name, price) values ('Poster of Nirvana','12850.46');
INSERT INTO products (name, price) values ('Dirty Ice Cream Scoup','6.99');
INSERT INTO products (name, price) values ('Real Dinosaur Egg','17.94');
INSERT INTO products (name, price) values ('Old Mans Slippers, Almost NEW','17.94');
INSERT INTO products (name, price) values ('Book: How to Ebay Like a Rock Star','19.98');
INSERT INTO products (name, price) values ('Semi-Used Nose Ring (Stainless Steel)','36.94');
INSERT INTO products (name, price) values ('Unicycle (Flat tire)','197.65');
INSERT INTO products (name, price) values ('Sieve (Warning: Leaks like a Sieve)','17.95');

INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 43 DAY),"1");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 34 DAY),"2");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 23 DAY),"4");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 16 DAY),"6");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 15 DAY),"7");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 9 DAY),"5");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 3 DAY),"4");
INSERT INTO orders (order_date, customer_id) values (DATE_SUB(NOW(), INTERVAL 1 DAY),"13");

INSERT INTO order_products (order_id, product_id) values ("1", "22");
INSERT INTO order_products (order_id, product_id) values ("1", "13");
INSERT INTO order_products (order_id, product_id) values ("1", "12");
INSERT INTO order_products (order_id, product_id) values ("1", "23");
INSERT INTO order_products (order_id, product_id) values ("1", "1");
INSERT INTO order_products (order_id, product_id) values ("1", "4");
INSERT INTO order_products (order_id, product_id) values ("2", "6");
INSERT INTO order_products (order_id, product_id) values ("2", "21");
INSERT INTO order_products (order_id, product_id) values ("2", "17");
INSERT INTO order_products (order_id, product_id) values ("2", "16");
INSERT INTO order_products (order_id, product_id) values ("2", "15");
INSERT INTO order_products (order_id, product_id) values ("3", "4");
INSERT INTO order_products (order_id, product_id) values ("3", "5");
INSERT INTO order_products (order_id, product_id) values ("3", "9");
INSERT INTO order_products (order_id, product_id) values ("3", "11");
INSERT INTO order_products (order_id, product_id) values ("4", "22");
INSERT INTO order_products (order_id, product_id) values ("5", "25");
INSERT INTO order_products (order_id, product_id) values ("5", "13");
INSERT INTO order_products (order_id, product_id) values ("5", "1");
INSERT INTO order_products (order_id, product_id) values ("5", "3");
INSERT INTO order_products (order_id, product_id) values ("5", "14");
INSERT INTO order_products (order_id, product_id) values ("5", "16");
INSERT INTO order_products (order_id, product_id) values ("5", "11");
INSERT INTO order_products (order_id, product_id) values ("5", "20");
INSERT INTO order_products (order_id, product_id) values ("6", "19");
INSERT INTO order_products (order_id, product_id) values ("6", "4");
INSERT INTO order_products (order_id, product_id) values ("6", "14");
INSERT INTO order_products (order_id, product_id) values ("6", "24");
INSERT INTO order_products (order_id, product_id) values ("6", "16");
INSERT INTO order_products (order_id, product_id) values ("6", "23");
INSERT INTO order_products (order_id, product_id) values ("6", "1");
INSERT INTO order_products (order_id, product_id) values ("7", "12");
INSERT INTO order_products (order_id, product_id) values ("7", "7");
INSERT INTO order_products (order_id, product_id) values ("7", "16");
INSERT INTO order_products (order_id, product_id) values ("7", "18");
INSERT INTO order_products (order_id, product_id) values ("7", "2");
INSERT INTO order_products (order_id, product_id) values ("8", "4");
INSERT INTO order_products (order_id, product_id) values ("8", "13");
INSERT INTO order_products (order_id, product_id) values ("8", "15");