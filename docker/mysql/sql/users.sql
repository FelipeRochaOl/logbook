CREATE TABLE blog.users
(
    id       BIGINT auto_increment NOT NULL,
    name     varchar(180) NOT NULL,
    email    varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    CONSTRAINT users_PK PRIMARY KEY (id)
) ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;
