INSERT INTO the_social_network.user VALUES('$user', '$hash', '$bdate', '$date', '$text');

INSERT INTO the_social_network.friend_request (sender_id, receiver_id, status, status_change_date) VALUES ('$friend_id', '$user_id', 'Sent', '$date');
-- DELETE FROM the_social_network.friend_request WHERE sender_id = '$user_id'   AND receiver_id = '$friend_id';
-- DELETE FROM the_social_network.friend_request WHERE sender_id = '$friend_id' AND receiver_id = '$user_id';

INSERT INTO the_social_network.message (author_id, chat_id, date, message) VALUES ('$user', '$chat', '$date', '$message');

/* ------------------------------------------------ */

INSERT INTO the_social_network.user (username, birth_date, registration_date)
VALUES ('john_doe', '1990-01-01', '2024-01-01');
INSERT INTO the_social_network.user (username, birth_date, registration_date, about_me)
VALUES ('jane_doe', '1992-05-15', '2024-01-02', 'Loves hiking and photography.');

INSERT INTO the_social_network.user_data (user_id, hash_pass)
VALUES (1, '$2y$10$eZMQ0hVjsfH8HbgdRuzKbeyS6PbznVFiUzIc3SAGj2pkZYK5ZcBSa');

INSERT INTO the_social_network.chat_info (chat_name)
VALUES ('Project Discussion');

INSERT INTO the_social_network.chat (chat_id, user_id)
VALUES (1, 1);
INSERT INTO the_social_network.chat (chat_id, user_id)
VALUES (1, 2);

INSERT INTO the_social_network.message (author_id, chat_id, date, message)
VALUES (1, 1, '2024-01-01 10:00:00+00', 'Hello everyone!');
INSERT INTO the_social_network.message (author_id, chat_id, date, message)
VALUES (2, 1, '2024-01-01 10:05:00+00', 'Hi John!');

INSERT INTO the_social_network.friend_request (sender_id, receiver_id, status, status_change_date)
VALUES (1, 2, 'Sent', '2024-01-01');
INSERT INTO the_social_network.friend_request (sender_id, receiver_id, status, status_change_date)
VALUES (1, 2, 'Denied', '2024-01-02');

INSERT INTO the_social_network.group (group_name, founder_id, topic)
VALUES ('Book Club', 2, 'Reading');

INSERT INTO the_social_network.group_administrator (group_id, admin_id)
VALUES (12, 1);  -- Назначение пользователя с user_id = 1 администратором группы с group_id = 1.

INSERT INTO the_social_network.post (group_id, author_id, publication_date, publication_text)
VALUES (2, 2, '2024-01-02', 'Our first book discussion is scheduled for next Thursday.');

INSERT INTO the_social_network.group_member (group_id, user_id)
VALUES (1, 1);
INSERT INTO the_social_network.group_member (group_id, user_id)
VALUES (1, 2);



