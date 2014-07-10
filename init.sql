INSERT INTO `symfony`.`Bar`
(`id`, `name`)
VALUES
('natationjone', 'Natation jone');


INSERT INTO `symfony`.`StockItem`
(`bar`, `name`, `qty`, `unit`, `price`, `tax`)
VALUES
('natationjone', 'Chocolat', 20, 'g', 0.1, 0),
('natationjone', 'Pain', 40, 'g', 0.2, 0);
