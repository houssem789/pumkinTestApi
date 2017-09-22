CREATE TABLE sellers (
  id INTEGER NOT NULL PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  rating INTEGER NOT NULL
);

CREATE TABLE items (
  id INTEGER NOT NULL PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  sellerId INTEGER REFERENCES sellers(id)
);

INSERT INTO sellers(id, name, rating) values(1, 'Roger', 3);
INSERT INTO sellers(id, name, rating) values(2, 'Penny', 5);
INSERT INTO items(id, name, sellerId) values(1, 'Notebook', 2);
INSERT INTO items(id, name, sellerId) values(2, 'Stapler', 1);
INSERT INTO items(id, name, sellerId) values(3, 'Pencil', 2);

-- Each item in a web shop belongs to a different seller. To ensure service quality, each seller has a rating.
-- The data are kept in the following two tables:
--  TABLE sellers
--    id INTEGER PRIMARY KEY,
--    name VARCHAR(30) NOT NULL,
--    rating INTEGER NOT NULL
--
--  TABLE items
--    id INTEGER PRIMARY KEY,
--    name VARCHAR(30) NOT NULL,
--    sellerId INTEGER REFERENCES sellers(id)

-- Write a query that selects the item name and the name of its seller for each item that belongs to a seller with a rating of more than 4.
