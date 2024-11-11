SELECT * FROM the_social_network.members;
SELECT * FROM the_social_network.members WHERE user_id='$user_id';

SELECT * FROM the_social_network.friends WHERE (user_id='$user_id' AND friend_id='$friend_id') OR (user_id='$friend_id' AND friend_id='$user_id');
SELECT * FROM the_social_network.friends WHERE user_id='$user' OR friend_id='$user';


SELECT * FROM the_social_network.messages WHERE id='$id';
SELECT * FROM the_social_network.messages WHERE (author_id='$user_id' AND recipent_id='$friend_id') OR (author_id='$friend_id' AND recipent_id='$user_id');
-- DELETE FROM the_social_network.messages WHERE id='$id';

SELECT * FROM the_social_network.profiles WHERE profile_id='$user_id';

SELECT * FROM the_social_network.friend_requests WHERE sender_id='$user_id'   AND receiver_id='$friend_id';
SELECT * FROM the_social_network.friend_requests WHERE sender_id='$friend_id' AND receiver_id='$user_id';
SELECT * FROM the_social_network.friend_requests WHERE receiver_id='$id';




