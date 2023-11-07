CREATE TABLE blog.posts (
	id BIGINT auto_increment NOT NULL,
	title varchar(100) NOT NULL,
	category_id BIGINT NOT NULL,
	date_publication DATE NOT NULL,
	content LONGTEXT NOT NULL,
	image varchar(150) NOT NULL,
	CONSTRAINT posts_PK PRIMARY KEY (id),
	CONSTRAINT posts_FK FOREIGN KEY (category_id) REFERENCES blog.categories(id) ON DELETE RESTRICT ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;

