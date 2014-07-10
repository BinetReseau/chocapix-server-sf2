INSERT INTO Bar
(`id`, `name`)
VALUES
('natationjone', 'Natation jone'),
('avironjone', 'Aviron Jône');


INSERT INTO Role
(`id`, `name`, `role`)
VALUES
(0, 'Admin', 'ROLE_ADMIN');


INSERT INTO Client
VALUES
(1, 23.3),
(2, -10.2),
(3, 12),
(4, 11.11),
(5, 10.34),
(6, 90.23),
(7, 1.2),
(8, 9.1);


INSERT INTO User
(`id`, `bar`, `name`, `pwd`, `login`)
VALUES
(0, 'natationjone', 'Admin', 'admin', 'admin');

INSERT INTO User
VALUES
(1, 1, 'avironjone', 'Basile Bruneau', 'kjhiuy', 'bb'),
(2, 2, 'avironjone', 'Thomas Dupond', 'kjhiuy', 'fgdfg'),
(3, 3, 'avironjone', 'Arthur Content', 'kjhiuy', 'bdfgb'),
(4, 4, 'avironjone', 'Benjamin Fleuri', 'kjhiuy', 'bsfdsb'),
(5, 5, 'avironjone', 'Amandine Rosier', 'kjhiuy', 'df.fgh'),
(6, 6, 'avironjone', 'Edouard Twilight', 'kjhiuy', 'sdfsdfsdgery.fhgfh'),
(7, 7, 'avironjone', 'Eric LeGrand', 'kjhiuy', 'dfdfdfd'),
(8, 8, 'avironjone', 'Etienne Marrant', 'kjhiuy', '12345');

INSERT INTO user_role
(`user_id`, `role_id`)
VALUES
(0, 0);



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


INSERT INTO OAuth_Client
VALUES
(1, '66itn4322bggs8wgg0o04wskskc8c4kscwckwos400g4s4ksog', 'a:0:{}', '93t2nvz00k08ks44c88oss8kss8wsc4g4o44kgogso04kg48s', 'a:1:{i:0;s:8:"password";}', 'Bars');
