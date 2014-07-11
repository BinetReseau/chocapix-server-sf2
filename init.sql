INSERT INTO Bar
(`id`, `name`)
VALUES
('natationjone', 'Natation Jône'),
('avironjone', 'Aviron Jône');


INSERT INTO Role
(`id`, `name`)
VALUES
('ROLE_ADMIN', 'Admin');


INSERT INTO Account
VALUES
(1, 23.3),
(2, -10.2),
(3, 12),
(4, 11.11),
(5, 10.34),
(6, 90.23),
(7, 1.2),
(8, 9.1),
(9, 0.0),
(10, 0.0);

INSERT INTO User
(`id`, `bar_id`, `account_id`, `name`,          `login`,   `password`)
VALUES
(1, 'avironjone',   1,  'Basile Bruneau',    'bb',                  'bb'),
(2, 'avironjone',   2,  'Thomas Dupond',     'fgdfg',               'kjhiuy'),
(3, 'avironjone',   3,  'Arthur Content',    'bdfgb',               'kjhiuy'),
(4, 'avironjone',   4,  'Benjamin Fleuri',   'bsfdsb',              'kjhiuy'),
(5, 'avironjone',   5,  'Amandine Rosier',   'df.fgh',              'kjhiuy'),
(6, 'avironjone',   6,  'Edouard Twilight',  'sdfsdfsdgery.fhgfh',  'kjhiuy'),
(7, 'avironjone',   7,  'Eric LeGrand',      'dfdfdfd',             'kjhiuy'),
(8, 'avironjone',   8,  'Etienne Marrant',   '12345',               'kjhiuy'),
(9, 'natationjone', 9,  'Admin',             'admin',               'admin' ),
(10,'avironjone',   10, 'Admin',             'admin',               'admin' );

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

