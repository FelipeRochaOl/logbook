CREATE TABLE blog.categories (
	id BIGINT auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	CONSTRAINT categories_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;