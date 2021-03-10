  CREATE DATABASE awr_database;

  USE awr_database;

  CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(225),
    password VARCHAR(225),
    username VARCHAR(225),
    firstname VARCHAR(225),
    middlename VARCHAR(225),
    lastname VARCHAR(225),
    suffix VARCHAR(225)
  );

  CREATE TABLE IF NOT EXISTS address (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    house_number VARCHAR(225),
    street VARCHAR(225),
    brgy VARCHAR(225),
    city VARCHAR(225),
    user_id INT(6) UNSIGNED, FOREIGN KEY (user_id) REFERENCES users(id)
  );

  CREATE TABLE IF NOT EXISTS currentuser (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED, FOREIGN KEY (user_id) REFERENCES users(id)
  );

  CREATE TABLE IF NOT EXISTS categories (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255)
  );

  CREATE TABLE IF NOT EXISTS prices (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    price INT(10)
  );

  CREATE TABLE IF NOT EXISTS colors (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    color VARCHAR(255)
  );

  CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    img_dir VARCHAR(225),
    name VARCHAR(255),
    color_id INT(6) UNSIGNED, FOREIGN KEY (color_id) REFERENCES colors(id),
    price_id INT(6) UNSIGNED, FOREIGN KEY (price_id) REFERENCES prices(id),
    category_id INT(6) UNSIGNED, FOREIGN KEY (category_id) REFERENCES categories(id),
    stock INT(6)
  );

  CREATE TABLE IF NOT EXISTS cart (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    qty INT(6),
    price INT(6),
    product_id INT(6) UNSIGNED, FOREIGN KEY (product_id) REFERENCES products(id),
    user_id INT(6) UNSIGNED, FOREIGN KEY (user_id) REFERENCES users(id),
    checkedOut INT(1)
  );

  CREATE TABLE IF NOT EXISTS logo (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    logo_dir VARCHAR(255)
  );

  INSERT INTO logo (logo_dir)
  VALUES
    ('https://i.imgur.com/gRkhOwT.png'),
    ('https://i.imgur.com/8VHbopk.png'),
    ('https://i.imgur.com/uz4CfMp.png'),
    ('https://i.imgur.com/1tNJ5aW.png');

  INSERT INTO categories (category)
  VALUES
    ('Logo Tees'),
    ('Script Tees'),
    ('Graphic Tees');

   INSERT INTO prices (price)
   VALUES
    (350),
    (450),
    (550);

  INSERT INTO colors (color)
  VALUES
    ('Black'),
    ('Navy Blue'),
    ('White'),
    ('Maroon');

  INSERT INTO products (img_dir, name, color_id, price_id, category_id, stock)
  VALUES
  	('https://i.imgur.com/BU70Crq.jpg', 'AWR Logo Tee V1', 1, 1, 1, 6),
  	('https://i.imgur.com/vVC1O9P.jpg', 'AWR Logo Tee V2', 2, 1, 1, 8),
  	('https://i.imgur.com/F8VuXyF.jpg', 'AWR Logo Tee V3', 3, 1, 1, 5),
  	('https://i.imgur.com/zOWRgYW.jpg', 'AWR Script Tee V1', 1, 2, 2, 9),
  	('https://i.imgur.com/8gpI2DX.jpg', 'AWR Script Tee V2', 2, 2, 2, 4),
  	('https://i.imgur.com/6wvoKFK.jpg', 'AWR Script Tee V3', 3, 2, 2, 6),
  	('https://i.imgur.com/a7hSIdX.jpg', 'AWR Tebigots', 3, 3, 3, 5),
  	('https://i.imgur.com/J6TPMFx.jpg', 'AWR Tsikot', 3, 3, 3, 7),
  	('https://i.imgur.com/5BllqK7.jpg', 'AWR Too Busy Doing Nothing', 1, 3, 3, 8),
  	('https://i.imgur.com/Edg5djr.jpg', 'AWR Brainless Genius', 4, 3, 3, 6),
  	('https://i.imgur.com/YFoZBRJ.jpg', 'AWR Toxic Talksick', 3, 3, 3, 8);
