INSERT INTO Bar
(`id`, `name`)
VALUES
('natationjone', 'Natation Jône'),
('avironjone', 'Aviron Jône');


INSERT INTO Role
(`id`, `name`)
VALUES
('ROLE_ADMIN', 'Admin');

INSERT INTO User
(`id`, `bar_id`, `name`,          `login`,   `password`)
VALUES
(1, 'avironjone',    'Basile Bruneau',    'bb',                  'bb'),
(2, 'avironjone',    'Thomas Dupond',     'fgdfg',               'kjhiuy'),
(3, 'avironjone',    'Arthur Content',    'bdfgb',               'kjhiuy'),
(4, 'avironjone',    'Benjamin Fleuri',   'bsfdsb',              'kjhiuy'),
(5, 'avironjone',    'Amandine Rosier',   'df.fgh',              'kjhiuy'),
(6, 'avironjone',    'Edouard Twilight',  'sdfsdfsdgery.fhgfh',  'kjhiuy'),
(7, 'avironjone',    'Eric LeGrand',      'dfdfdfd',             'kjhiuy'),
(8, 'avironjone',    'Etienne Marrant',   '12345',               'kjhiuy'),
(9, 'natationjone',  'Admin',             'admin',               'admin' ),
(10,'avironjone',    'Admin',             'admin',               'admin' );
INSERT INTO Account
VALUES
(1, 1, 23.3),
(2, 2, -10.2),
(3, 3, 12),
(4, 4, 11.11),
(5, 5, 10.34),
(6, 6, 90.23),
(7, 7, 1.2),
(8, 8, 9.1),
(9, 9, 0.0),
(10, 10, 0.0);
INSERT INTO user_role
(`user_id`, `role_id`)
VALUES
(1, 'ROLE_ADMIN'),
(9, 'ROLE_ADMIN'),
(10, 'ROLE_ADMIN');



INSERT INTO StockItem
(`bar_id`, `name`, `qty`, `unit`, `price`, `tax`)
VALUES
('natationjone', 'Chocolat', 20, 'g', 0.1, 0),
('natationjone', 'Pain', 40, 'g', 0.2, 0),
('avironjone', 'Pizza', 4, '', 3.34, 0),
('avironjone', 'Tomates', 40, '', 0.4, 0),
('avironjone', 'Fromage', 1.34, 'kg', 7.1, 0),
('avironjone', 'Galettes', 4, '', 0.4, 0),
('avironjone', 'Yaourt', 8, '', 0.67, 0),
('avironjone', 'Pates', 12.34, 'kg', 1.23, 0),
('avironjone', 'Steak', 20, '', 0.87, 0);

