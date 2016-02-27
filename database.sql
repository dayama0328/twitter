create table `tweets` (
  `id` int(11) not null,
  `user_id` int(11) not null,
  `acountname` varchar(255) not null,
  `username` varchar(255) not null,
  `content` varchar(140) not null,
  `created` datetime not null,
  `updated` datetime not null
)  ENGINE=InnoDB;

ALTER TABLE `tweets`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `tweets`
 MODIFY `id` int(11) not null AUTO_INCREMENT;


CREATE TABLE `users` (
  `id` int(11) not null,
  `acountname` varchar(255) not null,
  `username` varchar(255) not null,
  `email` varchar(255) not null,
  `password` varchar(100) not null,
  `created` datetime not null,
  `updated` datetime not null
) ENGINE=InnoDB;

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
 MODIFY `id` int(11) not null AUTO_INCREMENT;

CREATE TABLE `replys` (
  `id` int(11) not null,
  `user_id` int(11) not null,
  `tweet_id` int(11) not null,
  `acountname` varchar(255) not null,
  `username` varchar(255) not null,
  `content` varchar(255) not null,
  `created` datetime not null,
  `updated` datetime not null
) ENGINE=InnoDB;

ALTER TABLE `replys`
ADD PRIMARY KEY (`id`);

ALTER TABLE `replys`
MODIFY `id` int(11) not null AUTO_INCREMENT;

ALTER TABLE `replys`
ADD KEY `user_id` (`user_id`),
ADD KEY `tweet_id` (`tweet_id`);

ALTER TABLE `replys`
ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`),
ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

insert into replies (id, user_id, tweet_id, acountname, username, content, created, updated) values (1, 15, 35, "motherhouse", "マザーハウス", "返信テスト", now(), now());

ALTER table users add status int(11) not null after username;
ALTER table users add regist_code varchar(255) not null after status;



