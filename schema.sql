CREATE DATABASE IF NOT EXISTS yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

CREATE TABLE categories (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(150)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_register DATETIME DEFAULT CURRENT_TIMESTAMP,
  email CHAR(150),
  name CHAR(150),
  password CHAR(150),
  avatar CHAR(255),
  contacts CHAR(255)
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  name CHAR(255),
  description TEXT,
  image CHAR(255),
  price DECIMAL,
  date_end DATETIME,
  rate_step DECIMAL,
  id_creator INT,
  id_winner INT,
  id_category INT
);


CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME DEFAULT CURRENT_TIMESTAMP,
  price DECIMAL,
  id_user INT,
  id_lot INT
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX name_category ON categories(name);
CREATE INDEX name_lots ON lots(name);

ALTER TABLE bets
  ADD CONSTRAINT bets_users__fk
FOREIGN KEY (id_user) REFERENCES users (id);

ALTER TABLE bets
  ADD CONSTRAINT bets_lots__fk
FOREIGN KEY (id_lot) REFERENCES lots (id);

ALTER TABLE lots
  ADD CONSTRAINT lots_users__fk
FOREIGN KEY (id_creator) REFERENCES users (id);

ALTER TABLE lots
  ADD CONSTRAINT lots_users__win
FOREIGN KEY (id_winner) REFERENCES users (id);

ALTER TABLE lots
  ADD CONSTRAINT lots_categories__fk
FOREIGN KEY (id_category) REFERENCES categories (id);
