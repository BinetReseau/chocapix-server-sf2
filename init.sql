INSERT INTO `Bar`
(`id`, `name`)
VALUES
('natationjone', 'Natation jone');


INSERT INTO `Role`
(`id`, `name`, `role`)
VALUES
(1, 'User', 'ROLE_USER');

INSERT INTO `User`
(`id`, `bar`, `name`, `pwd`, `login`)
VALUES
(1, 'natationjone', 'Admin', 'admin', 'admin');

INSERT INTO `user_role`
(`user_id`, `role_id`)
VALUES
(1, 1);


INSERT INTO `StockItem`
(`bar`, `name`, `qty`, `unit`, `price`, `tax`)
VALUES
('natationjone', 'Chocolat', 20, 'g', 0.1, 0),
('natationjone', 'Pain', 40, 'g', 0.2, 0);


INSERT INTO `OAuth_Client` (`id`, `random_id`, `redirect_uris`, `secret`, `allowed_grant_types`, `name`) VALUES
(1, '66itn4322bggs8wgg0o04wskskc8c4kscwckwos400g4s4ksog', 'a:0:{}', '93t2nvz00k08ks44c88oss8kss8wsc4g4o44kgogso04kg48s', 'a:1:{i:0;s:8:"password";}', 'Bars');

