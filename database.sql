CREATE DATABASE resume_registry DEFAULT CHARACTER SET utf8;
USE resume_registry;

GRANT ALL ON resume_registry.* TO 'root'@'localhost' IDENTIFIED BY 'srm';
GRANT ALL ON resume_registry.* TO 'root'@'127.0.0.1' IDENTIFIED BY 'srm';

CREATE TABLE users (
	user_id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(128),
	email VARCHAR(128),
	`password` VARCHAR(128),

	PRIMARY KEY (user_id),
	INDEX (email),
    INDEX (`password`)
) ENGINE = InnoDB;

CREATE TABLE profiles (
    profile_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    image_url TEXT,
    first_name TEXT,
    last_name TEXT,
    email TEXT,
    headline TEXT,
    summary TEXT,

    PRIMARY KEY (profile_id),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE positions (
    position_id INTEGER NOT NULL AUTO_INCREMENT,
    profile_id INTEGER,
    rank INTEGER,
    `year` INTEGER,
    description TEXT,

    PRIMARY KEY (position_id),
    FOREIGN KEY (profile_id) REFERENCES profiles (profile_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE institution (
	institution_id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),

	UNIQUE (name),
    PRIMARY KEY (institution_id)
) ENGINE = InnoDB;

CREATE TABLE education (
    profile_id INTEGER,
    institution_id INTEGER,
    rank INTEGER,
    year INTEGER,

    FOREIGN KEY (profile_id) REFERENCES profiles (profile_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (institution_id) REFERENCES institution (institution_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY (profile_id, institution_id)

) ENGINE = InnoDB;

INSERT INTO users (name, email, `password`)
    VALUES ('UMSI', 'umsi@umich.edu', '1a52e17fa899cf40fb04cfc42e6352f1');
INSERT INTO users (name, email, `password`)
    VALUES ('Chuck', 'csev@umich.edu', '1a52e17fa899cf40fb04cfc42e6352f1');

