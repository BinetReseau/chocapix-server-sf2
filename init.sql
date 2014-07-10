INSERT INTO Bar
(`id`, `name`)
VALUES
('natationjone', 'Natation Jône'),
('avironjone', 'Aviron Jône');


INSERT INTO Role
(`id`, `name`, `role`)
VALUES
(1, 'Admin', 'ROLE_ADMIN');


INSERT INTO Client
VALUES
(1, 23.3),
(2, -10.2),
(3, 12),
(4, 11.11),
(5, 10.34),
(6, 90.23),
(7, 1.2),
(8, 9.1),
(9, 0.0);

INSERT INTO User
(`id`, `bar`, `client_id`, `name`,           `login`,   `pwd`)
VALUES
(1, 'avironjone',   1,  'Basile Bruneau',    'bb',                  'kjhiuy'),
(2, 'avironjone',   2,  'Thomas Dupond',     'fgdfg',               'kjhiuy'),
(3, 'avironjone',   3,  'Arthur Content',    'bdfgb',               'kjhiuy'),
(4, 'avironjone',   4,  'Benjamin Fleuri',   'bsfdsb',              'kjhiuy'),
(5, 'avironjone',   5,  'Amandine Rosier',   'df.fgh',              'kjhiuy'),
(6, 'avironjone',   6,  'Edouard Twilight',  'sdfsdfsdgery.fhgfh',  'kjhiuy'),
(7, 'avironjone',   7,  'Eric LeGrand',      'dfdfdfd',             'kjhiuy'),
(8, 'avironjone',   8,  'Etienne Marrant',   '12345',               'kjhiuy'),
(9, 'natationjone', 9,  'Admin',             'admin',               'admin' );

INSERT INTO user_role
(`user_id`, `role_id`)
VALUES
(9, 1);



INSERT INTO StockItem
(`bar`, `name`, `qty`, `unit`, `price`, `tax`)
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


-- INSERT INTO OAuth_Client
-- (`id`, `random_id`, `redirect_uris`, `allowed_grant_types`, `name`)
-- VALUES
-- (1, '66itn4322bggs8wgg0o04wskskc8c4kscwckwos400g4s4ksog', 'a:0:{}', 'a:1:{i:0;s:8:"password";}', 'Bars');
